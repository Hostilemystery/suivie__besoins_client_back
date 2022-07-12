<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDF;

class GestionService extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::orderBy('id', 'DESC')->get();;
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


    public function count(){
        $Service = count(Service::all());
        return response()->json(
            [
                'code'=>200,
                'client'=>$Service,
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
                'Service_Name'=>'required',
                'Info_Service'=>'required',
                'image'=>'required'
            ]);


            $service = new Service();
            $service->Service_Name = $request->Service_Name;
            $service->Info_Service = $request->Info_Service;
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $comPic= str_replace('','_',$fileNameOnly).'_'.rand().'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/posts',$comPic);
            $service->image = $comPic;

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



        $service = Client::where('service_id',$id)->get();
        if($service){
            return response()->json([
                'code'=>200,
                'service'=>$service,
                'Message'=>'voisi les information du service '
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
                'Service_Name',
                'Info_Service'=>'required',
                'image'=>'required'
            ]);


            $service = Service::find($id);

            if ($service) {
            $service->Service_Name = $request->Service_Name;
            $service->Info_Service = $request->Info_Service;
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $comPic= str_replace('','_',$fileNameOnly).'_'.rand().'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/posts',$comPic);
            $service->image = $comPic;
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

    public function pdfs($id)
    {
        $path= base_path('logoLis.jpg');
        $type =pathInfo($path,PATHINFO_EXTENSION);
        $data= file_get_contents($path);
        $pic = 'data:image/'. $type. ';base64,'. base64_encode($data);
        $service = Client::where('service_id',$id)->get();

        $pdf = PDF::loadView('pdf.service', compact('service','pic'));
        return $pdf->download('clientS.pdf');
    }
}
