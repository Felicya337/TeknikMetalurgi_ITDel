<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;

class StructureOrganizationController extends Controller
{
    public function index()
    {
        $levels = [];
        for ($i = 0; $i <= 4; $i++) {
            $levels[$i] = StructureOrganization::where('level', $i)
                ->where('is_active', true)
                ->orderBy('order', 'asc')
                ->get();
        }
        return view('structureorganization', compact('levels'));
    }
}
