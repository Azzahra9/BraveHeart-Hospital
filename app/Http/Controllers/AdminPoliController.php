<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class AdminPoliController extends Controller
{
    /**
     * Menampilkan daftar poli
     */
    public function index()
    {
        $polis = Poli::latest()->paginate(10);
        return view('admin.polis.index', compact('polis'));
    }

    /**
     * Menampilkan form tambah poli baru
     */
    public function create()
    {
        return view('admin.polis.create');
    }

    /**
     * Menyimpan poli baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255|unique:polis,nama_poli',
            'deskripsi' => 'required|string',
            // Icon opsional, bisa dikembangkan nanti (misal upload gambar)
        ]);

        Poli::create($request->all());

        return redirect()->route('admin.polis.index')
                         ->with('success', 'Poli berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit poli
     */
    public function edit(Poli $poli)
    {
        return view('admin.polis.edit', compact('poli'));
    }

    /**
     * Mengupdate data poli
     */
    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255|unique:polis,nama_poli,' . $poli->id,
            'deskripsi' => 'required|string',
        ]);

        $poli->update($request->all());

        return redirect()->route('admin.polis.index')
                         ->with('success', 'Data poli berhasil diperbarui!');
    }

    /**
     * Menghapus poli
     */
    public function destroy(Poli $poli)
    {
        // Cek apakah ada dokter yang terhubung ke poli ini?
        // Jika ada, sebaiknya jangan dihapus sembarangan atau set null dulu (sudah dihandle di migration on delete set null)
        $poli->delete();

        return redirect()->route('admin.polis.index')
                         ->with('success', 'Poli berhasil dihapus!');
    }
}