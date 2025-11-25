<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMedicineController extends Controller
{
    /**
     * Menampilkan daftar obat
     * Fitur: Search, Filter Stok, Sorting
     */
    public function index(Request $request)
    {
        $query = Medicine::query();

        // 1. LOGIKA PENCARIAN (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%");
        }

        // 2. LOGIKA FILTER (Berdasarkan Stok)
        if ($request->filled('stock')) {
            if ($request->stock === 'available') {
                $query->where('stok', '>', 0);
            } elseif ($request->stock === 'out_of_stock') {
                $query->where('stok', '<=', 0);
            }
        }

        // 3. LOGIKA SORTING (Urutan)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('nama', 'asc');
                    break;
                case 'stock_low':
                    $query->orderBy('stok', 'asc');
                    break;
                case 'stock_high':
                    $query->orderBy('stok', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            // Default urutan terbaru
            $query->latest();
        }

        // Eksekusi Query dengan Pagination & Query String
        $medicines = $query->paginate(10)->withQueryString();
        
        return view('admin.medicines.index', compact('medicines'));
    }

    /**
     * Form tambah obat baru
     */
    public function create()
    {
        return view('admin.medicines.create');
    }

    /**
     * Simpan obat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tipe' => 'required|in:obat keras,biasa',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('medicines', 'public');
            $data['gambar'] = $path;
        }

        Medicine::create($data);

        return redirect()->route('admin.medicines.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    /**
     * Form edit obat
     */
    public function edit(Medicine $medicine)
    {
        return view('admin.medicines.edit', compact('medicine'));
    }

    /**
     * Update data obat
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tipe' => 'required|in:obat keras,biasa',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($medicine->gambar) {
                Storage::disk('public')->delete($medicine->gambar);
            }
            $path = $request->file('gambar')->store('medicines', 'public');
            $data['gambar'] = $path;
        }

        $medicine->update($data);

        return redirect()->route('admin.medicines.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    /**
     * Hapus obat
     */
    public function destroy(Medicine $medicine)
    {
        if ($medicine->gambar) {
            Storage::disk('public')->delete($medicine->gambar);
        }
        
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Obat berhasil dihapus!');
    }
}