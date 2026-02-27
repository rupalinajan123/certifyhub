 <?php if ($this->session->flashdata('success')) {?>
	<div class="alert alert-success" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		 </button>
		 <?php echo $this->session->flashdata('success'); ?>
	</div>
<?php } else if ($this->session->flashdata('error')) {?>
	<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		 </button>
		<?php echo $this->session->flashdata('error');  ?>
	</div>
<?php } else if ($this->session->flashdata('warning')) {?>
	<div class="alert alert-warning" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		 </button>
		<?php echo $this->session->flashdata('warning'); ?>
	
	</div>
<?php } else if ($this->session->flashdata('info')) {?>
	<div class="alert alert-info" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		 </button>
		 <?php echo $this->session->flashdata('info'); ?>
	</div>
<?php }?>

 <?php if (isset($success) && !empty($success)) {?>
	<div class="alert alert-success" role="alert">
		 <?php echo $success; ?>
	</div>
<?php } else if (isset($error) && !empty($error)) {?>
	<div class="alert alert-danger" role="alert">
		<?php echo $error;  ?>
	</div>
<?php } ?>

