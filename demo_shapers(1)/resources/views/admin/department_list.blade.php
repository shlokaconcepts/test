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
                            <li class="breadcrumb-item active" aria-current="page">Department List</li>
                        </ol>
                    </nav>
                </div>
                @if(in_array(2, auth()->user()->get_allowed_menus()['add']))
                <div class="ms-auto">
                    <a href="{{route('admin.add-department')}}" class="btn btn-primary btn-sm add_menu">
                        <i class="bx bx-plus" aria-hidden="true"></i>Add Department
                    </a>
                </div>
                @endif
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive add-faq-url">
                        {!! $dataTable->table(['class' => 'table dataTable no-footer w-100 no-wrap table-bordered border table-striped']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
    <script>
         function deleteDepartment(id) {
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
                            url: "{{ route('admin.delete-department') }}",
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
                                        $('#departmentdatatable-table').DataTable().ajax.reload();
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
