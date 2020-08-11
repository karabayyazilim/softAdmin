@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Ayar Düzenle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Ayarlar</li>
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
                                    <h3 class="card-title">Ayar Düzenle </h3>
                                </div>
                                <div class="card-body">
                                    @if($setting->setting_type == 'input')
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{$setting->setting_description}}</label>
                                            <input type="text" name="setting_value" value="{{$setting->setting_value}}"
                                                   class="form-control">
                                        </div>
                                    @elseif($setting->setting_type == 'textarea')
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{$setting->setting_description}}</label>
                                            <textarea name="setting_value" value="{{$setting->setting_value}}"
                                                      class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    @else
                                        <div class="form-group ">
                                            <label for="exampleInputEmail1">{{$setting->setting_description}}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file"
                                                           name="setting_value"
                                                           class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button id="settingsButton" type="button" class="btn btn-primary">Kaydet</button>
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


    <script>

        $("#settingsButton").click(function () {

            var url = "{{route("setting-edit",$setting->id)}}";
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

@endsection
