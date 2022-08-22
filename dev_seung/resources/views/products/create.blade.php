{{-- layout 으로 --}}
@extends('products.layout')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')

    <h2 class="mt-4 mb-3">Product Create</h2>

    {{-- 유효성 검사에 걸렸을 경우 --}}
    @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('products.store')}}" method="post">
        {{-- old는 전역 헬퍼 함수로 blade 내에서 이전 Request 입력값을 가져와 줍니다. --}}
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" autocomplete="off" value="{{old('name')}}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea rows="10" cols="40" name="content" class="form-control" autocomplete="off" id="content">{{old('content')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="call" class="form-label">Call</label>
            <input type="text" name="call" class="form-control" id="call" autocomplete="off" value="{{old('call')}}" maxlength="13">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
