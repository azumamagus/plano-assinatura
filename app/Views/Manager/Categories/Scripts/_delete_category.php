<script>
    $(document).on('click', '#deleteCategoryBtn', function () {

        let id = $(this).data('id');      
        
        let url = '<?php echo route_to('categories.delete'); ?>'; 

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
                
            $.post(url,{
                '<?php echo csrf_token(); ?>': $('meta[name="<?php echo csrf_token(); ?>"]').attr('content'),
                _method:'DELETE', // Spoofing do request 
                id:id

                }, function (response) {

                    window.refreshCSRFToken(response.token);
                    
                    toastr.success(response.message);
                
                    $("#datatable").DataTable().ajax.reload(null, false);

                }, 'json').fail(function(){
                    toastr.error('Error backend');
                });

                // Swal.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // )
            }
        })

        

        });
</script>
