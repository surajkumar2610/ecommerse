@extends("layouts.default")
@section("title", "Product Page")
@section("content")
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 1050;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 1050;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<main class="container py-4">
    <section class="text-center">
        <h2 class="mb-4">Explore Our Products</h2>
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="position-relative overflow-hidden">
                        <a href="{{ route('products.details', $product->slug) }}">
                            <img src="{{ $product->image }}" class="card-img-top product-image" alt="{{ $product->title }}">
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ route('products.details', $product->slug) }}" class="text-dark text-decoration-none">
                                {{ $product->title }}
                            </a>
                        </h5>
                        <p class="text-primary fw-bold mb-2">₹{{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-sm btn-outline-success">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </section>
</main>

<style>
    .product-image {
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .card {
        transition: all 0.3s ease-in-out;
        border-radius: 10px;
    }

    .card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>

@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
setTimeout(() => {
    let alertEl = document.querySelector(".alert");
    if (alertEl) {
        let bsAlert = new bootstrap.Alert(alertEl);
        bsAlert.close();
    }
}, 3000);
</script>
