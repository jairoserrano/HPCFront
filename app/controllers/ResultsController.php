<?php

use HPCFront\Entities\Result;
use HPCFront\Repositories\ResultsRepository;

class ResultsController extends \BaseController {

    protected $resultsRepository;

    function __construct(ResultsRepository $resultsRepository)
    {
        $this->resultsRepository = $resultsRepository;
    }


    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        return Redirect::route('projects.show', array(Input::get('project_id')));
    }


    public function destroy($id)
    {
        Result::destroy($id);
        return Redirect::route('projects.show', array(Input::get('project_id')));
    }

    public function getFile($id)
    {
        return Response::download($this->resultsRepository->find($id)->path);
    }

}
