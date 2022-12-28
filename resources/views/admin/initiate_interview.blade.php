@extends('layouts.admin_app')

@section('style')
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
                            <li class="breadcrumb-item active" aria-current="page">Interviews
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Initiate Interview
                            </li>
                           
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <form method="get" class="js-datatable-filter-form row mb-3">

                        <div class="col-md-3 col-12 mt-1">
                            <div class="form-group">
                                <label for="unique_id">Search (Reg.No):</label>
                                <input type="text" name="unique_id" id="unique_id" placeholder="Search.."
                                    class="form-control">
                            </div>
                        </div>


                        <div class="col-md-2 col-12 mt-3">
                            <button type="button" class="btn btn-success clear_btn btn-sm mt-3" id="Filter_btn"> <i
                                    class="fadeIn animated bx bx-filter-alt"></i> </button>
                            <button type="button" class="btn btn-danger clear_btn btn-sm mt-3" id="clear_filter"><i
                                    class="fadeIn animated bx bx-x"></i></button>
                        </div>
                    </form>
                    <hr>

                    <div class="table-responsive">
                        {!! $dataTable->table([
                            'class' => 'table dataTable no-footer w-100 no-wrap table-bordered table-striped',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {

            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                window.LaravelDataTables["interviewercandidatedatatables-table"].draw();
            });

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["interviewercandidatedatatables-table"].draw();
            });

            $('#interviewercandidatedatatables-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
            });

            $('#interviewercandidatedatatables-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });

        });
    </script>
@endsection
