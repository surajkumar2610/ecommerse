@extends("layouts.default")
@section("title", "Order History")

@section("content")
<main class="container mt-4">
    <h2 class="text-center mb-4">Order History</h2>

    @if(session("success"))
        <div class="alert alert-success">{{ session("success") }}</div>
    @endif
    @if(session("error"))
        <div class="alert alert-danger">{{ session("error") }}</div>
    @endif

    @if($orders->isEmpty())
        <p class="text-center">No orders found.</p>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>
                        @php
                            $productIds = json_decode($order->product_id, true);
                            $quantities = json_decode($order->quantity, true);
                        @endphp
                        <ul>
                            @foreach($productIds as $index => $productId)
                                @php
                                    $product = \App\Models\Products::find($productId);
                                @endphp
                                @if($product)
                                    <li>{{ $product->title }} (x{{ $quantities[$index] }})</li>
                                @else
                                    <li>Product not found</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                    <td><span class="badge bg-success">{{ $order->status ?? 'Processing' }}</span></td>
                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>
@endsection
