@extends('layouts.default')

@section('title', 'Profile')

@section('content')
<main class="container py-5" style="max-width: 600px;">
    <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4">My Profile</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                    value="{{ old('name', auth()->user()->name) }}" required>
                <div class="invalid-feedback">Please enter your full name.</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email (read-only)</label>
                <input type="email" class="form-control" id="email" name="email" 
                    value="{{ auth()->user()->email }}" readonly>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
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