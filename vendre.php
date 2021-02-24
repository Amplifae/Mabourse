<?php
session_start();

include_once("connexion.php");

// recuperer pour l'utilisateur courant, les actions et quantite disponible
$sql="select action_id, symbol, companyName, ((select sum(quantite) from portfolio where type='Achat' group by action_id)-(SELECT SUM(quantite) from portfolio WHERE type='vente' group by action_id)) as reste 
    from action, portfolio 
    where portfolio.client_idclient=1 
    group by action_id
    order by symbol asc";
    
$stmt=$dbcon->prepare($sql);
$stmt->execute();

$result=$stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($result);
?>

<html>
    <head>

    </head>
    <body>
        
            <table border=1>
                <tr>
                    <td>Id</td>
                    <td>Symbole</td>
                    <td>Company</td>
                    <td>qte en Avoir</td>
                    <td>Qte a vendre</td>                    
                </tr>
                <?php
                foreach($result as $liste){
                    echo "<tr>";
                    echo "<td>".$liste['action_id']."</td>";
                    echo "<td>".$liste['symbol']."</td>";
                    echo "<td>".$liste['companyName']."</td>";
                    echo "<td>".$liste['reste']."</td>"; 
                }
                    
                ?>
            </table>
        
    </body>
</html>