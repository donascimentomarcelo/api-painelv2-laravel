<?php

namespace Painel\Services;

use Illuminate\Support\Facades\Validator;
use Painel\Models\User;
use Painel\Repositories\UserRepository;


class UserService 
{
  private $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function validateUser($request)
  {
     $validator = Validator::make($request, [
       'name'=>'required',
       'email'=>'required',
       'password'=>'required',
       'confirmpassword'=>'required',
    ]);

     return $validator;
  }

  public function validateUserUpdate($request)
  {
     $validator = Validator::make($request, [
       'id'=>'required',
       'name'=>'required',
       'email'=>'required',
       'password'=>'required',
       'confirmpassword'=>'required',
    ]);

     return $validator;
  }

  public function createUser(array $request)
  {
    $request['password'] = bcrypt($request['password']);
    
    $this->userRepository->create($request);
    
    return 1; 
  }

  public function updateUser(array $request)
  {
    $request['password'] = bcrypt($request['password']);
    
    $this->userRepository->update($request, $request['id']);
    
    return 1; 
  }

}