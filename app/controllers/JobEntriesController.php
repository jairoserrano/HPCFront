<?php

use HPCFront\Managers\CreateEntriesManager;
use HPCFront\Managers\UpdateEntriesManager;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Repositories\EntriesRepository;
use HPCFront\Entities\Entry;
use HPCFront\Managers\FilesManager;

class JobEntriesController extends \BaseController
{

    protected $jobsRepository;
    protected $entriesRepository;
    protected $entry;

    function __construct(JobsRepository $jobsRepository,
                         EntriesRepository $entriesRepository,
                         Entry $entry)
    {
        $this->entriesRepository = $entriesRepository;
        $this->jobsRepository = $jobsRepository;
        $this->entry = $entry;
    }


    /**
     * Show the form for creating a new resource.
     * @param int $id
     * @return Response
     */
    public function create($project_id, $job_id)
    {
        $job = $this->jobsRepository->find($job_id);
        return View::make('entries.create', compact('job', 'project_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($project_id, $job_id)
    {


        $manager = new CreateEntriesManager($this->entry, Input::instance());
        $manager->save();

        return Redirect::route('project.jobs.show', array($project_id, $job_id));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($project_id, $job_id, $entry_id)
    {
        $entry = $this->entriesRepository->find($entry_id);

        return View::make('entries.edit', compact(array('project_id', 'job_id', 'entry')));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($project_id, $job_id, $entry_id)
    {
        $entry = $this->entriesRepository->find($entry_id);

        $manager = new UpdateEntriesManager($entry, Input::instance());
        $manager->save();

        return Redirect::route('project.jobs.show', array($project_id, $job_id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($project_id, $job_id, $entry_id)
    {
        $this->entry->destroy($entry_id);

        return Redirect::route('project.jobs.show', array($project_id, $job_id));
    }

    public function getFile($entry_id)
    {
        return Response::download($this->entriesRepository->find($entry_id)->path);
    }
}
