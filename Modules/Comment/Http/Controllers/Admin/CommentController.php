<?php

namespace Modules\Comment\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comment\Http\Requests\UpdateCommentRequest;
use Modules\Comment\Service\CommentService;

class CommentController extends Controller
{
    public function index()
    {
     return CommentService::index();
    }

    
    public function update(UpdateCommentRequest $request, $id)
    {
        return CommentService::update($request,$id);
    }

    public function destroy($id)
    {
        return CommentService::destroy($id);
    }
}
