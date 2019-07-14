@if(session()->has('flash_message'))
		<script type="text/javascript">
      setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000,
						"positionClass": "toast-bottom-right",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
        };
        toastr.{{ session('flash_message.level') }}("{{ session('flash_message.message')}}", "{{ session('flash_message.title')}}");
      }, 1300);
  	</script>
@endif

@if(session()->has('flash_message_overlay'))
	<script type="text/javascript">
      swal({
        title: "{{ session('flash_message_overlay.title')}}",
        text: "{{session('flash_message_overlay.message')}}",
        type: "{{session('flash_message_overlay.level')}}",
        timer: 1500,
        showConfirmButton: false
      });
      location.reload();
  	</script>
@endif
