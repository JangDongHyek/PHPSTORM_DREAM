<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set('memory_limit','-1');
include_once('./common.php');

use SAPNWRFC\Connection as SapConnection;
use SAPNWRFC\Exception as SapException;


$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
    case 'chkPortConn':
        
        $ashost = $_POST['ashost'];
        $port = $_POST['port'];                        
        $timeout = 5; // 초 단위로 연결 시도 시간 제한 설정

        $socket = @fsockopen($ashost, $port, $errno, $errstr, $timeout);

        if ($socket) {
            $result['result'] = true;
            $result['msg'] = "Connection to {$ashost}:{$port} is successful!";
            fclose($socket);
        } else {
            $result['msg'] =  "Unable to connect to {$ashost}:{$port}. Error: {$errstr} ({$errno})";
        }

    break;
        
    case 'conn':
        $ashost = $_POST['ashost'];
        $port = $_POST['port'];
        $sysnr = $_POST['sysnr'];
        $client = $_POST['client'];
        $user = $_POST['user'];
        $passwd = $_POST['passwd'];        
        
        $config = [
            'ashost' => $ashost,
            'sysnr'  => $sysnr,
            'client' => $client,
            'user'   => $user,
            'passwd' => $passwd,
            'lang'   => 'EN',
            'trace'  => SapConnection::TRACE_LEVEL_OFF
        ];
        
        $result['configInfo'] = $config;

        try {
            $c = new SapConnection($config);
            
            $result['msg'] = 'conn 성공!';
        } catch(SapException $ex) {            
            $result['msg'] = 'Connection failed: ' . $ex->getMessage() . PHP_EOL;
        } catch(Exception $ex) {
            $result['deftailMsg'] = $ex;
            $result['msg'] =  '일반 예외 발생: ' . $ex->getMessage() . PHP_EOL;
        }
        
    break;
}

die(json_encode($result));
?>
