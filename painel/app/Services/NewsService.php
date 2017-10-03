<?php

namespace Painel\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Painel\Models\News;
use Painel\Repositories\NewsRepository;
use Painel\Services\ProjectService;
use Painel\Services\UploadService;

class NewsService 
{
	private $newsRepository;
	private $projectService;
	private $uploadService;

	public function __construct(NewsRepository $newsRepository, ProjectService $projectService, UploadService $uploadService)
	{
		$this->newsRepository = $newsRepository;
		$this->projectService = $projectService;
		$this->uploadService = $uploadService;
	}

	public function createNews($request)
	{
		$files = Input::file('images');

		if($files[0] != null)
		{
			$entityManager = new News();
			$returnFiles = $this->uploadService->doUpload($files, $entityManager);

			foreach ($returnFiles as $entry) 
			{
				$entry->title = $request['title'];
				$entry->description = $request['description'];
				$entry->subject = $request['subject'];
			}
			unset($entry['order']);
			// Unset exclui a coluna order do array retornado do metodo doUpload

			$entry->save();

			return $entry;
		}
		else
		{
			return $this->newsRepository->create($request);
		}


	}

	public function updateNews($request, $id)
	{
		
		$files = Input::file('images');

		if($files[0] != null)
		{
			$dataFile = $this->newsRepository->find($id);
			
				if(!empty($dataFile['original_filename']))
				{
					$this->uploadService->destroyImageInStorage($dataFile);
				}
			$entityManager = new News();
			$entrys = $this->uploadService->doUpload($files, $entityManager);
			
			foreach ($entrys as $entry) {	
				$arr = array(
					'title' =>$request['title'],
					'description' =>$request['description'],
					'subject' =>$request['subject'],
					'mime'=>$entry->mime,
					'original_filename'=>$entry->original_filename,
					'filename'=>$entry->filename,
					'way'=>$entry->way,
					);
			}

			News::where('id', $id)->update($arr);

			return $arr;
		}
		else
		{
			return $this->newsRepository->update($request, $id);
		}
	}

	public function destroyImageRepository($dataFile)
    {
      File::delete('uploads/'.$dataFile['original_filename']);

      return;
    }

	
}
