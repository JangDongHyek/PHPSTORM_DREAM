<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
</head>
<style>
    #error{display: flex; align-items: center; width: 100%; height: 100vh;}
    #error .box{background:#eee; width: auto; display: block; margin: 0 auto; padding:40px 30px;}
    #error .box h1{line-height: 1em; margin: 0 0 10px 0;}
    #error .box strong{margin-bottom:4px; display: block;}
    #error .box .btn{margin-top:20px; display: block; font-weight: 600; font-size: 0.9em; color: #1a2a49; opacity: 0.8; }
    #error .box .btn:hover{opacity: 1;}
</style>
<body>

    <div id="error">
        <div class="box">
        <h1>404</h1>
            <div>
                <strong>페이지를 찾을 수 없습니다.</strong>
                요청하신 페이지가 사라졌거나, 잘못된 경로로 접근하였습니다.
            </div>
        <a href="<?=PROJECT_URL?>" class="btn">메인으로 이동</a>
        </div>
    </div>

</body>
</html>
