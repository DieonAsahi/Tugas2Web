<x-layout>
    <x-slot name="title">Keranjang Belanja</x-slot>

    <div class="container my-5">
        <h1 class="mb-4" style="color: #3D74B6;">Keranjang Belanja</h1>

        @if($cart && count($cart->items))
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            @forelse($cart->items as $item)
                                @php
                                    $product = optional($item->itemable);
                                @endphp
                                <div class="cart-item d-flex align-items-center mb-3 border-bottom pb-3" style="color: #3D74B6;">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/80?text=Product' }}" 
                                         class="cart-img me-3 rounded" 
                                         alt="{{ $product->name ?? 'Produk tidak tersedia' }}">
                                    <div class="flex-grow-1">
                                        <h5 class="cart-item-name mb-1">{{ $product->name ?? 'Produk tidak tersedia' }}</h5>
                                        <p class="cart-item-price mb-0">Rp.{{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline-flex me-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                            <input type="text" name="quantity" value="{{ $item->quantity }}" class="form-control form-control-sm text-center mx-1" style="width: 50px; color: #3D74B6;" readonly>
                                            <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                                        </form>

                                        <span class="cart-item-subtotal mb-0 me-3 fw-semibold" style="color: #009e15ff;">
                                            Rp.{{ number_format(($product->price ?? 0) * $item->quantity, 0, ',', '.') }}
                                        </span>

                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-white btn-sm" title="Hapus" style="background-color: #d10000ff; border:1px solid #ac0000ff">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    Keranjang belanja Anda kosong.
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <a href="{{ url('/products') }}" class="btn btn-outline-primary mt-2" style="color: #3D74B6; border-color: #3D74B6;">
                        <i class="bi bi-arrow-left"></i> Lanjut Belanja
                    </a>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card p-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3 border-bottom pb-3" style="color: #3D74B6;">Ringkasan Pesanan</h5>
                            <div class="d-flex justify-content-between total-section mb-2" style="color: #3D74B6;">
                                <span>Subtotal</span>
                                <span>Rp.{{ number_format(optional($item->itemable)->getPrice() ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between total-section fw-bold" style="color: #3D74B6;">
                                <span>Total</span>
                                <span>Rp.{{ number_format(optional($item->itemable)->getPrice() ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="btn text-white w-100 mt-3" style="background-color: #00ad17ff; border:1px solid #009e15ff">
                                Lanjut ke Pembayaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Keranjang belanja Anda kosong.
            </div>
        @endif
    </div>
</x-layout>
