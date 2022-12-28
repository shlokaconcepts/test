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
                            <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(3,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add_admin">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add User
                        </a>
                    </div>
                @endif
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive add-faq-url">
                        {!! $dataTable->table([
                            'class' => 'table dataTable no-footer w-100 no-wrap table-bordered border table-striped',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m_title"></h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addNewAdmin" enctype="multipart/form-data">
                        <input type="hidden" name="op_type" id="op_type" value="add">
                        <input type="hidden" name="id" id="id" value="" />

                        <div class="col-md-6 col-12">
                            <label for="name" class="form-label mb-0"><strong>Name <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Full Name" />
                        </div>

                        <div class="col-md-6 col-12 ">
                            <label for="email" class="form-label mb-0"><strong>Email Address<span
                                        class="text-danger">*</span></strong></label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email Address" />
                        </div>

                        <div class="col-md-6 col-12 mt-3">
                            <label for="phone" class="form-label mb-0"><strong>Phone Number<span
                                        class="text-danger">*</span></strong></label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                placeholder="Conatact..." />
                        </div>

                        <div class="col-md-6 col-12 mt-3">
                            <label for="phone" class="form-label mb-0"><strong>Password<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="password" id="password"
                                placeholder="Password" />
                        </div>



                        <div class="col-md-6 col-12 mt-3">
                            <label for="department" class="form-label mb-0"><strong>Department<span
                                        class="text-danger">*</span></strong></label>
                            <select class="select2" required name="department" id="department">
                                <option value="">Select Department</option>
                                @foreach (departments() as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-3">
                            <label for="category" class="form-label mb-0"><strong>Company<span
                                        class="text-danger">*</span></strong></label>
                            <select class="select2 " name="company" id="company">
                                <option value="">Select Company</option>
                                @foreach (companies() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }} ({{ $company->prefix }})</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-12 mt-3">
                            <label for="image" class="form-label mb-0"><strong>Profile Image</strong></label>
                            <input type="file" class="form-control" name="image" id="image" />
                            <div class="img-box d-none mt-2 p-1 border">
                                <small><strong>Old Image:</strong></small><br>
                                <img alt="" id="admin_image" class="img-fluid w-50">
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
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {

            $('.add_admin').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('.m_title').html('Add New Employee');
                $('#addAdminModal').modal('show');
            });

            $('#addNewAdmin').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-employee') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-employee') }}";
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
                                $('#admindatatable-table').DataTable().ajax.reload();
                                document.getElementById('addNewAdmin').reset();
                                $('#addAdminModal').modal('hide');
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

        });

        function editAdminModal(event) {
            resetForm();
            var oTable = $('#admindatatable-table').dataTable();
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
            $('#email').val(oTable.fnGetData(row)['email']);
            $('#phone').val(oTable.fnGetData(row)['phone']);
            $('#company').val(oTable.fnGetData(row)['company']).change();
            $('#department').val(oTable.fnGetData(row)['department']).change();

            $('#admin_image').attr("src", 'https://storage.googleapis.com/shapers-hr-portal-upload/' + oTable.fnGetData(
                row)['full_image']);
            $('.img-box').removeClass('d-none');
            $('.m_title').html('Edit Employee');
            $('#addAdminModal').modal('show');
        }

        function deleteAdmin(id) {
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
                            url: "{{ route('admin.delete-employee') }}",
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
                                        $('#admindatatable-table').DataTable().ajax.reload();
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
            document.getElementById('addNewAdmin').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('#department').val('').change();
            $('#company').val('').change();
            $('.img-box').addClass('d-none');
        }
    </script>
@endsection
