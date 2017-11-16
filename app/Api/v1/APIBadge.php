<?php

namespace App\Api\v1;

use App\Badges;
use App\PlayerBadges;

class APIBadge extends BaseAPIRequest
{
    /**
     * Get all badges
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $badges = $this->getAllResource();
        
        if ($badges) {
            return $this->response('Badges retrieved successfully', 'success', 200, $badges);
        }

        return $this->response('Badges could not be retrieved', 'error', 404);
    }

    /**
	 * Gets the collection of player's badges
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     *
	 * @return Response
     */
    public function playerBadges(APIPlayer $apiPlayer, $playerID)
    {
        $player = $apiPlayer->getResourceByID($playerID);
        
        if ($player) {
            $badges = $player->badges;
            
            if ($badges) {
                return $this->response('Player badges retrieved successfully', 'success', 200, $badges);
            }
    
            return $this->response('Player badges could not be retrieved', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
	 * Adds a new badge to a player's badge collection
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     * @param int $badgeID
     *
	 * @return Response
     */
    public function createPlayerBadge(APIPlayer $apiPlayer, $playerID, $badgeID)
    {    
        $player = $apiPlayer->getResourceByID($playerID);

        if ($player) {
            $badge = $this->getResourceByID($badgeID);
            
            if ($badge) {
                //Check if the player already has this badge
                if (! $player->hasBadge($badgeID)) {
                    $player->badges()->attach($badgeID);
    
                    return $this->response('Player badge created', 'success', 201, $badge);
                }
    
                return $this->response('Player badge already exists', 'error', 409);
            }
    
            return $this->response('Badge does not exist', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
	 * Remove badge from a player's badge collection
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     * @param int $badgeID
     *
	 * @return Response
     */
    public function removePlayerBadge(APIPlayer $apiPlayer, $playerID, $badgeID)
    {
        $player = $apiPlayer->getResourceByID($playerID);

        if ($player) {
            $badge = $this->getResourceByID($badgeID);
            
            if ($badge) {
                //Check if the player already has this badge
                if ($player->hasBadge($badgeID)) {
                    $player->badges()->detach($badgeID);
    
                    return $this->response('Player badge removed', 'success', 200, $badge);
                }
    
                return $this->response('Player badge does not exist', 'error', 404);
            }
            
            return $this->response('Badge does not exist', 'error', 404);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllResource()
    {
        return Badges::all();
    }
 
     /**
      * {@inheritdoc}
      */
    public function getResourceByID($resourceID)
    {
        return Badges::find($resourceID);
    }

    /**
     * Get a badge by its ID
     *
     * @return \Illuminate\Http\Response
     */
     public function findByID($resourceID)
     {
         $badge = $this->getResourceByID($resourceID);
 
         if ($badge) {
             return $this->response('Badge retrieved successfully', 'success', 200, $badge);
         }
 
         return $this->response('Badge could not be retrieved', 'error', 404);
     }

    /**
     * {@inheritdoc}
     */
     public function paginate()
     {
         $this->itemsPerPage = $this->request->has('items_per_page') ? intval($this->request->items_per_page) : $this->itemsPerPage;
 
         $badges = $this->getAllResource()->paginate($this->itemsPerPage);
 
         if ($badges) {
             return $this->response('Badges retrieved successfully', 'success', 200, $badges);
         }
 
         return $this->response('Badges could not be retrieved', 'error', 404);
    }
}
