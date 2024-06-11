<?php

namespace App\Interfaces;

use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Requests\Users\UsersUpdateFormRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UsersRepositoryInterface
{
    public function getAll(): Collection;
    public function get(int $id): User|null;
    public function delete(int $id): bool;
    public function store(UsersAddFormRequest $request): User|null;
    public function update(UsersUpdateFormRequest $request): bool;
}
