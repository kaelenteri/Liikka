<?php
namespace Liikka\Entity;
use Liikka\Entity\Tyyppi;

/**
 * Description of Ruoka
 *
 * @author Make
 */
class Ravinto {
    private $id;
    private $nimi;
    /* @var Tyyppi*/
    private $tyyppi;
    private $kalorit; // 100g tai 100ml
    private $merkki; // Esim valio
    private $kommentti;
    
    function __construct($id, $nimi, $tyyppi, $kalorit, $merkki, $kommentti) {
        $this->id = $id;
        $this->nimi = $nimi;
        
        $this->tyyppi = $tyyppi;
        $this->kalorit = $kalorit;
        $this->merkki = $merkki;
        $this->kommentti = $kommentti;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
        return $this;
    }
/**
 * 
 * @return Tyyppi
 */
    public function getTyyppi() {
        return $this->tyyppi;
    }

    public function setTyyppi($tyyppi) {
        $this->tyyppi = $tyyppi;
        return $this;
    }

    public function getKalorit() {
        return $this->kalorit;
    }

    public function setKalorit($kalorit) {
        $this->kalorit = $kalorit;
        return $this;
    }

    public function getMerkki() {
        return $this->merkki;
    }

    public function setMerkki($merkki) {
        $this->merkki = $merkki;
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
