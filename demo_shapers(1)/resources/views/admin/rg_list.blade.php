@extends('layouts.admin_app')

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Registration Category List</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(8,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <button class="btn btn-primary btn-sm add_rg_cat">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add New
                        </button>
                    </div>
                @endif
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->type == 1)
                        <form method="get" class="js-datatable-filter-form row mb-3">
                            <div class="col-md-3 col-12">
                                <label for="name" class="form-label"><strong>Company<span
                                            class="text-danger">*</span></strong></label>
                                <select name="company_id" id="company_id" class="select2" required>
                                    <option value="">Select Company</option>
                                    @foreach (companies() as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}({{$company->prefix}})</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-3 mt-4">
                                <button type="button" class="btn btn-success clear_btn btn-sm" id="Filter_btn"> <i
                                        class="fadeIn animated bx bx-filter-alt"></i> </button>
                                <button type="button" class="btn btn-danger clear_btn btn-sm" id="clear_filter"><i
                                        class="fadeIn animated bx bx-x"></i></button>
                            </div>
                        </form>
                        <hr>
                    @endif
                    <div class="table-responsive add-faq-url">
                        {!! $dataTable->table([
                            'class' => 'table dataTable no-footer w-100 no-wrap table-bordered border table-striped',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addRGCatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m_title"></h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addNewRGCat" enctype="multipart/form-data">
                        <input type="hidden" name="op_type" id="op_type" value="add">
                        <input type="hidden" name="id" id="id" value="" />

                        <div class="col-md-12 col-12">
                            <label for="name" class="form-label"><strong>Name <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Name.." required />
                        </div>
                        <div class="col-md-6 col-12 mt-2">
                            <label for="title" class="form-label"><strong>Title <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Title.." required />
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="name" class="form-label"><strong>Company<span
                                        class="text-danger">*</span></strong></label>
                            <select name="company" id="company" class="single-select select2" required>
                                <option value="">Select Company</option>
                                @foreach (companies() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}({{$company->prefix}})</option>
                                @endforeach
                            </select>
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
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
          
            $('.add_rg_cat').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('.m_title').html('Add New RG-Category');
                $('#addRGCatModal').modal('show');
            });

            

            $('#addNewRGCat').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-rg-category') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-rg-category') }}";
                }
                $.ajax({
                    type: 'POST',
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
                                $('#registrationcategorydatatable-table').DataTable().ajax.reload();
                                document.getElementById('addNewRGCat').reset();
                                $('#addRGCatModal').modal('hide');
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
            });


            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('#company_id').val('').change();
                window.LaravelDataTables["registrationcategorydatatable-table"].draw();
            });


            $("#Filter_btn").click(() => {
                window.LaravelDataTables["registrationcategorydatatable-table"].draw();
            });

            $('#registrationcategorydatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });
        });

        function editRGModal(event) {
            resetForm();
            var oTable = $('#registrationcategorydatatable-table').dataTable();
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
            $('#name').val(oTable.fnGetData(row)['name']);
            $('#title').val(oTable.fnGetData(row)['title']);
            $('#company').val(oTable.fnGetData(row)['company']).change();
            $('.m_title').html('Edit RG-Category');
            $('#addRGCatModal').modal('show');
        }

        function deleteRG(id) {
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
                            url: "{{ route('admin.delete-rg-category') }}",
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
                                        $('#registrationcategorydatatable-table').DataTable().ajax.reload();
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

        function resetForm() {
            document.getElementById('addNewRGCat').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('.select2').val('').change();
        }

        function ChangeStatus(selector, id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.rg-category-change-status') }}",
                data: {
                    id: id
                },
                datatype: 'json',
                success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "Success",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#registrationcategorydatatable-table').DataTable().ajax.reload();
                        });
                    } else if (response.status == false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Error",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#registrationcategorydatatable-table').DataTable().ajax.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: "Error",
                        text: "Something went wrong..",
                        showConfirmButton: true,
                    });
                }

            });
        }
    </script>
@endsection
