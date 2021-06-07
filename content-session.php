<h1>2020 Virtual International Conference on Residency Education - La Conférence internationale sur la formation des résidents virtuelle 2020</h1>
<strong><em><?php echo $args['workshop_date']; ?></em></strong>

<h2><strong><?php echo $args['program']; ?></strong></h2>

<p>
  <span>Program track:</span> <?php echo $args['track']; ?> <br />
  <span>Learn Level:</span> <?php echo $args['learnerlevel']; ?>
</p>

<p>
  <?php echo $args['time']; ?> <br />
  ( <?php echo $args['room'], ', ',  $args['building'] ?> )
</p>

<p>
  <span>Language of presentation: </span> <?php echo $args['language']; ?>
</p>

<?php
$session_detail_arr = json_decode($args['sessdetailslist']);
if (count($session_detail_arr) !== 0) :
  foreach ($session_detail_arr as $sessdetail) :
?>
    <div>
      <?php echo $sessdetail->SESSDETAIL; ?> </div>
<?php
  endforeach;
endif;
?>


<div>
  <?php echo $args['sessionnote']; ?>
</div>

<p>
  <em>Last update:</em> <?php echo $args['changedon']; ?>
</p>
