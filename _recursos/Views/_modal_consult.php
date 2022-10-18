<div id="modal-consult" class="modal fade">
    <div class="modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dados da Cobrança</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class=" clearfix"></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">

                        <p>Dados da cobrança</p>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Código cobrança</th>
                                        <th scope="col">Status atual</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Recupero o objeto charge da sessão -->
                                    <?php $charge = session('charge'); ?>

                                    <tr>
                                        <td>
                                            <?php echo $charge->charge_id; ?>
                                        </td>
                                        <td>
                                            <?php echo reason_charge($charge->status); ?>
                                        </td>
                                        <td><?php echo $charge->created_at; ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-md-12">

                        <p>Histórico de eventos</p>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome do Evento</th>
                                        <th scope="col">Data do evento</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($charge->history as $history) : ?>
                                        <tr>
                                            <td>
                                                <?php echo $history['message']; ?>
                                            </td>

                                            <td>
                                                <?php echo date('d-m-Y H:i:s', strtotime($history['created_at'])); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <!-- Só exibiremos o trecho abaixo quando for boleto e estiver aguardando pagamento.
                                                Pois quando é cartão, já aparece no trecho acima as informações relevantes
                                    -->


                    <?php if ($charge->payment_method == 'banking_billet' && $charge->status == 'waiting') : ?>

                        <div class="col-md-12">

                            <p>Dados de pagamento</p>

                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Método</th>
                                            <th scope="col">
                                                Data de vencimento
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td>
                                                Boleto Bancário

                                                <button onclick="window.open('<?php echo $charge->url_pdf; ?>', '_blank');" class="btn btn-primary btn-sm ml-1">
                                                    Imprimir boleto
                                                </button>

                                            </td>

                                            <td>
                                                <?php echo $charge->expire_at; ?>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary btn-small" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>