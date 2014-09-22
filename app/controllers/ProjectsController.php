<?php

use HPCFront\Repositories\ProjectRepository;
use HPCFront\Managers\CreateProjectManager;
use HPCFront\Managers\UpdateProjectManager;
use HPCFront\Entities\Project;

class ProjectsController extends \BaseController
{

    protected $projectRepository;

    function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = $this->projectRepository->all();

        return View::make('projects.index', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('projects.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $manager = new CreateProjectManager(new Project(), Input::all());
        $manager->save();
        return Redirect::route('projects.index');

	}


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->find($id);

        return View::make('projects.edit', compact('project'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $project = $this->projectRepository->find($id);

        $manager = new UpdateProjectManager($project, Input::all());
        $manager->save();

        return Redirect::route('projects.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return Redirect::route('projects.index');

    }
}
