@extends('layouts.admin_app')
@section('style')
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item " aria-current="page">Onboarding Venue</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(26,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary add_link_btn btn-sm">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add New
                        </a>
                    </div>
                @endif
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive ">
                        {!! $dataTable->table(['class' => 'table dataTable no-footer w-100 no-wrap border']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->


    <!--Admin Create Modal -->
    <div class="modal fade" id="addExamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-muted model_title">Add Onboarding Venue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addNew" enctype="multipart/form-data">
                        <input type="hidden" name="op_type" id="op_type" value="ADD">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-md-6 col-12 mt-1">
                            <div class="form-group">
                                <label for="company" class="form-label mb-0">Company:</label>
                                <select name="company" id="company" class="select2" @disabled(auth()->user()->type == '0')>
                                    <option value="">Select Comapny</option>
                                    @foreach (companies() as $company)
                                        <option value="{{ $company->id }}" @selected(auth()->user()->company == $company->id)>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="name" class="form-label mb-0"><strong>Venue Title<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="name" class="form-control" name="name" required />
                        </div>

                        <div class="col-md-12 mt-1">
                            <label for="location" class="form-label mb-0"><strong>Venue Location<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="location" class="form-control" name="location" required />
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success"> Submit</button>
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



            $('.add_link_btn').click(function() {
                document.getElementById("addNew").reset();
                $('#op_type').val('ADD');
                $('.model_title').html('Add New Venue');
                $('#addExamModal').modal('show');
            });


            $('#addNew').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                postData.append('company',$('#company').val());
                $.ajax({
                    type: 'POST',
                    data: postData,
                    url: "{{route('admin.operation-onboarding-venue')}}",
                    async: true,
                    contentType: false,
                    processData: false,
                    datatype: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.msg,
                                showConfirmButton: true,
                            }).then(() => {
                                $(this).trigger("reset");
                                $('#onboardingvenuedatatable-table').DataTable().ajax.reload();
                                $('#addExamModal').modal('hide');
                            });


                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response.msg,
                                showConfirmButton: true,
                            }).then(() => {
                                $('#onboardingvenuedatatable-table').DataTable().ajax.reload();
                            });
                        }

                    },
                    error: function() {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Something went wrong..",
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });


        function ChangeStatus(selector, id) {
        if (id) {
            $.ajax({
                type: 'get',
                url: '{{url("admin/onboarding-venue-change-status")}}/'+id,
                datatype: 'json',
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success',
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#onboardingvenuedatatable-table').DataTable().ajax.reload();
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
                error: function () {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error',
                        text: "Something went wrong..",
                        showConfirmButton: true,
                    });
                }

            });
        }
    }

    function deleteRecord(selector, id) {
        if (id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "you want to delete?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({
                    type: 'delete',
                    url: '{{url("admin/delete-onboarding-venue")}}/' + id,
                    data: {
                        id: id
                    },
                    datatype: 'json',
                    success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success',
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#onboardingvenuedatatable-table').DataTable().ajax.reload();
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
                error: function () {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error',
                        text: "Something went wrong..",
                        showConfirmButton: true,
                    });
                }



                });



                }
            })




        }
    }
    

        function editModal(event) {
            var oTable = $('#onboardingvenuedatatable-table').dataTable();
            var row;
            if (event.target.tagName == "BUTTON")
                row = event.target.parentNode.parentNode;
            else if (event.target.tagName == "I")
                row = event.target.parentNode.parentNode.parentNode;
            else if (event.target.tagName == "SPAN")
                row = event.target.parentNode.parentNode.parentNode;
            $('#op_type').val('EDIT');
            $('#id').val(oTable.fnGetData(row)['id']);
            $('#company').val(oTable.fnGetData(row)['company']).change();
        
            $('#location').val(oTable.fnGetData(row)['location']);
            $('#name').val(oTable.fnGetData(row)['name']);
            $('.model_title').html('Edit Venue');
            $('#addExamModal').modal('show');
        }
    </script>
@endsection
