<?php 
    if($this->session->flashdata('msg')){
?>
<div class="alert alert-success">
    <?= $this->session->flashdata('msg') ?>
</div>
<?php } ?>