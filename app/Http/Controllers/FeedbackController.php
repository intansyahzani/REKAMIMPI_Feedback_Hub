<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Item;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    // Show the feedback submission form
    public function showForm()
    {
        $items = Item::all();
        return view('feedback.rate-us', compact('items'));
    }

    // Handle feedback submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
    'name' => 'required|string|max:255',
    'item_id' => 'required|exists:items,id',
    'star_rating' => 'required|integer|min:1|max:5',
    'remarks' => 'required|string|max:1000',
    'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // <= new line
]);
        

        // Determine the customer
        if (Auth::check()) {
            $customer = Auth::user(); // If using Laravel auth
        } else {
            // Create or find customer by name
            $customer = Customer::firstOrCreate(['customer_name' => $validated['name']]);
        }

        // Handle photo upload if provided
       $photoPath = null;
if ($request->hasFile('photo')) {
    try {
        $uploadedFileUrl = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();
        $photoPath = $uploadedFileUrl;
    } catch (\Exception $e) {
        return back()->withErrors(['photo' => 'Upload error: ' . $e->getMessage()]);
    }
}


        // Store feedback
       Feedback::create([
        'customer_id' => $customer->id,
        'item_id' => $validated['item_id'],
        'star_rating' => $validated['star_rating'],
        'feedback_text' => $validated['remarks'],
        'photo_path' => $photoPath, // <= new line
        'response' => null,
        'submission_date' => now(),
        'status' => 'new',
        ]);


        return back()->with([
            'success' => 'Thank you for your feedback!',
            'show_popup' => true,
        ]);
    }

    // Show review history (used by customers)
    public function reviewHistory(Request $request)
    {
        $query = Feedback::with(['item', 'customer'])->orderBy('submission_date', 'desc');

        // Optional filter: star rating
        if ($request->filled('star_rating')) {
            $query->where('star_rating', $request->input('star_rating'));
        }

        $feedbacks = $query->get();

        return view('review-history', compact('feedbacks'));
    }

// Admin views and filters feedback
public function index(Request $request)
{
    $query = Feedback::with(['customer', 'item']);

    if ($request->filled('customer_name')) {
        $query->whereHas('customer', function ($q) use ($request) {
            $q->where('customer_name', 'like', '%' . $request->customer_name . '%');
        });
    }

    if ($request->filled('item_name')) {
        $query->whereHas('item', function ($q) use ($request) {
            $q->where('item_name', 'like', '%' . $request->item_name . '%');
        });
    }

    if ($request->filled('star_rating')) {
        $query->where('star_rating', $request->star_rating);
    }

    if ($request->filled('status')) {
    if ($request->status === 'responded') {
        $query->whereNotNull('response');
    } elseif ($request->status === 'new') {
        $query->whereNull('response');
    }
    }

    if ($request->filled('date')) {
        $query->whereDate('submission_date', $request->date);
    }

    $feedbacks = $query->latest()->paginate(10);

    // 🔧 Add this line to fetch all items for the filter dropdown
    $items = Item::all();

    return view('admin.feedbacks', compact('feedbacks', 'items'));
}


    // Admin responds to feedback
    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->response = $request->input('response');
        $feedback->save();

        return redirect()->back()->with('success', 'Response sent successfully.');
    }

    // Admin deletes feedback
    public function delete($id)
    {
        $feedback = Feedback::findOrFail($id);

        // Delete the photo if it exists
        if ($feedback->photo_path && Storage::disk('public')->exists($feedback->photo_path)) {
            Storage::disk('public')->delete($feedback->photo_path);
        }

        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
    

}
