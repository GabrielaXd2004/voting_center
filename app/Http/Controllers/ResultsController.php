<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Category;
use App\Models\Participant;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function create($id)
    {
        $categories = Category::where('id', $id)->get();
        $participants = Participant::get();
        return view('votes.votes', compact('categories', 'participants'));
    }


    public function store(Request $request, $id)
    {
        // $result = new Result();
        // dd($request->votes);
        $result = Result::firstOrNew(['category_id' => $id, 'participant_id' => $request->participant]);
        $result->category_id = $id;
        $result->participant_id = $request->participant;
        $result->votes += $request->votes;
        $result->save();

        return redirect()->route('welcome');
    }
}
