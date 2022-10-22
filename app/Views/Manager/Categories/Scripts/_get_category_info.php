<script>
    $(document).on('click', '#updateCategoryBtn', function () {
        let id = $(this).data('id');
        
        let url = '<?php echo route_to('categories.get.info'); ?>'; 

        $.get(url,{

            id:id

        }, function (response) {

            $('#categoryModal').modal('show');
            $('.modal-title').text('Atualziar categoria'); //mudaremos depois com lang
            $('#categories-form').attr('action', '<?php echo route_to('categories.update'); ?>');
            $('#categories-form').find('input[name="id"]').val(response.category.id);
            $('#categories-form').find('input[name="name"]').val(response.category.name);
            $('#categories-form').append("<input type='hidden' name='_method' value='PUT'>");
            $('#boxParents').html(response.parents);
            $('#categories-form').find('span.error.text').text('');

        }, 'json');

      });
</script>
