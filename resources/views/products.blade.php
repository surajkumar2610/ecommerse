@extends("layouts.default")
@section("title", "Product page")
@section("content")

<main class="container" style="max-width:900px">
    <section>
        <div class="row">
            @foreach($products as $product)
            <div class="col-12 card col-md-6 col-lg-3 p-2 shadow-sm m-2">
                <img src="{{$product->image}}" alt="" width="100%" height="300px">
                <div id="product-title">
                    <a href="{{route('products.details', $product->slug)}}">{{$product->title}}</a>
                    <span>{{$product->price}}</span>
                </div>
            </div>
            @endforeach
        </div>
        {{$products->links()}}
    </section>
</main>

@endsection