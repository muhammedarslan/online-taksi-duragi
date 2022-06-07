<?php


try {
     $db = new PDO("mysql:host=".DB_HST.";dbname=".DB_NME.";charset=".DB_CHR, DB_USR, DB_PWD);
} catch ( PDOException $e ){
    die('<center><h2>EN KISA SÜREDE GERİ GELECEĞİZ.</h2></center>');
}


$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);