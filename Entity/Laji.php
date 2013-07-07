<?php

namespace Liikka\Entity;

/**
 * Description of Laji
 *
 * @author Make
 */
class Laji {

    /**
     *
     * @var int 
     */
    private $id;

    /**
     *
     * @var string 
     */
    private $nimi;

    /**
     *
     * @var double 
     */
    private $kulutus;

    /**
     *
     * @var string 
     */
    private $kommentti;

    /**
     * 
     * @param int $id
     * @param string $nimi
     * @param double $kulutus
     * @param string $kommentti
     */
    function __construct($id, $nimi, $kulutus, $kommentti) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->kulutus = $kulutus;
        $this->kommentti = $kommentti;
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
     * @return \Liikka\Entity\Laji
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getNimi() {
        return $this->nimi;
    }

    /**
     * 
     * @param string $nimi
     * @return \Liikka\Entity\Laji
     */
    public function setNimi($nimi) {
        $this->nimi = $nimi;
        return $this;
    }

    /**
     * Kulutus per minuutti kcal
     * @return double
     */
    public function getKulutus() {
        return $this->kulutus;
    }

    /**
     * 
     * @param double $kulutus
     * @return \Liikka\Entity\Laji
     */
    public function setKulutus($kulutus) {
        $this->kulutus = $kulutus;
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
     * @return \Liikka\Entity\Laji
     */
    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }

}

