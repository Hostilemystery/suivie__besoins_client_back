<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GestionClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $client = Client::all();
            if(count($client)>0){
                return response()->json(
                    [
                        'code'=>200,
                        'client'=>$client,
                        'message'=>'Got the clients  successfully'
                    ]);
            }else{
                return response()->json([
                    'code'=>404,
                    'message'=>'No Client found',
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
                'name' => 'required',
                'number'=>'required|min:9',
                'neighborhood'=>'max:50',
                'email'=>'required|email',
            ]);


            $client = new Client();
            $client->name = $request->name;
            $client->number = $request->number;
            $client->neighborhood = $request->neighborhood;
            $client->email = $request->email;

            if ($client->save()) {
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Client added successfully',
                        'body'=>$client
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
        $client = Client::find($id);
        if($client){
            return response()->json([
                'code'=>200,
                'client'=>$client,
                'Message'=>'voisi les information du client '.$client->client_Name,
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No Client found',
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
                'name' => 'required',
                'number'=>'required|min:9',
                'neighborhood'=>'max:50',
                'email'=>'required|email',
            ]);


            $client = Client::find($id);

            if($client){
                $client->name = $request->name;
                $client->number = $request->number;
                $client->neighborhood = $request->neighborhood;
                $client->email = $request->email;
                $client->update();
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Client updated successfully',
                        'body'=>$client
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
     * @param  int  $id+
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $client = Client::find($id);
            if($client){
                $client->delete();
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'Client deleted successfully',
                        'body'=>$client
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
