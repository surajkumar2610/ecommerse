@extends('layouts.default')
@section('title', 'Checkout')
@section('content')

<main class="container py-4" style="max-width: 700px;">
    <section>
        <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4">Checkout</h2>

            @if(session()->has("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get("success") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session("error") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @php
            $address = old('address', $latestOrder->address ?? '');
            $phone = old('number', $latestOrder->number ?? '');
            $pincode = old('pincode', $latestOrder->pincode ?? '');
            @endphp

            <form action="{{ route('checkout.post') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="mb-3">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $address) }}" placeholder="Enter your full address" required>
                    <div class="invalid-feedback">Please enter your address.</div>
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="number" name="number" value="{{ old('number', $phone) }}" placeholder="Enter your phone number" pattern="[0-9]{10}" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                </div>

                <div class="mb-3">
                    <label for="pincode" class="form-label">Pin Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode', $pincode) }}" placeholder="Enter your area pincode" pattern="[0-9]{6}" required>
                    <div class="invalid-feedback">Please enter a valid 6-digit pin code.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary">Back to Cart</a>
                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
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