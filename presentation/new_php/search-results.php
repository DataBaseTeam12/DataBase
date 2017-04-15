<?php
include 'php/connect-begin.php';

  $set = $pdo->query('SELECT DISTINCT title FROM media
                      JOIN book ON media.id=book.book_id
                      WHERE media.id=book.book_id;'
  );
  $cycle = 0;
  while($row = $set->fetch(PDO::FETCH_NUM))
  {
    echo '<div class="item">';
    foreach ($row as $key => $value)
    {
      echo $value;
    }
    echo '</div>';
  }

include 'php/connect-end.php';
?>
