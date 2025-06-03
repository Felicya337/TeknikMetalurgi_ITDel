<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\Collaborate;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = strtolower(trim($request->input('query')));

        // Validasi input
        if (empty($query)) {
            return response()->json(['error' => 'Masukkan kata kunci pencarian.'], 400);
        }

        // Daftar halaman yang valid
        $validPages = [
            'beranda' => ['url' => '/', 'name' => 'Beranda'],
            'profil umum' => ['url' => '/metaprofile', 'name' => 'Profil Umum'],
            'kurikulum' => ['url' => '/curriculum', 'name' => 'Kurikulum'],
            'struktur organisasi' => ['url' => '/structureorganization', 'name' => 'Struktur Organisasi'],
            'dosen staff' => ['url' => '/lecturer', 'name' => 'Dosen Staff'],
            'publikasi' => ['url' => '/achievements/publication', 'name' => 'Publikasi'],
            'penelitian' => ['url' => '/achievements/research', 'name' => 'Penelitian'],
            'pencapaian' => ['url' => '/achievements/achievement', 'name' => 'Pencapaian'],
            'fasilitas' => ['url' => '/facility', 'name' => 'Fasilitas'],
            'laboratorium' => ['url' => '/laboratory', 'name' => 'Laboratorium'],
            'kegiatan mahasiswa' => ['url' => '/student_activity/activity', 'name' => 'Kegiatan Mahasiswa'],
            'kegiatan prodi' => ['url' => '/student_activity/program', 'name' => 'Kegiatan Prodi'],
            'club mahasiswa' => ['url' => '/student_activity/club', 'name' => 'Club Mahasiswa'],
            'berita' => ['url' => '/news', 'name' => 'Berita'],
            'testimoni' => ['url' => '/testimoni', 'name' => 'Testimoni'],
            'collaborate' => ['url' => '/collaborate', 'name' => 'Kerjasama'],
        ];

        // Cari kecocokan halaman
        $pageResult = null;
        foreach ($validPages as $pageName => $pageData) {
            if (str_contains(strtolower($pageName), $query)) {
                $pageResult = $pageData;
                break;
            }
        }

        // Cari di tabel news
        $newsResults = News::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->get();

        // Cari di tabel testimonials
        $testimonialResults = Testimonial::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    ->orWhere('student', 'LIKE', "%{$query}%");
            })
            ->get();

        // Cari di tabel collaborates
        $collaborateResults = Collaborate::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('company_profile', 'LIKE', "%{$query}%")
                    ->orWhere('institution_description', 'LIKE', "%{$query}%");
            })
            ->get();

        // Jika tidak ada hasil dan tidak ada halaman yang cocok
        if (!$pageResult && $newsResults->isEmpty() && $testimonialResults->isEmpty() && $collaborateResults->isEmpty()) {
            return response()->json([
                'error' => 'Tidak ada hasil ditemukan untuk kata kunci: ' . $query
            ], 404);
        }

        // Kembalikan hasil dalam format JSON
        return response()->json([
            'page' => $pageResult,
            'news' => $newsResults->map(function ($news) {
                return [
                    'id' => $news->id,
                    'title' => $news->title,
                    'content' => \Illuminate\Support\Str::limit(strip_tags($news->content), 200),
                    'image' => $news->image ? asset('storage/' . $news->image) : null,
                    'url' => route('newsdetail', $news->id),
                ];
            }),
            'testimonials' => $testimonialResults->map(function ($testimonial) {
                return [
                    'id' => $testimonial->id,
                    'name' => $testimonial->name,
                    'student' => $testimonial->student,
                    'content' => \Illuminate\Support\Str::limit(strip_tags($testimonial->content), 200),
                    'image' => $testimonial->image ? asset('storage/' . $testimonial->image) : null,
                ];
            }),
            'collaborates' => $collaborateResults->map(function ($collaborate) {
                return [
                    'id' => $collaborate->id,
                    'institution_name' => $collaborate->institution_name,
                    'company_profile' => \Illuminate\Support\Str::limit(strip_tags($collaborate->company_profile), 200),
                    'institution_description' => \Illuminate\Support\Str::limit(strip_tags($collaborate->institution_description), 200),
                    'logo' => $collaborate->logo ? asset('storage/' . $collaborate->logo) : null,
                    'date' => \Carbon\Carbon::parse($collaborate->date)->format('d F Y'),
                ];
            }),
        ]);
    }
}
