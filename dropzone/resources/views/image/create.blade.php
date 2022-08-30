<!DOCTYPE html>
<html>
<head>
    <title>dropzone</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    {{-- dropzone.js --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    {{-- Jquery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- dropzone.css --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    {{-- bootstrap5 css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <h4 class="pt-4">Laravel DropZone</h4>
    <hr class="pd-4"/>
    {{-- 최대 업로드 양을 넘었을 경우 경고를 띄어줍시다. --}}
    <div class="alert alert-danger" role="alert" style="display: none">
        이미지는 한번에 5개까지 업로드가 가능합니다.
    </div>
    <form method="post" action="{{route('image.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        @csrf
    </form>
    {{-- 프로그래스 바를 만들어줍시다. --}}
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
                autoProcessQueue: false, // 자동 업로드 방지
                uploadMultiple: true, // 여러개 업로드 허용
                maxFilesize: 50, // 최대 파일 사이즈 (MB)
                parallelUploads: 5, // 한번에 업로드 가능 한 수
                maxFiles: 5, //올릴 수 있는 파일의 개수
                acceptedFiles: ".jpeg,.jpg,.png,.gif", // 허용 확장자
                timeout: 50000, // 최대 시간
                addRemoveLinks: true, // 삭제 버튼 노출
                renameFile: function (file) {
                    // 파일 업로드시 이름 변경
                    let dt = new Date();
                    let time = dt.getTime();
                    return time + "_" + file.name;
                },
                init: function () {
                    let myDropzone = this;

                    // submit-all 버튼을 클릭 해야만 파일 업로드
                    $("#submit-all").click(function (e) {
                        e.preventDefault();
                        // 큐에 파일 적재 => 업로드 실행
                        myDropzone.processQueue();
                    });

                    // maxFiles에 도달했을 경우 경고창 띄우기
                    myDropzone.on("maxfilesexceeded", function (file) {
                        myDropzone.removeFile(file);
                        $(".alert").show();
                    });

                    // 업로드시 프로그래스 바 애니메이션 추가
                    myDropzone.on("totaluploadprogress", function (progress) {
                        $(".progress-bar").width(progress + '%');
                    });

                    // 원래 이름도 form에 추가
                    myDropzone.on("sending", function(file, xhr, formData){
                        formData.append("origin_name[]", file.name);
                    })
                },
                // 삭제 이벤트 추가
                removedfile: function (file) {
                    let file_name = file.upload.filename;
                    let origin_name = file.name;

                    // 삭제 ajax
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
