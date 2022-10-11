<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    protected $filter_fields;

    public function __construct(TaskRepository $repository)
    {
        $this->repo = $repository;
        $this->filter_fields = [];
        $this->relation = [];
        $this->attributes = ['*'];

        $this->sort_fields = [];
    }

    public function get(array $params, $pagination = true)
    {
        $perPage = null;
        if ($pagination) {
            $perPage = isset($params['per_page']) ? $params['per_page'] : 20;
        }

        $query = $this->repo->getQuery();
        $query = $this->relation($query, $this->relation);
        $query = $this->filter($query, $this->filter_fields, $params);
        $query = $this->sort($query, $this->sort_fields, $params);
        $query = $this->select($query, $this->attributes);
        $query = $query->whereHas('todo',function ($q) {
            $q->where('user_id',auth()->user()->id );
        });
        $query = $this->repo->getPaginate($query,$perPage);
        return $query;
    }


}
