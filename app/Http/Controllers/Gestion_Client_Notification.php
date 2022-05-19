<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client_Notification;
use Illuminate\Validation\ValidationException;

class Gestion_Client_Notification extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_notification = Client_Notification::all();
            if(count($client_notification)>0){
                return response()->json(
                    [
                        'code'=>200,
                        'client'=>$client_notification,
                        'message'=>'Got the information  successfully'
                    ]);
            }else{
                return response()->json([
                    'code'=>404,
                    'message'=>'No data found',
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
                'client_id' => 'required',
                'notification_id'=>'required'
            ]);
            

            $client_notification = new Client_Notification();
            $client_notification->client_id = $request->client_id;
            $client_notification->notification_id = $request->notification_id;

            if ($client_notification->save()) {
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Added successfully',
                        'body'=>$client_notification
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
        $client_notification = Client_Notification::find($id);
        if($client_notification){
            return response()->json([
                'code'=>200,
                'client'=>$client_notification,
                'Message'=>'voiçi les information demandé '.$client_notification->client_Name,
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No data found',
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
                'client_id' => 'required',
                'notification_id'=>'required'
            ]);
            

            $client_notification = Client_Notification::find($id);
            
            if($client_notification){
                $client_notification->client_id = $request->client_id;
                $client_notification->notification_id = $request->notification_id;
                $client_notification->update(); 
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Updated successfully',
                        'body'=>$client_notification
                    ]
                );   
            }else {
                return response()->json([
                    'code'=>404,
                    'message'=>'an error occured when updating data',
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
        $client_notification = Client_Notification::find($id);
            if($client_notification){
                $client_notification->delete(); 
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'delete successfull',
                        'body'=>$client_notification
                    ]
                );   
            }else {
                return response()->json([
                    'code'=>404,
                    'message'=>'Nothing with that id was found',
                    'body'=>[]
                ]);
            }
    }
}
