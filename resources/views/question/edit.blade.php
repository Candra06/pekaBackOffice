@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Data Pertanyaan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">
                        Edit Data Pertanyaan
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
                            {{ $data->type == 'add' ? 'Tambah Data Pertanyaan' : 'Edit Data Pertanyaan' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $data->type == 'add' ? route('kuesioner.store') : route('kuesioner.update', $data->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @if ($data->type == 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Pertanyaan</label>
                                            <textarea class="form-control @error('question') is-invalid @enderror" name="question" required
                                                placeholder="Pertanyaan">{{ $data->question }}</textarea>

                                            @error('question')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tipe Jawaban</label>
                                            <select required name="type_question" onchange="showDiv(this)"
                                                class="form-control @error('type_question') is-invalid @enderror"
                                                id="type_question">
                                                <option value="">Pilih Tipe Jawaban</option>
                                                <option value="Choice"
                                                    {{ $data->type_question == 'Choice' ? 'selected' : '' }}>Pilihan Ganda
                                                </option>
                                                <option value="Essai"
                                                    {{ $data->type_question == 'Essai' ? 'selected' : '' }}>Isian</option>
                                            </select>

                                            @error('type_question')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nilai</label>
                                            <input required type="number" name="score"
                                                class="form-control @error('score') is-invalid @enderror"
                                                placeholder="Nilai" value="{{ $data->score }}">
                                            @error('score')
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
                        @if ($data->type_question == 'Choice')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <button type="button" data-toggle="modal" data-target="#modalAdd"
                                            class="btn btn-primary waves-effect waves-light pull-right">Tambah
                                            Pilihan</button>
                                    </div>
                                    <div class="table-responsive ml-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px">No.</th>
                                                    <th>Label</th>
                                                    <th>Score</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($choice as $no => $dt)
                                                    <tr>
                                                        <td>{{ $no + 1 }}</td>
                                                        <td>{{ $dt->label }}</td>
                                                        <td>{{ $dt->score }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                                data-target="#exampleModal{{ $dt->id }}"><i
                                                                    class="mdi mdi-pencil"></i>Edit</button>
                                                            <div class="modal fade" id="exampleModal{{ $dt->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <form action="{{ url('/updateChoice/' . $dt->id) }}"
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
                                                                                    <h3>Pilihan Jawaban</h3>

                                                                                    <div class="row" id="choices">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="control-label">Jawaban</label>
                                                                                                <input type="hidden"
                                                                                                    name="id"
                                                                                                    value="{{ $data->id }}"
                                                                                                    placeholder="Jawaban">
                                                                                                <input type="text"
                                                                                                    name="answer"
                                                                                                    value="{{ $dt->label }}"
                                                                                                    class="form-control @error('answer') is-invalid @enderror"
                                                                                                    placeholder="Jawaban">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="control-label">Nilai</label>
                                                                                                <input type="text"
                                                                                                    name="score_answer"
                                                                                                    value="{{ $dt->score }}"
                                                                                                    class="form-control @error('score_answer') is-invalid @enderror"
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
                                                                    <form action="{{ url('deleteChoice', $dt->id) }}"
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
                <form action="{{ url('/addChoice/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah
                                Pilihan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="answered">

                                <div class="row" id="choices">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Jawaban</label>
                                            <input type="text" name="answer" value=""
                                                class="form-control @error('answer') is-invalid @enderror"
                                                placeholder="Jawaban">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nilai</label>
                                            <input type="text" name="score_answer" value=""
                                                class="form-control @error('score_answer') is-invalid @enderror"
                                                placeholder="Nilai">
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
