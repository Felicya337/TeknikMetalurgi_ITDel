<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:16777215',
            'date' => 'required|date_format:Y-m-d',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('news_images', 'public');
            }

            $data['created_by'] = Auth::guard('admin')->id();

            if (!$data['created_by']) {
                return redirect()->back()->with('error', 'Admin belum login. Silakan login terlebih dahulu.');
            }

            News::create($data);

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Failed to store news: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan berita. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:16777215',
            'date' => 'required|date_format:Y-m-d',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean',
        ]);

        try {
            $news = News::findOrFail($id);
            $data = $request->all();

            // Hapus id dari data yang akan diperbarui karena id tidak boleh diedit
            unset($data['id']);

            if ($request->hasFile('image')) {
                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }
                $data['image'] = $request->file('image')->store('news_images', 'public');
            }

            $data['updated_by'] = Auth::guard('admin')->id() ?? null;

            $news->update($data);

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Failed to update news: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui berita. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            $news = News::findOrFail($id);

            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            $news->delete();

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Failed to delete news: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus berita. Silakan coba lagi.');
        }
    }
}
