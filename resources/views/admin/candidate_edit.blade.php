@extends('admin.layouts.layout')
@section('content')
<div class="card">
    <!--begin::Body-->
    <div class="card-body p-lg-17">
        <!--begin::Hero-->
        <div class="position-relative mb-17">
            <u><h3> <b> Candidate Edit Form </b> </h3></u>
        </div>
        <!--end::-->
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row mb-17">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                @include('flash::message')
                <form class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post" id="candidate_edit_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row mb-5">

                        <div class="col-md-6 fv-row fv-plugins-icon-container">

                            <label class="required fs-5 fw-bold mb-2">First Name</label>

                            <input type="text" class="form-control form-control-solid" value="{{$userDetail->name}}" placeholder="first name" name="first_name" id="first_name" autocomplete="off" maxlength="20">

                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <label class="required fs-5 fw-bold mb-2">Last Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="last name"  value="{{$userDetail->last_name}}" name="last_name" id="last_name" autocomplete="off" maxlength="20">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                    </div>
                        <input type="hidden" name="user_id" id="user_id" value="{{$userDetail->id}}">
                    <div class="row mb-5">

                        <div class="col-md-6 fv-row fv-plugins-icon-container">

                            <label class="required fs-5 fw-bold mb-2">Email</label>

                            <input type="email" class="form-control form-control-solid" placeholder="email"  value="{{$userDetail->email}}" name="email" id="email" autocomplete="off">

                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Mobile No</label>
                            <input type="text" class="form-control form-control-solid" placeholder="mobileno" name="mobileno"  value="{{$userDetail->mobile}}" id="mobileno" autocomplete="off" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)">
                            <span class="error text-danger d-none"></span>
                        </div>

                    </div>

                    <div class="row mb-5">

                        <div class="col-md-6 fv-row fv-plugins-icon-container">

                            <label class=" fs-5 fw-bold mb-2">Age</label>

                            <input type="text" class="form-control form-control-solid" placeholder="age" name="age" id="age" value="{{$userDetail->age}}"  autocomplete="off" maxlength="2" onkeypress="return /[0-9]/i.test(event.key)">

                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <label class="required fs-5 fw-bold mb-2">Resume (accept *pdf/doc)</label>
                            <input type="file" class="form-control form-control-solid" placeholder="resume" name="resume" id="resume" accept=".doc,.docx,.pdf">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if($userDetail->resume)
                            <div > <a href="{{$path}}" target="blank"> <i class="fas fa-file-pdf" style="color: #cb2d2d;"></i>  </a></div>
                            

                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row fv-plugins-icon-container">
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-bold mb-2">Address</label>
                            <textarea class="form-control form-control-solid" rows="2" name="address" id="address" placeholder="address" maxlength="250"> {{$userDetail->address}}</textarea>
                        </div>
                        <!-- <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span class="required">Position</span>
                        </label>
                        <select name="designation" id="designation" data-placeholder="Select a position..." class="form-control form-control-solid " >
                            <option value=""> Select</option>
                            @foreach($designation as $design)
                            <option value="{{$design->id}}" {{ $userDetail->designation_id == $design->id? 'selected' : '' }} >{{$design->name}}</option>
                            @endforeach
                        </select> -->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">

                            <label class="required fs-5 fw-bold mb-2">Department</label>

                            <select name="department" id="department" data-placeholder="Select a department..." class="form-control form-control-solid " onchange="get_department(this);">
                                <option value=""> Select</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" {{ $userDetail->department_id == $department->id? 'selected' : '' }}>{{$department->department_name}}</option>
                                @endforeach
                            </select>

                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Designation</label>
                             <select name="designation" id="designation" data-placeholder="Select a designation..." class="form-control form-control-solid ">
                                <option value="" > Select</option>
                                @foreach($designation as $design)
                                <option value="{{$design->id}}" {{ $userDetail->designation_id == $design->id? 'selected' : '' }}>{{$design->name}}</option>
                                @endforeach
                            </select>
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-5">
                        <label class="fs-6 fw-bold mb-2">Experience (Optional)</label>
                        <textarea class="form-control form-control-solid" rows="2" name="experience"  address placeholder="experience" id="experience" maxlength="100"> {{$userDetail->experience}}</textarea>
                        
                    </div>
                   


                    <button class="btn btn-primary" id="kt_careers_submit_button" type="submit" data-href="{{URL::to('candidate_list')}}">
                        <!--begin::Indicator-->
                        <span class="indicator-label">Edit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator-->
                    </button>
                    <!--end::Submit-->
                    <div></div>
                </form>

            </div>

        </div>
       
    </div>
</div>
@endsection