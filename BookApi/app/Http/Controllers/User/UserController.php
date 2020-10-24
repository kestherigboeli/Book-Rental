<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Role;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Exception;

class UserController extends Controller
{
	private $authController;

	/**
	 * Create a new AuthController instance.
	 *
	 * @param AuthController $authController
	 */
	public function __construct(AuthController $authController)
	{
		$this->authController = $authController;

		$this->middleware('JWT', ['except' => ['index', 'store']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
    	try {
		    return response( [
			    'users' => UserResource::collection(User::with('role')->latest()->get()),
			    'response' =>  true
		    ], Response::HTTP_CREATED);

	    } catch (\Exception $exception) {
    		$exception->getMessage() ;
	    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
    	$request['user_id'] = Str::uuid();
	    $user = User::create($request->all());
//	    User::latest()->first()

    	return response([
		        'user' => new UserResource($user),
	        ], Response::HTTP_CREATED);


//    	$user_role = Role::where('id', 1)->firstOrFail();
//
//
//    	$user_role->create([
//		    'first_name' => $request->first_name,
//		    'last_name' => $request->last_name,
//		    'email' => $request->email,
//		    'password' => $request->password,
////		        'role_id' => $user_role->id,
//		    'user_id' => $request['user_id']
//	    ]);

//    	return $user_role;

////    	try {
//	        $request['user_id'] = Str::uuid();
//
//	        $user = User::create([
//	        	'first_name' => $request->first_name,
//	        	'last_name' => $request->last_name,
//	        	'email' => $request->email,
//	        	'password' => $request->password,
////		        'role_id' => $user_role->id,
//		        'user_id' => $request['user_id']
//	        ]);
//
//		    $user->roles()->attach($request->role_id);
//
//	        $this->authController->login($request);
//
//	        return response([
//		        'user' => new UserResource(User::latest()->first()),
//	        ], Response::HTTP_CREATED);

    }

	/**
	 * Display the specified resource.
	 *
	 * @param User $user_id
	 *
	 * @return UserResource
	 */
    public function show(User $user_id)
    {
	    return new UserResource($user_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        return $user;
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  User $user
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function destroy(User $user)
    {
        $user->delete();

        return response([
        	'message' => 'user delete successfully',
        	'response' => true,
        ], Response::HTTP_OK);
    }

	/**
	 * Show the application dashboard.
	 *
	 * @param  User $user_id
	 * @param   PasswordRequest $passwordRequest
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function updatePassword(User $user_id, PasswordRequest $passwordRequest)
	{

		if (!Hash::check($passwordRequest->current_password, $user_id->password)) {
			return response()->json( ['errors' => ['message' => 'Please enter your current password']], 422 );
		}

		$user_id->update(['password'=> $passwordRequest->new_password]);

		return response([
			'message' => 'Password changed successfully',
			'response' => true,
		], Response::HTTP_OK);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @param  User $user_id
	 * @param   UpdateUserRequest $updateUserRequest
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function updateUser(User $user_id, UpdateUserRequest $updateUserRequest)
	{
		$user_id->update([
			'first_name'=> $updateUserRequest->first_name,
			'last_name' => $updateUserRequest->last_name,
			'email'     => $updateUserRequest->email
		]);

		return response([
			'message' => 'Details changed successfully',
			'response' => true,
		], Response::HTTP_OK);
	}


}
