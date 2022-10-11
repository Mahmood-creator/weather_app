<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\FileUploadRequest;
use App\Http\Requests\Task\IndexRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use File;

class TaskController extends Controller
{
    protected TaskService $service;

    public function __construct(TaskService $service)
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
        $model = $this->service->create($params);
        return response()->successJson($model);
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $this->authorize('update',$task);
        $params = $request->validated();
        $model = $this->service->edit($params, $task->id);
        if ($model)
            return response()->successJson($model);
        else
            return response()->errorJson('Not updated|305', 404);
    }


    public function show(Task $task)
    {
        $this->authorize('viewAny',$task);

        $model = $this->service->show($task->id);

        if ($model)
            return response()->successJson($model);
        else
            return response()->errorJson('Information not found|404', 404);
    }



    public function destroy(Task $task)
    {
        $this->authorize('destroy',$task);
        $model = $this->service->delete($task->id);
        if ($model)
            return response()->successJson('Successfully deleted');
        else
            return response()->errorJson('Not deleted|306', 404);
    }

    public function fileUpload(FileUploadRequest $request)
    {
        $params = $request->validated();
        if ($params['file']) {
            $name = 'images';
            $folder = public_path().'/'.$name;
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0775, true, true);
            }
            $file_name = time() .'.'. $request->file->extension();
            $request->file->move($name, $file_name);
            $path = $name.'/'.$file_name;
            return response()->successJson($path);
        }
        return response()->errorJson('Not upload|306', 404);
    }
}
