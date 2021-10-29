<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respondWithValidationError($message){
        return response()->json(["status"=>false,"message"=>$message,"data"=>[]],422);
    }
    public function respondWithSuccess($data = null){
        return response()->json(["status"=>true,"data"=>$data],200);
    }
}
