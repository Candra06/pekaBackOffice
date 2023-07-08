@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Data Pengguna</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">
                        {{ $data->type == 'add' ? 'Tambah Data Pengguna' : 'Edit Data Pengguna' }}
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
                            {{ $data->type == 'add' ? 'Tambah Data Pengguna' : 'Edit Data Expert' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ $data->type == 'add' ? route('users.store') : route('users.update', $user) }}"
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
                                            <input type="text" name="name" required
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
                                            <input type="text" name="phone" required
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Telepon/WA" value="{{ $data->phone }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" name="email" required
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Telepon/WA" value="{{ $data->email }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <select required class="form-control @error('role') is-invalid @enderror"
                                                name="role">
                                                <option value="">Pilih Role</option>
                                                <option value="Admin" {{ $data->role == 'Admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="User" {{ $data->role == 'User' ? 'selected' : '' }}>User
                                                </option>
                                            </select>

                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password"
                                                {{ $data->type == 'add' ? 'required' : '' }}
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="{{ $data->type == 'add' ? 'Password' : 'Password (Opsional)' }}">
                                            @error('phone')
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
