<?php

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
    private $kayttajanimi;
    private $salasana;
    private $etunimi;
    private $sukunimi;
    private $pituus;
    


    public function getSalasana() {
        return $this->salasana;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
        return $this;
    }

        
    public function getEtunimi() {
        return $this->etunimi;
    }

    public function setEtunimi($etunimi) {
        $this->etunimi = $etunimi;
        return $this;
    }

    public function getSukunimi() {
        return $this->sukunimi;
    }

    public function setSukunimi($sukunimi) {
        $this->sukunimi = $sukunimi;
        return $this;
    }


    public function getKayttajanimi() {
        return $this->kayttajanimi;
    }

    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
    }

    public function getPituus() {
        return $this->pituus;
    }

    public function setPituus($pituus) {
        $this->pituus = $pituus;
    }


}

