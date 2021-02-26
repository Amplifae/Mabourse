<?php
session_start();

include_once("connexion.php");
include("menu.html")

// recuperer pour l'utilisateur courant, les actions et quantite disponible
$sql="select action_id, symbol, companyName, ((select sum(quantite) from portfolio where type='Achat' group by action_id)-(SELECT SUM(quantite) from portfolio WHERE type='vente' group by action_id)) as reste 
    from action, portfolio 
    where portfolio.client_idclient=1 
    group by action_id
    order by symbol asc";

$entete=array("Num","symbole","compagnie","Reste");
    
$stmt=$dbcon->prepare($sql);
$stmt->execute();
$result=$stmt->fetchall(PDO::FETCH_ASSOC);
?>

<?php if ($stmt->rowCount()>0): ?>
<table border=1>
  <thead>
    <tr>
      <th><?php 
      echo implode('</th><th>', array_keys(current($result))); 
      ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
   