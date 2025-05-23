<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FirebaseController extends Controller
{
	public function authentication(Request $request)
	{
		$params = $request->all();
		$validate = Validator::make($params, [
			'email' => 'required|email'
		]);
		if (!$validate->fails()) {
			try {
				$user = User::whereEmail($params['email'])->first();
				if (!is_null($user)) {
					if (is_null($user->email_verified_at)) {
						$user->email_verified_at = Carbon::now();
						$user->save();
					}
					$user->token = $user->createToken($user->email)->plainTextToken;
					return ApiResponse::success($user);
				} else {
					$user = User::create([
						'name' => explode('@', $params['email'])[0],
						'email' => $params['email'],
						'email_verified_at' => Carbon::now(),
						'password' => Hash::make('12345678'),
						'avatar' => '/default.jpg'
					]);
					$user->token = $user->createToken($user->email)->plainTextToken;
					return ApiResponse::success(new AuthResource($user));
				}
			} catch (\Throwable $th) {
				return ApiResponse::internalServerError();
			}
		} else {
			return ApiResponse::internalServerError();
		}
	}
}
