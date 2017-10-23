<?php

namespace App\Api\Auth;

use App\Player;
use DB;

/*
|-------------------------------------------------------
| The AuthProvider
|------------------------------------------------------
| This class implements the Auth Factory functions
|
|*/

class AuthProvider implements AuthApi
{
	/**
	 * Logs a User into the Application
	 *
	 * @param Array of User details
	 * @return JSON response success | error
	 */

  public static function login(Array $data)
  {
			$username = filter_var($data['username'], FILTER_SANITIZE_STRING);
	    	$password = $data['password'];
	   
			$user = User::where('username', $email)->orWhere('email', $email)->get();
									
			if (($user) && password_verify($password, $user->password)) {
			
				
				//return user json
				//return $user;

			} else{
				// return error json
			}
  }

  /**
	 * Create a New User Account
	 *
	 * @param Array of User details
	 * @return JSON response success | error
	 */
  public static function signup(Array $data)
  {
	 
	  	$name = filter_var($data['first_name'], FILTER_SANITIZE_STRING);
	  	$last_name = filter_var($data['last_name'], FILTER_SANITIZE_STRING);		
		$username = filter_var($data['email'], FILTER_SANITIZE_STRING);
	  	$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
	  	$phone = filter_var($data['phone'], FILTER_SANITIZE_EMAIL);
	    $password = password_hash($data['password'], PASSWORD_DEFAULT);	   
			
	//check that email is valid
		if (static::checkEmail($email) == $email) {	

		//check if user does not already exist
	
				$user = new User;
				$user->name = $name;
				$user->username = $username;
				$user->password = $password;
				$user->email = $email;
				$user->phone = $phone;				
				
				if ($user->save()) {			
			
					
					//return json success

						
				}else{
					//return json error
				}
		} 
	}



}
