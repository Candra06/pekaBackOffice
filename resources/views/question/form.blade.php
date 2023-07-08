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
                        {{ $data->type == 'add' ? 'Tambah Data Pertanyaan' : 'Edit Data Pertanyaan' }}
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Kategori Screening</label>
                                            <select required name="category_id" 
                                                class="form-control @error('category_id') is-invalid @enderror"
                                                id="category_id">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($category as $ct)
                                                    <option value="{{ $ct->id }}"
                                                        {{ $data->category_id == $ct->id ? 'selected' : '' }}>
                                                        {{ $ct->category_name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Tipe Jawaban</label>
                                            <select required name="type_question" onchange="showDiv(this)"
                                                class="form-control @error('type_question') is-invalid @enderror"
                                                id="type_question">
                                                <option value="">Pilih Tipe Jawaban</option>
                                                <option value="Choice"
                                                    {{ $data->type_question == 'Choice' ? 'selected' : '' }}>Pilihan Ganda
                                                </option>
                                                <option value="Multiple"
                                                {{ $data->type_question == 'Multiple' ? 'selected' : '' }}>Multiple Select
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
                                    <div class="col-md-4">
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
                                <div id="answered" style="display:none;">
                                    <h3>Pilihan Jawaban</h3>
                                    @if ($data->type == 'edit')
                                        <div class="row" id="choices">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jawaban</label>
                                                    <input type="text" name="answer[]"
                                                        class="form-control @error('answer') is-invalid @enderror"
                                                        placeholder="Jawaban">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nilai</label>
                                                    <input type="text" name="score_answer[]"
                                                        class="form-control @error('score_answer') is-invalid @enderror"
                                                        placeholder="Nilai">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row" id="choices">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jawaban</label>
                                                    <input type="text" name="answer[]"
                                                        class="form-control @error('answer') is-invalid @enderror"
                                                        placeholder="Jawaban">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nilai</label>
                                                    <input type="text" name="score_answer[]"
                                                        class="form-control @error('score_answer') is-invalid @enderror"
                                                        placeholder="Nilai">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
                if (select.value == "Choice" || select.value == 'Multiple') {
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
