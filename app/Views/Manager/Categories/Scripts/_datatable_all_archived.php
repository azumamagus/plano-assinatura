<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            "order":[],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            "language":{
                processing: '<i class="fa fa-spinner fa-3x fa-fw"></i>',
            },
            ajax: '<?php echo route_to('categories.get.all.archived'); ?>',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'slug' },
                { data: 'actions' },                
            ],
        });
    });
</script>
