@extends('layouts.admin_app')
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Menu List</li>
                        </ol>
                    </nav>
                </div>
                
                @if (in_array(1, auth()->user()->get_allowed_menus()['add']))
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary  btn-sm add_menu">
                        <i class="bx bx-plus" aria-hidden="true"></i>Add Menu
                    </button>
                </div>
                @endif

            </div>


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive add-faq-url">
                        {!! $dataTable->table(['class' => 'table dataTable border no-footer w-100 no-wrap table-bordered border table-striped']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Menu</h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addNew" enctype="multipart/form-data">

                        <input type="hidden" name="op_type" id="op_type" value="add">
                        <input type="hidden" name="id" id="id" value="" />

                        <div class="col-md-12 col-12">
                            <label for="menu_name" class="form-label"><strong>Menu Name <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="menu_name" placeholder="Menu Name"
                                id="menu_name" />
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label class="form-label"><strong>Add <span class="text-danger">*</span></strong></label>
                            <div class=" d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="add" value="1"
                                        id="addRadioDefault1">
                                    <label class="form-check-label" for="addRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="add" value="0"
                                        id="addRadioDefault2" checked>
                                    <label class="form-check-label" for="addRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label class="form-label"><strong>Edit <span class="text-danger">*</span></strong></label>
                            <div class=" d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="edit" value="1"
                                        id="editRadioDefault1">
                                    <label class="form-check-label" for="editRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="edit" value="0"
                                        id="editRadioDefault2" checked>
                                    <label class="form-check-label" for="editRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-12 mt-2">
                            <label class="form-label"><strong>View <span class="text-danger">*</span></strong></label>
                            <div class=" d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="view" value="1"
                                        id="viewRadioDefault1">
                                    <label class="form-check-label" for="viewRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="view" value="0"
                                        id="viewRadioDefault2" checked>
                                    <label class="form-check-label" for="viewRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-12 mt-2">
                            <label class="form-label"><strong>Delete <span class="text-danger">*</span></strong></label>
                            <div class=" d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" name="delete"
                                        id="deleteRadioDefault1">
                                    <label class="form-check-label" for="deleteRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" value="0" name="delete"
                                        id="deleteRadioDefault2" checked>
                                    <label class="form-check-label" for="deleteRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label class="form-label"><strong>Download <span class="text-danger">*</span></strong></label>
                            <div class=" d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" name="download"
                                        id="downloadRadioDefault1">
                                    <label class="form-check-label" for="downloadRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" value="0" name="download"
                                        id="downloadRadioDefault2" checked>
                                    <label class="form-check-label" for="downloadRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label class="form-label"><strong>Submit Button <span
                                        class="text-danger">*</span></strong></label>
                            <div class=" d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" name="submit_btn"
                                        id="submit_btnRadioDefault1">
                                    <label class="form-check-label" for="submit_btnRadioDefault1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" value="0" name="submit_btn"
                                        id="submit_btnRadioDefault2" checked>
                                    <label class="form-check-label" for="submit_btnRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
            $('.add_menu').click(function() {
                document.getElementById('addNew').reset();
                $('#op_type').val('add');
                $('#addMenuModal').modal('show');
            });

            $('#addNew').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();

                if (op_type == 'add') {
                    url = "{{ route('admin.add-menu') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-menu') }}";
                }
                $.ajax({
                    type: "POST",
                    url: url,
                    data: postData,
                    async: true,
                    contentType: false,
                    processData: false,
                    datatype: 'json',

                    beforeSend: function() {
                        $('button[type="submit"]').prop("disabled", true);
                        $('button[type="submit"]').html(
                            `<span class="fadeIn animated bx bx-loader-circle bx-spin"></span>`
                            );
                    },

                    complete: function() {
                        $('button[type="submit"]').prop("disabled", false);
                        $('button[type="submit"]').html(`Save`);
                    },

                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: 'Success',
                                showConfirmButton: true,
                            }).then(() => {
                                $('#menudatatable-table').DataTable().ajax.reload();
                                document.getElementById('addNew').reset();
                                $('#op_type').val('add');
                                $('#addMenuModal').modal('hide');
                            });

                        } else if (response.status == false) {
                            if (response.input_error) {
                                var error_text = '';
                                $.each(response.input_error, function(key, val) {
                                    error_text += val[0] + "| ";
                                });
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Error',
                                    text: error_text,
                                    showConfirmButton: true,
                                });
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.msg,
                                    showConfirmButton: true,
                                });
                            }
                        }
                    },
                    error: function() {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error',
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }
                });
            });
        });

        function editMenuModal(event) {
            document.getElementById('addNew').reset();
            var oTable = $('#menudatatable-table').dataTable();
            var row;
            if (event.target.tagName == "BUTTON")
                row = event.target.parentNode.parentNode;
            else if (event.target.tagName == "I")
                row = event.target.parentNode.parentNode.parentNode;
            else if (event.target.tagName == "SPAN")
                row = event.target.parentNode.parentNode.parentNode;

            $('#op_type').val('edit');
            $('#id').val(oTable.fnGetData(row)['id']);
            $('button[type="submit"]').html(`Update`);
            $('#menu_name').val(oTable.fnGetData(row)['menu_name']);
            if (oTable.fnGetData(row)['add'] == 1) {
                $('#addRadioDefault2').prop('checked', false);
                $('#addRadioDefault1').prop('checked', true);
            } else {
                $('#addRadioDefault1').prop('checked', false);
                $('#addRadioDefault2').prop('checked', true);
            }
            if (oTable.fnGetData(row)['edit'] == 1) {
                $('#editRadioDefault2').prop('checked', false);
                $('#editRadioDefault1').prop('checked', true);
            } else {
                $('#editRadioDefault1').prop('checked', false);
                $('#editRadioDefault2').prop('checked', true);
            }
            if (oTable.fnGetData(row)['view'] == 1) {
                $('#viewRadioDefault2').prop('checked', false);
                $('#viewRadioDefault1').prop('checked', true);
            } else {
                $('#viewRadioDefault1').prop('checked', false);
                $('#viewRadioDefault2').prop('checked', true);
            }
            if (oTable.fnGetData(row)['delete'] == 1) {
                $('#deleteRadioDefault2').prop('checked', false);
                $('#deleteRadioDefault1').prop('checked', true);
            } else {
                $('#deleteRadioDefault1').prop('checked', false);
                $('#deleteRadioDefault2').prop('checked', true);
            }
            if (oTable.fnGetData(row)['download'] == 1) {
                $('#downloadRadioDefault2').prop('checked', false);
                $('#downloadRadioDefault1').prop('checked', true);
            } else {
                $('#downloadRadioDefault1').prop('checked', false);
                $('#downloadRadioDefault2').prop('checked', true);
            }
            if (oTable.fnGetData(row)['submit_btn'] == 1) {
                $('#submit_btnRadioDefault2').prop('checked', false);
                $('#submit_btnRadioDefault1').prop('checked', true);
            } else {
                $('#submit_btnRadioDefault1').prop('checked', false);
                $('#submit_btnRadioDefault2').prop('checked', true);
            }
            $('#addMenuModal').modal('show');
        }

        function deleteMenu(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete record!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('admin.delete-menu') }}",
                            data: {
                                id: id,
                                _method: 'DELETE',
                            },
                            datatype: 'json',
                            success: function(response) {
                                if (response.status == true) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        text: response.msg,
                                        title: 'Success',
                                        showConfirmButton: true,
                                    }).then(() => {
                                        $('#menudatatable-table').DataTable().ajax.reload();
                                    });
                                } else if (response.status == false) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.msg,
                                        showConfirmButton: true,
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Error',
                                    text: "Something went wrong..",
                                    showConfirmButton: true,
                                })
                            }
                        });
                    }
                });
        }
    </script>
@endsection
