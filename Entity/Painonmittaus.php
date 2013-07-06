<?php

namespace Liikka\Entity;

use Liikka\Entity\Kayttaja;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Kayttaja.php";

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
     * @var Kayttaja 
     */
    private $kayttaja;

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
     * @param \Liikka\Entity\Kayttaja $kayttaja
     * @param double $lukema
     * @param string $pvm
     * @param string $kommentti
     */
    function __construct($id, Kayttaja $kayttaja, $lukema, $pvm, $kommentti) {
        $this->id = $id;
        $this->kayttaja = $kayttaja;
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
     * @return \Liikka\Entity\Painonmittaus
     */
    public function setId($id) {
        $this->id = $id;
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
 * @return \Liikka\Entity\Painonmittaus
 */
    public function setKayttaja(Kayttaja $kayttaja) {
        $this->kayttaja = $kayttaja;
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
     * @return \Liikka\Entity\Painonmittaus
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
     * @return \Liikka\Entity\Painonmittaus
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
     * @return \Liikka\Entity\Painonmittaus
     */
    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;
        return $this;
    }



}

?>
