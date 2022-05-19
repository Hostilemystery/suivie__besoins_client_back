<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GestionService extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::all();
        if(count($service) > 0){
            return response()->json(
                [
                    'code'=>200,
                    'service'=>$service,
                    'message'=>'Got the services  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No service found',
                'body'=>[],
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $request->validate([
                'utilisateur_id'=>'required',
                'Service_Name'=>'required'
            ]);
            

            $service = new Service();
            $service->utilisateur_id = $request->utilisateur_id;
            $service->Service_Name = $request->Service_Name;

            if ($service->save()) {
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Service added successfully',
                        'body'=>$service
                    ]
                );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occure when saving data',
                    'body'=>[]
                ]);
            }

        } catch (ValidationException $e) {
            return response()->json([
                "code" => 419,
                "message" => $e->getMessage(),
                "body" => $e->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        if($service){
            return response()->json([
                'code'=>200,
                'service'=>$service,
                'Message'=>'voisi les information du service '.$service->Service_Name,
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No service found',
                'body'=>[],
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $request->validate([
                'utilisateur_id',
                'client_id',
                'Service_Name'
            ]);
            

            $service = Service::find($id);

            if ($service) {
            $service->utilisateur_id = $request->utilisateur_id;
            $service->client_id = $request->client_id;
            $service->Service_Name = $request->Service_Name;
            $service->update();
            return response()->json(
                [
                    'code'=>200,
                    'message'=>'Service added successfully',
                    'body'=>$service
                ]
            );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occure when saving data',
                    'body'=>[]
                ]);
            }

        } catch (ValidationException $e) {
            return response()->json([
                "code" => 419,
                "message" => $e->getMessage(),
                "body" => $e->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
            if($service){
                $service->delete(); 
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Service deleted successfully',
                        'body'=>$service
                    ]
                );   
            }else {
                return response()->json([
                    'code'=>404,
                    'message'=>'No service with that id found',
                    'body'=>[]
                ]);
            }
    }
}
