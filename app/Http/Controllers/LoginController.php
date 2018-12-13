<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Parser;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            //  'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $roles = Role::find(2);
        $user->role()->save($roles);

        $token = $user->createToken('TutsForWeb')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }


    public function logout()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json(['user' => $accessToken], 200);
    }


    public function tokenValidity(Request $request)
    {

        $value = $request->bearerToken();
        $id = (new Parser())->parse($value)->getHeader('jti');

        $result = DB::table('oauth_access_tokens')
            ->where('id', $id)->get()->first();


        //->update([
        //    'revoked' => true
        //]);
        return response()->json($result->revoked, 200);
    }


    public function isAdmin()
    {
        $user = Auth::user()->id;
        $role = User::find($user)->role()->get()[0]['role'];
        $output = false;
        if ($role == "admin") {
            $output = true;
        }
        return response()->json([
            $output
        ], 201);
    }


    /*

        public function logout(Request $request) {
            $value = $request->bearerToken();
            if ($value) {

                $id = (new Parser())->parse($value)->getHeader('jti');
                $revoked = DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => 1]);
                $this->guard()->logout();
            }
            Auth::logout();
            return Response(['code' => 200, 'message' => 'You are successfully logged out'], 200);
        }
    */
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}