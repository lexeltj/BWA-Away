<?php
// del button
include_once('func.php');
echo header1();

if ( !$_GET['del']) {
echo "erster aufruf";
}else {
echo "hier löschen";
$db_id = $_GET['del'];
eintrag_loeschen($db_id);
}


echo 'eintrag gelöscht<br/>
<form action="index.php" method="POST">
<input type="submit" value="zurück" />
</form>';
echo fooder();
?>