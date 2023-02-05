<?php

namespace App\Services;

use App\Repositories\WeatherRepository;

class WeatherService extends BaseService
{
    protected $filter_fields;

    public function __construct(WeatherRepository $repository)
    {
        $this->repo = $repository;
        $this->filter_fields = [];
        $this->relation = [];
        $this->attributes = ['*'];

        $this->sort_fields = [];
    }

    public function get(array $params, $pagination = false)
    {
        $query = $this->repo->weather($params);
        return $query;
//        $query = $this->repo->getPaginate($query,$perPage);
//        return $query;
    }


}
