<?php

namespace App\Repositories;

use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Requests\Users\UsersUpdateFormRequest;
use App\Interfaces\UsersRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Facades\Log;

class UsersRepository implements UsersRepositoryInterface
{
    /**
     * get all user
     */
    public function getAll(): Collection
    {
        return User::all()
            ->sortByDesc('id');
    }

    public function getByEmail(string $email): User|null
    {
        return User::where('email', $email)->first();
    }

    /**
     * Delete a specific user
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $deleted = User::where('id', $id)
            ->delete();

        return $deleted
            ? true
            : false;
    }

    /**
     * Store a new user
     * @param UsersAddFormRequest $request
     *
     * @return User|null
     */
    public function store(UsersAddFormRequest $request): User|null
    {
        try {
            $user = new User();
            $user->fillUser($request);
            $user->save();
            return $user;
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }


    /**
     * get a specific users
     * @param int $id
     *
     * @return User|null
     */
    public function get(int $id): User|null
    {
        return User::where('id', $id)->first();
    }


    /**
     * Store a new user
     * @param UsersUpdateFormRequest $request
     *
     * @return bool
     */
    public function update(UsersUpdateFormRequest $request): bool
    {
        try {
            $users = $this->get($request->id);
            $users->fillUser($request);
            return $users->update();
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }
}
