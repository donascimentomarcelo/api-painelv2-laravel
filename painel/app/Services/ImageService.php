<?php

namespace Painel\Services;

// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;
use Painel\Repositories\UploadsRepository;

class ImageService
{
	
	public function __construct(UploadsRepository $uploadsRepository)
	{
		$this->uploadsRepository = $uploadsRepository;
	}

	public function updateMultipleImage($request)
	{
		foreach ($request->ordernation as $key) {

			Uploads::where('id', $key['id'])->update(['order'=>$key['order']]);
		}
		return;		
	}

	public function updateSingleImage($request)
	{
		$order = $request->order;
		$id    = $request->id;

		try {

			Uploads::where('id', $id)->update(['order'=>$order]);
			
		} catch (Exception $e) {

			throw $e;
			
		}
	}

}