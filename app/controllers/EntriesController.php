<?php

use HPCFront\Managers\CreateEntriesManager;
use HPCFront\Managers\UpdateEntriesManager;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Repositories\EntriesRepository;
use HPCFront\Entities\Entry;
use HPCFront\Managers\FilesManager;

class EntriesController extends \BaseController
{

    protected $jobsRepository;
    protected $entriesRepository;

    function __construct(JobsRepository $jobsRepository,
                         EntriesRepository $entriesRepository)
    {
        $this->entriesRepository = $entriesRepository;
        $this->jobsRepository = $jobsRepository;
    }


    /**
     * Show the form for creating a new resource.
     * @param int $id
     * @return Response
     */
    public function newEntry($id)
    {
        $job = $this->jobsRepository->find($id);
        return View::make('entries.create', compact('job'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $project_id =  Input::get('project_id');
        $job_id =  Input::get('job_id');

        if (Input::hasFile('path')) {
            $path = public_path()."/files/projects/".$project_id."/jobs/".$job_id."/entries/";
            $file = new FilesManager($path, Input::file('path'));
            $input['path'] = $file->getFilePath();
        }

        $manager = new CreateEntriesManager(new Entry(), $input, true, 'path');
        $manager->save();

        return Redirect::route('jobs.show', array(Input::get('job_id')));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $entry = $this->entriesRepository->find($id);

        return View::make('entries.edit', compact('entry'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $entry = $this->entriesRepository->find($id);

        $input = Input::all();

        if (Input::hasFile('path')) {
            $path = public_path()."/files/projects/".$entry->job->project->id."/jobs/".$entry->job->id."/entries/";
            $file = $file = new FilesManager($path, Input::get('path'));
            $input['path'] = $file->getFilePath();
        } else {
            $input['path'] = $entry->path;
        }

        $manager = new UpdateEntriesManager($entry, $input);
        $manager->save();
        return Redirect::route('jobs.show', array(Input::get('job_id')));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Entry::destroy($id);
        return Redirect::route('jobs.show', array(Input::get('job_id')));
    }

    public function getFile($id)
    {
        return Response::download($this->entriesRepository->find($id)->path);
    }
}
