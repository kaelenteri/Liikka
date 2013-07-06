<?php

namespace Liikka\Entity;

use Liikka\Entity\Laji;
use Liikka\Entity\Liikuntasuoritus;
use Liikka\Entity\ApuMetodit;

include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Laji.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Liikuntasuoritus.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/ApuMetodit.php";

/**
 * Description of Liikuntasuoritukset
 *
 * @author Make
 */
class Liikuntasuoritukset {

    /**
     *
     * @var array
     */
    private $liikuntasuoritukset;

    /**
     * 
     * @return array
     */
    public function getLiikuntasuoritukset() {
        return $this->liikuntasuoritukset;
    }

    /**
     * 
     * @param array $liikuntasuoritukset
     * @return array
     */
    public function setLiikuntasuoritukset($liikuntasuoritukset) {
        $this->liikuntasuoritukset = $liikuntasuoritukset;
        return $this;
    }
    
    public function hae(Kayttaja $kayttaja){
        $liikuntasuoritukset = array();
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        
        $kayttajanimi = $kayttaja->getKayttajanimi() ;
        $kayttajanimi = ApuMetodit::muunnaJonoKyselyaVarten($kayttajanimi);
        
        $kysely = "SELECT ls.id AS ls_id, 
            ls.kayttajanimi AS ls_kayttajanimi,
            ls.pvm AS ls_pvm, 
            ls.laji_id AS ls_laji_id, 
            ls.kesto AS ls_kesto, 
            ls.kommentti AS ls_kommentti, 
            l.id AS l_id, 
            l.nimi AS l_nimi, 
            l.kulutus AS l_kulutus, 
            l.kommentti AS l_kommentti 
            FROM liikuntasuoritus AS ls, 
            laji AS l 
            WHERE ls.laji_id = l.id 
            AND ls.kayttajanimi = $kayttajanimi";
        $tulos = $conn->query($kysely);
        
        if(mysqli_num_rows($tulos) > 0){
            
            while($rivi = mysqli_fetch_assoc($tulos)){
                $l = new Laji($rivi['l_id'], $rivi['l_nimi'], $rivi['l_kulutus'], $rivi['l_kommentti']);
                $ls = new Liikuntasuoritus($rivi['ls_id'], $rivi['ls_kayttajanimi'], $l, $rivi['kommentti'], $rivi['kesto'], $rivi['pvm']);
                array_push($liikuntasuoritukset, $ls);
                
                
            }
            
        }
        mysqli_close($conn);
        
        usort($this->liikuntasuoritukset, "self::jarjestaPvmMukaan");
        
    }
    /**
     * 
     * @param Liikuntasuoritus $ls1
     * @param Liikuntasuoritus $ls2
     * @return int
     */
    public function vertaaPvm($ls1, $ls2){
        return strcmp($ls1->getPvm(), $ls2->getPvm());
    }
    /**
     * 
     * @return array
     */
    public function jarjestaPvmMukaan(){
        usort($this->liikuntasuoritukset, "self::vertaaPvm");
        return $this->liikuntasuoritukset;
    }

}

?>
