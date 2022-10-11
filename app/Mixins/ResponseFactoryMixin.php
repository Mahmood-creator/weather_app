<?php


namespace App\Mixins;


use Illuminate\Http\JsonResponse;

class ResponseFactoryMixin
{
    public function successJson()
    {
        return function($data){
            return [
                'success'=> true,
                'data' => $data,
                'message' => 'ok'
            ];
        };
    }

    public function errorJson()
    {
        return function($message, $status, $errors = null, $data = null){
            if(str_contains($message, '|')){
                $array_string = explode('|', $message);
                $message = $array_string[0];
                $code = (int) $array_string[1];
            }
            $data = [
                'success' => false,
                'message' => $message,
                'errors' => $errors,
                'data' => $data,
                'code' => $code??500
            ];
            return new JsonResponse($data, $status);
        };
    }
}
