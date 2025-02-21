@extends("layouts.default")
@section("title", "Product page")
@section("content")
<style>
    p{
        top:300px;
        left:200px;
        text:200px;
    }
</style>
<main class="container">
    <section>
        @foreach($products as $prod)
        <p>{{$prod->title}}</p>
        @endforeach 
    </section>
</main>

@endsection