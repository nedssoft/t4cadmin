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

class APIPlayer extends BaseAPIRequest
{

    /**
     * Get all players
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $players = $this->getAllResource()->orderBy('created_at')->get();
 
         if ($players) {
             return $this->response('Players retrieved successfully', 'success', 200, $players);
         }
 
         return $this->response('Players could not be retrieved', 'error', 404);
     }

    /**
	 * Create a New Player
	 *
     * @param Request $request
     *
	 * @return Response
	 */
    public function create()
    {	  
        //Validate the request
        $validator = Validator::make($this->request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:players',
            'username' => 'required|string|max:255|unique:players',
            'phone' => 'required|numeric|min:11',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->response($validator->errors(), 'error', 400);
        }

        //Validation passed, create resource

        //Begin transaction
        DB::beginTransaction();

        $player = new Players;
        $player->name = $this->request->name;
        $player->username = $this->request->username;
        $player->email = $this->request->email;
        $player->phone = $this->request->phone;
        $player->password = bcrypt($this->request->password);

        if ($player->save()) {
            //Add initial badge
            $player->badges()->attach(1);
            //Add initial level
            $player->levels()->attach(1);
            //Add initial point
            $player->point()->save(new PlayerPoint());
            if ($this->request->has('status')) {
                $player->profile()->save(new Profile(['status' => $this->request->status]));
            }
            
            //Commit
            DB::commit();

            return $this->response('Player created successfully', 'success', 201, $player->toArray());
        }

        //Rollback transaction
        DB::rollBack();

        return $this->response('Something went wrong, player was not created', 'error', 500);
    }

    /**
	 * Gets the player's points
     *
     * @param int $playerID
     *
	 * @return Response
     */
    public function points($playerID)
    {
        $player = $this->getResourceByID($playerID);
        
        if ($player) {
            $point = $player->point;
            
            if ($point) {
                return $this->response('Player point retrieved successfully', 'success', 200, $point);
            }
    
            return $this->response('Point does not exist', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
     * Get a player resource
     *
     * @param int $playerID
     * 
     * @return Response
     */
    public function findByID($playerID)
    {
        $player = $this->getResourceByID($playerID);
        
        if ($player) {
            return $this->response('Player retrieved successfully', 'success', 200, $player->load('profile'));
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
     * Update a player resource
     *
     * @param int $playerID
     * 
     * @return Response
     */
    public function update($playerID)
    {
        $player = $this->getResourceByID($playerID);

        if ($player) {
            if ($player->update($this->request->all())) {
                return $this->response('Player updated successfully', 'success', 200, $player);
            }
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
     * Delete a player resource
     *
     * @param int $playerID
     * 
     * @return Response
     */
    public function delete($playerID)
    {
        $player = Players::find($playerID);

        if ($player) {
            $deleted = $player->toArray();
            if ($player->delete()) {
                return $this->response('Player Deleted', 'success', 200, $deleted);
            } else {
                return $this->response('Something went wrong, please try again', 'error', 500);
            }
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceByID($resourceID)
    {
        return Players::find($resourceID);
    }

    /**
    * {@inheritdoc}
    */
    public function getAllResource()
    {
        return Players::with(['profile']);
    }

    /**
    * {@inheritdoc}
    */
    public function paginate()
    {
        $this->itemsPerPage = $this->request->has('items_per_page') ? intval($this->request->items_per_page) : $this->itemsPerPage;
        
        $players = $this->getAllResource()->paginate($this->itemsPerPage);

        if ($players) {
            return $this->response('Players retrieved successfully', 'success', 200, $players);
        }

        return $this->response('Players could not be retrieved', 'error', 404);
    }
}
