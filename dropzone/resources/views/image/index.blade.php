<!DOCTYPE html>
<html>
<head>
    <title>dropzone</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h4 class="pt-4">Laravel Image Archive</h4>


    <div class="container" class="pt-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">
                            <a href="{{route('image.create')}}">
                                <button class="btn btn-primary btn-xs">Create</button>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $key => $list)
                        <tr>
                            <td scope="row">{{$key + 1}}</td>
                            <td>{{$list->origin_name}}</td>
                            <td class="w-25">
                                <img src="{{asset($list->path)}}" class="img-fluid img-thumbnail"
                                     alt="{{$list->origin_name}}">
                            </td>
                            <td>{{$list->created_at}}</td>
                            <td>
                                <a>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                autoProcessQueue: false,
                uploadMultiple: true,
                maxFilesize: 50,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 100000,
                init: function () {
                    let myDropzone = this;
                    $("#submit-all").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                    });
                    myDropzone.on("totaluploadprogress", function (progress) {
                        $(".progress-bar").width(progress + '%');
                    });
                },
                removedfile: function (file) {
                    let name = file.upload.filename;
                    console.log(file);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ url("image.destory") }}',
                        data: {filename: name},
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    let fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                success: function (file, response) {
                    console.log("success");
                    console.log(response);
                },
                error: function (file, response) {
                    console.log(file);
                    console.log(response);
                    console.log("error");
                    return false;
                }
            };
    </script>
</body>
</html>

