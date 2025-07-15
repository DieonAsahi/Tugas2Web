<x-layout>
    <x-slot name="title"> Categories</x-slot>


    @push('styles')
    <style>
        .promo-img {
            height: 60vh;
            object-fit: cover;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .promo-img {
                height: 35vh;
            }
        }
    </style>
    @endpush

    <div class="container my-4">
        <h3 style="color: #3D74B6;">Promo Spesial dari Color Art</h3>
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/uploads/assets/COLOR ART.png') }}" class="d-block w-100 promo-img" alt="Color Art">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/uploads/assets/Art Day.png') }}" class="d-block w-100 promo-img" alt="Art Day">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/uploads/assets/animal.jpg') }}" class="d-block w-100 promo-img" alt="Animal Art">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/uploads/assets/diskon.jpg') }}" class="d-block w-100 promo-img" alt="Diskon">
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 border-bottom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold" style="font-size: 1.5rem; color: #3D74B6;">Kategori Produk</h3>
            <a href="{{ URL::to('/categories') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Kategori</a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($categories as $category)
            <div class="col">
                <a href="{{ URL::to('/category/'.$category->slug) }}" class="text-decoration-none">
                    <div class="card category-card h-100 text-center border rounded shadow-sm">

                        <!-- Kotak Gambar -->
                        <div class="p-3" style="height: 220px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>

                        <!-- Konten -->
                        <div class="card-body p-3">
                            <h6 class="card-title mb-2 text-dark">{{ $category->name }}</h6>
                            <p class="card-text small text-muted text-truncate">{{ $category->description }}</p>
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