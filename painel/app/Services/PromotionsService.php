<?php 

namespace Painel\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploadspromotions;
use Painel\Repositories\PromotionsRepository;
use Painel\Repositories\UploadspromotionsRepository;
use Painel\Services\UploadService;
// use Painel\Models\Uploads;
// use Painel\Repositories\UploadsRepository;
/**
* 
*/
class PromotionsService 
{
	private $promotionsRepository;
	private $uploadService;
	private $uploadspromotionsRepository;

	
	public function __construct(PromotionsRepository $promotionsRepository, UploadService $uploadService, UploadspromotionsRepository $uploadspromotionsRepository)
	{
		$this->promotionsRepository = $promotionsRepository;
		$this->uploadService = $uploadService;
		$this->uploadspromotionsRepository = $uploadspromotionsRepository;
	}

	public function saveUpload($files, $id)
	{
		if(is_object($id))
		{
			$id = $id->id;
		}

		$entityManager = new Uploadspromotions();
		$arr = $this->uploadService->singleUpload($files, $entityManager);

		foreach ($arr as $entry) 
		{
			$entry->promotions_id = $id;
			$entry->save();	
		}


		$result = $this->promotionsRepository->find($id);

		$result['status'] = 1;

		return $result;
	}

	public function countImage($value)
	{
		$id = (int)$value;

		$result = DB::table('uploadspromotions')
                     ->select(DB::raw('count(*) as result'))
                     ->where('promotions_id', '=', $value)
                     ->first();
                     
		return $result;
	}

	public function updateImage($id, $file, $data)
	{
		$this->uploadService->destroyImageInStorage($data);

		$entityManager = new Uploadspromotions();
		
		$arr = $this->uploadService->singleUpload($file, $entityManager);

		foreach ($arr as $key) 
		{
			$key =  array(
					'filename' => $key->filename ,
					'original_filename' => $key->original_filename,
					'mime'=>$key->mime,
				);
		}
		Uploadspromotions::where('id', $id)->update($key);		

		return $this->uploadspromotionsRepository->find($id);	
	}

	public function destroy($id)
	{
		$return = DB::table('uploadspromotions')->where('promotions_id', $id)->get();
		
		if(count($return) > 0)
		{
			foreach ($return as $key)
			{
				$returnResult = Uploadspromotions::where('original_filename', $key->original_filename);

				$this->uploadService->removeUpload($key, $returnResult);
			}
		}
		$this->promotionsRepository->delete($id);
		return 1;
	}
}
 ?>