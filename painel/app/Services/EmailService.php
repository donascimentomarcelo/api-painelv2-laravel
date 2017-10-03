<?php

namespace Painel\Services;

use Illuminate\Support\Facades\Mail;
use Painel\Repositories\EmailRepository;
use Painel\Models\Email;

class EmailService 
{
	private $emailRepository;

	public function __construct(EmailRepository $emailRepository)
	{
		$this->emailRepository = $emailRepository;
	}

	public function sendService($request)
	{
		$description = $request['description'];
		$subject = $request['subject'];
		$title = $request['title'];

		$emails = $this->emailRepository->EmailByStatus();


		if(empty($request->mime) || empty($request->original_filename) || empty($request->filename))
		{
			$arr = array(
				'title'=>$title,
				'subject'=>$subject,
				'description'=>$description,
				);

			foreach ($emails as $email) 
			{

				$send = Mail::send('email.email-multiple', $arr, function($message) use($email, $subject)
				{
					$message->to($email)->subject($subject);

					$message->from('marcelojunin2010@hotmail.com', 'Marcelo Nascimento');
				});

			}

			return;
		}
		else
		{
			$arr = array(
				'title'=>$title,
				'subject'=>$subject,
				'description'=>$description,
				'mime'=>$request->mime,
				'original_filename'=>$request->original_filename,
				'filename'=>$request->filename,
				'way'=>$request->way
				);
			
			foreach ($emails as $email) 
			{

				$send = Mail::send('email.email-multiple-with-image', $arr, function($message) use($email, $subject)
				{
					$message->to($email)->subject($subject);

					$message->from('marcelojunin2010@hotmail.com', 'Marcelo Nascimento');
				});

			}

			return;
		}

		
	}

	public function emailConfirmation($request)
	{

		$name = $request['name'];

		$email = $request['email'];

		$return  = $this->emailRepository->create($request);

		$arr = array(
			'name'=>$name,
			'email'=>$email,
			'id'=>$return['id']
			);

		$send = Mail::send('email.confirmation', $arr, function($message) use($email, $name)
		{
			$message->to($email)->subject('E-mail de confirmação');

			$message->from('marcelojunin2010@hotmail.com', 'Marcelo Nascimento');
		});

		if(!$send)
		{
			return 0;
		}
		else
		{
			
			return 1;
			
		}

	}

	public function updateStatusConfirmation($id)
	{
		try {

			Email::where('id', $id)->update(['status'=>'active']);
			
		} catch (Exception $e) {
			throw $e;
		}

		return;
	}
}
