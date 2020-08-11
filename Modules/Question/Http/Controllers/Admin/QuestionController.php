<?php

namespace Modules\Question\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Question\Service\QuestionService;
use Modules\Question\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
   
    public function index()
    {
        return QuestionService::index();
    }

   
    public function update(UpdateQuestionRequest $request, $id)
    {
     return QuestionService::update($request,$id);
    }

   
    public function destroy($id)
    {
        return QuestionService::destroy($id);
    }
}
