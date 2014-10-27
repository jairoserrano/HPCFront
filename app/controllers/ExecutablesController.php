<?php

use HPCFront\Entities\Executable;
use HPCFront\Repositories\ExecutableRepository;
use HPCFront\Managers\CreateExecutableManager;
use HPCFront\Managers\UpdateExecutableManager;

class ExecutablesController extends BaseController {

    protected $executable;
    protected $executableRepository;

    function __construct(Executable $executable, ExecutableRepository $executableRepository)
    {
        $this->executable = $executable;
        $this->executableRepository = $executableRepository;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $executables = $this->executableRepository->all();
		return View::make('executables.index', compact(array('executables')));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $types = $this->getJobTypes();
		return View::make('executables.create', compact('types'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$manager = new CreateExecutableManager($this->executable, Input::instance());
        $manager->save();

        return Redirect::route('executables.index');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $executable = $this->executableRepository->find($id);
        $types = $this->getJobTypes();

        return View::make('executables.edit', compact(array('executable', 'types')));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $executable = $this->executableRepository->find($id);

        $manager = new UpdateExecutableManager($executable, Input::instance());
        $manager->save();

        return Redirect::route('executables.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->executable->destroy($id);

        return Response::json(true);
    }

    public function downloadFile($id)
    {
        return Response::download($this->executableRepository->find($id)->path);
    }


}
