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
            //$player->level()->save(new PlayerLevel(['level_id' => 1]));
            //Add initial point
            $player->point()->save(new PlayerPoint());
            if ($this->request->has('status')) {
                $player->profile()->save(new Profile(['status' => $this->request->status]));
            }
            
            //Commit
            DB::commit();

            return $this->response('Player created', 'success', 201, $player->toArray());
        }

        //Rollback transaction
        DB::rollBack();

        return $this->response('Something went wrong, player was not created', 'error', 500);
    }

    /**
	 * Adds a new badge to a player's badge collection
     *
     * @param APIBadge $apiBadge
     * @param int $badgeID
     *
	 * @return Response
     */
    public function createPlayerBadge(APIBadge $apiBadge, $badgeID)
    {
        $badge = $apiBadge->getResourceByID($badgeID);

        if ($badge) {
            //Check if the player already has this badge
            if (! $this->request->user()->hasBadge($badgeID)) {
                $this->request->user()->badges()->attach($badgeID);

                return $this->response('Player badge created', 'success', 201, $badge);
            }

            return $this->response('Player badge already exists', 'error', 409);
        }

        return $this->response('Badge does not exist', 'error', 404);
    }

    /**
	 * Remove a badge player's badge collection
     *
     * @param APIBadge $apiBadge
     * @param int $badgeID
     *
	 * @return Response
     */
    public function removePlayerBadge(APIBadge $apiBadge, $badgeID)
    {
        $badge = $apiBadge->getResourceByID($badgeID);

        if ($badge) {
            //Check if the player already has this badge
            if ($this->request->user()->hasBadge($badgeID)) {
                $this->request->user()->badges()->detach($badgeID);

                return $this->response('Player badge removed', 'success', 200, $badge);
            }

            return $this->response('Player badge does not exist', 'error', 404);
        }
        
        return $this->response('Badge does not exist', 'error', 404);
    }

    /**
	 * Gets the collection of player's badges
     *
     * @param Request $request
     *
	 * @return Response
     */
    public function badges()
    {
        $badges = $this->request->user()->badges;

        if ($badges) {
            return $this->response('Player badges retrieved successfully', 'success', 200, $badges);
        }

        return $this->response('Badge does not exist', 'error', 404);
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
            return $this->response('Player retrieved successfully', 'success', 200, $player);
        }

        return $this->response('Player could not be retrieved', 'error', 404);
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

        return $this->response('Player could not be retrieved', 'error', 404);
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

        return $this->response('Player not found', 'error', 404);
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
        //
    }

    /**
    * {@inheritdoc}
    */
    public function paginate()
    {
        //
    }
}
