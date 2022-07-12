<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PDF;

class GestionClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $utilisateur = User::leftJoin('type_utilisateurs', 'users.type_utilisateur_id', '=', 'type_utilisateurs.id')
        // ->select('users.*', 'type_utilisateurs.role')
        // ->get();


            $client = Client::leftjoin('services','clients.service_id','=','services.id')
            ->select('clients.*','services.Service_Name')->orderBy('id', 'DESC')->get();
            // $client = Client::all();
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

    public function count(){
        $client = count(Client::all());
        return response()->json(
            [
                'code'=>200,
                'client'=>$client,
                'message'=>'Got the clients  successfully'
            ]);
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
                'detaille_service' => 'required',
                'service_id' => 'required',
            ]);


            $client = new Client();
            $client->name = $request->name;
            $client->number = $request->number;
            $client->neighborhood = $request->neighborhood;
            $client->email = $request->email;
            $client->detaille_service = $request->detaille_service;
            $client->service_id = $request->service_id;

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
        $client = Client::leftjoin('services','clients.service_id','=','services.id')
        ->select('clients.*','services.Service_Name')
        ->where('clients.id','=',$id)
        ->get()->first();
        if($client){
            return response()->json([
                'code'=>200,
                'client'=>$client,
                'Message'=>'voisi les information du client '.$client,
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


    public function trash(){
        $client = Client::onlyTrashed()->orderBy('deleted_at','asc')->get();

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

    public function restore($id){
        $client = Client::withTrashed()->where('id',$id);

        if($client){
            $client->restore();
            return response()->json(
                [
                    'code'=>200,
                    'client'=>$client,
                    'message'=>'Restored the client  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No client found',
                'body'=>[],
            ]);
        }


    }

    public function del($id){
        $client = Client::onlyTrashed()->where('id',$id);

        if($client){
            $client->forceDelete();
            return response()->json(
                [
                    'code'=>200,
                    'client'=>$client,
                    'message'=>'Deleted the client  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No client found',
                'body'=>[],
            ]);
        }

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
               'detaille_service' => 'required',
               'service_id'=>'required',
            ]);


            $client = Client::find($id);

            if($client){
                $client->name = $request->name;
                $client->number = $request->number;
                $client->neighborhood = $request->neighborhood;
                $client->email = $request->email;
                $client->detaille_service = $request->detaille_service;
                $client->service_id = $request->service_id;
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

    public function generatePdf()
    {
        $path= base_path('logoLis.jpg');
        $type =pathInfo($path,PATHINFO_EXTENSION);
        $data= file_get_contents($path);
        $pic = 'data:image/'. $type. ';base64,'. base64_encode($data);
        $client = Client::leftjoin('services','clients.service_id','=','services.id')
        ->select('clients.*','services.Service_Name')->orderBy('id', 'DESC')->get();
        // dd($client);

        $pdf = PDF::loadView('pdf.generateClientPdf', compact('client','pic'));
        return $pdf->download('clients.pdf');
    }
    public function pdf($id)
    {
        $path= base_path('logoLis.jpg');
        $type =pathInfo($path,PATHINFO_EXTENSION);
        $data= file_get_contents($path);
        $pic = 'data:image/'. $type. ';base64,'. base64_encode($data);
        $clien = Client::leftjoin('services','clients.service_id','=','services.id')
        ->select('clients.*','services.Service_Name')
        ->where('clients.id',$id)
        ->get();

        $pdf = PDF::loadView('pdf.client', compact('clien','pic'));
        return $pdf->download('client.pdf');
    }
}
