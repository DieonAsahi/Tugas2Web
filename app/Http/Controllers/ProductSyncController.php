<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ProductSyncController extends Controller
{
    public function sync(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Data simulasi untuk dikirim
        $postData = [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'name' => $product->name,
            'description' => $product->description ?? 'No description',
            'price' => $product->price,
            'category_id' => $product->category_id,
        ];

        // Kirim permintaan POST ke API eksternal
        $response = Http::post('https://phb-umkm.my.id/api/products', $postData);

        // Tambahkan logging
        Log::info('Post to API:', $postData);
        Log::info('API response:', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->successful()) {
            $product->hub_product_id = $response->json()['id'] ?? 'synced';
            $product->save();

            return back()->with('successMessage', 'Produk berhasil disinkron ke UMKM');
        } else {
            return back()->with('error', 'Gagal sinkronisasi produk. Respon API: ' . $response->body());
        }
    }
}
