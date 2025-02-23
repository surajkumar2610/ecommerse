@extends("layouts.default")
@section("title", "Product page")
@section("content")

<main class="container" style="max-width:900px">
    <section>
        <div class="row">
            @foreach($cartItem as $item)
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{$item->image}}" class="img-fluid rounded-start" alt="">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$item->title}}</h5>
                      <p class="card-text"><small class="text-body-secondary">Price: {{$item->price}}</small></p>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
        <div>
            {{$cartItem->links()}}
        </div>
    </section>
</main>

@endsection