<?php echo $this->extend('Dashboard/Layout/main'); ?>

<?php echo $this->section('title') ?>

<?php echo lang('Adverts.text_edit_questions'); ?>

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
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">

                    <h3 class="widget-header"><?php echo lang('Adverts.text_edit_questions',  ['title' => $advert->title]); ?></h3>

                    <div class="row">
                        <div class="col-lg-12">

                            <h4 class="tab-title mt-4">Últimas perguntas realizadas</h4>

                            <?php if (!empty($advert->questions)) : ?>

                                <ul class="list-inline mt-20">

                                    <?php foreach ($advert->questions as $question) : ?>


                                        <li class="list-inline-item d-inline">

                                            <?php echo $question->question; ?> - <small> <?php echo date('d/m/Y', strtotime($question->created_at)); ?></small>

                                            <?php if (!is_null($question->answer)) : ?>

                                                <p class="text-primary pl-3"><?php echo $question->answer; ?> - <small> <?php echo date('d/m/Y', strtotime($question->updated_at)); ?></small></p>

                                            <?php else : ?>

                                                <!-- Vamos desabilitar o botão de submit para evitar duplo click -->
                                                <?php echo form_open(route_to('adverts.my.answer.questions',  $question->id), ['id' => 'form-answer'], $hiddens); ?>

                                                <?php echo form_hidden('question_owner', $question->user_question_id); ?>

                                                <div class="form-row">

                                                    <div class="col-lg-8">
                                                        <input type="text" style="height: 36.5px" name="answer" value="<?php echo old('answer'); ?>" required class="form-control mb-2" id="inlineFormInput" placeholder="Escreva sua resposta...">
                                                    </div>


                                                    <div class="col-4">
                                                        <input type="submit" style="cursor: pointer;" value="Responder" class="btn btn-outline-primary btn-block btn-sm mb-2" />
                                                    </div>

                                                </div>

                                                <?php echo form_close(); ?>

                                            <?php endif; ?>
                                        </li>



                                    <?php endforeach; ?>

                                </ul>

                            <?php endif; ?>


                        </div>
                        <!-- end col -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>

<?= $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<script>
    $("#form-answer").submit(function() {

        $(this).find(":submit").val('Por favor aguarde...').attr('disabled', 'disabled');

    });
</script>

<?= $this->endSection() ?>