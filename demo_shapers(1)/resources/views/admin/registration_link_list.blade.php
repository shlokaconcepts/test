@extends('layouts.admin_app')

@section('style')
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
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
                            <li class="breadcrumb-item active" aria-current="page">Registration Link</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(5,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add_link">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add Link
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


    <div class="modal fade" id="addLinkModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m_title"></h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addNewLink" enctype="multipart/form-data">
                        <input type="hidden" name="op_type" id="op_type" value="add">
                        <input type="hidden" name="id" id="id" value="" />

                        <div class="col-md-6 col-12">
                            <label for="name" class="form-label"><strong>Company<span
                                        class="text-danger">*</span></strong></label>
                            <select name="company" id="company" class="single-select select2" required>
                                <option value="">Select Comapny</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}({{ $company->prefix }})</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6 col-12 ">
                            <label for="name" class="form-label"><strong>Category<span
                                        class="text-danger">*</span></strong></label>
                            <select name="category" id="category" class="single-select select2" required>
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-12 mt-2">
                            <label for="name" class="form-label"><strong>State<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2 state" multiple="multiple" placeholder="Select State"
                                name="state[]" required>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6 mt-2">
                            <label for="close_date" class="form-label mb-0"><strong>Close Date<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control datepicker" name="close_date" id="close_date"
                                required />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="close_date" class="form-label mb-0"><strong>Close Time<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control timepicker" name="close_time" id="close_time"
                                required />
                        </div>

                        <div class="col-md-12 mt-2">
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
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {!! $dataTable->scripts() !!}


    <script>
        $(function() {
            $('.single-select').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });

            $('#company').change(function() {
                var id = $('#company').val();
                $("#category").html('<option value="">Select Category</option>');
                if (id != '') {
                    $("#category").html('<option value="">Fetching Category...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            $('#category').html('<option value="">Select Category</option>');
                            $.each(res.data, function(key, value) {
                                $("#category").append(`<option value="${value
                                .id}">${value.name}</option>`);
                            });
                        }
                    });
                }
            });

            $(".datepicker").pickadate({
                selectMonths: true,
                selectYears: true,
                format: 'dd-mm-yyyy',
            });

            $('.timepicker').pickatime();

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
            $('.add_link').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('input[type="file"]').prop('required', true);
                $('.m_title').html('Add New Link');
                $('#description').summernote('code', "");
                $('#addLinkModal').modal('show');
            });

            $('#addNewLink').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-link') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-link') }}";
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
                                $('#registrationlinkdatatable-table').DataTable().ajax
                                    .reload();
                                document.getElementById('addNewLink').reset();
                                $('#addLinkModal').modal('hide');
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

        function editLinkModal(event) {
            resetForm();
            var oTable = $('#registrationlinkdatatable-table').dataTable();
            var row;
            if (event.target.tagName == "BUTTON")
                row = event.target.parentNode.parentNode;
            else if (event.target.tagName == "I")
                row = event.target.parentNode.parentNode.parentNode;
            else if (event.target.tagName == "SPAN")
                row = event.target.parentNode.parentNode.parentNode;
            $('#op_type').val('edit');

            var state_col_data = oTable.fnGetData(row)['state'];
            var valArr = '';
            if (state_col_data != null) {
                valArr = state_col_data.split(',');
            }


            var option = '';
            $.each(JSON.parse('{!! $json_state !!}'), function(key, val) {
                if (valArr.length > 0 && valArr.indexOf(`${val['id']}`) != -1) {
                    option += `<option value="${val['id']}" selected>${val['name']}</option>`;
                } else {
                    option += `<option value="${val['id']}">${val['name']}</option>`;
                }
            });
            $('.state').empty();
            $('.state').append(option);




            $('#id').val(oTable.fnGetData(row)['id']);
            $('button[type="submit"]').html(`Update`);
            $('#close_date').val(oTable.fnGetData(row)['closed_time']);
            $('#close_time').val(oTable.fnGetData(row)['closed_times']);
            $('#company').val(oTable.fnGetData(row)['company']).change();
            $('#description').summernote('code', oTable.fnGetData(row)['description']);
            $('.m_title').html('Edit Link');

            setTimeout(() => {
                $('#category').val(oTable.fnGetData(row)['form_category']).change();
            }, 1000);
            $('#addLinkModal').modal('show');
        }

        function deleteLink(id) {
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
                            url: "{{ route('admin.delete-link') }}",
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
                                        $('#registrationlinkdatatable-table').DataTable().ajax
                                            .reload();
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
            document.getElementById('addNewLink').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('.select2').val('').change();
            $('.img-box').addClass('d-none');
        }



        function ChangeStatus(selector, id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.registration-link-change-status') }}",
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
                            $('#registrationlinkdatatable-table').DataTable().ajax.reload();
                        });
                    } else if (response.status == false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Error",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#registrationlinkdatatable-table').DataTable().ajax.reload();
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
