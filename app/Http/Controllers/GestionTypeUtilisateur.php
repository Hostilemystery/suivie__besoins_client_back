<?php

namespace App\Http\Controllers;

use App\Models\Type_utilisateur;
use Illuminate\Http\Request;

class GestionTypeUtilisateur extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Type_utilisateur::all();
        if(count($role) > 0){
            return response()->json(
                [
                    'code'=>200,
                    'service'=>$role,
                    'message'=>'Got the role  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No role found',
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Type_utilisateur::find($id);
        if($role){
            return response()->json([
                'code'=>200,
                'client'=>$role,
                'Message'=>'voisi les information du role '.$role->client_Name,
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No role found',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
