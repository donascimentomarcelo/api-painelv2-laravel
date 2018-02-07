<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Repositories\PromotionsRepository;
use Painel\Repositories\UploadspromotionsRepository;
use Painel\Services\ProjectService;
use Painel\Services\PromotionsService;
use Painel\Services\UploadService;



class BIController extends Controller
{
    private $promotionsRepository;
    private $uploadspromotionsRepository;
    private $projectService;
    private $promotionsService;
    private $uploadService;

    public function __construct(PromotionsRepository $promotionsRepository, UploadspromotionsRepository $uploadspromotionsRepository, ProjectService $projectService,PromotionsService $promotionsService, UploadService $uploadService)
    {
        $this->promotionsRepository = $promotionsRepository;
        $this->uploadspromotionsRepository = $uploadspromotionsRepository;
        $this->projectService = $projectService;
        $this->promotionsService = $promotionsService;
        $this->uploadService = $uploadService;
    }

    public function countProject()
    {
        
    }

}
