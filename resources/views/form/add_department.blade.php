@extends("layouts.admin_app")
@section("style")
 <style>
    form .form-control,.select2{
        margin-bottom:5%;    
    }
    span.select2-results{
        text-align:center;
    }
    .form-check-input{
        float:inherit !important;
    }

</style>
@endsection

@section("wrapper")
 <div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item " aria-current="page">Departments</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{route('admin.departments-list')}}" class="btn btn-primary btn-sm">
                    <i class="fadeIn animated bx bx-arrow-back" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!--end breadcrumb-->
        <hr/>
		<div class="card">
			<div class="card-body">
			    <form method="POST" id="department_form">
    				<div class="row">
        					<div class="col-12 col-lg-12 ">
        						<div class="row">
        							<div class="col-3">
        								<label class="text-primary text-uppercase">Department Title <small class="text-danger">*</small></label>
        							</div>
        							<div class="col-9">
        							    <input type="text" name="name" class="form-control" placeholder="Department Title " value="" required>
        							</div>
        						</div>
        					</div>
        					<div class="col-12">
        					    <hr>
        					    <div class="row">
        					        <div class="col-12">
        					            <label class="text-primary text-uppercase"><span class="text-danger">*</span> Permissions</label>
        					        </div>
        					        <div class="col-12 border m-2">
        					            <div class="row m-2 border-bottom">
    					                    <div class="col-2 border-end text-center">
    					                        <label class="">{{'Check All'}}</label>
    					                        <span class="form-check form-switch">
                    								<input class="form-check-input checkall " type="checkbox" id="" onchange="check_all(this)">
                    							</span>
    					                    </div>
    					                    
    					                    <div class="col-2 border-end text-center">
    					                        <label class="">{{'Add'}}</label>
    					                        <div class="form-check form-switch">
                    								<input class="form-check-input checkall" type="checkbox" id="" onchange="check_all_add(this)">
                    							</div>
    					                    </div>
    					                    <div class="col-2 border-end text-center">
    					                        <label class="">{{'Edit'}}</label>
    					                        <div class="form-check form-switch">
                    								<input class="form-check-input checkall" type="checkbox" id="" onchange="check_all_edit(this)">
                    							</div>
    					                    </div>
    					                    <div class="col-2 border-end text-center">
    					                        <label class="">{{'View'}}</label>
    					                        <div class="form-check form-switch">
                    								<input class="form-check-input checkall" type="checkbox" id="" onchange="check_all_view(this)">
                    							</div>
    					                    </div>
    					                    <div class="col-1 border-end text-center">
    					                        <label class="">{{'Delete'}}</label>
    					                        <div class="form-check form-switch">
                    								<input class="form-check-input checkall" type="checkbox" id="" onchange="check_all_delete(this)">
                    							</div>
    					                    </div>
    					                    <div class="col-1 border-end text-center">
    					                        <label class="">{{'Download'}}</label>
    					                        <div class="form-check form-switch">
                    								<input class="form-check-input checkall" type="checkbox" id="" onchange="check_all_download(this)">
                    							</div>
    					                    </div>

                                            <div class="col-2 border-end text-center">
    					                        <label class="">{{'Submit Btn'}}</label>
    					                        <div class="form-check form-switch">
                    								<input class="form-check-input checkall" type="checkbox" id="" onchange="check_all_submit_btn(this)">
                    							</div>
    					                    </div>
    					                </div>

        					            @foreach($menus_permission as $mn)
        					                <div class="row m-2 border-bottom">
        					                    <div class="col-2 border-end">
        					                        <label class="text-primary">{{$mn->menu_name}}</label>
        					                    </div>
        					                    <div class="col-2 border-end text-center">
        					                        @if($mn->add=='1')
        					                        <div class="form-check form-switch">
                        								<input class="form-check-input checkall  checkadd  " name="add[]" value="{{$mn->id}}" type="checkbox" id="">
                        							</div>
                        							@endif
        					                    </div>
        					                    
        					                    <div class="col-2 border-end text-center">
        					                        @if($mn->edit=='1')
        					                        <div class="form-check form-switch">
                        								<input class="form-check-input checkall checkedit   " name="edit[]" value="{{$mn->id}}" type="checkbox" id="">
                        							</div>
                        							@endif
        					                    </div>
        					                    <div class="col-2 border-end text-center">
        					                        @if($mn->view=='1')
        					                        <div class="form-check form-switch">
                        								<input class="form-check-input checkall   checkview " name="view[]" value="{{$mn->id}}" type="checkbox" id="">
                        							</div>
                        							@endif
        					                    </div>
        					                    <div class="col-1 border-end text-center">
        					                        @if($mn->delete=='1')
        					                        <div class="form-check form-switch">
                        								<input class="form-check-input checkall checkdelete" name="delete[]" value="{{$mn->id}}" type="checkbox" id="">
                        							</div>
                        							@endif
        					                    </div>
        					                    <div class="col-1 border-end text-center">
        					                        @if($mn->download=='1')
        					                        <div class="form-check form-switch">
                        								<input class="form-check-input checkall checkdownload" name="download[]" value="{{$mn->id}}" type="checkbox" id="">
                        							</div>
                        							@endif
        					                    </div>


                                                <div class="col-2 border-end text-center">
        					                        @if($mn->submit_btn=='1')
        					                        <div class="form-check form-switch">
                        								<input class="form-check-input checkall checkSubmit" name="submit_btn[]" value="{{$mn->id}}" type="checkbox" id="">
                        							</div>
                        							@endif
        					                    </div>
        					                    
        					                </div>
        					            @endforeach
        					            
        					            
        					        </div>
        					    </div>
        					    
        					</div>
        					
        					{{-- @if(in_array(1,auth()->user()->get_allowed_menus()['add'])) --}}
        					<div class="col-12 text-center mt-2 ">
        						<button type="submit" class="btn btn-success">Submit</button>
        					</div>
        					{{-- @endif --}}
    				</div>
    				
				</form>
			</div>
			
		</div>


    </div>
