<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $newsQuery = News::where('is_active', 1);

        if ($query) {
            $newsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%"); // Anda bisa tambahkan field lain jika perlu
            });
        }

        $news = $newsQuery->latest()->paginate(5); // Ubah paginate sesuai kebutuhan
        $recentNews = News::where('is_active', 1)->latest()->take(5)->get();

        // Jika tidak ada hasil pencarian dan query ada, tampilkan pesan
        if ($query && $news->isEmpty()) {
            // Anda bisa mengirimkan pesan khusus ke view
            // atau biarkan view menangani $news->isEmpty()
        }

        return view('news', compact('news', 'recentNews', 'query')); // Tambahkan 'query'
    }

    public function show($id)
    {
        $newsItem = News::where('id', $id)->where('is_active', 1)->firstOrFail();
        $recentNews = News::where('is_active', 1)->where('id', '!=', $id)->latest()->take(5)->get(); // Jangan tampilkan berita yang sedang dibaca di recent

        return view('newsdetail', compact('newsItem', 'recentNews'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (empty($query)) {
            return response()->json([
                'news' => [],
                'message' => 'Query tidak boleh kosong'
            ]);
        }

        $news = News::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orderBy('date', 'desc')
            ->get();

        // If this is an AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'news' => $news,
                'query' => $query,
                'count' => $news->count()
            ]);
        }

        // If regular request, return view (for fallback)
        $recentNews = News::orderBy('date', 'desc')->take(5)->get();

        return view('news', [
            'news' => $news,
            'recentNews' => $recentNews,
            'query' => $query
        ]);
    }
}
