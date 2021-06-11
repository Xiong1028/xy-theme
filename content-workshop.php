<h1>2020 Virtual International Conference on Residency Education - La Conférence internationale sur la formation des résidents virtuelle 2020</h1>
<h2><?php echo $args['workshop_date']; ?></h2>
<table>
  <thead>
    <tr>
      <th>Time</th>
      <th>Program</th>
      <th>Track</th>
      <th>Learn Level</th>
      <th>Language of Presentation</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($args['workshop_table'] as $workshop_row) :
    ?>
      <tr>
        <td><?php echo $workshop_row['time'] ?></td>
        <td><a href="<?php echo get_permalink($workshop_row['session_post_id']); ?>"><?php echo $workshop_row['program']; ?></a></td>
        <td><?php echo $workshop_row['track'] ?></td>
        <td><?php echo $workshop_row['learnerlevel'] ?></td>
        <td><?php echo $workshop_row['language'] ?></td>
      </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
