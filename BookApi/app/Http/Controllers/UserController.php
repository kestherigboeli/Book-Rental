<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
    	try {
		    return response( [
			    'users' => UserResource::collection(User::all()),
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

        $user = User::create($request);

        return response([
        	$user => UserResource::collection($user)
        ], Response::HTTP_CREATED);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
