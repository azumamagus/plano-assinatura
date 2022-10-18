<?php echo $this->extend('Dashboard/Layout/main'); ?>

<?php echo $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>


<?php echo $this->section('styles') ?>


<?= $this->endSection() ?>


<?php echo $this->section('content') ?>


<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">


            <?php echo $this->include('Dashboard/Layout/_sidebar'); ?>


            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Edit Personal Info -->
                <div class="widget personal-info">
                    <h3 class="widget-header user">Confirmação de exclusão da conta</h3>

                    <?php echo form_open(route_to('account.delete'), hidden: $hiddens); ?>

                    <div class="row">

                        <div class="mb-3 col-md-12">
                            <div class="alert alert-danger">
                                Todos os seus anúncios serão removidos para sempre e a sua assinatura atual será cancelada, caso você a possua.<br><br>
                                Tenha em mente que esta ação não poderá ser revertida.<br><br>
                                Podemos prosseguir com a exclusão?
                            </div>
                        </div>

                    </div>

                    <!-- Colocamos a classe 'btn-gn' pois requisitaremos a gerencianet -->
                    <button type="submit" class="btn-gn btn btn-danger btn-sm"><?php echo lang('App.btn_confirmed_delete'); ?></button>

                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>



<?= $this->endSection() ?>


<?php echo $this->section('scripts') ?>



<?= $this->endSection() ?>