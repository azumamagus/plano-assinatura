<script>
    $(document).on('click', '#createCategoryBtn', function () {

        $('input[name="_method"]').remove();
        
        $('.modal-title').text('Criar categoria'); //mudaremos depois com lang
        $('#categoryModal').modal('show');        
        $('#categories-form')[0].reset();
        $('#categories-form').attr('action', '<?php echo route_to('categories.create'); ?>');
        $('#categories-form').find('span.error.text').text('');
        
        let url = '<?php echo route_to('categories.get.parents'); ?>'; 

        $.get(url, function (response) {

            $('#boxParents').html(response.parents);
            

        }, 'json');

      });
</script>
