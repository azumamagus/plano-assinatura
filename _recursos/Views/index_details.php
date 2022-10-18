<?php echo $this->extend('Web/Layout/advert'); ?>

<?php echo $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>


<?php echo $this->section('styles') ?>

<style>
    /* mudar a cor do indicadores do carrosel .carousel-indicators */
    .carousel-control-next,
    .carousel-control-prev {
        filter: invert(100%);
    }
</style>


<?= $this->endSection() ?>


<?php echo $this->section('content') ?>

<section class="section bg-gray">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <!-- Left sidebar -->
            <div class="col-md-8">
                <div class="product-details">
                    <h1 class="product-title"><?php echo $advert->title; ?></h1>
                    <div class="product-meta">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-user-o"></i> Por <a href="<?php echo route_to('adverts.user', $advert->username); ?>"><?php echo $advert->name ?? $advert->username; ?></a></li>
                            <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Categoria<a href="<?php echo route_to('adverts.category', $advert->category_slug); ?>"><?php echo $advert->category; ?></a></li>
                            <li class="list-inline-item"><i class="fa fa-location-arrow"></i> Onde <a title="Ver anúncios na Cidade de <?php echo $advert->city; ?>" href="<?php echo route_to('adverts.category.city', $advert->category_slug, $advert->city_slug); ?>"><?php echo $advert->address(); ?></a></li>
                        </ul>
                    </div>

                    <?php if (empty($advert->images)) : ?>


                        <div class="alert alert-info mt-4 mb-4">Esse anúncio não possui imagens</div>


                    <?php else : ?>

                        <div id="carouselExampleIndicators" class="product-slider carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">

                                <?php foreach ($advert->images as $key => $image) : ?>

                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>" class="<?php echo $key === 0 ? 'active' : ''; ?>"></li>

                                <?php endforeach; ?>

                            </ol>


                            <div class="carousel-inner">

                                <?php foreach ($advert->images as $key => $image) : ?>

                                    <div class="carousel-item text-center <?php echo $key === 0 ? 'active' : ''; ?>">
                                        <img class="img-fluid" src="<?php echo route_to('web.image', $image->image, 'regular'); ?>" alt="First slide">
                                    </div>

                                <?php endforeach; ?>

                            </div>



                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>



                    <?php endif ?>



                    <div class="content">

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h3 class="tab-title">Descrição</h3>
                                <p><?php echo $advert->description; ?></p>
                            </div>
                        </div>

                    </div>


                    <?php if (!empty($moreAdverts)) : ?>

                        <div class="content">

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <h4 class="tab-title">Achamos que você vai gostar desses anúncios...</h4>

                                    <div class="row">

                                        <?php foreach ($moreAdverts as $key => $advertMore) : ?>

                                            
                                            <div class="col-6 col-md-3 pl-1 pr-1 mb-2">


                                                <div class="card h-100">

                                                    <div class="thumb-content mx-auto d-block">

                                                        <a href="<?php echo route_to('advert.details', $advertMore->code) ?>">

                                                            <?php echo $advertMore->image(classImage: 'card-img-top', sizeImage: 'small'); ?>

                                                        </a>

                                                    </div>


                                                    <div class="card-body">

                                                        <p class="card-title">
                                                            <a href="<?php echo route_to('advert.details', $advertMore->code) ?>">
                                                                <?php echo word_limiter($advertMore->title, 5); ?>
                                                            </a>
                                                        </p>

                                                        <p class="card-text text-primary"><strong><?php echo $advertMore->price(); ?></strong></p>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                </div>

                            </div>


                        </div>

                    <?php endif; ?>

                    <div class="content">

                        <div class="tab-content" id="questions-and-answers">
                            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h3 class="tab-title">Perguntas e respostas</h3>

                                <!-- Vamos desabilitar o botão de submit para evitar duplo click -->
                                <?php echo form_open(route_to('details.toask', $advert->code), ['id' => 'form-ask']); ?>

                                <div class="form-row align-items-center">

                                    <div class="col-8">
                                        <label class="sr-only" for="inlineFormInput">Name</label>

                                        <!-- 
                                                Se tem na sessão a chave 'ask', significa que não estava logado quando da primeira pergunta. 
                                                Essa chave 'ask' foi definido no filtro AuthFilter, pois uma pergunta só pode ser feita se o user estiver logado
                                            -->
                                        <input type="text" style="height: 54.5px" name="ask" value="<?php echo session('ask') ?? old('ask'); ?>" required class="form-control mb-2" id="inlineFormInput" placeholder="Escreva sua pergunta...">
                                    </div>


                                    <div class="col-4">
                                        <input type="submit" style="cursor: pointer;" value="Perguntar" class="btn btn-primary btn-block mb-2" />
                                    </div>

                                </div>

                                <?php echo form_close(); ?>


                                <h4 class="tab-title mt-4">Últimas perguntas realizadas</h4>

                                <?php if (!empty($advert->questions)) : ?>


                                    <ul class="list-inline mt-20">

                                        <?php foreach ($advert->questions as $question) : ?>

                                            <p>
                                                <li class="list-inline-item">
                                                    <?php echo $question->question; ?><small> <?php echo date('d/m/Y', strtotime($question->created_at)); ?></small>

                                                    <?php if (!is_null($question->answer)) : ?>

                                                        <p class="text-primary pl-3"><?php echo $question->answer; ?> - <small> <?php echo date('d/m/Y', strtotime($question->updated_at)); ?></small></p>

                                                    <?php endif; ?>
                                                </li>

                                            </p>

                                        <?php endforeach; ?>

                                    </ul>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="widget price text-center">
                        <h4>Preço</h4>
                        <p><?php echo $advert->price(); ?></p>
                        <p><?php echo $advert->situation(); ?></p>
                    </div>
                    <!-- User Profile widget -->
                    <div class="widget user">
                        <h4><a href="<?php echo route_to('adverts.user', $advert->username); ?>"><?php echo $advert->name ?? $advert->username; ?></a></h4>
                        <p class="member-time">Desde <?php echo $advert->user_since->humanize(); ?></p>

                        <ul class="list-inline mt-20">

                            <?php if ($advert->displayPhone()) : ?>

                                <li class="list-inline-item mb-4">
                                    <span class="btn btn-outline-secondary btn-offer"><?php echo $advert->phone; ?></span>
                                </li>

                            <?php endif; ?>

                            <li class="list-inline-item"><a href="<?php echo route_to('adverts.user', $advert->username); ?>" class="btn btn-outline-primary btn-offer">Anúncios de <?php echo $advert->name ?? $advert->username; ?></a></li>

                        </ul>
                    </div>
                    <!-- Coupon Widget -->
                    <div class="widget coupon text-center">
                        <!-- Coupon description -->
                        <p>Tem algum item para anunciar?
                        </p>
                        <!-- Submii button -->
                        <a href="<?php echo route_to('dashboard'); ?>" class="btn btn-transparent-white">Criar anúncio</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Container End -->
</section>

<?= $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<script>
    $("#form-ask").submit(function() {

        $(this).find(":submit").val('Por favor aguarde...').attr('disabled', 'disabled');

    });
</script>


<?php if (session('info_ask')) : ?>


    <script>
        toastr.info('<?php echo session('info_ask'); ?>');
    </script>


<?php endif; ?>


<?php if (session('success_ask')) : ?>


    <script>
        toastr.success('<?php echo session('success_ask'); ?>');
    </script>


<?php endif; ?>



<?= $this->endSection() ?>