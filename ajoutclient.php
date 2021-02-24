<?php
include_once("connexion.php");

if(isset($_POST['ajouter'])){
    // Associer les valeur du formulaire aux variables
    $nom=$_POST['nom'];
    $courriel=$_POST['courriel'];
    $telephone=$_POST['telephone'];
    $pseudo=$_POST['pseudo'];;
    $passeword=sha1($_POST['passeword']); // hasher la valeur avant de l'affecter a la variable $passeword

    // Creation et execution de la requete
    $sql="insert into client(nom, courriel, telephone, pseudo, passeword) values (:nom, :courriel, :telephone, :pseudo, :passeword)";
    $stmt=$dbcon->prepare($sql);
    $stmt->bindparam(':nom', $nom);
    $stmt->bindparam('courriel', $courriel);
    $stmt->bindparam('telephone', $telephone);
    $stmt->bindparam('pseudo', $pseudo);
    $stmt->bindparam('passeword', $passeword);
    $result=$stmt->execute();
    if($result){
        echo "Merci pour votre inscription";
    }else{
        echo "Echec de l'inscription";
    }

}



?>
