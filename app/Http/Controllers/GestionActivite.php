<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GestionActivite extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activite = Activite::all();
        if(count($activite) > 0){
            return response()->json(
                [
                    'code'=>200,
                    'activite'=>$activite,
                    'message'=>'Got the activities  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No activity found',
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
                'service_id'=>'required',
                'activity_Name'=>'required',
                'starting_date'=>'required|date',
                'end_date'=>'required|date',
            ]);
            

            $activite = new Activite();
            $activite->service_id = $request->service_id;
            $activite->activity_Name = $request->activity_Name;
            $activite->starting_date = $request->starting_date;
            $activite->end_date = $request->end_date;

            if ($activite->save()) {
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'activity added successfully',
                        'body'=>$activite
                    ]
                );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occured when saving activity',
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
        $activite = Activite::find($id);
        if($activite){
            return response()->json([
                'code'=>200,
                'activity'=>$activite,
                'Message'=>'voici les information de l\'activite '.$activite->activity_Name,
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No activity found',
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
                'service_id'=>'required|int',
                'activity_Name'=>'required',
                'starting_date'=>'required|date',
                'end_date'=>'required|date',
            ]);
            

            $activite = Activite::find($id);

            if($activite){
                $activite->service_id = $request->service_id;
                $activite->activity_Name = $request->activity_Name;
                $activite->starting_date = $request->starting_date;
                $activite->end_date = $request->end_date;
                $activite->update();
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'activity updated successfully',
                        'body'=>$activite
                    ]
                );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occured when updating activity',
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
        $activite = Activite::find($id);
            if($activite){
                $activite->delete(); 
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Activity deleted successfully',
                        'body'=>$activite
                    ]
                );   
            }else {
                return response()->json([
                    'code'=>404,
                    'message'=>'No activity with that id found',
                    'body'=>[]
                ]);
            }
    }
}
