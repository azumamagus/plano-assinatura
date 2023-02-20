<script>
    $(document).on('click', '#archiveCategoryBtn', function () {

        let id = $(this).data('id');      
        
        let url = '<?php echo route_to('categories.archive'); ?>'; 

       
        $.post(url,{
            '<?php echo csrf_token(); ?>': $('meta[name="<?php echo csrf_token(); ?>"]').attr('content'),
            _method:'PUT', // Spoofing do request 
            id:id

            }, function (response) {

                window.refreshCSRFToken(response.token);
                
                toastr.success(response.message);
            
                $("#datatable").DataTable().ajax.reload(null, false);

            }, 'json').fail(function(){
                toastr.error('Error backend');
            });

        });
</script>
