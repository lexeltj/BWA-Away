<?php 

class away_entry {
    public $entry_id;
    public $user;
    public $grund;
    public $start_date;
    public $end_date;
    public $timestamp_entry;
    public $berechtigung;
    public $eintrag_arr = [];
    
    public function array_entry() {
        $this->eintrag_arr = array($this->user,$this->grund,$this->start_date,$this->end_date,$this->timestamp_entry);
        
    }
    
    public function eintrag_hinzufuegen() {
        global $wpdb;
        global $user_login;
        try {
             $this->array_entry();
            $tabellen_name = $wpdb->prefix.'bwa_away';
            $wpdb->insert($tabellen_name,
                array(
                    'user' => $this->eintrag_arr[0],
                    'text'=> $this->eintrag_arr[1],
                    'start'=> $this->eintrag_arr[2],
                    'end'=> $this->eintrag_arr[3],
                    'stamp'=> $this->eintrag_arr[4]
                    )
                );
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function eintrag_loeschen($entry) {
        global $wpdb;
        echo " eintrag mit id: ".$entry." gelöscht";
        $wpdb->delete($wpdb->prefix.'bwa_away', array('id' => $entry));
    }
    
    public function eintrag_bearbeiten() {
        echo "wird bearbeitet";
    }
    public function eintrag_ausgabe() {
        // wird nicht benötigt. belassen wir bei der funktion!!!
    }
}

?>