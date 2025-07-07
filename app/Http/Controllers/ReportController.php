<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller // ✅ Add this class
{
    public function reportsView()
    {
        $feedbacks = Feedback::with(['customer', 'item'])->latest()->get();
        return view('admin.reports', compact('feedbacks'));
    }

    public function exportCsv()
    {
        $feedbacks = Feedback::with(['customer', 'item'])->get();

        $filename = 'feedback_report_' . now()->format('Y-m-d') . '.csv';
        $headers = ['Content-Type' => 'text/csv'];

        $callback = function () use ($feedbacks) {
            $file = fopen('php://output', 'w');
            // Header
            fputcsv($file, ['Customer', 'Item', 'Rating', 'Feedback', 'Date']);

            // Data rows
            foreach ($feedbacks as $fb) {
                fputcsv($file, [
                    $fb->customer->customer_name ?? 'N/A',
                    $fb->item->item_name ?? 'N/A',
                    $fb->star_rating,
                    $fb->feedback_text,
                    $fb->submission_date,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, array_merge($headers, [
            "Content-Disposition" => "attachment; filename={$filename}",
        ]));
    }
}
