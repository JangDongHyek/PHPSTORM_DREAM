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
		<td><?php echo $crypto->encrypt('{"gourl" : ""}'); ?></td>
	</tr>
	<tr>
		<th>Decrypt</th>
		<td><?php
            $token = "sKJFSze35YANlIgyHZMt5LyxIq1v%2BbQUeKcpBNd6bV7%2B0zCZqyoV15nRb34EObXcNqCbvgSf3Skjf3No5NHEyGCUqyfVywqyp8Ar4W1XwGGlO90icQkQzDO/LKtOdi/nZquq%2BKqtyAFSJMckxzBbUfG167g6%2B0IITxvXf%2BU4RLxvnzom/nSlbGJt5P4zsJXJLE/mlf6SycG2vt3e0y%2BLlb/onX1ZW3L1k0Wx6qNHYkqYPXbR7Jl9lMmcB%2Bwm9vgpwXEGnqUrLCvkTiskk6v7teiHexI8mHfAsuk52dJxT9TcvXSUHQRYYSgON7ufi6jU/cAdp%2BX%2BMh1kjpJK%2B%2BTvZGmIuy1GQLiiTWBP2QaZwH8hl0D0JfLwfLDJEsj%2BFlG4k%2B%2BfTINeGHXyqOA80NeHNVXClhZJIftS0etCfcwopL13Xo0Nkb7KtK7aWq34qAI4Aj0TU2JfuLBfeX/MCoUhFaa80tN%2BNp9k6ncidmuZL/mUUo6GaI5/9AbvIXiYe2r%2BeaCFOZ/aSiWp4sjJxf8hWQ==";
            //$token = base64_encode($token);
            $token = $crypto->decrypt($token);
            //$decodedString = mb_convert_encoding($decodedString, "UTF-8", "EUC-KR");
            //$UTF = mb_convert_encoding($decodedString, "UTF-8", "UTF-8") . PHP_EOL;
            //$EUC = mb_convert_encoding($decodedString, "UTF-8", "EUC-KR") . PHP_EOL;
            //$ISO = mb_convert_encoding($decodedString, "UTF-8", "ISO-8859-1") . PHP_EOL;

            $convertedString = iconv("EUC-KR", "UTF-8", $token);
            echo $token;
            //echo $convertedString;
            ?></td>
	</tr>
	</table>	
</body>
</html>
