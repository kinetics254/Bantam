<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChangelogResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    use AuthorizesRequests;

    public function __construct($model = User::class, $resource = UserResource::class)
    {
        parent::__construct($model, $resource);
    }

    public function index()
    {
        $this->authorize('index', $this->model);
        return UserResource::collection(User::paginate());
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function employee(User $user, Request $request){
        return new EmployeeResource($user->Employee_Record);
    }

    public function current(Request $request){
        if($request->is('api*')){
            return new UserResource($request->user());
        }
    }

    public function changelog(User $user, Request $request){
        return ChangelogResource::collection($user->audits()->paginate());
    }
}
