<?php

namespace App\Api\v1;

use App\Players;
use App\PlayerLevel;
use App\PlayerBadges;
use App\PlayerPoint;
use App\Profile;
use App\Api\v1\APILevel;
use App\Api\v1\APIBadge;
use App\Api\v1\APIPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controller\TokenizerController as TK;
use Response;
use Validator;
use DB;

class APIPlayer
{
    /**
	 * Create a New Player
	 *
     * @param Request $request
     *
	 * @return Response
	 */
    public static function create(Request $request)
    {	  
        //Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:players',
            'username' => 'required|string|max:255|unique:players',
            'phone' => 'required|numeric|min:11',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        //Validation passed, create resource

        //Begin transaction
        DB::beginTransaction();

        $player = new Players;
        $player->name = $request->name;
        $player->username = $request->username;
        $player->email = $request->email;
        $player->phone = $request->phone;
        $player->password = bcrypt($request->password);

        if ($player->save()) {
            //Add initial badge
            $player->badges()->save(new PlayerBadges(['badge_id' => 1]));
            //Add initial level
            $player->level()->save(new PlayerLevel(['level_id' => 1]));
            //Add initial point
            $player->point()->save(new PlayerPoint());
            if ($request->has('status')) {
                $player->profile()->save(new Profile(['status' => $request->status]));
            }
            
            //Commit
            DB::commit();

            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' => 'Player created',
                'data' => $player->toArray()
            ], 201);
        }

        //Rollback transaction
        DB::rollBack();

        return response()->json([
            'status' => 'error',
            'code' => 500,
            'message' => 'Something went wrong, player was not created',
            'data' => null
        ], 500);
    }

    /**
	 * Adds a new badge to a player's badge collection
     *
     * @param APIBadge $apiBadge
     * @param Request $request
     * @param int $badgeID
     *
	 * @return Response
     */
    public function createPlayerBadge(APIBadge $apiBadge, Request $request, $badgeID)
    {
        $badge = $apiBadge->getResourceByID($badgeID);

        if ($badge) {
            //Check if the player already has this badge
            if (! $request->user()->hasBadge($badgeID)) {
                $request->user()->badges()->attach($badgeID);

                return response()->json([
                    'status' => 'success',
                    'code' => 201,
                    'message' => 'Player badge created',
                    'data' => $badge
                ], 201);
            }

            return response()->json([
                'status' => 'error',
                'code' => 409,
                'message' => 'Player badge already exists',
                'data' => null
            ], 409);
        } else {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Badge does not exist',
                'data' => null
            ], 404);
        }
    }

    /**
	 * Gets the collection of player's badges
     *
     * @param Request $request
     *
	 * @return Response
     */
    public function badges(Request $request)
    {
        $badges = $request->user()->badges;

        if ($badges) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Player badges retrieved successfully',
                'data' => $badges
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'code' => 404,
            'message' => 'Badge does not exist',
            'data' => null
        ], 404);
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
