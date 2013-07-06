<?php

namespace Liikka\Entity;

use Liikka\Entity\Kayttaja;
use Liikka\Entity\Laji;

include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Kayttaja.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Laji.php";

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

    /**
     *
     * @var int 
     */
    private $id;

    /**
     *
     * @var Kayttaja 
     */
    private $kayttaja;

    /**
     *
     * @var Laji 
     */
    private $laji;

    /**
     *
     * @var int 
     */
    private $kesto;

    /**
     *
     * @var string 
     */
    private $pvm;

    /**
     *
     * @var string 
     */
    private $kommentti;
    function __construct($id, Kayttaja $kayttaja, Laji $laji, $kesto, $pvm, $kommentti) {
        $this->id = $id;
        $this->kayttaja = $kayttaja;
        $this->laji = $laji;
        $this->kesto = $kesto;
        $this->pvm = $pvm;
        $this->kommentti = $kommentti;
    }

    /**
     * 
     * @return string
     */
    public function getPvm() {
        return $this->pvm;
    }

    /**
     * 
     * @param string $pvm
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setPvm($pvm) {
        $this->pvm = $pvm;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getKesto() {
        return $this->kesto;
    }

    /**
     * 
     * @param int $kesto
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setKesto($kesto) {
        $this->kesto = $kesto;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param int $id
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @return Laji
     */
    public function getLaji() {
        return $this->laji;
    }

    /**
     * 
     * @param Laji $laji
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setLaji(Laji $laji) {
        $this->laji = $laji;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getKommentti() {
        return $this->kommentti;
    }

    /**
     * 
     * @param string $kommentti
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }

    /**
     * 
     * @return Kayttaja
     */
    public function getKayttaja() {
        return $this->kayttaja;
    }

    /**
     * 
     * @param \Liikka\Entity\Kayttaja $kayttaja
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setKayttaja(Kayttaja $kayttaja) {
        $this->kayttaja = $kayttaja;
        return $this;
    }

}

?>
