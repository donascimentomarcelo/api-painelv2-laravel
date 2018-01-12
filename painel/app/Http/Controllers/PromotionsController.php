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
        $data = $request->all();

        $data['responsable'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;

        return $this->promotionsRepository->create($data);

    }

    public function update(Request $request)
    {
        return $this->promotionsRepository->update($request->all(), $request->id);
        
    }

    public function delete($id)
    {
        return $this->promotionsService->destroy($id);
    }

    public function edit($id)
    {
        return $this->promotionsRepository->find($id);
    }

    public function image()
    {
        return view('admin.promotions.image');
    }

    public function addNewImage(Request $request)
    {
        // return Input::file('file');
        $id = $request->id;

        $res = $this->promotionsService->countImage($id);

        if($res->result == 0)
        {
            $this->promotionsService->saveUpload(Input::file('file') ,$id);
            
            return $this->promotionsRepository->find($id); 
        }
        else
        {
            $return['status'] = 4;
            $return['message'] = 'Essa promoção já possui uma imagem vinculada.';
            return $return;
        }

        // foreach ($request->file('file')as $key) {
        //    echo '<pre>';
        //    echo($key);
        //    echo '</pre>';
        // }
    }

    public function updateImage(Request $request)
    {
        $data = $this->uploadspromotionsRepository->skipPresenter()->find($request->id);

        $this->promotionsService->updateImage($request->id, Input::file('file'), $data);
        
        return  $this->getNewImage($request->id); 
    }

    public function getNewImage($id)
    {
        $image = $this->uploadspromotionsRepository->skipPresenter()->find($id);

        return $this->promotionsRepository->find($image->promotions->id);
    }
}
