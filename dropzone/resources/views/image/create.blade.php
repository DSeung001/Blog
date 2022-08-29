<!DOCTYPE html>
<html>
<head>
    <title>dropzone</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <h4 class="pt-4">Laravel DropZone</h4>
    <hr class="pd-4"/>
    <div class="alert alert-danger" role="alert" style="display: none">
        이미지는 한번에 5개까지 업로드가 가능합니다.
    </div>
    <form method="post" action="{{route('image.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        @csrf
    </form>
    <div class="progress mt-3 mb-3">
        <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <button type="submit" id="submit-all" class="btn btn-primary btn-xs">Upload the file</button>
    <a href="{{route("image.index")}}">
        <button class="btn btn-primary btn-xs">List</button>
    </a>

    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                autoProcessQueue: false,
                uploadMultiple: true,
                maxFilesize: 50,
                parallelUploads: 5,
                maxFiles: 5,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                renameFile: function (file) {
                    let dt = new Date();
                    let time = dt.getTime();
                    return time + "_" + file.name;
                },
                init: function () {
                    let myDropzone = this;
                    $("#submit-all").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                    });

                    myDropzone.on("maxfilesexceeded", function (file) {
                        myDropzone.removeFile(file);
                        $(".alert").show();
                    });

                    myDropzone.on("totaluploadprogress", function (progress) {
                        $(".progress-bar").width(progress + '%');
                    });

                    myDropzone.on("sending", function(file, xhr, formData){
                        formData.append("origin_name[]", file.name);
                    })
                },
                removedfile: function (file) {
                    let file_name = file.upload.filename;
                    let origin_name = file.name;
                    console.log(file);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ route("image.ajaxDestroy") }}',
                        data: {
                            "file_name": file_name,
                            "origin_name": origin_name
                        },
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
                    return false;
                }
            };
    </script>
</body>
</html>
