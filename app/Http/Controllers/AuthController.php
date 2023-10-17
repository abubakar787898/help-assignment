<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            // return Helper::sendError(HelperMessage::error(), $e, 401);
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token =  $user->createToken('MyApp')->plainTextToken;

        if ($token) {

            return Helper::sendResponse([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], "added successfully");
        } else {

            return Helper::sendError(HelperMessage::error(), '', 401);
        }
    }
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return Helper::sendResponse([
                'access_token' => $success['token'],
                'token_type' => 'Bearer',
                'user' => $user
            ], "logged in successfully");
        } else {

            return Helper::sendError(HelperMessage::error(), '', 401);
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        }
    }

    public function logout(Request $request)
    {


        $request->user()->currentAccessToken()->delete();
        return Helper::sendResponse(['message' => "You have been successfully logged out."], HelperMessage::fetch());
      
    }
}
