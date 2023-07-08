<?php 
include_once('config.php'); 
$query = "SELECT * FROM user_form";
$result = mysqli_query($conn, $query); 
?> 

<!DOCTYPE html> 
<html> 
<head> 
	<title>Fetch Data From Database</title> 
</head> 
<body> 
	<table align="center" border="1px" style="width:600px; line-height:40px;"> 
		<tr> 
			<th colspan="12"><h2>Student Record</h2></th> 
		</tr> 
		<tr> 
			<th>ID</th> 
			<th>Name</th>
			<th>Email</th>
			<th>Username</th> 
			<th>Password</th> 
			<th>User Type</th> 
		</tr> 
		
		<?php while($rows = mysqli_fetch_assoc($result)) { ?> 
		<tr> 
			<td><?php echo $rows['id']; ?></td> 
			<td><?php echo $rows['name']; ?></td> 
			<td><?php echo $rows['gender']; ?></td> 
			<td><?php echo $rows['address']; ?></td>
			<td><?php echo $rows['email']; ?></td> 
			<td><?php echo $rows['username']; ?></td> 
			<td><?php echo $rows['password']; ?></td> 
			<td><?php echo $rows['user_type']; ?></td> 
		</tr> 
		<?php } ?> 

	</table> 
</body> 
</html>
