<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Detail;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index()
    {
        $kuliners = Kuliner::all();
        return view('homepage.index', compact('kuliners'));
    }

    public function data()
    {
        $kuliners = Kuliner::all();
        return view('kuliners.data', compact('kuliners'));
    }

    public function create()
    {
        return view('kuliners.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nmcafe' => 'required',
        'altcafe' => 'required',
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'keterangan' => 'required',
        'maps' => 'required',
    ]);

    $imagePath = $request->file('file')->store('uploads', 'public');

    Kuliner::create([
        'nmcafe' => $request->nmcafe,
        'altcafe' => $request->altcafe,
        'file' => $imagePath,
        'keterangan' => $request->keterangan,
        'maps' => $request->maps,
    ]);

    return redirect()->route('kuliner')->with('success', 'Data kuliners berhasil ditambahkan.');
}

    public function show($id)
    {
        $kuliners = Kuliner::findOrFail($id);

        $details = Detail::where('id_detail', $id)->get();

        return view('homepage.detail-menu', compact('kuliners', 'details'));
    }

    public function edit($id)
    {
        $kuliner = Kuliner::find($id);
        return view('kuliners.edit', compact('kuliner'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nmcafe' => 'required',
        'altcafe' => 'required',
        'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan
        'keterangan' => 'required',
        'maps' => 'required',
    ]);

    $kuliner = Kuliner::find($id);

    $kuliner->update([
        'nmcafe' => $request->nmcafe,
        'altcafe' => $request->altcafe,
        'keterangan' => $request->keterangan,
        'maps' => $request->maps,
    ]);

    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        // Storage::disk('public')->delete($kuliner->file);

        // Upload file baru
        $imagePath = $request->file('file')->store('uploads', 'public');
        $kuliner->update(['file' => $imagePath]);
    }

    return redirect()->route('kuliner')->with('success', 'Data kuliners berhasil diperbarui.');
}

    public function destroy($id)
    {
        Kuliner::find($id)->delete();

        return redirect()->route('kuliner')
                         ->with('success', 'Data kuliners berhasil dihapus.');
    }
}
