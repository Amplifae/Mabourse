<?php
session_start();
include_once("connexion.php");
?>

<html>
    <head>

    </head>
    <body>
        <form method="POST" action="historique.php">
            <label>Username</label>
            <input type="text" name="identifiant" id="identifiant"/>

        </form>
    </body>
</html>

<?php
$identifiant=$_POST['pseudo'];
$passeword=sha1($_POST['passeword']);

$sql="select * from client where (client.pseudo=:identifiant or client.courriel=:identifiant) and client.passeword=:passeword";
$stmt=$dbcon->prepare($sql);
$stmt->bindparam(':identifiant',$identifiant);
$stmt->bindparam(':passeword',$passeword);
$stmt->execute();


if($stmt->rowCount()==1){
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['pseudo']=$result['pseudo'];
    $_SESSION['idclient']=$result['idclient'];
    $_SESSION['nom']=$result['nom'];
    header("location: historique.php");    
}else{
    echo("Echec de la connexion. Veuillez verifier votre nom d'utilisateur et votre mot de passe");
    header("location: seconnecter.html"); 
    die;
}