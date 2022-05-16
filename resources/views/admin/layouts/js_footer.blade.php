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
<script src="{{asset('assets/js/custom/modals/users-search.js')}}"></script>
<!--end::Page Custom Javascript-->
<script>
	$('div.alert').delay(3000).slideUp(300);
	$(".alert alert-success").delay(1000).slideUp(100);
	window.urls = {
		candidate: {
			store: "{{route('candidate.store')}}"
			,update: "{{route('candidate.update')}}"
			,search: "{{route('candidate.search')}}"
			,delete: "{{route('candidate.delete')}}"

		},
		department: {
			add: "{{route('department.add')}}",
			edit: "{{route('department.edit')}}",
			update: "{{route('department.update')}}",
			delete: "{{route('department.delete')}}",
		},
		designation: {
			add: "{{route('designation.add')}}",
			edit: "{{route('designation.edit')}}",
			update: "{{route('designation.update')}}",
			delete: "{{route('designation.delete')}}",
			get: "{{route('designation.getDesignation')}}",
			edit_get: "{{route('designation.edit_get')}}",
		},
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
		formData.append("department", $("#department").val());
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
						timer: 3000
					})
				}
				setTimeout(function() {

					location.reload(true);
				}, 5000);
				document.location.href="{!! route('candidate.list'); !!}";
			},
			error: function(err) {
				$.each(err.responseJSON.errors, function(key, value) {
					$("#" + key).next().html(value[0]);
					$("#" + key).next().removeClass('d-none');
				});
			},
		});
	});



	$(document).ready(function() {
		$('#add_department_form').on("submit", function(event) {
			event.preventDefault();

			if ($('#department_name').val() == "") {
				$('#department_name_error').html("Department Name Required..!");
			} else if ($('#d_status').val() == '') {
				$('#d_status_error').html("Status Name Required..!");
			} else {
				$.ajax({
					url: window.urls.department.add,
					method: "POST",
					data: $('#add_department_form').serialize(),
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {
						console.log(data.status);
						if (data.status == "failure") {
							$('#department_name_error').html(data.msg.department_name);
						} else {
							$('#department_name_error').html("");
							$('#sucess').html("<div class='alert alert-success'>success</div>");
							setTimeout(function() {
								location.reload(true);
							}, 1000);
						}
					}
				});
			}
		});

		$('#edit_department_form').on("submit", function(event) {
			event.preventDefault();
			var department_name1 = $('#department_name1').val();
			var d_status1 = $('#d_status1').val();
			var id = $('#id').val();


			if ($('#department_name1').val() == "") {
				$('#department_name1_error').html("Department Name Required..!");
			} else if ($('#d_status1').val() == '') {
				$('#d_status1_error').html("Status Name Required..!");
			} else {
				$.ajax({
					url: window.urls.department.update,
					method: "POST",
					data: {
						department_name1: department_name1,
						d_status1: d_status1,
						id: id
					},
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {
						console.log(data.status);
						if (data.status == "success") {
							Swal.fire({
								position: 'center',
								title: 'Updated Successfully',
								showConfirmButton: false,
								timer: 1500
							})

							setTimeout(function() {
								location.reload(true);
							}, 1000);
						}

					}
				});
			}
		});

	});

	$('.hide_model').click(function() {
		$('#kt_modal_add_user').modal('hide');
	});


	$('.hide_models').click(function() {
		$('#add_department').modal('hide');
	});

	$('.hide_model_department').click(function() {
		$('#edit_department').modal('hide');
	});

	$('.edit_designation').click(function() {
		$('#edit_designation').modal('hide');
	});
	function edit_depat(id) {

		$('#edit_department').modal('show');
		$("#id").val(id);
		$.ajax({
			url: window.urls.department.edit,
			method: "POST",
			data: {
				id: id
			},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
			},
			success: function(data) {
				console.log(data.status);
				$('#department_name1').val(data.department_name);
				if (data.status == 1) {
					$("#d_status1").val(1);
				} else if (data.status == 0) {
					$("#d_status1").val(0);
				}
			}
		});
	}

	function delete_depat(id) {

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {

				$("#id").val(id);
				$.ajax({
					url: window.urls.department.delete,
					method: "POST",
					data: {
						id: id
					},
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {
						console.log(data.status);

						if (data.status == 'success') {
							Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
							)
							setTimeout(function() {
								location.reload(true);
							}, 1000);
						} else {
							Swal.fire(
								'Deleted!',
								'something went wrong.',
								'danger'
							)
						}
					}
				});



			}
		})
	}


	//designation

	$(document).ready(function() {
		$('#add_designation_form').on("submit", function(event) {
			event.preventDefault();

			if ($('#designation').val() == "") {
				$('#designation_name_error').html("Designation Name Required..!");
			}
			if ($('#department_id').val() == '') {
				$('#department_id_error').html("Department Name Required..!");

			}
			if ($('#d_status').val() == '') {
				$('#d_status_error').html("Status Name Required..!");
			} else {
				$.ajax({
					url: window.urls.designation.add,
					method: "POST",
					data: $('#add_designation_form').serialize(),
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {

						if (data.status == "failure") {
							$('#designation_name_error').html(data.msg.department_name);
							$('#department_error').html(data.msg.department_id);
						} else {
							$('#department_name_error').html("");
							$('#sucess').html("<div class='alert alert-success'>success</div>");
							setTimeout(function() {
								location.reload(true);
							}, 1000);
						}
					}
				});
			}
		});

		$('#edit_department_form').on("submit", function(event) {
			event.preventDefault();
			var department_name1 = $('#department_name1').val();
			var d_status1 = $('#d_status1').val();
			var id = $('#id').val();


			if ($('#department_name1').val() == "") {
				$('#department_name1_error').html("Department Name Required..!");
			} else if ($('#d_status1').val() == '') {
				$('#d_status1_error').html("Status Name Required..!");
			} else {
				$.ajax({
					url: window.urls.department.update,
					method: "POST",
					data: {
						department_name1: department_name1,
						d_status1: d_status1,
						id: id
					},
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {
						console.log(data.status);
						if (data.status == "success") {
							Swal.fire({
								position: 'center',
								title: 'Updated Successfully',
								showConfirmButton: false,
								timer: 1500
							})

							setTimeout(function() {
								location.reload(true);
							}, 1000);
						}

					}
				});
			}
		});




		$('#edit_designation_form').on("submit", function(event) {
			event.preventDefault();
			var designation_name1 = $('#designation_name1').val();
			var department_id1 = $('#department_id1').val();
			var d_status1 = $('#d_status1').val();
			var id = $('#id').val();


			if ($('#designation_name1').val() == "") {
				$('#designation_name1_error').html("designation  name Required..!");
			} else if ($('#d_status1').val() == '') {
				$('#d_status1_error').html("Status Name Required..!");
			} else if ($('#department_id1').val() == '') {
				$('#department_id1_error').html("Status Name Required..!");
			} else {
				$.ajax({
					url: window.urls.designation.update,
					method: "POST",
					data: {
						designation_name1: designation_name1,
						d_status1: d_status1,
						department_id1: department_id1,
						id: id
					},
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {
						console.log(data.status);
						if (data.status == "success") {
							Swal.fire({
								position: 'center',
								title: 'Updated Successfully',
								showConfirmButton: false,
								timer: 1500
							})

							setTimeout(function() {
								location.reload(true);
							}, 1000);
						}

					}
				});
			}
		});

	});

	function edit_desig(id) {

		$('#edit_designation').modal('show');
		$("#id").val(id);
		$.ajax({
			url: window.urls.designation.edit,
			method: "POST",
			data: {
				id: id
			},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
			},
			success: function(data) {
				console.log(data.department.id);
				$('#designation_name1').val(data.name);
				$('#department_id1').val(data.department.id);
				if (data.status == 1) {
					$("#d_status1").val(1);
				} else if (data.status == 0) {
					$("#d_status1").val(0);
				}
			}
		});
	}

	function delete_desig(id) {

		Swal.fire({
			title: 'Are you sure delete?',
			text: "delete the users also under this designation !",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {

				$("#id").val(id);
				$.ajax({
					url: window.urls.designation.delete,
					method: "POST",
					data: {
						id: id
					},
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(data) {
						console.log(data.status);

						if (data.status == 'success') {
							Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
							)
							setTimeout(function() {
								location.reload(true);
							}, 1000);
						} else {
							Swal.fire(
								'Deleted!',
								'something went wrong.',
								'danger'
							)
						}
					}
				});



			}
		})
	}

	

	$('#kt_modal_add_user').on('hidden.bs.modal', function() {
		$('#department_name_error').html("");
	})



	$('#candidate_edit_form').submit(function(e) {
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
		formData.append("department", $("#department").val());
		
		formData.append("experience", $("#experience").val());
		formData.append("email", $("#email").val());
		formData.append("user_id", $("#user_id").val());
		formData.append("resume", resume);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: window.urls.candidate.update,
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
						title: 'Updated Successfully',
						showConfirmButton: false,
						timer: 1500
					})
				}
				window.location.href ='{{ route('candidate.list') }}';
			},
			error: function(err) {
				$.each(err.responseJSON.errors, function(key, value) {
					$("#" + key).next().html(value[0]);
					$("#" + key).next().removeClass('d-none');
				});
			},
		});
	});




	$(function() {
        $("#candidate_edit_form").validate({
            rules: {
                name: {
                       required: true,
                        maxlength: 50,
                    },
                    mobileno: {
                       required: true,
                        maxlength: 10,
                       
                    },

                },
                messages: {
                    name: {
                        required: "Please enter valid name",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },
                    mobileno: {
                        required: "Please enter valid  mobile numnber",
                       
                        maxlength: "The email name should less than or equal to 10 characters",
                    },

                },
            })

        });


		var searchRequest = null;

