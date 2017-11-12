<?php

namespace App\Api\v1;

use App\Levels;
use App\Category;
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
            'category',
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
            return $this->response('Question retrieved successfully', 'success', 200, $question);
        }

        return $this->response('Question could not be retrieved', 'error', 404);
    }

    /**
     * Get questions under a given category
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryQuestions($categoryID)
    {
        $questions = $this->getAllResource()->where('category_id', $categoryID)->get();

        if ($questions) {
            return $this->response('Questions retrieved successfully', 'success', 200, $questions);
        }

        return $this->response('Questions could not be retrieved', 'error', 404);
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