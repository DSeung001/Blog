<!DOCTYPE html>
<html>
<head>
    <title>Laravel Test</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-10 offset-1 mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-success btn-submit">저장</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="/draw">
                                <button class="btn btn-success" type="button">추첨하기</button>
                            </a>
                        </div>
                    </form>
                    <hr/>
                    <strong>List:</strong>
                    <ul class="list-group">
                        @foreach ($list as $item)
                            <li class="list-group-item">{{$item->id}}<span class="border m-3"></span>{{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
