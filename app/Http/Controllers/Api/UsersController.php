<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {

        $verifyDate = Cache::get($request->verification_key);
        if (!$verifyDate) {
            \abort(403, '验证码已失效');
        }
        if (!\hash_equals((string) $verifyDate['code'], (string) $request->verification_code)) {
            throw new AuthenticationException('验证码错误');
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyDate['phone'],
            'password' => $request->password,
        ]);
        Cache::forget($request->verification_key);
        return new UserResource($user);
    }
}
