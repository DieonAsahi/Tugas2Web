<x-layout>
    <x-slot name="title">{{ $product->name }}</x-slot>

    <style>
        .img-square {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin: auto;
        }
    </style>

    @if(session('error'))
    <div class="container mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="container my-5">
        <div class="row g-5 align-items-start">
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm d-flex align-items-center justify-content-center p-3">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-square">
                </div>
                <div class="mt-3">
                    <span class="badge bg-secondary">{{ $product->category->name ?? 'Kategori Tidak Diketahui' }}</span>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6">
                <h1 class="mb-2 fw-bold" style="color: #3D74B6;">{{ $product->name }}</h1>
                <div class="mb-3">
                    <span class="fs-4 fw-semibold" style="color: #009e15ff;">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    @if($product->old_price)
                    <span class="text-muted text-decoration-line-through ms-2" style="color: #009e15ff;">
                        Rp{{ number_format($product->old_price, 0, ',', '.') }}
                    </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Form Tambah ke Keranjang -->
                <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group" style="max-width: 320px;">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                        <button class="btn btn-primary" type="submit" style="background-color: #3D74B6;">
                            <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </form>

                <!-- Info Produk -->
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #3D74B6;">
                        <span><strong>Stok:</strong></span>
                        <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $product->stock > 0 ? $product->stock : 'Habis' }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="color: #3D74B6;">
                        <span><strong>Kategori:</strong></span>
                        <span>{{ $product->category->name ?? '-' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Deskripsi Produk Panjang -->
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="mb-3" style="color: #3D74B6;">Deskripsi Produk</h4>
                <div class="bg p-4 rounded shadow-sm" style="background-color: #d7e9ffff;">
                    {!! nl2br(e($product->long_description ?? $product->description)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="container my-5">
        <h3 class="mb-4" style="color: #3D74B6;">Produk Lainnya</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse($relatedProducts as $relatedProduct)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="text-center" style="background:#f8f9fa; height: 200px; padding-right: 20px; padding-left: 20px;  display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                        <p class="card-text text-truncate">{{ $relatedProduct->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="color: #64d172">
                                Rp{{ number_format($relatedProduct->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('product.show', $relatedProduct->slug) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col">
                <div class="alert alert-info">Tidak ada produk terkait.

                </div>
            </div>
            @endforelse
        </div>
    </div>
</x-layout>