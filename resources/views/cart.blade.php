@extends("layouts.default")
@section("title", "Cart Page")
@section("content")

<main class="container py-4" style="max-width:900px">
    <section>
        <!-- Alert Messages -->
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 1050;">
            {{ session()->get("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session("error"))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 1050;">
            {{ session("error") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @php $total = 0; @endphp

        <div class="row">
            @forelse($cartItem as $item)
            @php $subtotal = $item->price * $item->quantity; $total += $subtotal; @endphp
            <div class="card mb-3 cart-item" style="max-width: 540px;" data-id="{{ $item->product_id }}" data-price="{{ $item->price }}">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $item->image }}" class="img-fluid rounded-start" alt="">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                <small class="text-body-secondary">Price: ₹{{ number_format($item->price, 2) }}</small>
                            </p>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-danger update-quantity" data-action="decrease">-</button>
                                <span class="mx-2 quantity">{{ $item->quantity }}</span>
                                <button class="btn btn-sm btn-success update-quantity" data-action="increase">+</button>
                            </div>
                            <p class="mt-2"><strong>Subtotal: ₹<span class="subtotal">{{ number_format($subtotal, 2) }}</span></strong></p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">Your cart is empty.</p>
            @endforelse
        </div>

        @if($cartItem->count() > 0)
        <div class="text-center mt-3">
            <h4 class="fw-bold">Total: ₹<span id="totalAmount">{{ number_format($total, 2) }}</span></h4>
            <a href="{{ route('checkout.show') }}" class="btn btn-primary">Checkout</a>
        </div>
        @endif
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".update-quantity").on("click", function () {
            var productId = $(this).closest(".cart-item").data("id");
            var price = $(this).closest(".cart-item").data("price");
            var action = $(this).data("action");
            var $quantityElement = $(this).closest(".cart-item").find(".quantity");
            var $subtotalElement = $(this).closest(".cart-item").find(".subtotal");

            $.ajax({
                url: "{{ route('cart.update') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    action: action
                },
                success: function (response) {
                    if (response.success) {
                        if (response.removed) {
                            location.reload();
                        } else {
                            var newQuantity = response.quantity;
                            var newSubtotal = (price * newQuantity).toFixed(2);
                            $quantityElement.text(newQuantity);
                            $subtotalElement.text(newSubtotal);
                            updateTotalAmount();
                        }
                    }
                },
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
        function updateTotalAmount() {
            var total = 0;
            $(".cart-item").each(function () {
                var price = $(this).data("price");
                var quantity = parseInt($(this).find(".quantity").text());
                total += price * quantity;
            });
            $("#totalAmount").text(total.toFixed(2));
        }
    });
</script>

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