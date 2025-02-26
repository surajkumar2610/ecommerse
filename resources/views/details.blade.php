@extends("layouts.default")
@section("title", $product->title)
@section("content")

<!-- Alerts -->
@if(session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 1050;">
        {{ session()->get("success") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session()->has("error"))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 1050;">
        {{ session("error") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<main class="container py-4">
    <section class="row justify-content-center">
        <div class="col-md-6 text-center">
            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid rounded shadow-sm">
        </div>

        <div class="col-md-6">
            <h1 class="fw-bold">{{ $product->title }}</h1>
            <h3 class="text-primary fw-bold">₹{{ number_format($product->price, 2) }}</h3>
            <p class="text-muted">{{ $product->description }}</p>
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-lg btn-success shadow-sm px-4">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </a>
        </div>
    </section>
</main>

<style>
    .img-fluid {
        max-height: 400px;
        object-fit: cover;
    }

    .btn-success {
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #28a745;
        transform: scale(1.05);
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