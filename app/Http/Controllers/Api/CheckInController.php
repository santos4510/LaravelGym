<?php

namespace App\\Http\Controllers\\Api;

use App\\Http\\Controllers\\Controller;
use Illuminate\\Http\\Request;
use Carbon\\Carbon;

class CheckInController extends Controller
{
    /**
     * Display the user's attendances for the current week.
     */
    public function index(Request \)
    {
        \ = \->user();
        
        // Assuming the frontend week starts on Monday
        \ = now()->startOfWeek(Carbon::MONDAY);
        \ = now()->endOfWeek(Carbon::SUNDAY);

        \ = \->attendances()
            ->whereBetween('date', [\, \])
            ->get()
            ->map(function (\) {
                // Return the day of the week (0=Sun, 1=Mon, ..., 6=Sat)
                return Carbon::parse(\->date)->dayOfWeek;
            });

        return response()->json(\);
    }

    /**
     * Store a new attendance for the current day (check-in).
     */
    public function store(Request \)
    {
        \ = \->user();
        \ = now()->toDateString();

        // Use firstOrCreate to prevent duplicate check-ins for the same day.
        \ = \->attendances()->firstOrCreate(
            ['date' => \]
        );

        if (\->wasRecentlyCreated) {
            // Future logic for updating streak can go here.
            return response()->json(['message' => 'Check-in successful.'], 201);
        }

        return response()->json(['message' => 'Already checked in today.'], 200);
    }
}
