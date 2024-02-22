<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        try {
            $usersQuery = User::select("*");
            // if (request()->has("id")) {
            //     $usersQuery->where("id","=", request()->id);
            // }
            if (request()->has("name")) {
                $usersQuery->where("name","like","%". request()->name ."%");
            }
            if (request()->has("email")) {
                $usersQuery->where("email","like","%". request()->email ."%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $users = $usersQuery->paginate($quantity);
            return response()->json($users, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json($user, 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        try {
            return response()->json($user, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != '') {
                $user->password = Hash::make($request->password);
            }
            $user->update();
            return response()->json($user, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        try {
            $user->delete();
            return response()->json([
                'message' => 'deleted',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

}
