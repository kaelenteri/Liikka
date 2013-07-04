<?php

namespace Liikka\Entity;

use Liikka\Entity\Ravinnon_saanti;
use Liikka\Entity\Ravinto;
use Liikka\Entity\Tyyppi;

include_once 'Ravinto.php';
include_once 'Ravinnon_saanti.php';
include_once 'Tyyppi.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ravinnon_saannit
 *
 * @author Make
 */
class Ravinnon_saannit {

    /* @var Ravinnon_saanti[] */
    private $ravinnon_saannit;

    /**
     * 
     * @return Ravinnon_saanti[]
     */
    public function getRavinnon_saannit() {
        return $this->ravinnon_saannit;
    }

    public function setRavinnon_saannit($ravinnon_saannit) {
        $this->ravinnon_saannit = $ravinnon_saannit;
        return $this;
    }

    function __construct() {
        $this->setRavinnon_saannit(array());
    }

    public function hae($kayttajanimi) {
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        $kysely = "SELECT 
                rs.id AS rs_id, 
                rs.kayttajanimi AS rs_kayttajanimi, 
                rs.pvm AS rs_pvm, 
                rs.ravinto_id AS 
                rs_ravinto_id, 
                rs.maara AS rs_maara, 
                rs.kommentti AS rs_kommentti,
                r.id AS r_id,
                r.nimi AS r_nimi, 
                r.tyyppi AS r_tyyppi, 
                r.merkki AS r_merkki, 
                r.kalorit AS r_kalorit, 
                r.kommentti AS r_kommentti, 
                rt.id AS rt_id, 
                rt.nimi AS rt_nimi 
                FROM ravinnon_saanti AS rs, 
                ravinto AS r, 
                ravinto_tyyppi AS rt 
                WHERE rs.ravinto_id = r.id 
                AND r.tyyppi = rt.id 
                AND rs.kayttajanimi = \"".$kayttajanimi. "\"";

        $tulos = $conn->query($kysely);
        
        while($rivi = $tulos->fetch_array(MYSQLI_ASSOC)){
            $rt = new Tyyppi($rivi['rt_id'], $rivi['rt_nimi']);
            $r = new Ravinto($rivi['r_id'], $rivi['r_nimi'], $rt, $rivi['r_kalorit'], $rivi['r_merkki'], $rivi['r_kommentti']);
            $rs = new Ravinnon_saanti($rivi['rs_id'], $rivi['rs_kayttajanimi'], $rivi['rs_pvm'], $r, $rivi['rs_maara'], $rivi['rs_kommentti']);
            //echo var_dump($rs);
            array_push($this->ravinnon_saannit, $rs);
            
            
        }
        mysqli_close($conn);

    }
    
    public function jarjesta(){
        usort($this->ravinnon_saannit, "self::jarjestaPvmMukaan");
    }
    
    public function jarjestaPvmMukaan($rs1, $rs2){
        return strcmp($rs1->getPvm(), $rs2->getPvm());
    }
    
    

}

?>
