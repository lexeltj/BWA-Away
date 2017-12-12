<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//=================================
//== datebankverbindung aufbauen ==
//== und Daten ausgeben          ==
//=================================
function db_connect () {
global $wpdb;
try{
    $abfrage = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bwa_away"); 
    return $abfrage;
    }
  catch (Exception $e){
	  echo "keine db verbindung";
	  echo $e->getMessage();
  }
}

//===================
//== Delete Button ==
//===================
function del_button ($dbut) {
    $serverPfad = $_SERVER['SERVER_NAME'];
    $filePfad = $_SERVER['REQUEST_URI'];
    $gesamtpfad = 'http://'. $serverPfad . $filePfad;

$dbutton = '<form  method="GET"> 
<button type="submit" name="del" value="' . $dbut . '">x</button>
</form>';
return $dbutton; 
}

//=================
//== Edit Button ==
//=================
function edit_button ($ebut) {
    $serverPfad = $_SERVER['SERVER_NAME'];
    $filePfad = $_SERVER['REQUEST_URI'];
    $gesamtpfad = 'http://'. $serverPfad . $filePfad;
    $ebutton = '<form  method="GET">
<button type="submit" name="edit" value="' . $ebut . '">edit</button>
</form>';
    return $ebutton;
}

//======================
//== Tabelle ausgeben ==
//======================
function table_result () {

foreach (db_connect() as $ausgabe) {
$stamp_e = $ausgabe->stamp;
$datum_start = $ausgabe->start;
$datum_start = date('d.m.Y',strtotime($datum_start));
$datum_ende = $ausgabe->end;
$datum_ende = date('d.m.Y',strtotime($datum_ende));
$dbut = $ausgabe->id;

if( current_user_can('administrator')){
    
    echo '<tr><td>' . $ausgabe->user . '</td><td>'. $ausgabe->text . '</td><td>'  .  $datum_start . '</td> <td>' . $datum_ende . '</td> <td>'. edit_button($dbut) .' '. del_button($dbut) .'<br /><FONT SIZE="1">' . date("d.m.Y H:i", $stamp_e) . '</FONT><br/></td></tr>';
    
}else{
    echo '<tr><td>' . $ausgabe->user . '</td><td>'. $ausgabe->text . '</td><td>'  .  $datum_start . '</td> <td>' . $datum_ende . '</td> <td><FONT SIZE="1">' . date("d.m.Y H:i", $stamp_e) . '</FONT><br/></td></tr>';
    }
    }
}

function pruef_edit() {
    if ($_GET['edit']) {
        $wert = 'testtext';
        $eintrag = new away_entry();
        return $eintrag->eintrag_bearbeiten($_GET['edit']);
        //return $wert;
    }
}
?>