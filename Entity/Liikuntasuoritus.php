<?php
namespace Liikka\Entity;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Liikuntasuoritus
 *
 * @author Make
 */
class Liikuntasuoritus {
    private $ID;
    private $laji;
    private $kommentti;
    private $kesto;
    private $pvm;
    
    
    public function getPvm() {
        return $this->pvm;
    }

    public function setPvm($pvm) {
        $this->pvm = $pvm;
        return $this;
    }

        
    
    public function getKesto() {
        return $this->kesto;
    }

    public function setKesto($kesto) {
        $this->kesto = $kesto;
        return $this;
    }

        
    
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
        return $this;
    }

    public function getLaji() {
        return $this->laji;
    }

    public function setLaji($laji) {
        $this->laji = $laji;
        return $this;
    }

    public function getKommentti() {
        return $this->kommentti;
    }

    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }


}

?>
