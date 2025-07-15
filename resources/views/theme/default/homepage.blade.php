<x-layout>
    <x-slot name="title">Beranda</x-slot>

<div class="container-fluid px-0">
    <img src="{{ asset('storage/uploads/assets/Slider.png') }}" alt="Slider" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
</div>


    <div class="container py-3 border-bottom pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-size: 1.5rem; color: #3D74B6; padding-top:20px">Kategori Product</h3>
            <a href="{{ URL::to('/categories') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Kategori</a>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach($categories as $category)
            <div class="col">
                <a href="{{ URL::to('/category/'.$category->slug) }}" class="card text-decoration-none h-100">
                    <div class="card category-card text-center h-100 border-0 shadow-sm">

                        <!-- Kotak Gambar -->
                        <div class="mx-auto mb-2" style="width: 100%; height: 200px; background:#f8f9fa; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                        </div>

                        <div class="card-body p-2">
                            <h6 class="card-title mb-1 text-dark">{{ $category->name }}</h6>
                            <p class="card-text text-muted small text-truncate">{{ $category->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

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

    <div class="container py-3 pt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-size: 1.5rem; color: #3D74B6;">Product Kami</h3>
            <a href="{{ URL::to('/products') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Product</a>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($products as $product)
            <div class="col">
                <div class="card product-card h-100 shadow-sm">
                    <div class="text-center" style="background:#f8f9fa; height: 200px; display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-truncate">{{ $product->description }}</p>
                        <div class="mt-auto">
                            <span class="fw-bold" style="color: #64d172;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary btn-sm float-end">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <div class="col">
                <div class="alert alert-info">Belum ada produk.</div>
            </div>
            @endforelse

            <div class="d-flex justify-content-center w-100 mt-4">
                {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layout>