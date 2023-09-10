<?php

namespace App\Http\Controllers;

use App\Models\Cabor;
use App\Models\Event;
use App\Models\Pertandingan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index()
    {
        // Get the latest event
        $latestEvent = DB::table('events')
            ->orderBy('tgl_mulai', 'desc')
            ->first(); // Ambil hanya satu record pertama

        // Get all cabors
        $cabors = Cabor::with('caborPertandingans')->get();

        // Get all pertandingans
        $pertandingans = Pertandingan::with('event', 'cabor', 'venue')->get();

        // Create a collection to store medal counts
        $medalCounts = new Collection();

        // Calculate medal counts for each cabor
        foreach ($cabors as $cabor) {
            $cabor->emas = $cabor->medaliEmas();
            $cabor->perak = $cabor->medaliPerak();
            $cabor->perunggu = $cabor->medaliPerunggu();
            $cabor->total = $cabor->totalMedali();

            // Add medal counts to the collection
            $medalCounts->push([
                'cabangOlahraga' => $cabor->name,
                'emas' => $cabor->emas,
                'perak' => $cabor->perak,
                'perunggu' => $cabor->perunggu,
            ]);
        }

        // Calculate total medal counts for all cabors
        $totalEmas = $medalCounts->sum('emas');
        $totalPerak = $medalCounts->sum('perak');
        $totalPerunggu = $medalCounts->sum('perunggu');

        // Send data with json format
        return response()->json([
            'latestEvent' => $latestEvent,
            'cabors' => $cabors,
            'pertandingans' => $pertandingans,
            'totalEmas' => $totalEmas,
            'totalPerak' => $totalPerak,
            'totalPerunggu' => $totalPerunggu,
        ]);

    }
}