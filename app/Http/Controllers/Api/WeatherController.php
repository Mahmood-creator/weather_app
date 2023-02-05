<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Weather\IndexRequest;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected WeatherService $service;

    public function __construct(WeatherService $service)
    {
        $this->service = $service;
    }


    public function index(IndexRequest $request)
    {
        $params = $request->validated();
        $lists = $this->service->get($params);
        if ($lists)
            return response()->successJson($lists);
        else
            return response()->errorJson('Information not found|404', 404);
    }

}
