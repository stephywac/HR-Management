<script>
	var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{asset('assets/js/custom/modals/users-search.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--end::Page Custom Javascript-->
<script>
	window.urls = {
		candidate: {
			store: "{{route('candidate.store')}}"
		}
	};
</script>
<script>
	$('#candidate_form').submit(function(e) {
		e.preventDefault();

		let formData = new FormData();
		var resume = ($('#resume')[0].files[0] || '');
		//alert(resume);
		formData.append("first_name", $("#first_name").val());
		formData.append("last_name", $("#last_name").val());
		formData.append("age", $("#age").val());
		formData.append("mobileno", $("#mobileno").val());
		formData.append("address", $("#address").val());
		formData.append("designation", $("#designation").val());
		formData.append("experience", $("#experience").val());
		formData.append("email", $("#email").val());
		formData.append("resume", resume);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: window.urls.candidate.store,
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",

			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				Accept: "application/json",
			},
			success: function(response) {
				console.log(response);
				if (response.status == true) {
					Swal.fire({
						position: 'top-end',
						title: 'Register Successfully',
						showConfirmButton: false,
						timer: 1500
					})
				}

			},
			error: function(err) {
				
				$.each(err.responseJSON.errors, function(key, value) {
					$("#" + key).next().html(value[0]);
					$("#" + key).next().removeClass('d-none');
				});
			},
		});
	});

</script>