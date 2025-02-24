@extends("layouts.default")
@section("title", "Product page")
@section("content")

<main class="container" style="max-width:900px">
    <section>
        <div class="row">
          @if(session()->has("success"))
          <div class="alert alert-success">{{session()->get("success")}}</div>
          @endif
          @if(session("error"))
          <div class="alert alert-danger">{{session("error")}}</div>
          @endif
          
            @foreach($cartItem as $item)
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{$item->image}}" class="img-fluid rounded-start" alt="">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$item->title}}</h5>
                      <p class="card-text"><small class="text-body-secondary">Price: {{$item->price}} | Quantity: {{$item->quantity}}</small></p>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
        <div>
          <a href="{{route('checkout.show')}}" class="btn btn-primary">Checkout</a>
        </div>
    </section>
</main>

@endsection