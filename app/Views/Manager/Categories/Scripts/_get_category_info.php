<script>
    $(document).on('click', '#updateCategoryBtn', function () {
        let id = $(this).data('id');
        
        let url = '<?php echo route_to('categories.get.info'); ?>'; 

        $.get(url,{

            id:id

        }, function (response) {

            $('#categoryModal').modal('show');

        }, 'json');

      });
</script>
