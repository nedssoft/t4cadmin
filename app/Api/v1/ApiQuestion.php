<?php

namespace App\Api\v1;

use App\Levels;
use App\Category;
use App\SubCategory;
use App\Questions;

//Todo Cache API Requests for calls made by specific users
class ApiQuestion extends BaseAPIRequest
{
    /**
     * Get all questions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->request->offsetExists('order')
            && strtolower($this->request->order) === 'random') {
            return $this->randomQuestions();
        }

        $questions = $this->getAllResource()->get();

        if ($questions) {
            return $this->response('Questions retrieved successfully', 'success', 200, $questions);
        }

        return $this->response('Questions could not be retrieved', 'error', 404);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllResource()
    {
        return Questions::with([
            'options', 
            'categories',
            'level',
            'point'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceByID($resourceID)
    {
        return Questions::find($resourceID);
    }

    /**
     * Get questions randomly
     *
     * @return \Illuminate\Http\Response
     */
    public function randomQuestions()
    {
        $limit = $this->request->has('limit') ? intval($this->request->limit) : $this->limit;
        $questions = null;

        if ($limit === 'all' || $limit === 0) {
            $questions = $this->getAllResource()->inRandomOrder()->get();
        } else {
            if ($limit !== 0) {
                $questions = $this->getAllResource()->inRandomOrder()->take($limit)->get();
            }
        }

        if ($questions) {
            return $this->response('Questions retrieved successfully', 'success', 200, $questions);
        }

        return $this->response('Questions could not be retrieved', 'error', 404);
    }

    /**
     * Get a question by its ID
     *
     * @return \Illuminate\Http\Response
     */
    public function findByID($resourceID)
    {
        $question = $this->getResourceByID($resourceID);

        if ($question) {
            return $this->response('Question retrieved successfully', 'success', 200, $question->load(['options', 'categories', 'level', 'point']));
        }

        return $this->response('Question does not exist', 'error', 404);
    }

    /**
     * Get questions under a given category
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryQuestions(ApiCategory $apiCategory, $categoryID)
    {
        $category = $apiCategory->getResourceByID($categoryID);

        if ($category) {
            $limit = $this->request->has('limit') ? intval($this->request->limit) : $this->limit;

            if ($this->request->offsetExists('order')
            && strtolower($this->request->order) === 'random') {
                if ($limit === 'all' || $limit === 0) {
                    $questions = $category->questions()
                                          ->with(['options', 'point', 'level'])
                                          ->inRandomOrder()->get();
                } else {
                    if ($limit !== 0) {
                        $questions = $category->questions()
                                              ->with(['options', 'point', 'level'])
                                              ->take($limit)
                                              ->inRandomOrder()
                                              ->get();
                    }
                }
            } else {
                if ($limit === 'all' || $limit === 0) {
                    $questions = $category->questions->load(['options', 'point', 'level']);
                } else {
                    if ($limit != 0) {
                        $questions = $category->questions->load(['options', 'point', 'level'])->take($limit);
                    }
                }
            }

            if ($questions) {
                return $this->response('Questions retrieved successfully', 'success', 200, $questions);
            }

            return $this->response('Questions could not be retrieved', 'error', 404);
        }

        return $this->response('Category does not exist', 'error', 404);
    }

    /**
     * Get questions under a given sub category
     *
     * @return \Illuminate\Http\Response
     */
     public function subCategoryQuestions($subCategoryID)
     {
         $subCategory = SubCategory::find($subCategoryID);
        
         if ($subCategory) {
            if ($this->request->offsetExists('order')
            && strtolower($this->request->order) === 'random') {
                $limit = $this->request->has('limit') ? intval($this->request->limit) : $this->limit;

                if ($limit === 'all' || $limit === 0) {
                    $questions = $subCategory->questions()
                                             ->with(['options', 'point', 'level'])
                                             ->inRandomOrder()
                                             ->get();
                } else {
                    if ($limit !== 0) {
                        $questions = $subCategory->questions()
                                                 ->with(['options', 'point', 'level'])
                                                 ->take($limit)
                                                 ->inRandomOrder()
                                                 ->get();
                    }
                }
            } else {
                $questions = $subCategory->questions->load(['options', 'point', 'level']);
            }
            
            if ($questions) {
                return $this->response('Questions retrieved successfully', 'success', 200, $questions);
            }
    
            return $this->response('Questions could not be retrieved', 'error', 404);
         }

         return $this->response('Subcategory does not exist', 'error', 404);
     }

    /**
     * {@inheritdoc}
     */
    public function paginate()
    {
        $this->itemsPerPage = $this->request->has('items_per_page') ? intval($this->request->items_per_page) : $this->itemsPerPage;

        $questions = $this->getAllResource()->paginate($this->itemsPerPage);

        if ($questions) {
            return $this->response('Questions retrieved successfully', 'success', 200, $questions);
        }

        return $this->response('Questions could not be retrieved', 'error', 404);
    }
}