<?php

namespace App\Http\Controllers;

use App\Models\Cabor;
use App\Models\Event;
use App\Models\Pertandingan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get the latest event
        $latestEvent = Event::with('eventPertandingans')
            ->orderBy('tgl_mulai', 'desc')
            ->first(); // Ambil hanya satu record pertama

        // Get all cabors
        $cabors = Cabor::with('caborPertandingans')->get();

        // Get all events
        $events = Event::with('eventPertandingans')->get();

        // Get event group by cabor
        $eventGroupByCabor = Event::with('eventPertandingans')->get()->groupBy('cabor_id');

        // Get all pertandingans
        $pertandingans = Pertandingan::with('event', 'cabor', 'venue')->get();

        // Get Latest News from blogger api
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'. env('BLOGGER_BLOG_ID') .'/posts?maxResults=1&key=' . env('BLOGGER_API_KEY');
        $data = json_decode(file_get_contents($url), true);
        // get image from content
        $content = $data['items'][0]['content'];
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
        $data['items'][0]['image'] = $image['src'];

        $latestNews = $data['items'][0];

        // Get 8 latest news from blogger api
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'. env('BLOGGER_BLOG_ID') .'/posts?maxResults=8&key=' . env('BLOGGER_API_KEY');
        $data = json_decode(file_get_contents($url), true);
        // get image from content
        foreach ($data['items'] as $key => $value) {
            $content = $value['content'];
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            $data['items'][$key]['image'] = $image['src'];
        }
        // limit title length and add ellipsis
        foreach ($data['items'] as $key => $value) {
            $data['items'][$key]['title'] = substr($value['title'], 0, 50) . '...';
        }
        $eightlatestNews = $data['items'];

        // split $eightlatestNews into $fourlatestNews and $fourlatestNews2

        $fourlatestNews = array_slice($eightlatestNews, 0, 4);
        $fourlatestNews2 = array_slice($eightlatestNews, 4, 7);


        // Get all news from blogger api
        $allNews = $data['items'];

        return view('front', compact('latestEvent', 'cabors', 'pertandingans', 'events', 'eventGroupByCabor', 'latestNews', 'allNews', 'fourlatestNews', 'fourlatestNews2'));
    }

    public function kalender(Request $request)
    {
        // get 5 berita terbaru
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'. env('BLOGGER_BLOG_ID') .'/posts?maxResults=5&key=' . env('BLOGGER_API_KEY');
        $data = json_decode(file_get_contents($url), true);
         // get image from content
         foreach ($data['items'] as $key => $value) {
            $content = $value['content'];
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            $data['items'][$key]['image'] = $image['src'];
        }

        // limit title length and add ellipsis
        foreach ($data['items'] as $key => $value) {
            $data['items'][$key]['title'] = substr($value['title'], 0, 50) . '...';
        }

        $recentNews = $data['items'];

        // get all cabor
        $cabors = Cabor::with('caborPertandingans')->get();

        // get all events with 1 media
        $events = Event::with('eventPertandingans')->get();

        // Jika cabor_id disertakan dalam request, ambil event yang terkait
        $selectedCabor = $request->input('cabor_id');
        if ($selectedCabor) {
            $events = Event::whereHas('cabors', function ($query) use ($selectedCabor) {
                $query->where('cabor_id', $selectedCabor);
            })->get();
        } else {
            // Jika cabor tidak dipilih, tampilkan semua event
            $events = Event::with('eventPertandingans')->get();
        }

        // dd($events->toArray());

        return view('kalender', compact('recentNews', 'cabors', 'events', 'selectedCabor'));
    }

    public function event($id)
    {
        $event = Event::with('eventPertandingans')->findOrFail($id);

        // get 5 berita terbaru
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'. env('BLOGGER_BLOG_ID') .'/posts?maxResults=5&key=' . env('BLOGGER_API_KEY');
        $data = json_decode(file_get_contents($url), true);
         // get image from content
         foreach ($data['items'] as $key => $value) {
            $content = $value['content'];
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            $data['items'][$key]['image'] = $image['src'];
        }

        // limit title length and add ellipsis
        foreach ($data['items'] as $key => $value) {
            $data['items'][$key]['title'] = substr($value['title'], 0, 50) . '...';
        }

        $recentNews = $data['items'];

        return view('event', compact('event', 'recentNews'));
    }
}