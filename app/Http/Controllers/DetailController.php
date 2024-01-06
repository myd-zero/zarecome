<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Kuliner;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function data()
    {
        $details = Detail::all();
        $kuliners = Kuliner::all();
        return view('detail-menu', compact('details', 'kuliners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_detail' => 'required',
            'file_menu' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan_menu' => 'required',
        ]);

        $imagePath = $request->file('file_menu')->store('uploads', 'public');

        $kuliner = Kuliner::find($request->id_detail);

        // Mengecek apakah kuliner ditemukan
        if ($kuliner) {
            Detail::create([
                'id_detail' => $request->id_detail,
                'nmcafe' => $kuliner->nmcafe,
                'altcafe' => $kuliner->altcafe,
                'file_menu' => $imagePath,
                'keterangan_menu' => $request->keterangan_menu,
            ]);
        
            return redirect()->back()->with('success', 'Detail created successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid id_detail. Kuliner not found.');
        }
    }

    public function edit(Detail $id)
    {
        $kuliners = Kuliner::all();
        return view('details.edit', compact('details', 'kuliners'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'file_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Memperbolehkan update tanpa mengganti gambar
        'keterangan_menu' => 'required',
    ]);

    $detail = Detail::find($id);

    if (!$detail) {
        return redirect()->back()->with('error', 'Detail not found');
    }

    $imagePath = $detail->file_menu; // Tetap gunakan gambar yang sudah ada jika tidak ada file baru

    if ($request->hasFile('file_menu')) {
        $imagePath = $request->file('file_menu')->store('uploads', 'public');
    }

    $kuliner = Kuliner::find($request->id_detail);

    if (!$kuliner) {
        return redirect()->back()->with('error', 'Kuliner not found');
    }

    $detail->update([
        'id_detail' => $request->id_detail,
        'nmcafe' => $kuliner->nmcafe,
        'altcafe' => $kuliner->altcafe,
        'file_menu' => $imagePath,
        'keterangan_menu' => $request->keterangan_menu,
    ]);

    return redirect()->back()->with('success', 'Detail updated successfully');
}

    
    public function destroy($id)
    {
        Detail::find($id)->delete();
    
        return redirect()->back()
            ->with('success', 'Detail deleted successfully');
    }
    
}
