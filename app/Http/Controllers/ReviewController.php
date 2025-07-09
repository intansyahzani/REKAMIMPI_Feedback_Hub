<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Show the feedback submission form
    public function showForm()
    {
        $items = Item::all();
        return view('rate-us', compact('items'));
    }

    // Handle the form submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'star_rating' => 'required|integer|min:1|max:5',
            'feedback_text' => 'required|string|max:1000',
            'item_id' => 'nullable|exists:items,id',
        ]);

        $feedback = new Feedback();
        $feedback->star_rating = $validated['star_rating'];
        $feedback->feedback_text = $validated['feedback_text'];
        $feedback->item_id = $validated['item_id'] ?? null;
        $feedback->customer_id = Auth::check() ? Auth::id() : null;
        $feedback->submission_date = now();

        $feedback->save();

        return back()->with('success', 'Thank you for your feedback!');
    }

    // Publicly show all feedback history to everyone, no login needed
    public function reviewHistory()
    {
        $feedbacks = Feedback::with('customer')
            ->orderBy('submission_date', 'desc')
            ->get();

        return view('review-history', compact('feedbacks'));
    }
}
