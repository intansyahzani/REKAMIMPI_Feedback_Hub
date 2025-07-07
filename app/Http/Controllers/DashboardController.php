<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Item;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // 🟣 Admin dashboard: show new feedback and feedback count + chart data
    public function index()
    {
        // Recent new feedbacks (no response yet)
        $newFeedbacks = Feedback::with(['customer', 'item'])
                                ->where('status', 'new')
                                ->whereNull('response')
                                ->latest()
                                ->take(5)
                                ->get();

        $newFeedbackCount = $newFeedbacks->count();

        // ⭐ Feedback count per star rating (for chart)
        $starCounts = [
            '1' => Feedback::where('star_rating', 1)->count(),
            '2' => Feedback::where('star_rating', 2)->count(),
            '3' => Feedback::where('star_rating', 3)->count(),
            '4' => Feedback::where('star_rating', 4)->count(),
            '5' => Feedback::where('star_rating', 5)->count(),
        ];

        return view('dashboard', compact('newFeedbacks', 'newFeedbackCount', 'starCounts'));
    }

    // 🔴 Delete feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Feedback deleted successfully.');
    }

    // 🟢 Respond to feedback
    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->response = $request->response;
        $feedback->status = 'responded'; // ✅ Mark as responded
        $feedback->save();

        return redirect()->route('admin.dashboard')->with('success', 'Response added successfully.');
    }
}
