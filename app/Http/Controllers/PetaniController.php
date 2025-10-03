<?php
namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $penawarans = Penawaran::where('status', 'aktif')->latest()->get();
        return view('petani.penawaran.index', compact('penawarans'));
    }

    public function show(Penawaran $penawaran)
    {
        return view('petani.penawaran.show', compact('penawaran'));
    }
}
