<?php

namespace App\Api\v1;

use App\Category;
use App\SubCategory;

class ApiCategory extends BaseAPIRequest
{
    /**
     * Get all categories
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $categories = $this->getAllResource()->get();
 
         if ($categories) {
             return $this->response('Categories retrieved successfully', 'success', 200, $categories);
         }
 
         return $this->response('Categories could not be retrieved', 'error', 404);
     }

    /**
     * {@inheritdoc}
     */
    public function getAllResource()
    {
        return Category::with(['subCategories']);
    }

    /**
     * {@inheritdoc}
     */
     public function getResourceByID($resourceID)
     {
         return Category::find($resourceID);
     }

     /**
     * Get a category by its ID
     *
     * @param int $resourceID
     *
     * @return \Illuminate\Http\Response
     */
    public function findByID($resourceID)
    {
        $category = $this->getResourceByID($resourceID);

        if ($category) {
            return $this->response('Category retrieved successfully', 'success', 200, $category->load('subCategories'));
        }

        return $this->response('Category does not exist', 'error', 404);
    }

    /**
     * Get all subcategories of a category
     *
     * @param int $resourceID
     *
     * @return \Illuminate\Http\Response
     */
    public function subCategories($resourceID)
    {
        $category = $this->getResourceByID($resourceID);
        
        if ($category) {
            $subCategories = $category->subCategories;

            if ($subCategories) {
                return $this->response('Subcategories retrieved successfully', 'success', 200, $subCategories);
            }
    
            return $this->response('Subcategories could not be retrieved', 'error', 404);
        }
    
        return $this->response('Category does not exist', 'error', 404);
    }

    /**
     * Get a subcategory by ID
     *
     * @param int $resourceID
     *
     * @return \Illuminate\Http\Response
     */
     public function subCategory($resourceID)
     {
         $subCategory = SubCategory::find($resourceID);
         
         if ($subCategory) {
            return $this->response('Subcategory retrieved successfully', 'success', 200, $subCategory->load('category'));
         }
     
         return $this->response('Subcategory does not exist', 'error', 404);
     }

    /**
     * {@inheritdoc}
     */
    public function paginate()
    {
        $this->itemsPerPage = $this->request->has('items_per_page') ? intval($this->request->items_per_page) : $this->itemsPerPage;

        $categories = $this->getAllResource()->paginate($this->itemsPerPage);

        if ($categories) {
            return $this->response('Categories retrieved successfully', 'success', 200, $categories);
        }

        return $this->response('Categories could not be retrieved', 'error', 404);
    }
}
