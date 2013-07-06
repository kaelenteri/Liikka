<?php

namespace Liikka\Entity;

use Liikka\Entity\Tyyppi;
//var_dump(stream_resolve_include_path("../../Entity/Tyyppi.php"));
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Tyyppi.php";

/**
 * Description of Ruoka
 *
 * @author Make
 */
class Ravinto {

    /**
     *
     * @var int $id
     */
    private $id;

    /**
     *
     * @var string $nimi
     */
    private $nimi;

    /**
     *
     * @var Tyyppi $tyyppi 
     */
    private $tyyppi;

    /**
     *
     * @var int $kalorit
     */
    private $kalorit; // 100g tai 100ml
    /**
     *
     * @var string $merkki
     */
    private $merkki; // Esim valio
    /**
     *
     * @var string $kommentti 
     */
    private $kommentti;

    /**
     * 
     * @param int $id
     * @param string $nimi
     * @param Tyyppi $tyyppi
     * @param string $kalorit
     * @param string $merkki
     * @param string $kommentti
     */
    function __construct($id, $nimi, $tyyppi, $kalorit, $merkki, $kommentti) {
        $this->id = $id;
        $this->nimi = $nimi;

        $this->tyyppi = $tyyppi;
        $this->kalorit = $kalorit;
        $this->merkki = $merkki;
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
     * @return \Liikka\Entity\Ravinto
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
     * @return \Liikka\Entity\Ravinto
     */
    public function setNimi($nimi) {
        $this->nimi = $nimi;
        return $this;
    }

    /**
     * 
     * @return \Liikka\Entity\Tyyppi
     */
    public function getTyyppi() {
        return $this->tyyppi;
    }
    /**
     * 
     * @param Tyyppi $tyyppi
     * @return \Liikka\Entity\Ravinto
     */
    public function setTyyppi($tyyppi) {
        $this->tyyppi = $tyyppi;
        return $this;
    }
/**
 * 
 * @return int
 */
    public function getKalorit() {
        return $this->kalorit;
    }
/**
 * 
 * @param int $kalorit
 * @return \Liikka\Entity\Ravinto
 */
    public function setKalorit($kalorit) {
        $this->kalorit = $kalorit;
        return $this;
    }
/**
 * 
 * @return string
 */
    public function getMerkki() {
        return $this->merkki;
    }
/**
 * 
 * @param string $merkki
 * @return \Liikka\Entity\Ravinto
 */
    public function setMerkki($merkki) {
        $this->merkki = $merkki;
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
 * @return \Liikka\Entity\Ravinto
 */
    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }

}

?>
