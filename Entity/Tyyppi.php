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


    function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
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