</div>

@endsection


@section("script")
<script>
    function check_all(selector){
        if (selector.checked) {
            $(".checkall").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkall").each(function() {
                this.checked=false;
            });
        }
    }
    
    function check_all_add(selector){
        if (selector.checked) {
            $(".checkadd").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkadd").each(function() {
                this.checked=false;
            });
        }
    }
    
    function check_all_edit(selector){
        if (selector.checked) {
            $(".checkedit").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkedit").each(function() {
                this.checked=false;
            });
        }
    }
    
    function check_all_view(selector){
        if (selector.checked) {
            $(".checkview").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkview").each(function() {
                this.checked=false;
            });
        }
    }
    
    function check_all_delete(selector){
        if (selector.checked) {
            $(".checkdelete").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkdelete").each(function() {
                this.checked=false;
            });
        }
    }
    
    function check_all_download(selector){
        if (selector.checked) {
            $(".checkdownload").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkdownload").each(function() {
                this.checked=false;
            });
        }
    }




    function check_all_submit_btn(selector){
        if (selector.checked) {
            $(".checkSubmit").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkSubmit").each(function() {
                this.checked=false;
            });
        }
    }


    $('#department_form').on('submit',function(e){
        e.preventDefault(); 
        var postData=new FormData(document.getElementById('department_form'));
        $.ajax({
            type: 'POST',
            data: postData,
            url:"{{route('admin.add-department')}}",
            contentType: false, 
            processData: false,
            success: function (response) {
                if (response.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: response.msg,
                            title:'Success',
                            showConfirmButton: true,
                        }).then(() => {
                            document.getElementById('department_form').reset();
                        });


                    } else if (response.status == false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title:'Error',
                            text: response.msg,
                            showConfirmButton: true,
                        });
                    }
            },
            error:function(){
                Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title:'Error',
                            text:"Something went wrong..",
                            showConfirmButton: true,
                        })
            }
            
        }); 
    });
</script>
@endsection