$(function () {
    $("#sample_search").keyup(function () {
        var that = this,
        value = $(this).val();

    
            if (searchRequest != null) 
                searchRequest.abort();
                 searchRequest = $.ajax({
                type: "GET",
                url:  window.urls.candidate.search,
                data: {
                    'search_keyword' : value
                },
                dataType: "text",
                success: function(msg){
                    console.log(msg);
					$('tbody').html(msg);
                }
            });
        
    });
});



function delete_candidate(id) {

Swal.fire({
	title: 'Are you sure?',
	text: "You won't be able to revert this!",
	icon: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Yes, delete it!'
}).then((result) => {
	if (result.isConfirmed) {

		$("#id").val(id);
		$.ajax({
			url: window.urls.candidate.delete,
			method: "POST",
			data: {
				id: id
			},
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
			},
			success: function(data) {
				console.log(data.status);

				if (data.status == 'success') {
					Swal.fire(
						'Deleted!',
						'Your file has been deleted.',
						'success'
					)
					setTimeout(function() {
						location.reload(true);
					}, 1000);
				} else {
					Swal.fire(
						'Deleted!',
						'something went wrong.',
						'danger'
					)
				}
			}
		});



	}
})
}



function get_department(id)
{
	var value=id.value;
	$.ajax({
			type: "POST",
			url: window.urls.designation.get,
			data: {value:value},
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				Accept: "application/json",
			},
			success: function(response) {
				console.log(response);
				$('#designation').html(response)
				
			},
		
		});

}


$(function() { 
  var value= $('#department').val();
  var user=$('#user_id').val();
  
   $.ajax({
			type: "POST",
			url: window.urls.designation.edit_get,
			data: {value:value,user:user},
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				Accept: "application/json",
			},
			success: function(response) {
				console.log(response);
				$('#designation').html(response)
				
			},
		
		});
});

$(document).ready(function(){
    $('.copy-btn').on("click", function(){
        value = $(this).data('clipboard-text'); //Upto this I am getting value
 
        var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(value).select();
          document.execCommand("copy");
          $temp.remove();
    })
})
</script>