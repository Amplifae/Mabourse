<?php
    session_start();
    include_once("connexion.php");
    include("menu.html");
    //if(isset($_session['idclient'])) die ("Veuillez vous connecter");

    $idclient=$_SESSION['idclient'];  // valeur a remplacer par une variable session ( id de l'utilisateur en cours)
    echo "Historique des transactions de l'utilisateur ".$_session['nom'];

    // requete de selection de l'historique du client avec pour parametre l'identifiant du client
    $sqlhisto="select datemouvement, type, symbol, companyName, quantite, prix, prix*quantite as valeurachat, open*quantite as valeuractuelle, (open*quantite-prix*quantite) as marge 
        from portfolio, action 
        where portfolio.action_id=action.id and portfolio.client_idclient=".$idclient." order by datemouvement desc";
        
    // execution de la requete creee
    $result=$dbcon->query($sqlhisto);
 ?>   

<html>
    <head></head>
    <body>
           
    <!--Creation d'un tableau pour recevoir l'affichage de l'historique-->
        <table border=1>
            <tr>
                <td>DATES </td>
                <td>OPERATIONS </td>
                <td>SYMBOLES</td>
                <td>COMPAGNIE</td>                
                <td>PRIX D'ACHAT</td>
                <td>QUANTITES</td>
                <td>VALEUR ACHAT</td>
                <td>VALEUR ACTUELLE</td>
                <td>MARGE</td>
            </tr>

     <?php
        // Parcours et affichage du resultat de la requete dans un tableau
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>".$row['datemouvement']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['symbol']."</td>";
            echo "<td>".$row['companyName']."</td>";
            echo "<td>".$row['quantite']."</td>";
            echo "<td>".$row['prix']."</td>";
            echo "<td>".$row['valeurachat']."</td>";
            echo "<td>".$row['valeuractuelle']."</td>";
            echo "<td>".$row['marge']."</td>";
            }
        
     ?>
        </table>
    </body>
</html>


