<?php
namespace Liikka\Entity;
/**
 * Description of Tyyppi
 * Joko ruoka tai juoma
 *
 * @author Make
 */
class Tyyppi {

    private $id;
    private $nimi;
    private $mittayksikko;
    private $gr_ml;
    
    public function getMittayksikko() {
        return $this->mittayksikko;
    }

    public function setMittayksikko($mittayksikko) {
        $this->mittayksikko = $mittayksikko;
        return $this;
    }

    public function getGr_ml() {
        return $this->gr_ml;
    }

    public function setGr_ml($gr_ml) {
        $this->gr_ml = $gr_ml;
        return $this;
    }

    

    function __construct($id, $nimi, $mittayksikko, $gr_ml) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->mittayksikko = $mittayksikko;
        $this->gr_ml = $gr_ml;
    }
    
    public function __toString() {
        return $this->getNimi();
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
}

?>
