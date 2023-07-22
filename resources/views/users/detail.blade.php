@extends('template.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Data Pengguna </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data Pengguna </li>
                </ol>
            </div>

        </div>

        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="card col-md-12">
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
                <div class="card-body">
                    <h4 class="card-title">Detail Pengguna</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nama Pengguna</label>
                            <h5>{{ $data['detail']['name'] }}</h5>
                        </div>
                        <div class="col-md-4">
                            <label for="">Username/Email</label>
                            <h5>{{ $data['detail']['email'] }}</h5>
                        </div>
                        <div class="col-md-4">
                            <label for="">Telepon</label>
                            <h5>{{ $data['detail']['phone'] }}</h5>
                        </div>
                        <div class="col-md-4">
                            <label for="">Role</label>
                            <h5>{{ $data['detail']['role'] }}</h5>
                        </div>
                        <div class="col-md-4">
                            <label for="">Jenis Kelamin</label>
                            <h5>{{ $data['detail']['name'] }}</h5>
                        </div>
                    </div>
                    {{-- <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:20px">No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon/WA</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $no => $dt)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td>{{ $dt->email }}</td>
                                        <td>{{ $dt->phone }}</td>
                                        <td>{{ $dt->role }}</td>
                                        <td>
                                            <a href="{{ url('/users/' . $dt->id . '/edit') }}" class="btn btn-info"><i
                                                    class="mdi mdi-pencil"></i> Edit</a>
                                            <a href="{{ url('/users/' . $dt->id) }}" class="btn btn-success"><i
                                                    class="mdi mdi-eye"></i> Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- Row -->
        @foreach ($data['screening'] as $item)
            <div class="row">
                <!-- Column -->
                <div class="card col-md-12">
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
                    <div class="card-body">
                        <h4 class="card-title">{{ $item['question']['category_name'] }}</h4>
                        <div class="row">

                            <div class="col-md-6">
                                <label for="">Total Score</label>
                                <h5>{{ $item['question']['total_score'] }}</h5>
                            </div>
                            <div class="col-md-6">
                                <label for="">Hasil</label>
                                <h5>{{ $item['question']['result_decission'] }}</h5>
                            </div>

                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:20px">No.</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item['answered'] as $no => $dt)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $dt->question }}</td>
                                            <td>{{ $dt->answer }}</td>
                                            <td>{{ $dt->score }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

    </div>
@endsection
