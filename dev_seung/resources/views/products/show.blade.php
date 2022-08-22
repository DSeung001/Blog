@extends('products.layout')

@section('content')
    <h2 class="mt-4 mb-3">Product View: {{$product->name}}</h2>
    <p style="text-align: right" class="pt-2">{{$product->created_at}}</p>

    <div class="content mt-4 rounded-3 border border-secondary">
        <div class="p-3">
            {{$product->content}}
        </div>
    </div>
    <div class="content mt-4 rounded-3 border border-secondary">
        <div class="p-3">
            call : {{$product->call}}
        </div>
    </div>
@endsection
