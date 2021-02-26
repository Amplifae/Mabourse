<?php
session_start();
include_once("connexion.php");
include("menu.html");

$sql="select id, symbol, companyName, estVendu, idclient from client, action, portfolio where client.idclient=portfolio.client_idclient and action.id=portfolio.action_id and estvendu is not null";
//$stmt=$dbcon->prepare($sql);
$stmt=$dbcon->prepare($sql);
$stmt->execute();
$result=$stmt->fetchall(PDO::FETCH_ASSOC);
?>

<?php if ($stmt->rowCount()>0): ?>
<table border=1>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys(current($result))); ?></th>
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

