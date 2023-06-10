<script src="{{ url('/') }}/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ url('/') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ url('/') }}/assets/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="{{ url('/') }}/assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{ url('/') }}/assets/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="{{ url('/') }}/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/sparkline/jquery.sparkline.min.js"></script>

<!--Custom JavaScript -->
<script src="{{ url('/') }}/assets/js/custom.min.js"></script>
<!--c3 JavaScript -->
<script src="{{ url('/') }}/assets/plugins/d3/d3.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/c3-master/c3.min.js"></script>
<!-- Chart JS -->
<script src="{{ url('/') }}/assets/js/dashboard1.js"></script>
<!-- This is data table -->
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<!-- jQuery file upload -->
<script src="{{ url('/') }}/assets/plugins/dropify/dist/js/dropify.min.js"></script>
<!--Custom JavaScript -->
<script src="{{ url('/') }}/assets/js/custom.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/summernote/dist/summernote.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/sweetalert/sweetalert.min.js"></script>

<script src="{{ url('/') }}/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group +
                                '</td></tr>');
                            last = group;
                        }
                    });
                }
            });

        });
    });

</script>
<script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 250, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }
</script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
    <script>
        $('.sa-params').click(function(e){
            id = e.target.dataset.id;
            swal({
                title: "Yakin Hapus Data?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus ini!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    $(`#delete${id}`).submit();
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        });
    </script>

    <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();
            $('.selectpicker').selectpicker();

        });
        </script>
