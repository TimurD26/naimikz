<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'spec_id' => ['required', 'integer'],
            'review_mark' => ['required', 'string'],
            'text' => ['required', 'string'],
            'name' => ['required', 'string'],
            'url_to_photo' => ['required', 'string'],
          ]);
     $review = new Review();
     $review->spec_id = $request->spec_id;
     $review->review_mark = $request->review_mark;
     $review->text = $request->text;
     $review->name = $request->name;
     $review->url_to_photo = $request->url_to_photo;
     $review->save();
     return $review;
    }
    public function get_all()
    {
        $reviews=Review::paginate(15);
        return $reviews;
    }
    public function update($id, Request $request )
    {
        $review=Review::find($id);
        $review->spec_id = $request->spec_id;
        $review->review_mark = $request->review_mark;
        $review->text = $request->text;
        $review->name = $request->name;
        $review->url_to_photo = $request->url_to_photo;
        $review->save();
        return $review;
    }
    public function destroy($id)
    {
        $review=Review::find($id);
        
        $review->delete();
        // $cabinet->save();
        return $review;
    }
}
