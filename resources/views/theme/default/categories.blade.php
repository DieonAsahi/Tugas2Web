<x-layout>
    <x-slot name="title"> Categories</x-slot>

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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-size: 1.5rem; color: #3D74B6;">Kategori Product</h3>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach($categories as $category)
            <div class="col">
                <a href="{{ URL::to('/category/'.$category->slug) }}" class="card text-decoration-none">
                    <div class="card category-card text-center h-100 py-3 border-0 shadow-sm">
                        <div class="mx-auto mb-2" style="width: 250px; height: 250px; padding-top: 5px; padding-left: 10px; padding-right: 10px; background:#f8f9fa; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1">{{ $category->name }}</h6>
                            <p class="card-text small text-truncate">{{ $category->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center w-100 mt-4">
            {{ $categories->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>

</x-layout>