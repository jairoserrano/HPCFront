<?php

use HPCFront\Managers\EntryManager;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Repositories\EntriesRepository;
use HPCFront\Entities\Entry;

class EntriesController extends \BaseController {

    protected $jobsRepository;
    protected $entriesRepository;
    function __construct(JobsRepository $jobsRepository, EntriesRepository $entriesRepository)
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
        if (Input::hasFile('path'))
        {
            $file = Input::file('path');
            $destinationPath = public_path()."/files/";
            $filename = $file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            $input['path'] = $upload_success;
        }

        $manager = new EntryManager(new Entry(), $input);
        $manager->save();

        return Redirect::route('projects.show', array(Input::get('project_id')));
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
        Entry::destroy($id);
        return Redirect::route('projects.show', array(Input::get('project_id')));
	}

    public function getFile($id)
    {
        return Response::download($this->entriesRepository->find($id)->path);
    }
}
