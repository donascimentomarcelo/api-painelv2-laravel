<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\EmailRequest;
use Painel\Http\Requests\UserRequest;
use Painel\Models\User;
use Painel\Repositories\UserRepository;
use Painel\Services\UserService;

class PainelController extends Controller
{
    private $user;
    private $userService;

    public function __construct(UserRepository $user, UserService $userService)
    {
        $this->user = $user;
        $this->userService = $userService;
    }


	public function index()
	{
		return view('admin.painel.index');
	}

    public function createUser()
    {
        return view('admin.painel.create-user');
    }

    public function saveUser(Request $userRequest)
    {
        $validator = $this->userService->validateUser($userRequest->all());

        if ($validator->fails()) {    
           return 3;
        }

        return $this->userService->createUser($userRequest->all());    
    }

    public function updateUser(Request $userRequest)
    {
        $validator = $this->userService->validateUserUpdate($userRequest->all());

        if ($validator->fails()) {    
           return 3;
        }

        return $this->userService->updateUser($userRequest->all());    
    }

    public function listUser()
    {
        return view('admin.painel.list-user');
    }
    public function indexList()
    {
        return $this->user->all();
    }

    public function editUser($id)
    {
        return  $this->user->find($id);

    }

    public function email(EmailRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $description = $request->input('description');
        $subject = $request->input('subject');

    	$send = Mail::send('email.contact', $request->all(), function($message) use($name, $email, $description, $subject)
    	{
    		$message->to('marcelojunin2010@hotmail.com', 'Marcelo Nascimento')->subject($subject);
            
            $message->from($email, $name);
    	});
        if(!$send)
        {
            return 0;
        }
    	return 1;
    }
}
