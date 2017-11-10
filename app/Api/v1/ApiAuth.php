<?php
namespace App\Api\v1;

use App\User;
use Illuminate\Http\Request;
use Response;
use Validator;

class APIAuth 
{
    /**
     * Creates a new user resource on the platform
     *
     * @return Response
     */
    public function signup(Request $request)
    {
        //Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        //Validation passed, create resource
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' => 'User created',
                'data' => $user->toArray()
            ], 201);
        }

        return response()->json([
            'status' => 'error',
            'code' => 500,
            'message' => 'Something went wrong, user was not created',
            'data' => null
        ], 500);
    }
}