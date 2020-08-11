<?php

namespace Modules\Comment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comment\Http\Requests\CreateCommentRequest;
use Modules\Comment\Http\Requests\UpdateCommentRequest;
use Modules\Comment\Service\CommentService;

class CommentController extends Controller
{
    public function index($product)
    {
     return CommentService::getProductComments($product);
    }


    public function store(CreateCommentRequest $request,$product)
    {
        return CommentService::store($request,$product);
    }


  
}
