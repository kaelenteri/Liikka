<?php

namespace Liikka\Entity;

/**
 * Description of ApuMetodit
 *
 * @author Make
 */
class ApuMetodit {

    /**
     * 
     * @param string $jono
     * @return string
     */
    public static function muunnaJonoKyselyaVarten($jono) {
        return self::lisaaAlkuunJaLoppuun($jono, "\"");
    }

    /**
     * 
     * @param string $jono
     * @param string $alku
     * @return string
     */
    public static function lisaaAlkuun($jono, $alku) {
        return $alku . $jono;
    }

    /**
     * 
     * @param string $jono
     * @param string $loppu
     * @return string
     */
    public static function lisaaLoppuun($jono, $loppu) {
        return $jono . $loppu;
    }

    /**
     * 
     * @param string $jono
     * @param string $lisays
     * @return string
     */
    public static function lisaaAlkuunJaLoppuun($jono, $lisays) {
        $jono = self::lisaaAlkuun($jono, $lisays);
        $jono = self::lisaaLoppuun($jono, $lisays);
        return $jono;
    }

    /**
     * Muuntaa taulukon key => valuet SQL kyselya varten sopiviksi
     * @param array $taulukko
     */
    public static function muunnaTaulukkoKyselyaVarten($taulukko) {
        foreach ($taulukko as $key => $value) {
            // echo "Key: " . $key . ", Value: " . $value . "<br />";
            self::muunnaJonoKyselyaVarten($value);
        }
    }

    public static function muunnaTaulukkoKyselyaVartenRekursiivinen($taulukko) {
        foreach ($taulukko as $key => $value) {
            if (!is_array($value)) {
                self::muunnaJonoKyselyaVarten($value);
            } else {
               

                foreach ($value as $key2 => $value2) {
                    self::muunnaJonoKyselyaVarten($value2);
                }

            }
        }
    }


}
?>

