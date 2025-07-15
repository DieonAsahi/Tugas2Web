<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Binafy\LaravelCart\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private $cart;

    public function __construct()
    {
        // Sama seperti di CartController
        $this->cart = Cart::query()->firstOrCreate([
            'user_id' => auth()->guard('customer')->user()->id
        ]);
    }

    public function index()
    {
        $this->cart->load('items.itemable'); // Eager load relationships

        $cart = $this->cart; // <--- Tambahkan ini agar bisa digunakan di view
        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $ongkir = $subtotal >= 50000 ? 0 : 10000;
        $total = $subtotal + $ongkir;

        return view('theme.default.customer.checkout', compact('cart', 'subtotal', 'ongkir', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        if ($this->cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        DB::beginTransaction();
        try {
            $subtotal = $this->cart->items->sum(fn($item) => $item->price * $item->quantity);
            $ongkir = $subtotal >= 50000 ? 0 : 10000;
            $total = $subtotal + $ongkir;

            $order = Order::create([
                'customer_id' => auth()->guard('customer')->id(),
                'billing_name' => $request->fullname,
                'billing_email' => $request->email,
                'billing_address' => $request->address,
                'billing_city' => $request->city,
                'billing_state' => $request->state,
                'billing_zip' => $request->zip,
                'subtotal' => $subtotal,
                'ongkir' => $ongkir,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($this->cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->itemable->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ]);
            }

            // Kosongkan cart
            $this->cart->items()->delete();

            DB::commit();

            return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }
}
