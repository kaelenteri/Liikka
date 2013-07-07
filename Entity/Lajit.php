<?php

namespace Liikka\Entity;

use Liikka\Entity\Laji;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Laji.php";

/**
 * Description of Lajit
 *
 * @author Make
 */
class Lajit {

    /**
     *
     * @var array 
     */
    private $lajit = array();

    /**
     * 
     * @return array
     */
    public function getLajit() {
        return $this->lajit;
    }

    /**
     * 
     * @param array $lajit
     * @return \Liikka\Entity\Lajit
     */
    public function setLajit($lajit) {
        $this->lajit = $lajit;
        return $this;
    }

    public function alusta() {
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        $kysely = "SELECT * FROM laji";
        $tulos = $conn->query($kysely);
        while ($rivi = $tulos->fetch_assoc()) {
            $laji = new Laji($rivi['id'], $rivi['nimi'], $rivi['kulutus'], $rivi['kommentti']);
            array_push($this->lajit, $laji);
        }
        mysqli_close($conn);
    }
/**
 * 
 * @param Laji $l1
 * @param Laji $l2
 * @return int
 */
    public function vertaaNimi($l1, $l2) {
        if($l1->getNimi() == $l2->getNimi()){
            return self::vertaaKulutus($l1,$l2);
        }
        return strcmp($l1->getNimi(), $l2->getNimi());
    }
    /**
     * 
     * @param Laji $l1
     * @param Laji $l2
     * @return int
     */
    public function vertaaKulutus($l1, $l2){
        if($l1->getKulutus() == $l2->getKulutus()){
            return self::vertaaKommentti($l1, $l2);
        }
        return strcmp($l1->getKulutus(), $l2->getKulutus());
    }
    /**
     * 
     * @param Laji $l1
     * @param Laji $l2
     * @return int
     */
    public function vertaaKommentti($l1,$l2){
        return strcmp($l1->getKommentti(), $l2->getKommentti());
    }

}

?>
