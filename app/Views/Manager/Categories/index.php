<?php echo $this->extend('Manager/Layout/main'); ?>

<?php $this->section('title'); ?>
<?php echo $title ?? ''; ?>
<?php $this->endSection(); ?>

<?php $this->section('styles'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>

<?php $this->endSection(); ?>


<?php $this->section('content'); ?>
                <div class="container-fluid pt-3">
                    <h1 class="mt-4"><?php echo $title ?? ''; ?></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                <h5><?php echo $title ?? ''; ?></h5>
                                </div>
                                <div class="card-body">
                                <table class="table table-borderless table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Ações</th>
                                        </tr>
                                    </thead>                                  
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            ajax: '<?php echo route_to('categories.get.all'); ?>',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'slug' },
                { data: 'actions' },                
            ],
        });
    });
</script>

<?php $this->endSection(); ?>
