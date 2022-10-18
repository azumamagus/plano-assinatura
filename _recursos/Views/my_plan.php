<?php echo $this->extend('Dashboard/Layout/main'); ?>

<?php echo $this->section('title'); ?> <?php echo $title ?? ''; ?> <?php $this->endSection(); ?>


<?php echo $this->section('styles'); ?>



<?php echo $this->endSection(); ?>



<?php echo $this->section('content'); ?>


<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">


            <?php echo $this->include('Dashboard/Layout/_sidebar'); ?>


            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">

                    <h3 class="widget-header"><?php echo $title ?? 'Meu Plano'; ?></h3>

                    <div class="row">

                        <?php if (is_null($subscription)) : ?>


                            <div class="col-lg-12">

                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="text-center">

                                            <h4 class="mt-3 mb-4"><?php echo auth()->user()->name ?? auth()->user()->username;  ?>, você ainda não tem um Plano :(</h4>
                                            
                                            <?php echo anchor(route_to('pricing'), 'Bora escolher um bem lindão!', ['class' => 'btn btn-success btn-lg mx-auto']); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php else : ?>


                            <div class="col-md-12">


                                <?php if (!$subscription->is_paid) : ?>

                                    <div class="alert alert-warning">
                                        <h4 class="alert-heading">Importante!</h4>
                                        <p>Assim que identificarmos o pagamento do seu plano você poderá desfrutar de todos os recursos que ele
                                            oferece.</p>
                                        <hr>
                                        <p class="mb-0">

                                            <?php echo anchor(route_to('detail.charge', $subscription->charge_not_paid), 'Quero ver se foi paga', ['class' => 'btn btn-sm btn-primary btn-gn']); ?>

                                        </p>
                                    </div>

                                <?php endif; ?>


                                <div class="card shadow">

                                    <div class="card-header">
                                        <h4 class="card-title"><?php echo $title ?? ''; ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <div class="default-tab">
                                            <ul class="nav nav-tabs mb-4" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Detalhes da
                                                        Assinatura</a>
                                                </li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Detalhes do
                                                        Plano</a>
                                                </li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Histórico de
                                                        Cobranças</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                                    <div class="p-t-15">

                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#modal-cancel">
                                                                    Cancelar assinatura
                                                                </button>
                                                            </div>
                                                        </div>


                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Assinatura</th>
                                                                        <th scope="col">Valor</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Próxima cobrança</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <?php echo $subscription->subscription_id; ?>
                                                                        </th>
                                                                        <td><?php echo $subscription->features->value_details; ?>
                                                                        </td>
                                                                        <td><?php echo $subscription->status; ?></td>
                                                                        <td><?php echo date('d-m-Y', strtotime($subscription->history['next_execution'])); ?>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="tab-pane fade" id="profile">
                                                    <div class="p-t-15">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Plano</th>
                                                                        <th scope="col">Cadastro de Anúncios</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $subscription->plan_id . ' - ' . $subscription->features->plan_name; ?></th>

                                                                        <td>
                                                                            <?php echo $subscription->features->adverts ?? 'Ilimitado'; ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="contact">
                                                    <div class="p-t-15">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Código cobrança</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Data</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($subscription->history['history'] as $history) : ?>
                                                                        <tr>
                                                                            <th scope="row"><?php echo $history['charge_id']; ?></th>

                                                                            <td>

                                                                                <?php echo reason_charge($history['status']); ?>

                                                                                <?php if ($history['status'] == 'waiting' || $history['status'] == 'unpaid') : ?>

                                                                                    <?php echo anchor(route_to('detail.charge', $history['charge_id']), 'Quero ver se foi paga', ['class' => 'btn btn-sm btn-primary btn-gn']); ?>

                                                                                <?php endif; ?>

                                                                            </td>
                                                                            <td><?php echo date('d-m-Y H:i:s', strtotime($history['created_at'])); ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="modal-cancel" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirmação</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold text-black">Sério mesmo que quer cancelar a sua assinatua atual, <?php echo auth()->user()->name ?? auth()->user()->username;  ?>?</p>

                                                <p>O cancelamento de uma Assinatura é realizado de forma imediata e automática. No entanto, é importante lembrar que somente é válido para os futuros lançamentos. Os débitos já realizados permanecem inalterados.</p>

                                                <p class="text-warning">Esta ação não poderá ser revertida.</p>
                                            </div>
                                            <div class="modal-footer">

                                                <?php echo form_open(route_to('dashboard.cancel.subscription'), hidden: $hiddens); ?>

                                                <button type="submit" class="btn btn-sm btn-danger btn-gn">Sim, mete bronca</button>

                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Não, não vou mais...</button>

                                                <?php echo form_close(); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php if (session()->has('charge')) : ?>

                                    <?php echo $this->include('Dashboard/Home/_modal_consult'); ?>

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                    </div>




                </div>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>



<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>

<script>
    $(document).ready(function() {

        /**
         * o flashdata 'charge' foi definido no método detailCharge do controller Dashbord.
         * Se temos o 'charge', então fazemos o include do modal
         */
        <?php if (session()->has('charge')) : ?>

            $('#modal-consult').modal('show');

        <?php endif; ?>

    });
</script>


<?php echo $this->endSection(); ?>