<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Badge;

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
  public static function signup(Request $request)
  {	  
        $data = $request->all();

	  	$name = filter_var($data['name'], FILTER_SANITIZE_STRING);		
		$username = filter_var($data['username'], FILTER_SANITIZE_STRING);	
	  	$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
	  	$phone = filter_var($data['phone'], FILTER_SANITIZE_EMAIL);
        $password = Hash::make($data['password']);
        

            if(count(Players::where('email','=',$email)->first()) > 0){

                return response()->json([
                    'status'=>'error',
                    'code'=>504,
                    'message'=>'player already exits',
                    'data'=> null
                ]);

            }else{

                $player = new Players;	
                $player->name = $name;
				$player->username = $username;
				$player->password = $password;
				$player->email = $email;
                $player->phone = $phone;
                
                if($player->save()){

                    return response()->json([
                        'status'=>'success',
                        'code'=>201,
                        'message'=>'player created',
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
    
    public static function login(Request $request)
    {
            $data = $request->all();          

            $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
            $password = $data['password'];
           
                //allow signin with username or email and password

              $player = Players::where('username','=', $username)->orWhere('email','=', $username)->first();
            
              //check if user exists
              if (count($player)>0) { 
                //compare pasword
                if (Hash::check($password, $player->password)) {                
                        
                        return response()->json([
                            'status'=>'success',
                            'code'=>200,
                            'message'=>'Player Logged',
                            'data'=> $player
                        ]);

                    }else{
                        
                    return response()->json([
                        'status'=>'error',
                        'code'=>400,
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

        public function player($id){
                      
            $player = Players::find($id);
            
            if(count($player) < 1){
                return response()->json([
                    'status'=>'error',
                    'code'=>404,
                    'message'=>'Player Not Found.',
                    'data'=> null
                ]);
            }else{
                return response()->json([
                    'status'=>'success',
                    'code'=>200,
                    'message'=>'Player Found',
                    'data'=> $player
                ]);
            }

        }
}
