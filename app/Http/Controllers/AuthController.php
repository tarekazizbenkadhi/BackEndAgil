<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'prenom' => 'nullable|string',
            'nom' => 'nullable|string',
            'cin' => 'nullable|string',
            'lieu_cin' => 'nullable|string',
            'date_cin' => 'nullable|string',
            'adresse' => 'nullable|string',
            'code_postal' => 'nullable|string',
            'ville' => 'nullable|string',
            'raison_sociale' => 'nullable|string',
            'activite' => 'nullable|string',
            'forme_juridique' => 'nullable|string',
            'responsable' => 'nullable|string',
            'mobile' => 'nullable|string',
            'email_res'=>'nullable|string',
            'siege' => 'nullable|string',
            'rib' => 'nullable|string',
            'prevision' => 'nullable|string',
            'fax' => 'nullable|string',
            'poste'=>'nullable|string',
            'type' => 'required|string',
            'tel' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'tel' => $request->tel,
            'fax' => $request->fax,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        if ($request->type === 'client') {
            $user->client()->create([ //user de type client yzid les champs hedhom
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'cin' => $request->cin,
                'lieu_cin' => $request->lieu_cin,
                'date_cin' => $request->date_cin,
                'adresse' => $request->adresse,
                'code_postal' => $request->code_postal,
                'ville' => $request->ville,
                'fax' => $request->fax,

            ]);
        }
        else if ($request->type === 'entreprise'){
                $user->entreprise()->create([
                    'user_id' => $request->user(),
                    'raison_sociale' => $request->raison_sociale,
                    'activite' => $request->activite,
                    'forme_juridique' => $request->forme_juridique,
                    'responsable' => $request->responsable,
                    'mobile' => $request->mobile,
                    'email_res' => $request->email_res,
                    'siege' => $request->siege,
                    'rib' => $request->rib,
                    'prevision' => $request->prevision,
                ]);
            }
        else if ($request->type === 'admin_commerical'){
            $user->admin_commercial()->create([
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'poste' => $request->poste,
            ]);
        }
        else if ($request->type === 'admin_livraison')
        {
            $user->admin_livraison()->create([
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'poste' => $request->poste,
            ]);
        }
        else {
            $user->super_admin()->create([
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'poste' => $request->poste,
            ]);
        }


            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
        }

        /**
         * Login user and create token
         *
         * @param  [string] email
         * @param  [string] password
         * @param  [boolean] remember_me
         * @return [string] access_token
         * @return [string] token_type
         * @return [string] expires_at
         */
        public
        function login(Request $request)
        {
            /*dd($request->email);
            $users = DB::table('user')
                ->where('email',$request->email)
                ->select('')
                ->get();*/

           $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ]);
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'id_user'=>Auth::id(),
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }

        /**
         * Logout user (Revoke the token)
         *
         * @return [string] message
         */
        public
        function logout(Request $request)
        {
            $request->user()->token()->revoke();
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }

        /**
         * Get the authenticated User
         *
         * @return [json] user object
         */
        public
        function user(Request $request)
        {
            return response()->json($request->user()->with('client','entreprise','admin_commerical','admin_livraison','super_admin')->find(Auth::id()));
        }
    }
