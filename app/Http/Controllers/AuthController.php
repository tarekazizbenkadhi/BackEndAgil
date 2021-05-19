<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Hash;



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
            'email_res' => 'nullable|string',
            'matricule_fisc' => 'nullable|string',
            'budget' => 'nullable|string',
            'siege' => 'nullable|string',
            'rib' => 'nullable|string',
            'image_cin' => 'nullable',
            'num_registre_commerce' => 'nullable',
            'mat_fiscal' => 'nullable',
            'prevision' => 'nullable|string',
            'fax' => 'nullable|string',
            'poste' => 'nullable|string',
            'type' => 'required|string',
            'tel' => 'required|string',
            'valide' => 'nullable',
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
        if ($request->hasFile('image_cin')) {
            $request->image_cin = Storage::url(Storage::put('public/images', $request->image_cin));
        }
        if ($request->hasFile('num_registre_commerce')) {
            $request->num_registre_commerce = Storage::url(Storage::put('public/images', $request->num_registre_commerce));

        }
        if ($request->hasFile('mat_fiscal')) {
            $request->mat_fiscal = Storage::url(Storage::put('public/images', $request->mat_fiscal));

        }

        if ($request->type === 'client') {
            $request->valide = $request->valide != '0';

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
                'valide' => $request->valide,
                'image_cin' => $request->image_cin,

            ]);

        } elseif ($request->type === 'entreprise') {
            $request->valide = $request->valide != '0';

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
                'matricule_fisc' => $request->matricule_fisc,
                'budget' => $request->budget,
                'prevision' => $request->prevision,
                'mat_fiscal' => $request->mat_fiscal,
                'valide' => $request->valide,
                'num_registre_commerce' => $request->num_registre_commerce,
            ]);
        } elseif ($request->type === 'admin_commercial') {
           $request->valide = $request->valide != '1';

            $user->admin_commercial()->create([
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'poste' => $request->poste,
                'valide'=> $request->valide,

            ]);
        } elseif ($request->type === 'admin_livraison') {
            $request->valide = $request->valide != '1';

            $user->admin_livraison()->create([
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'poste' => $request->poste,
                'valide'=> $request->valide,
            ]);
        } else {
            $request->valide = $request->valide != '1';
            $user->super_admin()->create([
                'user_id' => $request->user(),
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'poste' => $request->poste,
                'valide'=> $request->valide,

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
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $client = DB::table('users')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->select('client.valide')
            ->where('users.email', $request->email)
            ->first();
        $super = DB::table('users')
            ->leftJoin('super_admin', 'super_admin.user_id', '=', 'users.id')
            ->select('super_admin.valide')
            ->where('users.email', $request->email)
            ->first();
        $entreprise = DB::table('users')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->select('entreprise.valide')
            ->where('users.email', $request->email)
            ->first();
        $liv = DB::table('users')
        ->leftJoin('admin_livraison', 'admin_livraison.user_id', '=', 'users.id')
            ->select('admin_livraison.valide')
            ->where('users.email', $request->email)
            ->first();
        $com = DB::table('users')
            ->leftJoin('admin_commercial', 'admin_commercial.user_id', '=', 'users.id')
            ->select('admin_commercial.valide')
            ->where('users.email', $request->email)
            ->first();
          //  ->select('client.valide','super_admin.valide')


  //dd($client);

        if (!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);}
        if ( $super->valide === 0){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);}
       //dd( gettype( $com->valide );
       if ( $com->valide === 0){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);}
       // dd($com->valide);
        if ($liv->valide === 0){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);}
        if ($client->valide === 0){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);}
        if ( $entreprise->valide === 0){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);}
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'id_user' => Auth::id(),
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

    public function user(Request $request)
    {
        return response()->json($request->user()->with('client', 'entreprise', 'admin_commercial', 'admin_livraison', 'super_admin')->find(Auth::id()));
    }

    public function delete_user($id){

        return User::destroy($id);
        return response()->json(['message' => 'user not found'], 404);

    }
}
