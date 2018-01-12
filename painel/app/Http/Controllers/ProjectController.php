<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\ImageRequest;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;
use Painel\Services\ProjectService;
use Painel\Services\UploadService;

class ProjectController extends Controller
{  
    private $projectService;
    private $projectRepository;
    private $uploadRepository;
    private $uploadService;

    public function __construct(ProjectService $projectService, ProjectsRepository $projectRepository, UploadsRepository $uploadRepository, UploadService $uploadService)
    {
        $this->projectService = $projectService;
        $this->projectRepository = $projectRepository;
        $this->uploadRepository = $uploadRepository;
        $this->uploadService = $uploadService;
    }
     public function createProject()
    {
        return view('admin.project.create-project');
    }

    public function saveProject(Request $request)
    {
        
        $return = $this->projectRepository->create($request->all());
        // dd($id);
        // $response = $this->projectService->save($files, $id);

        // $return['status'] = 1;

        return $return;
    }


    public function updateProject(Request $request)
    {
        $id = $request->id;
        
        $this->projectRepository->update($request->all(), $id);

        $response = $this->projectRepository->find($id);

        $response['status'] = 1;

        return $response;
    }

    public function project()
    {
        return view('admin.project.list-project');
    }

    public function listProject()
    {
        return $this->projectRepository->all();        
    }

    public function edit($id)
    {
        return $this->projectRepository->edit($id);

    }
    public function editProject()
    {
         return view('admin.project.edit-project');
    }

    public function destroyProject($id)
    {
        $return = $this->projectService->deleteImageAndProject($id);
        
        return json_encode($return);
    }

   

}
