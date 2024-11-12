<?php
include 'class.crypto.php';
$crypto = new Crypto();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> Seed 128 - ANSI-X.923-Padding</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
</head>
<body>
	<h1>Seed128 + ANSI-X.923-Padding</h1>
	<table border="1">
	<tr>
		<th>TestKey</th>
		<td><?php echo $crypto->pbUserKey; ?></td>
	</tr>
	<tr>
		<th>Encrypt</th>
		<td><?php echo $crypto->encrypt('EzwelCrypto TEST!!'); ?></td>
	</tr>
	<tr>
		<th>Decrypt</th>
		<td><?php echo $crypto->decrypt('DT+MVmbVtvpCWt4loM1B9i/vyxq3VKkq4OVtdEgi+lU='); ?></td>
	</tr>
	</table>	
</body>
</html>
