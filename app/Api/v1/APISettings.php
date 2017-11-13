<?php

namespace App\Api\v1;

use App\CategorySetting;

class APISettings extends BaseAPIRequest
{
    /**
     * Get the settings for the category based on
     * the current user
     *
     * @param int $resourceID
     *
     * @return \Illuminate\Http\Response
     */
    public function categorySettings($categoryID)
    {
        $settings = CategorySetting::where('category_id', $categoryID)
                                    ->where('player_id', $this->request->user()->id)
                                    ->first();
        if ($settings) {
            return $this->response('Category Settings retrieved successfully', 'success', 200, $settings);
        }

        return $this->response('Category Settings could not be retrieved', 'error', 404);
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceByID($resourceID)
    {
        //
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