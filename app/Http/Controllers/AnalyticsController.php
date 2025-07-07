<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Feedback;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $items = Item::all();
        $labels = [];
        $datasets = [];

        // Initialize arrays to hold star rating counts per item
        $starRatings = [1, 2, 3, 4, 5];
        $ratingData = [
            1 => [], 2 => [], 3 => [], 4 => [], 5 => []
        ];

        foreach ($items as $item) {
            $labels[] = $item->item_name;

            foreach ($starRatings as $star) {
                $query = Feedback::where('item_id', $item->id)
                                 ->where('star_rating', $star);

                if ($startDate) {
                    $query->whereDate('submission_date', '>=', $startDate);
                }

                if ($endDate) {
                    $query->whereDate('submission_date', '<=', $endDate);
                }

                $ratingData[$star][] = $query->count();
            }
        }

        // Build datasets for Chart.js
        $colors = [
            1 => '#f87171', // red
            2 => '#fb923c', // orange
            3 => '#facc15', // yellow
            4 => '#4ade80', // green
            5 => '#60a5fa', // blue
        ];

        foreach ($starRatings as $star) {
            $datasets[] = [
                'label' => $star . '-Star',
                'data' => $ratingData[$star],
                'backgroundColor' => $colors[$star],
                'borderRadius' => 6,
                'barThickness' => 20,
            ];
        }

        return view('admin.analytics', compact('labels', 'datasets', 'startDate', 'endDate'));
    }
}
