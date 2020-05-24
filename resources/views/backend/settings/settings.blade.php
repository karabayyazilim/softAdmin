@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Site Ayarları</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Site Ayarları</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card direct-chat direct-chat-warning collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Site Ayar Ekle</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <br>
                                <center>
                                    <form method="post">
                                        <div class="form-group row col-md-11">
                                            <div class="col-md-3">
                                                <input type="text" name="title" class="form-control" required
                                                       placeholder="Ayar Açıklama Yazınız">
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="title" class="form-control" required
                                                       placeholder="Anahtar Kelime Yazınız">
                                            </div>

                                            <div class="col-md-3">
                                                <select class="form-control select2" name="setting_type" id="">
                                                    <option value="">Textarea</option>
                                                    <option value="">İmage</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <button class="btn btn-primary btn-block"> Kaydet</button>
                                            </div>

                                        </div>

                                    </form>
                                    <br>
                                </center>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Site Ayarları Listesi</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Ayar Açıklama</th>
                                <th>Anahtar Kelime</th>
                                <th>Değer</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Trident</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>
                                    <a href="page-edit.html" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Düzenle</a>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
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
@endsection

@section('css')
    <link rel="stylesheet" href="/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
