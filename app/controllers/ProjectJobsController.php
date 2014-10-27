<?php

use HPCFront\Managers\FilesManager;
use HPCFront\Managers\JobManager;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Repositories\EntriesRepository;
use HPCFront\Repositories\ExecutableRepository;
use HPCFront\Entities\Job;
use Illuminate\Filesystem\Filesystem as File;
use Carbon\Carbon;

class ProjectJobsController extends \BaseController
{

    protected $jobsRepository;
    protected $entriesRepository;
    protected $projectsRepository;
    protected $executableRepository;
    protected $file;
    protected $ssh_output;

    function __construct(
        JobsRepository $jobsRepository,
        EntriesRepository $entriesRepository,
        ExecutableRepository $executableRepository,
        File $filesystem
    )
    {
        $this->jobsRepository = $jobsRepository;
        $this->entriesRepository = $entriesRepository;
        $this->file = $filesystem;
        $this->executableRepository = $executableRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($project_id, $job_id)
    {
        $job = $this->jobsRepository->getWithAllTheInformation($job_id);
        $path = storage_path() . "/jobs/" . $job->id . "/results";

        $results = $this->file->allFiles($path);

        $files = array();

        foreach ($results as $result) {
            $files[] = array(
                'name' => $result->getFilename(),
                'size' => round($result->getSize() / 1048576, 2),
                'created_date' => Carbon::createFromTimeStamp($result->getMTime())->format('l jS \d\e F Y h:i:s A'),
                'to_download' => \Crypt::encrypt($result->getRealpath()),
            );

        }
        return View::make('jobs.show', compact(array('job', 'files', 'project_id')));

    }

    public function create($project_id)
    {
        $executables = $this->executableRepository->listAll();
        return View::make('jobs.create', compact(array('project_id', 'executables')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($project_id)
    {

        $manager = new JobManager(new Job(), Input::instance());
        $manager->save();
        $manager->createJobFolder('results');
        $manager->createJobFolder('entries');

        return Redirect::route('projects.show', array($project_id));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($project_id, $job_id)
    {
        $job = $this->jobsRepository->find($job_id);
        $executables = $this->executableRepository->listAll();


        return View::make('jobs.edit', compact('job', 'executables', 'project_id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $job_id
     * @return Response
     */
    public function update($project_id, $job_id)
    {
        $job = $this->jobsRepository->find($job_id);

        $manager = new JobManager($job, Input::instance());
        $manager->save();

        return Redirect::route('project.jobs.show', array($project_id, $job_id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $job_id
     * @return Response
     */
    public function destroy($project_id, $job_id)
    {
        if (Request::ajax()) {

            $file = new File();
            $job = Job::find($job_id);
            $job_folder = storage_path() . "/jobs/" . $job->id;

            $file->deleteDirectory($job_folder);

            Job::destroy($job_id);

            return Response::json(true);
        }
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

        $jobDirectory = public_path() . "/jobs/" . $job->id . "/";
        $result_name = Carbon::now();
        $results = $jobDirectory . "results/$result_name";

        //dd("java -jar $job->executable $entry->path $results");
        SSH::run(array(
            "cd $jobDirectory",
            "java -jar $job->executable $entry->path $results",
        ), function ($line) {
            $this->ssh_output = $line . PHP_EOL;
        });


        return Redirect::route('jobs.show', array($id))
            ->with(array('output' => $this->ssh_output));
    }

    public function downloadResult($result)
    {
        return Response::download(\Crypt::decrypt($result));
    }

}
