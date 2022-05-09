@extends('admin.layouts.layout')
@section('content')

<div class="col-xl-8">
	<!--begin::Tables Widget 9-->
	<div class="card card-xl-stretch mb-5 mb-xl-8">
		<!--begin::Header-->
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bolder fs-3 mb-1">Members Statistics</span>
				<span class="text-muted mt-1 fw-bold fs-7">Over {{$count}} members</span>
			</h3>
			<div class="card-toolbar" >
				<a href="{{url('/candidate_register')}}" class="btn btn-sm btn-light btn-active-primary">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
					<span class="svg-icon svg-icon-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
							<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
						</svg>
					</span>
					<!--end::Svg Icon-->New Member</a>
			</div>
		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body py-3">
			<!--begin::Table container-->
			<div class="table-responsive">
				<!--begin::Table-->
				<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
					<!--begin::Table head-->
					<thead>
						<tr class="fw-bolder text-muted">
							<th class="min-w-200px" >Candidates Name</th>
						</tr>
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody>
						<tr>
							
							<td>
								
								@foreach($UsersLists as $UsersList)
								<div class="d-flex align-items-center">
									<div class="d-flex justify-content-start flex-column">
										<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$UsersList->name}}</a>
										<span class="text-muted fw-bold text-muted d-block fs-7">{{$UsersList->email}}</span>
									</div>
								</div>
								@endforeach
							</td>
							
						
							<td>
							
							</td>
						</tr>

					</tbody>
					<!--end::Table body-->
				</table>
				<!--end::Table-->
			</div>
			<!--end::Table container-->
		</div>
		<!--begin::Body-->
	</div>
	<!--end::Tables Widget 9-->
</div>






@endsection