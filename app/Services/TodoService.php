<?php

namespace App\Services;


use App\Jobs\makePdfJob;
use App\Repositories\TodoRepository;

class TodoService extends BaseService
{
    protected $filter_fields;

    public function __construct(TodoRepository $repository)
    {
        $this->repo = $repository;
        $this->filter_fields = [
            'user_id' => ['type' => 'number'],
        ];
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
        $query = $query->where('user_id',auth()->user()->id);
        $query = $this->repo->getPaginate($query,$perPage);
        return $query;
    }

    public function makePdf()
    {
        $query = $this->repo->getQuery();
        $todos = $query->get();
        if ($todos)
        {
            return makePdfJob::dispatch($todos);
        }
        return false;
    }

}
