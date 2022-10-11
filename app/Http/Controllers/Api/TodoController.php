<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\IndexRequest;
use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected TodoService $service;

    public function __construct(TodoService $service)
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


    public function store(StoreRequest $request)
    {
        $params = $request->validated();
        $params['user_id'] = auth()->user()->id;
        $model = $this->service->create($params);
        return response()->successJson($model);
    }

    public function update(UpdateRequest $request, Todo $todo)
    {
        $this->authorize('update',$todo);
        $params = $request->validated();
        $params['user_id'] = auth()->user()->id;
        $model = $this->service->edit($params, $todo->id);
        if ($model)
            return response()->successJson($model);
        else
            return response()->errorJson('Не обновлено|305', 404);
    }


    public function show(Todo $todo)
    {
        $this->authorize('viewAny',$todo);

        $model = $this->service->show($todo->id);

        if ($model)
            return response()->successJson($model);
        else
            return response()->errorJson('Information not found|404', 404);
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete',$todo);
        $model = $this->service->delete($todo->id);
        if ($model)
            return response()->successJson('Successfully deleted');
        else
            return response()->errorJson('Not deleted|306', 404);
    }

    public function makePdf()
    {
        $pdf = $this->service->makePdf();
        if ($pdf)
            return response()->successJson("storage/app/public/pdf/todo.pdf");
        else
            return response()->errorJson('Information not found|404', 404);
    }
}
