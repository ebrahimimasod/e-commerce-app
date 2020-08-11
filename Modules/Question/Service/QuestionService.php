<?php

namespace Modules\Question\Service;

use Modules\Product\Entities\Product;
use Modules\Question\Entities\Question;
use Modules\Question\Http\Requests\CreateQuestionRequest;
use Modules\Question\Http\Requests\ReplyQuestionRequest;
use Modules\Question\Http\Requests\UpdateQuestionRequest;

class QuestionService{

    public static function index()
    {
        $question=Question::latest()->paginate(20);
        return $question;
    }


    public static function getProductQuestions($product)
    {
        $product=Product::where('id',$product)->firstOrFail();
        return $questions= $product->questions()->where('status',true)->latest()->paginate(20);
    }


    public static function store(CreateQuestionRequest $request,$product)
    {
        $question=$request->validated();
        $question['user_id']=auth('api')->id();
      
        if($request->filled('parent_id')){
            $resText='.پاسخ شما با موفقیت ثبت شد.پس از بررسی منتشر خواهد شد';
        }else{
            $resText='.پرسش شما با موفقیت ثبت شد.پس از بررسی منتشر خواهد شد';
        }
        
        $product=Product::where('id',$product)->firstOrFail();
        $product->questions()->create($question);
        return httpResponse($resText);
    }

  

    public static function update(UpdateQuestionRequest $request,$id)
    {
        $question = Question::findOrFail($id);
        $data=$request->validated();
        $question->update($data);
        return httpResponse('.با موفقیت ویرایش شد');
    }

    public static function destroy($id)
    {
        $question=Question::findOrFail($id);
        $question->delete();
        return httpResponse('.با موفقیت حذف شد');
    }



}