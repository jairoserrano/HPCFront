<?php

use HPCFront\Managers\JobManager;
use HPCFront\Managers\UpdateJobManager;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Entities\Job;

class JobsController extends \BaseController {

    protected $jobTypes;
    protected $jobsRepository;

    function __construct( JobsRepository $jobsRepository)
    {
        $this->jobsRepository =  $jobsRepository;
        $this->jobTypes = array(
            'java' => 'Java',
            'php' => 'PHP',
            'python' => 'Python',
            'bash' => 'Bash'
        );
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function newJob($id)
	{
		$types = $this->jobTypes;
        $project_id = $id;
        return View::make('jobs.create', compact(array('types', 'project_id')));
	}

    public function runJob($id){
        $job = $this->jobsRepository->find($id);
        $jobs = $this->jobsRepository->getList();
        return View::make('jobs.run', compact(array('jobs', 'job')));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $manager = new JobManager(new Job(), Input::all());
        $manager->save();
        return Redirect::route('projects.show', array(Input::get('project_id')));

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
