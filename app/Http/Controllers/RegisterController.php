<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register new user to the API
     *
     * @param StoreUserRequest $request
     * @return array
     */
    public function register(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer())
            ->toArray();
    }
}
