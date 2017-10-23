<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Players;

class PlayerController extends Controller
{
    
    //create new player
    /**
	 * Create a New Player
	 *
	 * @param Array of Player details
	 * @return JSON response success | error
	 */
  public static function signup(Array $data)
  {	 
	  	$name = filter_var($data['first_name'], FILTER_SANITIZE_STRING);
	  	$lname = filter_var($data['name'], FILTER_SANITIZE_STRING);		
		$username = filter_var($data['email'], FILTER_SANITIZE_STRING);
	  	$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
	  	$phone = filter_var($data['phone'], FILTER_SANITIZE_EMAIL);
        $password = Hash::make($data['password']);
        
	//check that email is valid
		if (static::checkEmail($email) == $email) {	

            if(Player::find('email',$email)->get()){

                return response()->json([
                    'status'=>'error',
                    'code'=>504,
                    'message'=>'player already exits',
                    'data'=> null
                ]);

            }else{

                $player = new Player;
                $player->name = $name;
				$player->username = $username;
				$player->password = $password;
				$player->email = $email;
                $player->phone = $phone;
                
                if($player->save()){

                    return response()->json([
                        'status'=>'success',
                        'code'=>201,
                        'message'=>'player already exits',
                        'data'=> $player
                    ]);

                }else{

                    return response()->json([
                        'status'=>'error',
                        'code'=>500,
                        'message'=>'player already exits',
                        'data'=> null
                    ]);

                }
            }	
			
		} 
    }
    
    public static function login(Array $data)
    {
              $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
              $password = Hash::make($data['password']);

                //allow signin with username or email and password
              $player = Player::where('username', $username)->orWhere('email', $username)->get();
            
              //check if user exists
              if ($player) { 
                //compare pasword
                  if($password == $player->password){

                    return response()->json([
                        'status'=>'success',
                        'code'=>200,
                        'message'=>'Player Logged',
                        'data'=> $player
                    ]);

                  }else{

                    return response()->json([
                        'status'=>'error',
                        'code'=>200,
                        'message'=>'Username or Password Incorrect',
                        'data'=> null
                    ]);

                  }
                
  
              } else{

                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Not registered.',
                    'data'=> null
                ]);

              }
    }

}
