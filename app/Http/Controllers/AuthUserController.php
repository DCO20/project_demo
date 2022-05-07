<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
	public function auth(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
			'device_name' => 'required',
		]);

		$client = User::where('email', $request->email)->first();

		if (!$client || !Hash::check($request->password, $client->password)) {
			return response()->json(['message' => trans('messages.invalid_credentials')], 404);
		}

		$token = $client->createToken($request->device_name)->plainTextToken;

		return response()->json(['token' => $token]);
	}

	public function logout(Request $request)
	{
		$user = $request->user();

		$user->tokens()->delete();

		return response()->json([], 204);
	}
}
