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
