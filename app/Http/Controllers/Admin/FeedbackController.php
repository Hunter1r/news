<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Feedbacks\CreateRequest;
use App\Http\Requests\Feedbacks\UpdateRequest;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacksModel = new Feedback();
        $feedbacks = $feedbacksModel->getFeedbacks();
        return view('admin.feedbacks.index', ['feedbacks'=>$feedbacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feedbackModel = new Feedback();
        return view('admin.feedbacks.create', ['feedback'=>$feedbackModel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $feedback = Feedback::create($request->validated());
        if($feedback) {
            return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback is created');
        }
        return back()->with('error', 'Feedback isn\'t created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback  $feedback)
    {
        return view('admin.feedbacks.create', ['feedback'=>$feedback]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Feedback $feedback)
    {
        $feedback->fill($request->validated());
        if($feedback->save()) {
            return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback is updated');
        }
        return back()->with('error', 'Feedback isn\'t updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return response()->json(['message'=>'feedback was deleted successful']);
    }
}
