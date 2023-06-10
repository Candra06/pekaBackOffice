@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Artikel</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{  $data->type == 'add' ? 'Tambah Artikel' : 'Edit Artikel' }}</li>
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
                        <h4 class="m-b-0 text-white">{{  $data->type == 'add' ? 'Tambah Artikel' : 'Edit Artikel' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ $data->type == 'add' ? route('artikel.store') : route('artikel.update', $artikel) }}"
                            method="POST" enctype="multipart/form-data">
                            @if ($data->type == 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Judul</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Judul" value="{{ $data->title }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Thumbnail</label>
                                            <div class="form-check">

                                                <input type="file" id="input-file-now-custom-1"
                                                    class="dropify @error('thumbnail') form-control-danger @enderror"
                                                    data-default-file="{{ url('/') }}/{{ $data->thumbnail }}"
                                                    name="thumbnail" />
                                                @error('thumbnail')
                                                    <small class="form-control-feedback"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label class="control-label">Konten</label>
                                            <textarea class="summernote @error('content') is-invalid @enderror" name="content" placeholder="Konten">{{ $data->content }}</textarea>

                                            @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info waves-effect waves-light pull-right">Simpan</button>
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
