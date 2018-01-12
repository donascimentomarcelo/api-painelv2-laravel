<?php

namespace Painel\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;
use Painel\Services\UploadService;


class ProjectService 
{
  private $uploadsRepository;
  private $projectsRepository;
  private $uploadService;

  public function __construct(UploadsRepository $uploadsRepository, ProjectsRepository $projectsRepository, UploadService $uploadService)
  {
    $this->uploadsRepository = $uploadsRepository;
    $this->projectsRepository = $projectsRepository;
    $this->uploadService = $uploadService;
  }

    public function save($files, $id)
    {
        if(is_object($id))
        {
          $id = $id->id;
        }

        
        $arr = $this->doUpload($files);
        foreach($arr as $entry)
        {
          $entry->projects_id = $id;
          $entry->save();
        }

        $result = $this->projectsRepository->find($id);

        $result['status'] = 1;

        return $result;
    }

    public function doUpload($files)
    {
        $file_count = count($files);
        $uploadcount = 0;
          foreach($files as $file) {
            
              $destinationPath = 'uploads';
              $filename = $file->getClientOriginalName();
              $filename = $this->uploadService->renameFile($filename);
              $upload_success = $file->move($destinationPath, $filename);
              
              $uploadcount ++;
              $extension = $file->getClientOriginalExtension();
              $entry = new Uploads();
              $entry->mime = $file->getClientMimeType();
              $entry->original_filename = $filename;
              $entry->filename = $file->getFilename().'.'.$extension;
              
              $entry->way = $this->uploadService->way();
              $entry->order = $uploadcount;
              $arr[] = $entry;
              
          }
      
        return $arr;
    }

    public function updateImage($files, $id, $dataImage)
    {
         $this->uploadService->destroyImageInStorage($dataImage);

         $entityManager = new Uploads();
         $arr = $this->uploadService->doUpload($files, $entityManager);

         foreach ($arr as $key) {
          $key = array(
            'filename' => $key->filename,
            'original_filename'=> $key->original_filename,
            'mime'=> $key->mime,
            );

          Uploads::where('id', $id)->update($key);
         }

         return  $this->uploadsRepository->find($id);

    }

    public function deleteImageAndProject($id)
    {

      $data = DB::table('uploads')->where('projects_id', $id)->get();
      // verificar qtdd d valores retornados na consulta. Se for zero, n entra no foreach

      if(count($data) > 0)
      {
        foreach ($data as $key)
        {
          $returnResult = Uploads::where('original_filename', $key->original_filename);

          $this->uploadService->removeUpload($key, $returnResult);
        }
      }
      
      $this->projectsRepository->delete($id);
      
      return 1;

    }

    public function removeUpload($upload)
    // essa função deleta a imagem do repositório e dps vai na tabela upload e deleta o registro de la tb de acordo com o original filename
    {
      try {

        $this->uploadService->destroyImageInStorage($upload);

        Uploads::where('original_filename', $upload->original_filename)->delete();

        return 1;

      } catch (Exception $e) {

        throw $e;
      
      }

    }

    public function validateFiles($files)
    {
        foreach($files as $file) {
          $rules = array('file' => 'required|mimes:png,jpeg,jpg'); 
          $validator = Validator::make(array('file'=> $files), $rules);
         return $validator;
        }
    }

    public function validateProject(array $project)
    {
      $validator = Validator::make($project,[
        'name'       =>'required|max:50',
        'category'   =>'required|max:50',
        'link'       =>'required|max:50',
        'description'=>'required|max:255'
        ], [
        'required' => 'O campo :attribute é obrigatório!',
        ], [
        'name'        => 'Nome',
        'category'    => 'Categoria',
        'link'        => 'Link',
        'description' => 'Descrição'

        ]);
      if($validator->fails()){
            $error['message'] = $validator->messages();
            $error['status'] = 333;
            return $error;
        }
    }
}