@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Data Expert</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ $data->type == 'add' ? 'Tambah Data Expert' : 'Edit Data Expert' }}
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
                        <h4 class="m-b-0 text-white">{{ $data->type == 'add' ? 'Tambah Data Expert' : 'Edit Data Expert' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ $data->type == 'add' ? route('expert.store') : route('expert.update', $expert) }}"
                            method="POST" enctype="multipart/form-data">
                            @if ($data->type == 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nama</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" placeholder="Nama"
                                                value="{{ $data->name }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Telepon/WA</label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror" placeholder="Telepon/WA"
                                                value="{{ $data->phone }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Foto</label>
                                            <div class="form-check">

                                                <input type="file" id="input-file-now-custom-1"
                                                    class="dropify @error('photo') form-control-danger @enderror"
                                                    data-default-file="{{ url('/') }}/{{ $data->photo }}"
                                                    name="photo" />
                                                @error('photo')
                                                    <small class="form-control-feedback"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label class="control-label">Deskripsi</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Deskripsi">{{ $data->description }}</textarea>

                                            @error('description')
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
