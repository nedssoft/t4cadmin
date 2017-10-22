<?php

namespace App\Api\Auth;

/*
|------------------------------------------
| The Auth Factory
|-------------------------------------------
| This is the interface that outlines the functions the AuthProvider
| would implement. each of these functions are implemented in the authentication provider
|
|
*/

interface AuthApi{
    public static function login(Array $data);
    public static function signup(Array $data);
    public static function forgotPassword(Array $data);
    public static function resetPassword(Array $data);
    public static function confirmEmail(Array $data);
}
