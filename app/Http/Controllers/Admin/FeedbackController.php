<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feedbackModel = new Feedback();
        $feedbackModel->fill($request->except('_token'));
        
        $feedbackModel->save();
        return redirect()->route('admin.feedbacks.index')
        ->with('status', 'Feedback is created');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $feedback->fill($request->all());
        $feedback->save();
        return redirect()->route('admin.feedbacks.index')
        ->with('status', 'Feedback is updated');
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
