<?php

namespace Liikka\Entity;

/**
 * Description of Painonmittaus
 *
 * @author Make
 */
class Painonmittaus {

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
     * @var double 
     */
    private $lukema;

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

    /**
     * 
     * @param int $id
     * @param string $kayttajanimi
     * @param double $lukema
     * @param string $pvm
     * @param string $kommentti
     */
    function __construct($id, $kayttajanimi, $lukema, $pvm, $kommentti) {
        $this->id = $id;
        $this->kayttajanimi = $kayttajanimi;
        $this->lukema = $lukema;
        $this->pvm = $pvm;
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
 * @return \Painonmittaus
 */
    public function setId($id) {
        $this->id = $id;
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
 * @return \Painonmittaus
 */
    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
        return $this;
    }
/**
 * 
 * @return double
 */
    public function getLukema() {
        return $this->lukema;
    }
/**
 * 
 * @param double $lukema
 * @return \Painonmittaus
 */
    public function setLukema($lukema) {
        $this->lukema = $lukema;
        return $this;
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
 * @return \Painonmittaus
 */
    public function setPvm($pvm) {
        $this->pvm = $pvm;
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
 * @return \Painonmittaus
 */
    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }

}

?>
