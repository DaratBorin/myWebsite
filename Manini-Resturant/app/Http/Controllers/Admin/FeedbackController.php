<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(20);
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function updateStatus(Request $request, Feedback $feedback)
    {
        $feedback->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Feedback deleted.');
    }
}