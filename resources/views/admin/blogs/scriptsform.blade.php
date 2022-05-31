<script type="text/javascript" src="{{ asset('public/vendor/ckeditor/ckeditor.js') }}"></script>
<script>
	$("#judul_blog").keyup(function(){
		var str 	= $(this).val();
		var trims 	= $.trim(str);
		var slug 	= trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
		
		$("#slug").val(slug.toLowerCase())
	})
	$(document).ready(function() { 			
		var form = $('#formartikel');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);
		
		form.validate({
			doNotHideMessage: true, 
			errorElement: 'span', 
			errorClass: 'help-block help-block-error', 
			focusInvalid: false, 
			rules:{
				judul_blog: {
					required: true,
				},
				kategori: {
					required: true,
				},
				status: {
					required: true,
					number:true
				}
			},
			
			errorPlacement: function (error, element) { 
				if (element.attr("data-error-container")) { 
					error.appendTo(element.attr("data-error-container"));
				}else {
					error.insertAfter(element); 
				}
			},
			
			invalidHandler: function (event, validator) {    
					success.hide();
					error.show();
					Metronic.scrollTo(error, -200);
				},

			highlight: function (element) { 
				$(element)
					.closest('.form-group').removeClass('has-success').addClass('has-error'); 
			},

			unhighlight: function (element) { 
				$(element)
					.closest('.form-group').removeClass('has-error'); 
			},
			
			success: function (label) {
				label
					.addClass('valid') 
					.closest('.form-group').removeClass('has-error').addClass('has-success'); 
			},
			submitHandler: function (form) {
				success.show();
				error.hide();
				form.submit(); 
			},
		});
		$('.select2me',form).change(function () {
			form.validate().element($(this)); 
		});

		$("#select2_tags").change(function() {
			form.validate().element($(this));  
		}).select2({
			tags: ["red", "green", "blue", "yellow", "pink"]
		});
		
	});
	
	var url = "{{ url('/public/ckfinder/ckfinder.html') }}";
	CKEDITOR.replace('editor-ckeditor',{
		filebrowserBrowseUrl: url,
		filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
	});
</script>