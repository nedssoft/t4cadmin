<?php

namespace App\Api\v1;

use App\Levels;
use App\PlayerLevel;

class APILevel extends BaseAPIRequest
{
    /**
     * Get all levels
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = $this->getAllResource()->get();
        
        if ($levels) {
            return $this->response('Levels retrieved successfully', 'success', 200, $levels);
        }

        return $this->response('Levels could not be retrieved', 'error', 404);
    }

    /**
     * Get all players in a specified level
     *
     * @param int $levelID
     *
     * @return Response
     */
    public function levelPlayers($levelID)
    {
        $level = $this->getResourceByID($levelID);

        if ($level) {
            $players = $level->players->load('point');
            
            if ($players) {
                return $this->response('Players retrieved successfully', 'success', 200, $players);
            }

            return $this->response('Players could not be retrieved', 'error', 404);
        }

        return $this->response('Level does not exist', 'error', 404);
    }

    /**
	 * Gets the collection of player's levels
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     *
	 * @return Response
     */
    public function playerLevels(APIPlayer $apiPlayer, $playerID)
    {
        $player = $apiPlayer->getResourceByID($playerID);
        
        if ($player) {
            $levels = $player->levels;
            
            if ($levels) {
                return $this->response('Player levels retrieved successfully', 'success', 200, $levels);
            }
    
            return $this->response('Levels could not be retrieved', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
	 * Adds a new level to a player's level achievement
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     * @param int $levelID
     *
	 * @return Response
     */
    public function createPlayerLevel(APIPlayer $apiPlayer, $playerID, $levelID)
    {
        $player = $apiPlayer->getResourceByID($playerID);
        
        if ($player) {
            $level = $this->getResourceByID($levelID);

            if ($level) {
                if (! $player->hasLevel($levelID)) {
                    $player->levels()->attach($levelID);
                    
                    return $this->response('Player level created', 'success', 201, $level);
                }

                return $this->response('Player level already exists', 'error', 409);
            }

            return $this->response('Level does not exist', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
	 * Remove level from a player's level achievements
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     * @param int $levelID
     *
	 * @return Response
     */
    public function removePlayerLevel(APIPlayer $apiPlayer, $playerID, $levelID)
    {
        $player = $apiPlayer->getResourceByID($playerID);

        if ($player) {
        $level = $this->getResourceByID($levelID);
            
            if ($level) {
                //Check if the player already has this level
                if ($player->hasLevel($levelID)) {
                    $player->levels()->detach($levelID);
    
                    return $this->response('Player level removed', 'success', 200, $level);
                }
    
                return $this->response('Player level does not exist', 'error', 404);
            }
            
            return $this->response('Level does not exist', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAllResource()
    {
        return Levels::query();
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceByID($resourceID)
    {
        return Levels::find($resourceID);
    }

    /**
     * Get a level by its ID
     *
     * @param int $resourceID
     *
     * @return \Illuminate\Http\Response
     */
    public function findByID($resourceID)
    {
        $level = $this->getResourceByID($resourceID);

        if ($level) {
            return $this->response('Level retrieved successfully', 'success', 200, $level);
        }

        return $this->response('Level does not exist', 'error', 404);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate()
    {
        $this->itemsPerPage = $this->request->has('items_per_page') ? intval($this->request->items_per_page) : $this->itemsPerPage;

        $levels = $this->getAllResource()->paginate($this->itemsPerPage);

        if ($levels) {
            return $this->response('Levels retrieved successfully', 'success', 200, $levels);
        }

        return $this->response('Levels could not be retrieved', 'error', 404);
    }
}
