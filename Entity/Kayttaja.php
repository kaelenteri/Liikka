<?php

namespace Liikka\Entity;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kayttaja
 *
 * @author Make
 */
class Kayttaja {

    /**
     *
     * @var string $kayttajanimi
     */
    private $kayttajanimi;

    /**
     *
     * @var string $salasana 
     */
    private $salasana;

    /**
     *
     * @var string $etunimi 
     */
    private $etunimi;

    /**
     *
     * @var string $sukunimi 
     */
    private $sukunimi;

    /**
     *
     * @var double $pituus
     */
    private $pituus;
/**
 * 
 * @param string $kayttajanimi
 * @param string $salasana
 * @param string $etunimi
 * @param string $sukunimi
 * @param double $pituus
 */
    function __construct($kayttajanimi, $salasana, $etunimi, $sukunimi, $pituus) {
        $this->kayttajanimi = $kayttajanimi;
        $this->salasana = $salasana;
        $this->etunimi = $etunimi;
        $this->sukunimi = $sukunimi;
        $this->pituus = $pituus;
    }

    /**
     * 
     * @return string
     */
    public function getSalasana() {
        return $this->salasana;
    }

    /**
     * 
     * @param string $salasana
     * @return \Liikka\Entity\Kayttaja
     */
    public function setSalasana($salasana) {
        $this->salasana = $salasana;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getEtunimi() {
        return $this->etunimi;
    }

    /**
     * 
     * @param string $etunimi
     * @return \Liikka\Entity\Kayttaja
     */
    public function setEtunimi($etunimi) {
        $this->etunimi = $etunimi;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getSukunimi() {
        return $this->sukunimi;
    }

    /**
     * 
     * @param string $sukunimi
     * @return \Liikka\Entity\Kayttaja
     */
    public function setSukunimi($sukunimi) {
        $this->sukunimi = $sukunimi;
        return $this;
    }

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
     * @return \Liikka\Entity\Kayttaja
     */
    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
        return $this;
    }

    /**
     * 
     * @return double
     */
    public function getPituus() {
        return $this->pituus;
    }

    /**
     * 
     * @param double $pituus
     * @return \Liikka\Entity\Kayttaja
     */
    public function setPituus($pituus) {
        $this->pituus = $pituus;
        return $this;
    }

}

