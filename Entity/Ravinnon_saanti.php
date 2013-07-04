<?php

namespace Liikka\Entity;

use Liikka\Entity\Ravinto;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ravinnon_saanti
 *
 * @author Make
 */
class Ravinnon_saanti {

    /**
     *
     * @var int $id 
     */
    private $id;
    private $kayttajanimi;
    private $pvm;

    /**
     *
     * @var Ravinto $ravinto
     */
    private $ravinto;

    /**
     *
     * @var int $maara
     */
    private $maara;
    private $kommentti;

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getKayttajanimi() {
        return $this->kayttajanimi;
    }

    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
        return $this;
    }

    public function getPvm() {
        return $this->pvm;
    }

    public function setPvm($pvm) {
        $this->pvm = $pvm;
        return $this;
    }

    /**
     * @return Ravinto */
    public function getRavinto() {
        return $this->ravinto;
    }

    public function setRavinto($ravinto) {
        $this->ravinto = $ravinto;
        return $this;
    }
/**
 * 
 * @return int
 */
    public function getMaara() {
        $m = $this->maara;
        return intval($m);
    }

    public function setMaara($maara) {
        $this->maara = $maara;
        return $this;
    }

    public function getKommentti() {
        return $this->kommentti;
    }

    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }

    /**
     * 
     * @param int $id
     * @param string $kayttajanimi
     * @param string $pvm
     * @param Ravinto $ravinto
     * @param int $maara
     * @param string $kommentti
     */
    function __construct($id, $kayttajanimi, $pvm, $ravinto, $maara, $kommentti) {
        $this->id = $id;
        $this->kayttajanimi = $kayttajanimi;
        $this->pvm = $pvm;
        $this->ravinto = $ravinto;
        $this->maara = $maara;
        $this->kommentti = $kommentti;
    }

}

?>
