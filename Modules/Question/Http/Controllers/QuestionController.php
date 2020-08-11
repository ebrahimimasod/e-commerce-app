<?php

namespace Modules\Question\Http\Controllers;

use CreateQuestionsTable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Question\Service\QuestionService;
use Modules\Question\Http\Requests\CreateQuestionRequest;
use Modules\Question\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
   
    public function index($product)
    {
        return QuestionService::getProductQuestions($product);
    }

   
    public function store(CreateQuestionRequest $request, $product)
    {
        return QuestionService::store($request,$product);
    }
   
}
