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

    /**
     *
     * @var int 
     */
    private $id;

    /**
     *
     * @var string 
     */
    private $kayttajanimi;

    /**
     * 
     * @return string
     */
    public function getKayttajanimi() {
        return $this->kayttajanimi;
    }

    /**
     * 
     * @param string $kayttajanimi
     * @return \Liikka\Entity\Liikuntasuoritus
     */
    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
        return $this;
    }

    /**
     *
     * @var Laji 
     */
    private $laji;

    /**
     *
     * @var string 
     */
    private $kommentti;

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
     * @param int $id
     * @param \Liikka\Entity\Laji $laji
     * @param string $kommentti
     * @param int $kesto
     * @param string $pvm
     */
    function __construct($id, $kayttajanimi, Laji $laji, $kommentti, $kesto, $pvm) {
        $this->id = $id;
        $this->kayttajanimi = $kayttajanimi;
        $this->laji = $laji;
        $this->kommentti = $kommentti;
        $this->kesto = $kesto;
        $this->pvm = $pvm;
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

}

?>
