@extends('admin.layouts.layout')
@section('content')
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!-- <div class="d-flex align-items-center position-relative my-1">
               
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                
                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
            </div> -->
            <!--end::Search-->

        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">


                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_department">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                        </svg>
                    </span>
                    Add Department</button>
                <!--end::Add user-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
            </div>
            <!--end::Group actions-->
            <!--begin::Modal - Adjust Balance-->
            <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Export Users</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->

                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card-->
            <!--begin::Modal - Add task-->
            <div class="modal fade" id="add_department" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Add Department</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary hide_models" data-kt-users-modal-action="close" >
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <span id="sucess" style="color:green"></span>
                            <form id="add_department_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" method="post">
                                @csrf
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 231px;">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Department Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="department_name" id="department_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="" autocomplete="off">

                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        <span id="department_name_error" style="color:red"></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Status</label>
                                        <select class="form-control form-control-solid mb-3 mb-lg-0" id="d_status" name="d_status">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        <span id="d_status_error" style="color:red"></span>
                                    </div>

                                </div>

                                <div class="text-center pt-15">

                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                    </button>
                                    <button type="reset" class="btn btn-light me-3 hide_models" data-kt-users-modal-action="cancel">Discard</button>
                                </div>
                                <!--end::Actions-->
                                <div></div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add task-->




            <div class="modal fade" id="edit_department" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="edit_department">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Edit User</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary hide_model_department" data-kt-users-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <span id="sucess" style="color:green"></span>
                            <form id="edit_department_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" method="post">
                                @csrf
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="edit_department_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 231px;">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Department Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="department_name1" id="department_name1" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="" autocomplete="off">
                                        <input type="hidden" id="id" name="id" value="">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        <span id="department_name1_error" style="color:red"></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Status</label>
                                        <select class="form-control form-control-solid mb-3 mb-lg-0" id="d_status1" name="d_status1">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        <span id="d_status1_error" style="color:red"></span>
                                    </div>

                                </div>

                                <div class="text-center pt-15">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Edit</span>
                                    </button>
                                    <button type="reset" class="btn btn-light me-3 hide_model_department" data-kt-users-modal-action="cancel">Discard</button>
                                </div>
                                <!--end::Actions-->
                                <div></div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table class="table table-striped table-row-bordered gy-5 gs-7" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <!-- <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.25px;">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1">
                                </div>
                            </th> -->
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 288.516px;">department</th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="Joined Date: activate to sort column ascending" style="width: 208.453px;">Status</th>

                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="Joined Date: activate to sort column ascending" style="width: 208.453px;">Joined Date</th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 128.922px;">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>

                    <tbody class="text-gray-600 fw-bold">
                        @foreach($departments as $department)
                        <tr>
                            <td>{{$department->department_name}}</td>
                            @if($department->status==1)

                            <td>Active</td>

                            @else
                            <td>Inactive</td>

                            @endif
                            <td>{{$department->created_at}}</td>

                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" onclick="return edit_depat('{{$department->id}}')">Edit</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row" onclick="return delete_depat('{{$department->id}}')">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>

                        </tr>



                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">
                        <ul class="pagination">
                            {{ $departments->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Table-->








    </div>
    <!--end::Card body-->
</div>
@endsection

<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script>
    var status = {
        1: {
            "title": "Pending",
            "state": "primary"
        },
        2: {
            "title": "Delivered",
            "state": "danger"
        },
        3: {
            "title": "Canceled",
            "state": "primary"
        },
        4: {
            "title": "Success",
            "state": "success"
        },
        5: {
            "title": "Info",
            "state": "info"
        },
        6: {
            "title": "Danger",
            "state": "danger"
        },
        7: {
            "title": "Warning",
            "state": "warning"
        },
    };

    $("#kt_datatable_example_1").DataTable({
        "columnDefs": [{
            // The `data` parameter refers to the data for the cell (defined by the
            // `data` option, which defaults to the column being worked with, in
            // this case `data: 0`.
            "render": function(data, type, row) {
                var index = KTUtil.getRandomInt(1, 7);

                return data + '<span class="ms-2 badge badge-light-' + status[index]['state'] + ' fw-bold">' + status[index]['title'] + '</span>';
            },
            "targets": 1
        }]
    });
</script>