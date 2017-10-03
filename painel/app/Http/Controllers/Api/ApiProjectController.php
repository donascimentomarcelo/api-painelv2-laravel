<?php

namespace Painel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\RegisterEmailRequest;
use Painel\Repositories\ProjectsRepository;
use Painel\Services\EmailService;


class ApiProjectController extends Controller
{
    private $projectRepository;
    private $emailService;

    public function __construct(ProjectsRepository $projectRepository, EmailService $emailService)
    {
        $this->projectRepository = $projectRepository;
        $this->emailService = $emailService;
    }


    public function ApiListProject()
    {
        $projects = $this->projectRepository->all();

        return $projects;
    }

    public function create(RegisterEmailRequest $request)
    {

        $res = $this->emailService->emailConfirmation($request->all());

        return $res;
   
    }
}
