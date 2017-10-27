<?php

namespace App\Api\v1;

use Illuminate\Http\Request;
use App\Badges;
use App\PlayerBadge;

use Response;

class APIBadge 
{
    
    public function index(){
        
        $allbadges = Badges::all();

        if($allbadges){
            return response()->json([
                'status'=>'success',
                'code'=>201,
                'message'=>'All Badge Fetched',
                'data'=> $badge
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'code'=>400,
                'message'=>'No Badge Found',
                'data'=> $badge
            ]);
        }

    }

    public function create(Array $data){       
               
        $name = $data['name'];
        $icon = $data['icon'];
        $points = $data['points'];

        $badget = Badges::create([
            'name'=>$name,
            'icon'=>$icon,
            'points'=>$points
        ]);

        if($badget){
            return response()->json([
                'status'=>'success',
                'code'=>201,
                'message'=>'Badge was created',
                'data'=> $badge
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'code'=>504,
                'message'=>'Something went wrong, badge was not created',
                'data'=> null
            ]);
        }

    }

    public function update(Array $data){        
        
        $badge = Badges::find($data['id']);

        if($badge){

            $badge->name = $data['name'];
            $badge->icon = $data['icon'];
            $badge->points = $data['points'];
            
            if($badge->save()){
                
                return response()->json([
                    'status'=>'Success',
                    'code'=>201,
                    'message'=>'Badge Updated',
                    'data'=> null
                ]);

            }else{

                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Badge not updated, something went wrong',
                    'data'=> null
                ]);

            }            

        }else{
            return response()->json([
                'status'=>'error',
                'code'=>504,
                'message'=>'Badge Not Found',
                'data'=> null
            ]);
        }

    }

    public function badge(Array $data){
        $id = $data['id'];
        $badge = Badges::find($id);

        if($badge){

            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'Badge Found',
                'data'=> null
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>500,
                'message'=>'Badge Not Found',
                'data'=> null
            ]);

        }

    }

    public function delete(Array $data){
        $id = $data['id'];
        $badge = Badges::find($id);

        if($badge){

            if($badge->delete()){

                return response()->json([
                    'status'=>'success',
                    'code'=>200,
                    'message'=>'Badge Deleted',
                    'data'=> $badge
                ]);

            }else{

                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Something went wrong, badge was not deleted',
                    'data'=> $badge
                ]);

            }

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>404,
                'message'=>'Badge Not Found',
                'data'=> null
            ]);

        }
    }

    public static function createPlayerBadge(Array $data){
        
                $player_id = $data['player_id'];
                $badge_id = $data['badge_id'];
        
                $createPlayerBadge = PlayerBadge::create([
                    'player_id'=>$player_id,
                    'badge_id'=>$badge_id
                ]);
        
                if($createPlayerBadge){
        
                    return response()->json([
                        'status'=>'success',
                        'code'=>200,
                        'message'=>'Player Badge Created',
                        'data'=> $createPlayerBadge
                    ]);
        
                }else{
                    return response()->json([
                        'status'=>'error',
                        'code'=>500,
                        'message'=>'Player Badge Not Created',
                        'data'=> null
                    ]);
                }
        
            }
}
