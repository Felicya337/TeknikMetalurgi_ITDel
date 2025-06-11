<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = strtolower(trim($request->input('query')));

            Log::info('Search query received: ' . $query);

            if (empty($query)) {
                if ($request->expectsJson()) {
                    Log::warning('Empty search query');
                    return response()->json(['error' => 'Masukkan kata kunci pencarian.'], 400);
                }
                return redirect()->route('not-found')->with('error', 'Masukkan kata kunci pencarian.');
            }

            $validPages = [
                ['keywords' => ['beranda', 'home', 'utama'], 'url' => '/', 'name' => 'Beranda'],
                ['keywords' => ['profil', 'profile', 'profil umum', 'tentang', 'sejarah'], 'url' => '/metaprofile', 'name' => 'Profil Umum'],
                ['keywords' => ['kurikulum', 'curriculum', 'mata kuliah', 'matkul'], 'url' => '/curriculum', 'name' => 'Kurikulum'],
                ['keywords' => ['struktur', 'organisasi', 'struktur organisasi', 'organization'], 'url' => '/structureorganization', 'name' => 'Struktur Organisasi'],
                ['keywords' => ['dosen', 'staff', 'dosen staff', 'lecturer', 'pengajar'], 'url' => '/lecturer', 'name' => 'Dosen Staff'],
                ['keywords' => ['publikasi', 'publication', 'jurnal', 'paper'], 'url' => '/achievements/publication', 'name' => 'Publikasi'],
                ['keywords' => ['penelitian', 'research', 'riset'], 'url' => '/achievements/research', 'name' => 'Penelitian'],
                ['keywords' => ['pencapaian', 'achievement', 'prestasi'], 'url' => '/achievements/achievement', 'name' => 'Pencapaian'],
                ['keywords' => ['fasilitas', 'facility', 'sarana'], 'url' => '/facility', 'name' => 'Fasilitas'],
                ['keywords' => ['laboratorium', 'laboratory', 'lab'], 'url' => '/laboratory', 'name' => 'Laboratorium'],
                ['keywords' => ['kegiatan mahasiswa', 'student activity', 'aktivitas mahasiswa'], 'url' => '/student_activity/activity', 'name' => 'Kegiatan Mahasiswa'],
                ['keywords' => ['kegiatan prodi', 'program', 'kegiatan program'], 'url' => '/student_activity/program', 'name' => 'Kegiatan Prodi'],
                ['keywords' => ['club', 'klub', 'club mahasiswa', 'organisasi mahasiswa'], 'url' => '/student_activity/club', 'name' => 'Club Mahasiswa'],
                ['keywords' => ['berita', 'news', 'artikel'], 'url' => '/news', 'name' => 'Berita'],
                ['keywords' => ['testimoni', 'testimonial', 'kesaksian'], 'url' => '/#testimonial-section', 'name' => 'Testimoni'],
                ['keywords' => ['kerjasama', 'collaborate', 'collaboration', 'partnership'], 'url' => '/#kerjasama-section', 'name' => 'Kerjasama'],
            ];

            $pageResult = null;
            foreach ($validPages as $page) {
                foreach ($page['keywords'] as $keyword) {
                    $keywordLower = strtolower($keyword);
                    if (strpos($keywordLower, $query) !== false || strpos($query, $keywordLower) !== false) {
                        $pageResult = ['url' => $page['url'], 'name' => $page['name']];
                        Log::info('Page match found: ' . $page['name']);
                        break 2;
                    }
                }
            }

            if ($request->expectsJson()) {
                if ($pageResult) {
                    return response()->json(['page' => $pageResult]);
                }
                // Optionally, search for testimonials or collaborations in the database
                $news = \App\Models\News::where('is_active', true)
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%' . $query . '%')
                            ->orWhere('content', 'like', '%' . $query . '%');
                    })->get();
                $testimonials = \App\Models\Testimonial::where('is_active', true)
                    ->where(function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%')
                            ->orWhere('content', 'like', '%' . $query . '%')
                            ->orWhere('student', 'like', '%' . $query . '%');
                    })->get();
                $collaborates = \App\Models\Collaborate::where('is_active', true)
                    ->where(function ($q) use ($query) {
                        $q->where('institution_name', 'like', '%' . $query . '%')
                            ->orWhere('company_profile', 'like', '%' . $query . '%')
                            ->orWhere('institution_description', 'like', '%' . $query . '%');
                    })->get();

                return response()->json([
                    'query' => $query,
                    'news' => $news,
                    'testimonials' => $testimonials,
                    'collaborates' => $collaborates
                ]);
            }

            if ($pageResult) {
                return redirect($pageResult['url']);
            }

            return view('search-results', compact('query', 'pageResult'));
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Terjadi kesalahan dalam pencarian: ' . $e->getMessage()], 500);
            }
            return redirect()->route('not-found')->with('error', 'Terjadi kesalahan dalam pencarian.');
        }
    }
}
