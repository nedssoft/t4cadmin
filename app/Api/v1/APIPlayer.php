<?php

namespace App\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Response;

use App\Api\v1\APILevel;
use App\Api\v1\APIBadge;
use App\Api\v1\APIPoint;

Use App\Players;


class APIPlayer
{
    
    //create new player
    /**
	 * Create a New Player
	 *
	 * @param Array of Player details
	 * @return JSON response success | error
	 */
  public static function create(Request $request)
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

                    /** 
                     * SETUP PLAYER ACCOUNT
                    */

                    $createBadgeData = ['player_id'=>$player->id, 'badge_id'=>'1']; //add initial badge
                    $createLevelData = ['player_id'=>$player->id, 'level_id'=>'1']; //add initial level
                    $createPointData = ['player_id'=>$player->id, 'point'=>'0']; //add initial point

                   $addLevel = APILevel::createPlayerLevel($createLevelData);
                   $addBagde = APIBadge::createPlayerBadge($createBadgeData);
                   $addPoint = APIPoint::UpdatePlayerPoint($createPointData);

                   if(!$addLevel || !$addBagde || !$addPoint ){

                    return response()->json([
                        'status'=>'success',
                        'code'=>201,
                        'message'=>'player account created, but setup is not completed',
                        'data'=> $player
                    ]);

                   }

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

    public function delete($id){

        $player = Players::find($id);

        if($player){

            if($player->delete()){

                return response()->json([
                    'status'=>'success',
                    'code'=>200,
                    'message'=>'Player Was Deleted',
                    'data'=> $player
                ]);

            }else{
                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Player Was not deleted',
                    'data'=> $player
                ]);
            }
        }

    }
}
