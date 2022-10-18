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
					<h3 class="widget-header user">Meu acesso</h3>

					<div class="mb-4">

						<a href="<?php echo route_to('profile'); ?>" class="btn btn-primary btn btn-main-sm bg-info border-info mb-2">Meus dados</a>

					</div>

					<?php echo form_open(route_to('access.update'), hidden: $hiddens); ?>

					<div class="row">

						<div class="mb-3 col-md-12">
							<label>Senha atual</label>
							<input type="password" name="current_password" class="form-control">
						</div>

						<div class="mb-3 col-md-12">
							<label>Nova senha</label>
							<input type="password" name="password" class="form-control">
						</div>

						<div class="mb-3 col-md-12">
							<label>Confirme a nova senha</label>
							<input type="password" name="password_confirmation" class="form-control">
						</div>

					</div>

					<button type="submit" class="btn btn-success btn-sm"><?php echo lang('App.btn_save'); ?></button>

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