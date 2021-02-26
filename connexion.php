<?php
$host='localhost';
$base='mabourse';
$user='root';
$password='';
//creation de la connexion a la base de donnees
try {
    $dbcon=new PDO("mysql:host=$host;dbname=$base",$user,'');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connexion reussie';
} catch (PDOException $errors) {
    echo 'Echec de la connexion '.$errors->getMessage();
}