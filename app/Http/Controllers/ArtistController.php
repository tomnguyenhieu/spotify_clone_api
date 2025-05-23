<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\FileHelper;
use App\Models\Blocked;
use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, $id)
	{
		try {
			$artist = User::find($id);
			$artist->avatar_path = FileHelper::getAvatar($artist);
			return ApiResponse::success($artist);
		} catch (\Throwable $th) {
			return ApiResponse::dataNotfound();
		}
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
		//
	}

	public function follow(Request $request, $id)
	{
		try {
			Library::insert([
				'user_id' => Auth::user()->id,
				'artist_id' => $id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]);
			return ApiResponse::success();
		} catch (\Throwable $th) {
			return ApiResponse::dataNotfound();
		}
	}

	public function block(Request $request, $id)
	{
		try {
			Blocked::insert([
				'user_id' => Auth::user()->id,
				'artist_id' => $id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]);
			return ApiResponse::success();
		} catch (\Throwable $th) {
			return ApiResponse::internalServerError();
		}
	}
}
