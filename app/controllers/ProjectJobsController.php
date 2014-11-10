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
        if(Request::ajax()){
            $job = $this->jobsRepository->find($id);
            $jobDirectory = storage_path() . "/jobs/" . $job->id . "/";
            $entry_path = '';
            $result_name = Carbon::now()->timestamp;
            $results = '';
            $command = '';

            if (Input::get('no_entry') || Input::get('entry_id') == '0') {
                $entryId = Input::get('entry_id');
                $entry_path = Input::get('entry_id') > 0 ? $this->entriesRepository->findJobEntry($id, $entryId)->path : '';
                $results = $jobDirectory . "results/$result_name";
            }

            $log_file = $jobDirectory . "logs/$result_name"."_logs.txt";
            $error_file = $jobDirectory . "logs/$result_name"."_errors.txt";
            $executable = $job->executable->path;

            if ($job->executable->type == 'js') {
                $command = "node $executable $entry_path $results >> $log_file &";
            }
            if ($job->executable->type == 'java') {
                $command = "java -jar $executable $entry_path $results &> $log_file &2> $error_file &";
            }
            //dd($command);
            SSH::run(
                array(
                    "cd $jobDirectory",
                    $command,
                ), function($line){
                    $this->ssh_output = $line.PHP_EOL;
                }
            );
            dd('hola');
            return Response::json(
                array(
                    'success' => true,
                    'log' => \Crypt::encript($log_file),
                    'log_errors' => \Crypt::encrypt($log_file),
                )
            );
        }
    }

    public function downloadResult($result)
    {
        return Response::download(\Crypt::decrypt($result));
    }

    public function showResults($logs){

    }

}
