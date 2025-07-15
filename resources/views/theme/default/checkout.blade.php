<x-layout>
    <x-slot name="title">Checkout</x-slot>

    <div class="container my-5" style="color: #3D74B6;">
        <div class="row">
            <!-- Detail Penagihan -->
            <div class="col-md-7">
                <h4 class="mb-4">Detail Penagihan</h4>
                <form>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Masukkan nama lengkap Anda">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" placeholder="anda@contoh.com">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" placeholder="Jl. Contoh 1234">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="city" placeholder="Kota">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="state" placeholder="Provinsi">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zip" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="zip" placeholder="Kode Pos">
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class="mb-3">Pembayaran</h5>
                    <div class="mb-3">
                        <label for="cardName" class="form-label">Nama di Kartu</label>
                        <input type="text" class="form-control" id="cardName" placeholder="Nama sesuai kartu">
                    </div>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Nomor Kartu Kredit</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="Nomor kartu">
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cardExp" class="form-label">Masa Berlaku</label>
                            <input type="text" class="form-control" id="cardExp" placeholder="MM/YY">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cardCvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cardCvv" placeholder="CVV">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="col-md-5">
                <ul class="list-group mb-3">
                    <h4 class="mb-4">Detail Pesanan</h4>
                    @forelse ($cart->items as $item)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0" style="color: #3D74B6;">{{ $item->itemable->name ?? 'Produk tidak ditemukan' }}</h6>
                            <small class="text-muted">Jumlah: {{ $item->quantity }}</small>
                        </div>
                        <span class="text" style="color: #07bd1fff;">Rp{{ number_format((optional($item->itemable)->getPrice() ?? 0) * $item->quantity, 0, ',', '.') }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-danger">Keranjang kosong.</li>
                    @endforelse
                    <li class="list-group-item d-flex justify-content-between">
                        <span style="color: #3D74B6;">Subtotal</span>
                        <strong style="color: #07bd1fff">Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span style="color: #3D74B6;">Ongkir</span>
                        <strong style="color: #07bd1fff">Rp{{ number_format($ongkir, 0, ',', '.') }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span style="color: #3D74B6;">Total</span>
                        <strong style="color: #07bd1fff">Rp{{ number_format($total, 0, ',', '.') }}</strong>
                    </li>
                </ul>

                @if ($subtotal < 1000000)
                    <div class="alert alert-info" role="alert">
                    Gratis ongkir untuk pesanan di atas Rp1.000.000!
            </div>
            @endif
            <button class="btn btn-primary w-100 mt-3" type="submit" style="background-color: #00ad17ff; border:1px solid #009e15ff ">Pesan Sekarang</button>
        </div>
    </div>
</x-layout>

<!-- <style>
    .form-control::placeholder {
        color: #73a3deff;
        opacity: 1;
    }
</style> -->