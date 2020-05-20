@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Menü Ekle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Menü</li>
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
                                    <h3 class="card-title">Menü</h3>
                                </div>
                                <form method="post">

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Menüler</label>
                                            <select name="up_menu" class="form-control select2" style="width: 100%;">
                                                <option value="0">Üst Menü</option>
                                                @foreach($menus as $menu)
                                                    <option value="{{$menu->id}}">{{$menu->menu_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Menü Adı</label>
                                            <input name="menu_name" type="text" class="form-control"
                                                   placeholder="Menü Adı Yazınız">
                                        </div>

                                        <div class="form-group">
                                            <label>Sayfa Seç</label>
                                            <select name="page_id" class="form-control select2" style="width: 100%;">
                                                @foreach($pages as $page)
                                                    <option value="{{$page->id}}">{{$page->page_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="">Menü Görünürlüğü</label><br>
                                            <input type="checkbox" name="menu_status" checked data-bootstrap-switch>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button id="menusButton" type="button" class="btn btn-primary">Kaydet</button>
                                    </div>
                                </form>
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

    <script>

        $("#menusButton").click(function () {

            var url = "{{route("menu-add")}}";
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
    <link rel="stylesheet" href="/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
