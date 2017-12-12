<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

include_once('bwa-away_func.php');
include_once('bwa-away_class.php');
 
/*
 
Plugin Name: BWA Away
Description: Abmeldescript fuer Bundeswehr Armaclan
Author: Torsten John
Version: 0.3
Author URI: http://www.webdel.de
 
*/
 function bwa_awaycal() {
     $serverPfad = $_SERVER['SERVER_NAME'];
     //echo $serverPfad = $_SERVER['DOCUMENT_ROOT'];
     $filePfad = $_SERVER['REQUEST_URI'];
      $gesamtpfad = 'http://'. $serverPfad . $filePfad;
     //echo $gesamtpfad;
	 global $user_login; 
	 global $wpdb;
	 
	 //-----------------
	 
	 if ( !$_GET['del']) {
	     //echo "erster aufruf";
	 }else {
	     //echo "hier löschen";
	     //$db_id = $_GET['del'];
	     //eintrag_loeschen($db_id);
	     $away = new away_entry();
	     $away->eintrag_loeschen($_GET['del']);
	 }
	 
	 //-----------------
	 if (!$_GET['edit']) {
	     
	 }else {
	     $db_id = $_GET['edit'];
	     echo 'hallo ' . $db_id;
	 }
	 // -----------
	 
	 echo "Hallo " . $user_login . "<br/><br/>";
	 if( current_user_can('administrator')){
	     echo "du bist administrator";
	 }else {
	     //echo "du bist kein administrator";
	 }
	 
	  $user = wp_get_current_user();
    if ( $user->exists() ) {
       // do something
  
	 
if ( !$_POST['grund'] || !$_POST['datum1'] || !$_POST['datum2']) {

//echo "eingaben unvollständig";
}else {
echo "Eintrag hinzugefügt";

//--------start class eintrag hinzufügen ---------

$away = new away_entry();

$away->user = $user_login;
$away->grund = $_POST['grund'];
$away->start_date = $_POST['datum1'];
$away->end_date = $_POST['datum2'];
$away->timestamp_entry = '"'.time().'"';
$away->eintrag_hinzufuegen();

//-------- end class eintrag hinzufügen ----------
}
 // prüfe ob editirt wird
pruef_edit();
	 
	 // formular
	 
	 echo "<h3>Trage hier ein, wenn du nicht an den Terminen teilnehmen kannst</h3><br/><br/>";
	 echo '<form method="POST" id="abmeldung">
<!--<label for="user">
Benutzername
<input type="text" id="user" name="user">
</label>
<br/>-->
<label for="grund">
Grund<br />
<textarea rows="4" cols="50" name="grund" form="abmeldung" id="grund" required>'.$away->grund.'</textarea>
<!--<input type="text" id="grund" name="grund">-->
</label>
<br/>
<label for="datum1">
von<br />
<input type="date" id="datum1" name="datum1" value="tt.mm.jjjj">
</label>

<br/>

<label for="datum2">
bis<br />
<input type="date" id="datum2" name="datum2" value="tt.mm.jjjj">
</label>
<br/>
<input type="submit" />

</form>
';

  } else {
	  echo "<br />Logge dich ein um eine Abmeldung zu verfassen!";
  }
  

//beginn tabelle
echo "<table border=1px>
<thead>
		<tr>
			<th>Name</th>
			<th>Grund</th>
			<th>von</th>
			<th>bis</th>
			<th>eingetragen</th>
		</tr>
	</thead>";
//datenbank abfragen und ergbnis ausgeben
table_result();

//tabelle schliesen
echo "</table>"; 
	 



 }
 
 
add_shortcode("bwa-away", "bwa_awaycal");
 ?>