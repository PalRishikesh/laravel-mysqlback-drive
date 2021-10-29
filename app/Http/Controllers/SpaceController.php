<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            'number_of_record' => 'nullable|numeric|min:1',
            'page_number'=>'nullable|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return $this->respondWithValidationError($validator->errors()->first());
        }
        $noOfRecord = 10;
        $pageNumber = 1;
        if($request->filled("number_of_record")){
            $noOfRecord = $request->number_of_record;
        }
        if($request->filled("page_number")){
            $pageNumber = ($request->page_number-1)* $noOfRecord;
        }

        $client = new \GuzzleHttp\Client();
        $params=[
            'query' => [
                'limit'=>$noOfRecord,
                'offset'=>$pageNumber
                ]
            ];
        $request = $client->get('https://api.spacexdata.com/v3/launches',$params);
        $response = $request->getBody()->getContents();
        // echo '<pre>';
        // print_r($response);
        // exit;
        $data = json_decode($response);

        return $this->respondWithSuccess($data);
        
    }
}
