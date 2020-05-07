<?php
include_once 'conn.php';
$result = mysqli_query($conn,"SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
 <head>
 <title> Available Users</title>
 <link rel="stylesheet" type="text/css" href=" ">
 </head>
<body>
<?php
if (mysqli_num_rows($result) > 0) {
?><div class="data">
  <table>
  
  <tr>
    <td>FARMER_ID&nbsp;</td>
    <td>FARMER_USERNAME&nbsp;</td>
    <td>FARMER_USERTYPE&nbsp;</td>
    <td></td>
  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
    <td><?php echo $row["id"]; ?></td>
   <td><?php echo $row["username"]; ?></td>
    <td><?php echo $row["user_type"]; ?></td>
	<td><a href="index.php">click here to view the users measurements</a></td>
    
</tr>
<?php
$i++;
}
?></div>
</table>
 <?php
}
else{
    echo "No result found";
}
?>
 </body>
</html>