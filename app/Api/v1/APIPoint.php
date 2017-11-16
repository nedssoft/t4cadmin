<?php

namespace App\Api\v1;

use App\PlayerPoints;

class APIPoint extends BaseAPIRequest
{
    
    /**
     * Get all points
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = $this->getAllResource()->get();
        
        if ($points) {
            return $this->response('Points retrieved successfully', 'success', 200, $points);
        }

        return $this->response('Points could not be retrieved', 'error', 404);
    }

    /**
     * Retrieves player points
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     *
     * @return Response
     */ 
    public function playerPoints(APIPlayer $apiPlayer, $playerID)
    {
        $player = $apiPlayer->getResourceByID($playerID);

        if ($player) {
            return $this->response('Points retrieved successfully', 'success', 200, $player->point);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    /**
     * Updates a player's points
     *
     * @param APIPlayer $apiPlayer
     * @param int $playerID
     *
     * @return Response
     */
    public function updatePlayerPoints(APIPlayer $apiPlayer, $playerID)
    {
        $player = $apiPlayer->getResourceByID($playerID);
        
        if ($player) {
            $playerPoints = $player->point;

            if ($this->request->offsetExists('points')
                && ! is_null($this->request->points)) {
                $playerPoints->total_points += $this->request->points;
                $playerPoints->earned_points += $this->request->points;
                
                if ($playerPoints->save()) {
                    return $this->response('Points updated successfully', 'success', 200, $playerPoints);
                }
    
                return $this->response('Something went wrong, points were not updated', 'error', 500);
            }

            return $this->response('Missing parameter - points', 'error', 400);
        }

        return $this->response('Player does not exist', 'error', 404);
    }

    //TODO: cashPoint - Convert points to cash or airtime
     
    /**
    * {@inheritdoc}
    */
    public function getAllResource()
    {
        return Points::query();
    }
 
    /**
    * {@inheritdoc}
    */
    public function getResourceByID($resourceID)
    {
        return Points::find($resourceID);
    }

    /**
    * Get a point by its ID
    *
    * @param int $resourceID
    *
    * @return \Illuminate\Http\Response
    */
    public function findByID($resourceID)
    {
        $point = $this->getResourceByID($resourceID);

        if ($point) {
            return $this->response('Point retrieved successfully', 'success', 200, $v);
        }

        return $this->response('Point does not exist', 'error', 404);
    }

    /**
    * {@inheritdoc}
    */
    public function paginate()
    {
        $this->itemsPerPage = $this->request->has('items_per_page') ? intval($this->request->items_per_page) : $this->itemsPerPage;

        $points = $this->getAllResource()->paginate($this->itemsPerPage);

        if ($points) {
            return $this->response('Points retrieved successfully', 'success', 200, $points);
        }

        return $this->response('Points could not be retrieved', 'error', 404);
    }
}
