<?php foreach($this->data as $item) { ?>
  <?php foreach($item as $key => $value) { ?>
    <h3><?php echo $key ?>: <?php echo $value ?></h3>
  <?php } ?>
<?php } ?>