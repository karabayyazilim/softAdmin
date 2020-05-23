@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Slider Düzenle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Slider</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Slider</h3>
                                </div>
                                <div class="card-body">
                                    <center><img id="coverImageShow" src="{{$slider->slider_image}}" width="70%" height="350px"></center>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slider Resim</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input id="coverImage" type="file" name="slider_image" class="custom-file-input"
                                                       id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Başlık</label>
                                        <input type="text"name="slider_name" value="{{$slider->slider_name}}" class="form-control" placeholder="Slider Başlık Yazınız">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slider Url</label>
                                        <input type="text" name="slider_url" value="{{$slider->slider_url}}" class="form-control" placeholder="Slider Url Yazınız">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Slider Görünürlüğü</label><br>
                                        <input type="checkbox" name="slider_status" {{$slider->slider_status == 'on' ? 'checked' : ' '}} data-bootstrap-switch>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button id="slidersButton" type="button" class="btn btn-primary">Kaydet</button>
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

            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
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

        $("#slidersButton").click(function () {

            var url = "{{route("slider-edit",$slider->id)}}";
            var form = new FormData($("form")[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: form,
                processData: false,
                contentType: false,

                success: function (response) {
                    if (response.status=="success"){
                        toastr.success(response.content, response.title);
                    }
                    else{
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
