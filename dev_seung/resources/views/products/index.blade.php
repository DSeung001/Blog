{{-- layout 으로 --}}
@extends('products.layout')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')
    <h2 class="mt-4 mb-3">Product List</h2>

    <a href="{{route("products.create")}}">
        <button type="button" class="btn btn-dark" style="float: right; margin-left:10px">Create</button>
    </a>

    {{--<a href="{{route("products.excel")}}">
        <button type="button" class="btn btn-dark" style="float: right;">Excel</button>
    </a>--}}

    <a href="{{route("products.export")}}">
        <button type="button" class="btn btn-dark" style="float: right;">Excel</button>
    </a>

    <table class="table table-striped table-hover">
        <colgroup>
            <col width="15%"/>
            <col width="55%"/>
            <col width="15%"/>
            <col width="15%"/>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        {{-- blade 에서는 아래 방식으로 반복문을 처리합니다. --}}
        {{-- Product Controller의 index에서 넘긴 $products(product 데이터 리스트)를 출력해줍니다. --}}
        @foreach ($products as $key => $product)
            <tr>
                <th scope="row">{{$key+1 + (($products->currentPage()-1) * 10)}}</th>
                <td>
                    <a href="{{route("products.show", $product->id)}}">{{$product->name}}</a>
                </td>
                <td>{{$product->created_at}}</td>
                <td>
                    <input type="button" value="Edit" onclick="location.href='{{route("products.edit", $product)}}'"/>

                    <form action="{{route('products.destroy', $product->id)}}" method="post" style="display:inline-block;">
                        {{-- delete method와 csrf 처리필요 --}}
                        @method('delete')
                        @csrf
                        <input onclick="return confirm('정말로 삭제하겠습니까?')" type="submit" value="delete"/>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- 라라벨 기본 지원 페이지네이션 --}}
    {{-- 라라벨의 지원 스타일을 적용해야 함 --}}
    {!! $products->links() !!}
@endsection
