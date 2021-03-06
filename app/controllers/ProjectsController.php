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
        $projects = $this->projectRepository->getAllUserProjects(Auth::user()->username);

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
        $manager = new CreateProjectManager(new Project(), Input::instance());
        $manager->save();
        $new_project_url = URL::route('projects.show', $manager->getEntity()->id);

        return Redirect::route('projects.index')
            ->with('success', $new_project_url);

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->findWithAllJobsInformation($id);

        return View::make('projects.show', compact(array('project')));

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

        $manager = new UpdateProjectManager($project, Input::instance());
        $manager->save();

        $updated_project_name = $manager->getEntity()->name;

        return Redirect::route('projects.index')
            ->with('updated', $updated_project_name);
        ;

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

        return Response::json(true);

    }
}
