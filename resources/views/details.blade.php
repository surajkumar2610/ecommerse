@extends("layouts.default")
@section("title", "Product page")
@section("content")

<main class="container" style="max-width:900px">
    <section>
        <div class="row">
            <img src="{{$product->image}}" alt="" class="p-2 m-1" width="100%" >
            @if(session()->has("success"))
            <div class="alert alert-success">{{session()->get("success")}}</div>
            @endif
            @if(session("error"))
            <div class="alert alert-danger">{{session("error")}}</div>
            @endif

            <h1 class="titile">{{$product->title}}</h1>
            <p class="price">{{$product->price}}</p>
            <p class="description">{{$product->description}}</p>
            <a href="{{route('cart.add', $product->id)}}" class="btn btn-success">Add to cart</a>
        </div>
    </section>
</main>

@endsection