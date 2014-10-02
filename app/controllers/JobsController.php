<?php

use HPCFront\Managers\FilesManager;
use HPCFront\Managers\CreateJobManager;
use HPCFront\Managers\UpdateJobManager;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Repositories\EntriesRepository;
use HPCFront\Entities\Job;

class JobsController extends \BaseController
{

    protected $jobsRepository;
    protected $entriesRepository;
    protected $projectsRepository;
    protected $ssh_output;

    function __construct(JobsRepository $jobsRepository,
                         EntriesRepository $entriesRepository)
    {
        $this->jobsRepository = $jobsRepository;
        $this->entriesRepository = $entriesRepository;
        $this->setJobTypes();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $lastJobId = $this->jobsRepository->getLastJob();

        $projectId = Input::get('project_id');
        $path = public_path() . "/files/projects/" . $projectId . "/jobs/" . ($lastJobId + 1) . "/";
        if (Input::hasFile('executable')) {
            $file_path = new FilesManager($path, Input::file('executable'));
            $input['executable'] = $file_path->getFilePath();
        }

        $manager = new CreateJobManager(new Job(), $input);
        $manager->save();

        File::makeDirectory($path.'/results');
        File::makeDirectory($path.'/entries');

        return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $job = $this->jobsRepository->getWithAllTheInformation($id);
        $path = public_path() . "/files/projects/" . $job->project->id . "/jobs/" . $job->id . "/results";

        $results = File::allFiles($path);
        $files = array();
        foreach($results as $result){
            $files[] = array(
                'name' => $result->getFilename(),
                'size' => round($result->getSize() / 1048576, 2),
                'to_download' => $result->getRealpath(),
            );

        }
        return View::make('jobs.show', compact(array('job', 'files')));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $job = $this->jobsRepository->find($id);
        $types = $this->jobTypes;

        return View::make('jobs.edit', compact('job', 'types'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $job = $this->jobsRepository->find($id);
        $input = Input::all();
        $path = public_path() . "/files/projects/" . $job->project->id . "/jobs/" . $id . "/";
        if (Input::hasFile('executable')) {
            $file_path = new FilesManager($path, Input::file('executable'));
            $input['executable'] = $file_path->getFilePath();
        } else {
            $input['executable'] = $job->executable;
        }

        $manager = new UpdateJobManager($job, $input);
        $manager->save();

        return Redirect::route('jobs.show', array($id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Job::destroy($id);
        return Redirect::route('projects.show', array(Input::get('project_id')));
    }
    /**
     * Show the form for creating a new resource.
     * @param $id Job id
     * @return Response
     */
    public function newJob($id)
    {
        $types = $this->jobTypes;
        $project_id = $id;
        return View::make('jobs.create', compact(array('types', 'project_id')));
    }

    public function runJob($id)
    {
        $job = $this->jobsRepository->find($id);
        $entries = $this->entriesRepository->getJobEntriesList($id);
        return View::make('jobs.run', compact(array('job', 'entries')));
    }

    public function executeJob($id)
    {
        //dd(Input::all());
        $entryId = Input::get('entry_id');

        $job = $this->jobsRepository->find($id);
        $entry = $this->entriesRepository->findJobEntry($job->id, $entryId);

        $jobDirectory = public_path()."/files/projects/".$job->project->id."/jobs/".$job->id."/";
        $results = $jobDirectory."results/";

        SSH::run(array(
            "cd $jobDirectory",
            "java -jar $job->executable $entry->path $results",
        ), function($line){
            $this->ssh_output = $line.PHP_EOL;
        });


        return Redirect::route('jobs.show', array($id))->with(array('output' => $this->ssh_output));
    }

    public function downloadResult(){
        dd($result);
        Response::download();
    }

}
