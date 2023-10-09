<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Resources\Api\V1\UserCollection;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $description = "Returns a user by the specified Id";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->api(
                status: true,
                message:"User collection retrieved successfully.",
                description: $this->description,
                data: new UserCollection(User::query()->paginate( request()->input('per_page') ?? 10)->withQueryString())
            );
        }catch (\Exception $e){
            return response()->api(
                status: false,
                message: "User collection not retrieved",
                description: $e->getMessage(),
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            return response()->api(
                status: true,
                message:"User has been created successfully.",
                description: $user->name,
                data: new UserResource($user)
            );
        }catch (\Exception $e){
            return response()->api(
                status: false,
                message: "User not been created. Try again.",
                description: $e->getMessage(),
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find('1dds');
        if (!empty($user)){
            return response()->api(
                status: true,
                message:"Success",
                description: $this->description,
                data: new UserResource($user)
            );
        }
        return response()->api(
            status: false,
            message: 'User Not Found. Please Check This Id',
            description: $this->description,
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); // this is check if user created by auth
//            $user = User::findOrFail($id); // this is for all users
            if (request()->input('is_force')){
                $user->forceDelete();
            }else{
                $user->delete();
            }
            return response()->api(
                status: true,
                message:"User has been deleted successfully.",
                description: $user->name." delete form database",
                data: new UserResource($user)
            );
        }catch (\Exception $e){
            return response()->api(
                status: false,
                message: "User not been deleted. Try again.",
                description: $e->getMessage(),
            );
        }
    }
}
