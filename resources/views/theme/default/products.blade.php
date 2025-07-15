<x-layout>
    <x-slot name="title"> Products</x-slot>

    <div class="container py-5">
        <h3 style="font-size: 1.5rem; color: #3D74B6;" class="mb-4">Promo Spesial dari Color Art</h3>

        <div id="promoCarousel" class="carousel slide shadow-sm" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner rounded">
                @foreach (['COLOR ART.png', 'Art Day.png', 'animal.jpg', 'diskon.jpg'] as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/uploads/assets/' . $image) }}" class="d-block w-100" alt="Promo {{ $index + 1 }}" style="max-height: 400px; object-fit: cover;">
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Selanjutnya</span>
            </button>
        </div>
    </div>

    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-4" style="color: #3D74B6;">
            <h3 style="font-size: 1.5rem; color: #3D74B6;">Product Kami</h3>
            <form action="{{ url()->current() }}" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" name="search" class="form-control me-2 search-input" placeholder="Cari produk..." value="{{ request('search') }}" style="color: #3D74B6; border: 1px solid #7f9cc1ff; border-radius: 5px;">
                <button type="submit" class="btn btn-primary" style="background-color: #3D74B6;">Cari</button>
            </form>
        </div>
        <div class="row">
            @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="text-center" style="background:#f8f9fa; height: 200px; padding-right: 20px; padding-left: 20px;  display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-truncate">{{ $product->description }}</p>
                        <div class="mt-auto">
                            <span class="fw-bold" style="color: #64d172;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary btn-sm float-end" style="color: #3D74B6; border-color: #3D74B6;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col">
                <div class="alert alert-info">Belum ada produk pada kategori ini.</div>
            </div>
            @endforelse

            <div class="d-flex justify-content-center w-100 mt-4">
                {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layout>
<style>
    .search-input::placeholder {
        color: #73a3deff;
        opacity: 1;
    }
</style>