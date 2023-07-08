@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Data Kategori Screening</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">
                        Edit Data Kategori Screening
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
                @if (session('success'))
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">
                            {{ $data->type == 'add' ? 'Tambah Data Kategori Screening' : 'Edit Data Kategori Screening' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @if ($data->type == 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Kategori Screening</label>
                                            <input type="text"
                                                class="form-control @error('category_name') is-invalid @enderror"
                                                name="category_name" required placeholder="Kategori Screening"
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
                                            <label class="control-label">Type Scoring</label>
                                            <select required name="isDecission" onchange="showDiv(this)"
                                                class="form-control @error('isDecission') is-invalid @enderror"
                                                id="isDecission">
                                                <option value="">Pilih Type Scoring</option>
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
                                <div class="form-actions">
                                    <button type="submit"
                                        class="btn btn-info waves-effect waves-light pull-right">Simpan</button>
                                </div>
                        </form>
                        @if ($data->isDecission == 'true')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <button type="button" data-toggle="modal" data-target="#modalAdd"
                                            class="btn btn-primary waves-effect waves-light pull-right">Tambah
                                            Kondisi</button>
                                    </div>
                                    <div class="table-responsive ml-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px">No.</th>
                                                    <th>Nama Kondisi</th>
                                                    <th>Symbol</th>
                                                    <th>Nilai Kondisi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($condition as $no => $dt)
                                                    <tr>
                                                        @php
                                                            $cond = json_decode($dt->condition_maker);
                                                        @endphp
                                                        <td>{{ $no + 1 }}</td>
                                                        <td>{{ $dt->condition_name }}</td>
                                                        <td>{{ $cond->symbol }}</td>
                                                        <td>{{ $cond->condition_score }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                                data-target="#exampleModal{{ $dt->id }}"><i
                                                                    class="mdi mdi-pencil"></i>Edit</button>
                                                            <div class="modal fade" id="exampleModal{{ $dt->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <form action="{{ url('/updateCondition/' . $dt->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    Edit
                                                                                    Pilihan</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div id="answered">
                                                                                    <h3>Pilihan Kondisi</h3>

                                                                                    <div class="row" id="choices">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="control-label">Nama
                                                                                                    Kondisi</label>
                                                                                                <input type="hidden"
                                                                                                    name="id"
                                                                                                    value="{{ $data->id }}"
                                                                                                    placeholder="Jawaban">
                                                                                                <input type="text"
                                                                                                    name="condition_name"
                                                                                                    value="{{ $dt->condition_name }}"
                                                                                                    class="form-control @error('condition_name') is-invalid @enderror"
                                                                                                    placeholder="Nama Kondisi">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="control-label">Simbol</label>
                                                                                                <input type="text"
                                                                                                    name="symbol"
                                                                                                    value="{{ $cond->symbol }}"
                                                                                                    class="form-control @error('symbol') is-invalid @enderror"
                                                                                                    placeholder="Simbol">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="control-label">Nilai</label>
                                                                                                <input type="text"
                                                                                                    name="condition_score"
                                                                                                    value="{{ $cond->condition_score }}"
                                                                                                    class="form-control @error('condition_score') is-invalid @enderror"
                                                                                                    placeholder="Nilai">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Save
                                                                                    changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <a href="#" data-id="{{ $dt->id }}"
                                                                class="btn btn-danger sa-params"><i class="fa fa-trash-o">
                                                                    <form action="{{ url('deleteCondition', $dt->id) }}"
                                                                        id="delete{{ $dt->id }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </i>
                                                                Hapus
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
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
        <div class="modal fade" id="modalAdd" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ url('/addCondition/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah
                                Kondisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="answered">

                                <div class="row" id="choices">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Nama Kondisi</label>
                                            <input type="text" name="condition_name" value=""
                                                class="form-control @error('condition_name') is-invalid @enderror"
                                                placeholder="Nama Kondisi">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Simbol</label>
                                            <input type="text" name="symbol" value=""
                                                class="form-control @error('symbol') is-invalid @enderror"
                                                placeholder="Simbol">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Nilai Kondisi</label>
                                            <input type="text" name="condition_score" value=""
                                                class="form-control @error('condition_score') is-invalid @enderror"
                                                placeholder="Nilai Kondisi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save
                                changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
