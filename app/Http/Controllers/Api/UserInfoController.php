<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserInfo;

class UserInfoController extends Controller
{
    public function __construct()
    {
        //
    }

    public function createUser(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name'  => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dob'   => ['required', 'date'],
        ]);

        if ($data->fails()) {
            return response()->json([
                $data->errors()
            ], 422);
        }

        $validatedData = $data->validated();

        $createdUserInfo = UserInfo::create($validatedData);

        return response()->json([
            'success'               => true,
            'message'               => 'User created successfully',
            'userCreated'          => $createdUserInfo,
        ], 200);
    }

    public function userList()
    {
        $userList = UserInfo::paginate(15);

        return response()->json([
            'success'       => true,
            'userList'     => $userList,
        ], 200);
    }

    public function userDetails(UserInfo $id)
    {
        $userDetails = UserInfo::find($id);

        return response()->json([
            'success'       => true,
            'userDetails'   => $userDetails,
        ], 200);
    }

}

