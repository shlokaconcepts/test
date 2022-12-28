@extends('layouts.admin_app')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

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
                            <li class="breadcrumb-item active" aria-current="page">Company List</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(3,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <button class="btn btn-primary btn-sm add_company">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add Company
                        </button>
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


    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m_title"></h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addNewCompany" enctype="multipart/form-data">
                        <input type="hidden" name="op_type" id="op_type" value="add">
                        <input type="hidden" name="id" id="id" value="" />

                        <div class="col-md-6 col-12">
                            <label for="name" class="form-label"><strong>Name <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Company Name.." required />
                        </div>

                        <div class="col-md-6 col-12">
                            <label for="prefix" class="form-label"><strong>Company URL Code<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="prefix" id="prefix"
                                placeholder="Company Code.." required />
                        </div>


                        <div class="col-md-6 col-12 mt-2">
                            <label for="name" class="form-label"><strong>Company Category<span
                                        class="text-danger">*</span></strong></label>
                            <select name="category" id="category" class="single-select select2" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="logo" class="form-label"><strong>Compnay Logo <span
                                        class="text-danger">*</span></strong></label>
                            <input type="file" class="form-control" name="logo" />
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="question_type" class="form-label">
                                <strong>Question Trade Wise
                                    <span class="text-danger">*</span>
                                </strong>
                            </label>
                            <select name="question_type" id="question_type" class="single-select select2" required>
                                <option value="">Select Wise</option>
                                    <option value="0">{{'NO'}}</option>
                                    <option value="1">{{'YES'}}</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="img-box d-none mt-2 p-1 border">
                                <small><strong>Old Logo:</strong></small><br>
                                <img alt="" id="company_logo" class="img-fluid w-50">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="description" class="form-label"><strong>Description <span
                                        class="text-danger">*</span></strong></label>
                            <textarea class="mytextarea" name="description" id="description" required></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {!! $dataTable->scripts() !!}


    <script>
        $(function() {
            $('#description').summernote({
                placeholder: 'Description...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });

            $('.note-image-input').remove();
            $('.add_company').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('input[type="file"]').prop('required', true);
                $('.m_title').html('Add New Company');
                $('#description').summernote('code', "");
                $('#addCompanyModal').modal('show');
            });

            $('#addNewCompany').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-Company') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-company') }}";
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
                                $('#companydatatable-table').DataTable().ajax.reload();
                                document.getElementById('addNewCompany').reset();
                                $('#addCompanyModal').modal('hide');
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

        function editCompanyModal(event) {
            resetForm();
            var oTable = $('#companydatatable-table').dataTable();
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


            $('#name').val(oTable.fnGetData(row)['name']);
            $('#prefix').val(oTable.fnGetData(row)['prefix']);
            $('#category').val(oTable.fnGetData(row)['category']).change();
            $('#question_type').val(oTable.fnGetData(row)['question_type']).change();
            $('#description').summernote('code', oTable.fnGetData(row)['full_description']);
            $('#company_logo').attr("src", 'https://storage.googleapis.com/shapers-hr-portal-upload/' + oTable.fnGetData(
                row)['full_logo']);
            $('.img-box').removeClass('d-none');
            $('input[type="file"]').prop('required', false);
            $('.m_title').html('Edit Company');
            $('#addCompanyModal').modal('show');
        }

        function deleteCompany(id) {
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
                            url: "{{ route('admin.delete-company') }}",
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
                                        $('#companydatatable-table').DataTable().ajax.reload();
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
            document.getElementById('addNewCompany').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('.select2').val('').change();
            $('.img-box').addClass('d-none');
        }
    </script>
@endsection
