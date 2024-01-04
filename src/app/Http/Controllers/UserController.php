<?php
use App\Models\User;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::with()->get();
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
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
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
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
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
