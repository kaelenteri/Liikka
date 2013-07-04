<?php

use Liikka\Entity\ApuMetodit;

include_once '../Entity/ApuMetodit.php';
$ar = array(
    "nimi" => "makke",
    "ika" => "20" ,
    "puhelinnumero" => array("koti" => "04012321321", "työ"=>"0404121233")
);
ApuMetodit::muunnaTaulukkoKyselyaVartenRekursiivinen($ar);
//ApuMetodit::das($ar);
echo var_dump($ar);
