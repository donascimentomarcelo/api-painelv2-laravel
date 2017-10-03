<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Repositories\PromotionsRepository;
use Painel\Repositories\UploadspromotionsRepository;
use Painel\Services\ProjectService;
use Painel\Services\PromotionsService;
use Painel\Services\UploadService;



class PromotionsController extends Controller
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


    public function index()
    {
        return view('admin.promotions.list');
    }


    public function store(Request $request)
    {
        return view('admin.promotions.create');
    }

    public function show()
    {
        return $this->promotionsRepository->all();
    }

    public function create(Request $request)
    {
        $files = Input::file('file');
        // return $this->promotionsService->validatePromotions($request->all());
        
        $validator = $this->uploadService->validateFiles($files);
        if($validator->fails())
        {
            $error['message'] = 'Só serão aceitas imagens no formato jpg, jpeg e png.';
            $error['status'] = 333;
            return $error;
        }
        $id = $this->promotionsRepository->skipPresenter()->create($request->all());
        $response = $this->promotionsService->saveUpload($files, $id);
        return json_encode($response);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete($id)
    {
        
    }
}
