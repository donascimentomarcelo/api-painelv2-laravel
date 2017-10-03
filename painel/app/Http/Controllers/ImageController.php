<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\ImageRequest;
use Painel\Http\Requests\OrderImageRequest;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;
use Painel\Services\ImageService;
use Painel\Services\ProjectService;


class ImageController extends Controller
{
    private $uploadsRepository;
    private $projectsRepository;
    private $imageService;
    private $projectService;

    public function __construct(UploadsRepository $uploadsRepository, ProjectsRepository $projectsRepository, ImageService $imageService, ProjectService $projectService)
    {
        $this->uploadsRepository = $uploadsRepository;
        $this->projectsRepository = $projectsRepository;
        $this->imageService = $imageService;
        $this->projectService = $projectService;
    }

    public function editImage($id)
    {
        return $this->uploadsRepository->find($id);
    }

    public function updateImage(Request $request)
    {
        $id = $request->id;
        $files = Input::file('file');
        $validator = $this->projectService->validateFiles($files);
        if($validator->fails()){
            return 3;
        }
        $dataImage = $this->uploadsRepository->skipPresenter()->find($id);

        $return['img'] = $this->projectService->updateImage($files, $id, $dataImage);

        $return['project'] = $this->returnToEdit($id);

        return $return;

    }

    public function destroyImage($id)
    {
        $upload = $this->uploadsRepository->skipPresenter()->find($id);

        $this->projectService->removeUpload($upload);

        $id_project = $upload->projects->id;

        $projects = $this->projectsRepository->find($id_project);

        return $projects;
    }

    public function saveImage(Request $request)
    {
        $id = $request->id;
        $files = Input::file('file');
        // $validator = $this->projectService->validateFiles($files);
        //   if($validator->fails()){
        //     $return['status'] = 3;
        //     return $return;
        //   }
        
        $this->projectService->save($files, $id);

        $return['return'] = $this->projectsRepository->find($id);
        $return['status'] = 1;

        return $return;

    }

    public function returnToEdit($id)
    {
        $uploads = $this->uploadsRepository->skipPresenter()->find($id);

        $id_project = $uploads->projects->id;

        return $projects = $this->projectsRepository->find($id_project);
    }

    public function updateOrder(Request $request)
    {
        $this->imageService->updateSingleImage($request);
    }
   
}
