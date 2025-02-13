<?php
$idsede = (empty($_GET['idsede'])) ? null : $_GET['idsede'] ;
?>
<iframe src="<?php echo RUTA . 'views/productos/ticket.php?idsede='. $idsede; ?>" frameborder="0">
</iframe>