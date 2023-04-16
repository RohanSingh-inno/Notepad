<?php
$title = $GLOBALS['data']['title'];
$body = substr($GLOBALS['data']['NoteBody'], 0, 100);
$currDate = $GLOBALS['data']['currentDate'];
$numberOfNotes = $GLOBALS['data']['numberOfNotes'];
?>
<a href='/dashboardController/notePage/<?php echo $numberOfNotes;?>'>
  <div class='sec'>
    <h2>
      <?php
      echo $title;
      ?>
    </h2>
    <h3>
      <?php echo $currDate; ?>
    </h3>
    <p>
      <?php echo $body; ?>
    </p>
</a>
</div>
<div class='flex loadMore'>
  <button class='ajaxbtn' data-id='<?php echo $numberOfNotes ?>'>Load more</button>
</div>