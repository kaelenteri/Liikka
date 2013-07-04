<?php
namespace Liikka\Entity;


/**
 * Description of Laji
 *
 * @author Make
 */
class Laji {
    private $ID;
    private $nimi;
    private $kulutus;
    private $kommentti;
    
    
    function __construct($ID, $nimi, $kulutus, $kommentti) {
        $this->ID = $ID;
        $this->nimi = $nimi;
        $this->kulutus = $kulutus;
        $this->kommentti = $kommentti;
    }

    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
        return $this;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
        return $this;
    }

    public function getKulutus() {
        return $this->kulutus;
    }

    public function setKulutus($kulutus) {
        $this->kulutus = $kulutus;
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

