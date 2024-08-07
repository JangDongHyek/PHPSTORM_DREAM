<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use SAPNWRFC\Connection as SapConnection;
use SAPNWRFC\Exception as SapException;

$ashost = $_GET['ashost'];
$sysnr = $_GET['sysnr'];
$client = $_GET['client'];
$user = $_GET['user'];
$passwd = $_GET['passwd'];

$config = [
    'ashost' => $ashost,
    'sysnr'  => $sysnr,
    'client' => $client,
    'user'   => $user,
    'passwd' => $passwd,
    'lang'   => 'EN'    
];

try {
    $c = new SapConnection($config);

    echo '연결성공';
//    $f = $c->getFunction('YTEST_RFC_001');
//
//    $invokeData = [];
//    $result = $f->invoke($invokeData);
//
//    var_dump($result);
//	exit;
} catch(SapException $ex) {
    echo "<pre>";
	var_dump($ex);
    echo "</pre>";
    //echo 'Exception: ' . $ex->getMessage() . PHP_EOL;
} catch(Exception $ex) {
    echo '일반 예외 발생: ' . $ex->getMessage() . PHP_EOL;
}

?>
