<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
    }

    public function getByEmail($email)
    {
        $query = $this->repo->getQuery();
        return $query->where('email',$email)->first();
    }

}
