<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Requests\Users\UsersDeleteFormRequest;
use App\Http\Requests\Users\UsersEditFormRequest;
use App\Http\Requests\Users\UsersUpdateFormRequest;
use App\Http\Resources\UsersResource;
use App\Repositories\UsersRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersController extends Controller
{   

     /**
     * get all posts
     */
    public function index(UsersRepository $usersRepository)
    {
        $users = $usersRepository->getAll();
        return JsonResource::collection($users);
    }

     /**
     * Remove the specified user.
     */
    public function delete(UsersDeleteFormRequest $request, UsersRepository $userRepository)
    {
        $deleted= $userRepository->delete($request->id);
        $collection = collect([
            'success' => $deleted
        ]);
        return new JsonResource($collection);
    }
    
    public function add()
    {
        return view('pages.users.form');
    }

    /**
     * Store a new created user.
     */
    public function store(UsersAddFormRequest $request, UsersRepository $userRepository)
    {
        $saved = $userRepository->store($request);
        return new UsersResource(['saved' => $saved]);
    }

   /**
     * Open view to edit a specific User 
     * 
     * @return View
     */
    public function edit(UsersEditFormRequest $request,  UsersRepository $userRepository)
    {
        $user = $userRepository->get($request->id);
        return view('pages.user.form', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(UsersUpdateFormRequest $request, UsersRepository $userRepository)
    {
        $updated = $userRepository->update($request);
        return new UsersResource(['saved' => $updated]);
    }

   
}
