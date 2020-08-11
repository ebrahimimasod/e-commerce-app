<?php

namespace Modules\Comment\Service;

use Modules\Comment\Entities\Comment;
use Modules\Comment\Http\Requests\CreateCommentRequest;
use Modules\Comment\Http\Requests\UpdateCommentRequest;
use Modules\Product\Entities\Product;

class CommentService{
    
    
    public static function index(){
        $comments=Comment::latest()->paginate(20);
        return $comments;
    }


    public static function getProductComments($product){
        $product =Product::where('id',$product)->firstOrFail();
        return $product->comments()->where('status',Comment::ACCEPTED)->latest()->paginate(20);
    }

    public static function store(CreateCommentRequest $request,$product)
    {
        $product              = Product::where('id',$product)->firstOrFail();
        $comment              = $request->validated();
        $comment['good_tags'] = self::tagsToString($comment['good_tags']);
        $comment['bad_tags']  = self::tagsToString($comment['bad_tags']);
        $comment['user_id']   = auth('api')->id();
        $product->comments()->create($comment);
        return httpResponse('نظر شما با موفقیت ثبت شد.پس از تایید منتشر خواهد شد.');
    }
    


    public static function update(UpdateCommentRequest $request,$id){
        $data=$request->validated();
        $comment=Comment::findOrFail($id);
        $data['good_tags'] = self::tagsToString($data['good_tags']);
        $data['bad_tags']  = self::tagsToString($data['bad_tags']);
        $comment->update($data);
        return HttpResponse('با موفقیت اپدیت شد.');
    }


    public static function destroy($id)
    {
        $comment=Comment::findOrFail($id);
        $comment->delete();
        return HttpResponse('با موفقیت حذف شد');
    }

    
    private static function tagsToString($tags=[])
    {
        return join('@',$tags);
    }



}