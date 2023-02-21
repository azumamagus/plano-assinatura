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

                                <a class="btn btn-primary btn-sm mt-2 mb-4" href="<?php echo route_to('categories'); ?>"><?php echo lang('App.btn_back'); ?></a>

                                <table class="table table-borderless table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo lang('Categories.label_name'); ?></th>
                                        <th scope="col"><?php echo lang('Categories.label_slug'); ?></th>
                                        <th scope="col"><?php echo lang('App.btn_actions'); ?></th>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php echo $this->include('Manager/Categories/Scripts/_datatable_all_archived'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_recover_category'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_delete_category'); ?>

<script>
    function refreshCSRFToken(token)
    {
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
    }
</script>


<?php $this->endSection(); ?>
