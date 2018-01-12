<?php

namespace Painel\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;
// use Painel\Models\Uploadspromotions;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;



class UploadService 
{
  private $uploadsRepository;
  private $projectsRepository;

  public function __construct(UploadsRepository $uploadsRepository, ProjectsRepository $projectsRepository)
  {
    $this->uploadsRepository = $uploadsRepository;
    $this->projectsRepository = $projectsRepository;
  }

    public function validateFiles($files)
    {
        foreach($files as $file) {
          $rules = array('file' => 'required|mimes:png,jpeg,jpg'); 
          $validator = Validator::make(array('file'=> $file), $rules);
         return $validator;
        }
    }

    public function validateFile($file)
    {
      $rules = array('file' => 'required|mimes:png,jpeg,jpg'); 
      $validator = Validator::make(array('file'=> $file), $rules);
      return $validator;
    }

    public function way()
    {
        // return 'http://marceloprogrammer.com/api/uploads/project/';
        return 'http://localhost:8000/uploads/';
    }

    public function doUpload($files, $entityManager)
    {
        $file_count = count($files);
        $uploadcount = 0;
          foreach($files as $file) {
            
              $destinationPath = 'uploads';
              $filename = $file->getClientOriginalName();

              $filename = $this->renameFile($filename);
              $upload_success = $file->move($destinationPath, $filename);
              
              $uploadcount ++;

              $extension = $file->getClientOriginalExtension();
              $entry = $entityManager;
              $entry->mime = $file->getClientMimeType();
              $entry->original_filename = $filename;
              $entry->filename = $file->getFilename().'.'.$extension;
              
              $entry->way = $this->way();

              $entry->order = $uploadcount;


              $arr[] = $entry;
              
          }
      
        return $arr;
    }

    public function singleUpload($file, $entityManager)
    {
       $destinationPath = 'uploads';
       $filename = $file->getClientOriginalName();

       $filename = $this->renameFile($filename);
       $upload_success = $file->move($destinationPath, $filename);

       $extension = $file->getClientOriginalExtension();
       $entry = $entityManager;
       $entry->mime = $file->getClientMimeType();
       $entry->original_filename = $filename;
       $entry->filename = $file->getFilename().'.'.$extension;

       $entry->way = $this->way();

       $arr[] = $entry;

       return $arr;
    }


    public function renameFile($filename)
    {
      $file_name_pieces = explode(".",  $filename);
      $length = 20;
      $key = '';
      $keys = array_merge(range(0, 9), range('a', 'z'), range(111, 999));
          for ($i = 0; $i < $length; $i++) 
          {
            $key .= $keys[array_rand($keys)];
          }
      $new_file_name = $key;
      $newname = $new_file_name.'.'.$file_name_pieces[1];

      return $newname;
    }
    
    public function removeUpload($upload, $entityResult)
    // essa função deleta a imagem do repositório e dps vai na tabela upload e deleta o registro de la tb de acordo com o original filename
    {
      try {

        $this->destroyImageInStorage($upload);

        $entityResult->delete();

        return 1;

      } catch (Exception $e) {

        throw $e;
      
      }

    }

    public function destroyImageInStorage($image)
    {
      File::delete('uploads/'.$image->original_filename);

      return;
    }
}