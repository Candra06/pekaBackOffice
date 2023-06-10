@extends('template.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Data Artikel </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Data Artikel </li>
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
                <h4 class="card-title">Daftar Artikel</h4>
                
                <a href="{{ url('/artikel/create')}}"><button class="btn btn-primary pull-right">Tambah
                        Data</button></a>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:20px">No.</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $no => $dt)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td><img src="{{ url('/').'/'. $dt->thumbnail }}" height="100" alt="" srcset=""></td>
                                <td>{{ $dt->title }}</td>
                                <td>{{ $dt->created_at }}</td>
                                <td>
                                    <a href="{{ url('/artikel/'.$dt->id.'/edit') }}" class="btn btn-info"><i
                                            class="mdi mdi-pencil"></i>Edit</a>
                                    <a href="#" data-id="{{ $dt->id }}" class="btn btn-danger sa-params"><i
                                            class="fa fa-trash-o">
                                            <form action="{{ route('artikel.destroy', $dt->id) }}"
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
    </div>
    <!-- Row -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/importPartner')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row ">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Import Lokasi Partner</label>
                                    <input type="file" name="fileImport"
                                        class="form-control  @error('status') is-invalid @enderror">
                                    @error('fileImport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <script>
        var exampleModal = document.getElementById("samedata-modal");
        exampleModal.addEventListener("show.bs.modal", function (event) {
          // Button that triggered the modal
          var button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          var recipient = button.getAttribute("data-bs-whatever");
          // If necessary, you could initiate an AJAX request here
          // and then do the updating in a callback.
          //
          // Update the modal's content.
          var modalTitle = exampleModal.querySelector(".modal-title");
          var modalBodyInput = exampleModal.querySelector(".modal-body input");
  
          modalTitle.textContent = "New message to " + recipient;
          modalBodyInput.value = recipient;
        });
    </script>
</div>
@endsection