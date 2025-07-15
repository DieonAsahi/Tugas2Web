<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ProductSyncController extends Controller
{
    public function sync(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->is_active == 0) {
            $response = Http::post('https://phb-umkm.my.id/api/products', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category_id' => $product->category_id,
            ]);

            if ($response->successful()) {
                $product->hub_product_id = $response->json()['id'] ?? 'synced';
                $product->save();

                return back()->with('success', 'Produk berhasil disinkron ke UMKM');
            } else {
                return back()->with('error', 'Gagal sinkronisasi produk');
            }
        } else {
            $product->hub_product_id = null;
            $product->save();

            return back()->with('success', 'Sinkronisasi produk dinonaktifkan');
        }
    }
}
