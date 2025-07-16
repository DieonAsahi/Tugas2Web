<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Categories; // pastikan ini sesuai modelmu

class CategoryController extends Controller
{
    public function sync(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        if ($request->is_active == 0) {
            // Kirim ke server eksternal (aktifkan sinkronisasi)
            $response = Http::post('https://phb-umkm.my.id/api/categories', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'name' => $category->name,
                'description' => $category->description,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $category->hub_category_id = $data['id'] ?? 'synced';
                $category->save();

                return back()->with('success', 'Kategori berhasil dikirim ke UMKM');
            } else {
                return back()->with('error', 'Gagal sinkronisasi ke server UMKM');
            }
        } else {
            // Nonaktifkan (hapus sinkronisasi lokal)
            $category->hub_category_id = null;
            $category->save();

            return back()->with('success', 'Sinkronisasi kategori dinonaktifkan');
        }
    }
}
