<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\TokenRepository;
use Illuminate\Validation\ValidationException;

class Connexion extends Controller
{
    // the method to log into app
    public function login(Request $request){

        try {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user= User::where('email','=',$request->email)->first();

            if ($user===null){	// requette pour verifier si un user existe a partir de son email
                return response()->json([
                    'code' => 403,
                    'message' => 'email doesn\'t exist',
                    'body' => []
                ]);
            }else{
                // $accountExist =  User::where(['password' => Hash::make('123456789')])->first(); // verifier la combinaison des identifiants

                $cred = $request->only('email','password');
                $val = Auth::attempt($cred);

                // $2y$10$hmxP3UfE1ezhRz9Ex7o6Se.Es2N7v/1j296vz1pJYSIA4PjsxXYmq
                // $2y$10$E1QMtM4FT5pwL7qVxOHTMOP0GQH5PwCL09WuU1s8sJTPyKHF6.bB.

                // $b

                // return response()->json([
                //     //
                // ]);

                if (!$val) {
                    return response()->json([
                        'code' => 403,
                        'message' => 'password doesn\'t correspond',
                        'body' => []
                    ]);
                } else {

                    // $user = User::find(1);
                    // Creating a token without scopes...
                    $accessToken = $user->createToken('Token Name')->accessToken;

                    // $accessToken = $user->createToken('authToken')->accessToken;
                    // $accessToken['token'] =  $user->createToken('MyApp')->accessToken;
                    // $accessToken = $request->bearerToken();
                    return response()->json([
                        'code' => 200,
                        'message' => 'connected',
                        'body' => [
                            'user' => $user,
                            'access_token' => $accessToken
                        ]
                    ]);
                }
            }

        } catch (ValidationException $e) {
            return response()->json([
                'code' => 419,
                'message' => $e->getMessage(),
                'body' => $e->errors()
            ]);
        }

    }

    public function get_user_id_accessToken($id)
    {
        $a_token2 = DB::table('oauth_access_tokens')->where('user_id', $id)->get()->last();
        return $a_token2->id;
    }

    public static function logout(Request $request){

        $tokenRepository = app(TokenRepository::class);
        if ($request->input('id_token')) {
            // Revoke an access token...
            $tokenRepository->revokeAccessToken($request->input('id_token'));
            return response()->json([
                'code' => 200,
                'message' => 'user disconected',
                'body' => []
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'error occure when disconnecting user',
                'body' => []
            ]);
        }
    }
}
