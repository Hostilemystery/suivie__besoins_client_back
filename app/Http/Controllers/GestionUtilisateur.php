<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GestionUtilisateur extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateur = User::leftJoin('type_utilisateurs', 'users.type_utilisateur_id', '=', 'type_utilisateurs.id')
                            ->select('users.*', 'type_utilisateurs.role')
                            ->get();

        if(count($utilisateur)>0){
            return response()->json(
                [
                    'code'=>200,
                    'user'=> $utilisateur,
                    'message'=>'Got the userss  successfully'
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No user found',
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
                'name' =>'required',
                'password' =>'required|min:8',
                'email' =>'required|email',
                'type_utilisateur_id' =>'required',
            ]);


            $utilisateur = new User();
            $utilisateur->type_utilisateur_id = $request->type_utilisateur_id;
            $utilisateur->name = $request->name;
            $utilisateur->password = Hash::make($request->password);
            $utilisateur->email = $request->email;

            if ($utilisateur->save()) {
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'User added successfully',
                        'body'=>$utilisateur,
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
        $utilisateur = User::find($id);
        if($utilisateur){
            return response()->json([
                'code'=>200,
                'user'=>$utilisateur,
                'Message'=>'voisi les information du user -> '.$utilisateur->name,
            ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'No user found',
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
                'type_utilisateur_id' =>'required',
                'name' =>'required',
                'email' =>'required|email',
            ]);

            $utilisateur =User::find($id);
            if ($utilisateur) {
                $utilisateur->name = $request->name;
                $utilisateur->email = $request->email;
                $utilisateur->type_utilisateur_id = $request->type_utilisateur_id;
                $utilisateur->password = Hash::make($request->password);
            $utilisateur->update();
            return response()->json(
                [
                    'code'=>200,
                    'message'=>'User updated successfully',
                    'body'=>$utilisateur
                ]
            );
            } else {
                return response()->json([
                    'code'=>500,
                    'message'=>'error occured when saving data',
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
        $utilisateur = User::find($id);
            if($utilisateur){
                $utilisateur->delete();
                return response()->json(
                    [
                        'code'=>200,
                        'message'=>'User deleted successfully',
                        'body'=>$utilisateur
                    ]
                );
            }else {
                return response()->json([
                    'code'=>404,
                    'message'=>'No user with that id found',
                    'body'=>[]
                ]);
            }
    }
}
