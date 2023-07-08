@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Data Kategori</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">
                        {{ $data->type == 'add' ? 'Tambah Data Kategori' : 'Edit Data Kategori' }}
                    </li>
                </ol>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">
                            {{ $data->type == 'add' ? 'Tambah Data Kategori' : 'Edit Data Kategori' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $data->type == 'add' ? route('category.store') : route('category.update', $data->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @if ($data->type == 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nama Kategori</label>
                                            <input type="text"
                                                class="form-control @error('category_name') is-invalid @enderror"
                                                name="category_name" required placeholder="Nama Kategori Screening"
                                                value="{{ $data->category_name }}">

                                            @error('category_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tipe Skoring</label>
                                            <select required name="isDecission" onchange="showDiv(this)"
                                                class="form-control @error('isDecission') is-invalid @enderror"
                                                id="isDecission">
                                                <option value="">Pilih Tipe Skoring</option>
                                                <option value="true" {{ $data->isDecission == 'true' ? 'selected' : '' }}>
                                                    Iya
                                                </option>
                                                <option value="false"
                                                    {{ $data->isDecission == 'false' ? 'selected' : '' }}>Tidak</option>
                                            </select>

                                            @error('isDecission')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                                <div id="answered" style="display:none;">
                                    <h3>Kondisi</h3>

                                    <div class="row" id="choices">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Simbol</label>
                                                <input type="text" name="symbol[]"
                                                    class="form-control @error('symbol') is-invalid @enderror"
                                                    placeholder="Simbol( ex. < | <= | > | >= | =)">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Nilai Penentu</label>
                                                <input type="number" name="condition_score[]"
                                                    class="form-control @error('condition_score') is-invalid @enderror"
                                                    placeholder="Nilai Penentu">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Kondisi</label>
                                                <input type="text" name="kondition_name[]"
                                                    class="form-control @error('kondition_name') is-invalid @enderror"
                                                    placeholder="Nama Kondisi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3 button-add">
                                        <div class="col-md-2">
                                            <button id="add-choice" type="button" class="btn btn-sm btn-success"><span
                                                    class="fa far fa-plus"></span> Tambah Pilihan</button>
                                        </div>
                                        <div class="col-md-3">
                                            <button id="remove-choice" type="button" class="btn btn-sm btn-danger"><span
                                                    class="fa far fa-minus"></span> Hapus Pilihan</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit"
                                        class="btn btn-info waves-effect waves-light pull-right">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#type_question").live("change", function() {
                    console.log("seledte");
                    // do whatever you need to do

                    // you want the element to lose focus immediately
                    // this is key to get this working.
                    $('#type_question').blur();
                });
            });

            function showDiv(select) {
                if (select.value == "true") {
                    document.getElementById('answered').style.display = "block";
                } else {
                    document.getElementById('answered').style.display = "none";
                }
            }
            $(document).ready(function() {
                var length = $("#choices").length;
                if (length == 1) {
                    $("#remove-choice").hide();
                }
                $("#add-choice").click(function() {
                    console.log("tambah");
                    var clone = $("#choices:first").clone();
                    clone.find("input").val("");
                    $(".button-add").before(clone);
                    length += 1;
                    if (length == 1) {
                        $("#remove-choice").hide();
                    } else {
                        $("#remove-choice").show();
                    }
                });
                $("#remove-choice").click(function() {
                    $("#choices:last").remove();
                    length -= 1;
                    if (length == 1) {
                        $("#remove-choice").hide();
                    } else {
                        $("#remove-choice").show();
                    }
                });
            })
        </script>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
