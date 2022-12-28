@extends('layouts.admin_app');
@section("style")
<style>
    .page-wrapper {
        height: inherit;
}
</style>
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Admins</p>
                                    <h4 class="my-1 text-info">{{$admins}}</h4>
                                    <small class="mb-0">
                                         <a href="{{url('admin/employee-list')}}" class="">View All</a>
                                         <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                    <i class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Companies</p>
                                    <h4 class="my-1 text-danger">{{$company}}</h4>
                                    <small class="mb-0">
                                        <a href="{{url('admin/company-list')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                   </small>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='fadeIn animated bx bx-buildings'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Interviewer</p>
                                    <h4 class="my-1 text-success">{{$inter}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-group' ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Registration</p>
                                    <h4 class="my-1 text-warning">{{$user}}</h4>
                                    <small class="mb-0">
                                        <a href="{{url('admin/registration-list')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                   </small>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bx-message-square-edit'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->


        </div>
    </div>
@endsection

@section("script")

@endsection
