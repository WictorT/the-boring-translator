<?php

namespace App\Auth;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use LogicException;

class UserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        return User::where('token', $credentials)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        throw new LogicException('Not supported');
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new LogicException('Not supported');
    }
}
