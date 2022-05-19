<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GestionNotification extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification = Notification::all();
        if(count($notification) > 0){
            return response()->json(
                [
                    'code'=>200,
                    'notification'=>$notification,
                    'message'=>'Got the notifications  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No notification found',
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
                'content'=>'required',
            ]);
            

            $notification = new Notification();
            $notification->activite_id = $request->activite_id;
            $notification->content = $request->content;

            if ($notification->save()) {
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Notification added successfully',
                        'body'=>$notification
                    ]
                );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occure when saving notification',
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
        $notification = Notification::find($id);
        if($notification){
            return response()->json([
                'code'=>200,
                'notification'=>$notification,
                'Message'=>'voiçi les information de la notification ',
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No notification found',
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
                'content'=>'required',
            ]);
            $notification = Notification::find($id);
            if ($notification) {
            $notification->activite_id = $request->activite_id;
            $notification->content = $request->content;
            $notification->update();
            return response()->json(
                [
                    'code'=>200,
                    'message'=>'Notification updateded successfully',
                    'body'=>$notification
                ]
            );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occure when updatinging notification',
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
        $notification = Notification::find($id);
            if($notification){
                $notification->delete(); 
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Client deleted successfully',
                        'body'=>$notification
                    ]
                );   
            }else {
                return response()->json([
                    'code'=>404,
                    'message'=>'No client with that id found',
                    'body'=>[]
                ]);
            }
    }
}
