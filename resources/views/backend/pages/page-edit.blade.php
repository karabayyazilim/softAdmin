@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sayfa Düzenle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Sayfa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Sayfa</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Başlık</label>
                                        <input type="text" name="page_name" value="{{$pages->page_name}}"
                                               class="form-control" placeholder="Başlık Yazınız">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kısa Açıklama</label>
                                        <input type="text" name="page_description" value="{{$pages->page_description}}"
                                               class="form-control" placeholder="Kısa Açıklama Yazınız">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Etiket</label>
                                        <input type="text" name="page_tags" value="{{$pages->page_tags}}"
                                               class="form-control" placeholder="Etiket">
                                    </div>
                                    <div class="form-group">
                                        <label>İçerik</label>
                                        <textarea name="page_content"
                                                  id="editor">{!! $pages->page_content !!}</textarea>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button id="pageButton" type="button" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Sayfa Resim</h3>
                                </div>
                                <br>
                                <img id="coverImageShow" src="{{$pages->page_image}}" width="100%" height="165px">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input id="coverImage" name="page_image" type="file"
                                                       class="custom-file-input"
                                                       id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Sayfa Görünürlüğü</h3>
                                </div>
                                <br>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="checkbox" name="page_status" {{$pages->page_status == 'on' ? 'checked' : ' ' }} data-bootstrap-switch>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection

@section('js')

    <script src="/backend/plugins/select2/js/select2.full.min.js"></script>
    <script src="/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

        });
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', options);
    </script>
    <script>
        $("#coverImage").change(function () {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#coverImageShow').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>

    <script>

        $("#pageButton").click(function () {

            CKEDITOR.instances['editor'].updateElement();
            var url = "{{route("page-edit",$pages->id)}}";
            var form = new FormData($("form")[0]);



            $.ajax({
                type: "POST",
                url: url,
                data: form,
                processData: false,
                contentType: false,

                success: function (response) {
                    if (response.status == "success") {
                        toastr.success(response.content, response.title);
                    } else {
                        toastr.error(response.content, response.title);
                    }
                },
                error: function () {

                }
            });
        })
    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
