<?php $this->load->view('Admin/Template/header') ?>

<?php $this->load->view('Admin/Template/nav', $nav) ?>
<main>
	<?php $this->load->view($view_name, $view_data) ?>
<main>
<?php $this->load->view('Admin/Template/footer') ?>