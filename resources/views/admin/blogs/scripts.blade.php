<script>
	$(document).ready(function() { 
		var grid = new Datatable();

		grid.init({
			src: $("#listartikel"),
			onSuccess: function (grid) {
				
			},
			onError: function (grid) {
				  
			},
			loadingMessage: 'Loading...',
			dataTable: {
				"lengthMenu": [
					[10, 20, 50, 100, 150],
					[10, 20, 50, 100, 150]  
				],
				"pageLength": 10, 
				"ajax": {
				  "url": "{{ url('haloadmin/articles') }}",
				  "data": {
					  "_token":"{{ csrf_token() }}"
					}
				 },
				"order": [
					[1, "asc"]
				] 
			}  
		});
	});

	function hapusid(id) {
        swal({
            title: "Are you sure?",
            text: "You will be delete this item ?",
            type: "warning",
            confirmButtonText: "Yes, delete",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url('haloadmin/articles') }}",
                    type: "POST",
                    data:{
						'id':id,
						'_method':'DELETE',
						'_token': '{{ csrf_token() }}'
					},
                    success: function(){
                        swal(
                            'Success',
                            'Destroy Data <b style="color:green;">Success</b> button!',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        swal({
                            title: 'Opps...',
                            text: 'Error',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your stay here :)',
                    'error'
                )
            }
        })
       
    }
	
</script>