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
    protected $files_to_donwload;
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


    private function addFilesToDownload($path, $type = 'results')
    {
        $files = $this->file->allFiles($path);

        foreach ($files as $result) {
            $this->files_to_donwload[$type][] = array(
                'name' => $result->getFilename(),
                'size' => round($result->getSize() / 1048576, 2),
                'created_date' => Carbon::createFromTimeStamp($result->getMTime())->format('l jS \d\e F Y h:i:s A'),
                'to_download' => \Crypt::encrypt($result->getRealpath()),
            );

        }
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

        $paths = array(
            'results' => storage_path() . "/jobs/" . $job->id . "/results",
            'logs' => storage_path() . "/jobs/" . $job->id . "/logs",
        );

        foreach ($paths as $type => $path) {
            $this->addFilesToDownload($path, $type);
        }

        $files = $this->files_to_donwload;

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
        $manager->createJobFolder('logs');
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
        if (Request::ajax()) {
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

            $log_file = $jobDirectory . "logs/$result_name" . "_logs.txt";
            $error_file = $jobDirectory . "logs/$result_name" . "_errors.txt";
            $executable = $job->executable->path;

            if ($job->executable->type == 'js') {
                $command = "node $executable $entry_path $results &> $log_file &2> $error_file &";
            }
            if ($job->executable->type == 'java') {
                $command = "java -jar $executable $entry_path $results &> $log_file &2> $error_file &";
            }

            SSH::run(
                array(
                    "cd $jobDirectory",
                    $command,
                    "chown hpcfront:apache $log_file && chown hpcfront:apache $error_file",
                    "chmod 764 $log_file && chmod 764 $error_file"
                ), function ($line) {
                    $this->ssh_output = $line . PHP_EOL;
                }
            );
            //dd('hola');
            return Response::json(
                array(
                    'success' => true,
                    'log' => \Crypt::encrypt($log_file),
                    'log_errors' => \Crypt::encrypt($log_file),
                    'output' => $this->ssh_output,
                )
            );
        }
    }

    public function downloadResult($result)
    {
        return Response::download(\Crypt::decrypt($result));
    }

    public function showOutputs($log_file)
    {
        //dd($log_file);
        $file = \Crypt::decrypt($log_file);
        //dd($file);
        $data = file($file);
        dd($data);
        $line = $data[count($data) - 1];

        return Response::json($line);
    }

}
