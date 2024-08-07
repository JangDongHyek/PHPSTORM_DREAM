<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once('./common.php');
?>
<script>
    const rootUrl = '<?=G5_URL?>';
</script>
<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/util.js?v=<?=date('Y-m-d H:i:s')?>"></script>

<style>
    div{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    
    input{
        margin: 10px 0;        
    }
    
    label{
        font-weight: bold;
    }
    
    button{
        cursor: pointer;
        background: #eee;
        border: 1px solid black;
        width: 150px;
        height: 40px;
        margin: 10px 0;
    }
    
</style>

<div>
    <h2>OJC SAPRFC 통신 테스트</h2>
        
    <label for="ashost"> 호스트 이름 또는 IP 주소만 포함</label>    
    <input type="text" id="ashost" value="3.37.73.241">
    
    <label for="port">포트</label>
    <input type="text" id="port" value="3203">
    <button onclick="chkPortConn()">포트 연결확인</button>
    
    <label for="sysnr">시스템 번호</label>
    <input type="text" id="sysnr" value="03">
    
    <label for="client">클라이언트 번호</label>
    <input type="text" id="client" value="100">
    
    <label for="user">사용자 이름</label>
    <input type="text" id="user" value="RTS01">
    
    <label for="passwd">비밀번호</label>
    <input type="text" id="passwd" value="@ojc0329">
    
    <p>※연결시에는 포트 번호를 포함하여 연결하지 않습니다.</p>
    <p>포트 넣고 테스트 할시 ex) 3.37.73.241:3301(뒤 :3301)를 붙혀주세요.</p>
    <button onclick="conn()">연결하기</button>
</div>


<script>

    async function chkPortConn(){
        let $ashost = $('#ashost'),
            $port = $('#port');
        
        if(!$ashost.val()){
            alert('호스트를 입력해주세요.');
            $ashost.focus();
            return;
        }else if(!$port.val()){
            alert('포트번호를 입력해주세요.');
            $port.focus();
            return;
        }
                
        const chkPortConnRes = await postJson('./ajaxOjcRfc.php', {
            mode : 'chkPortConn',
            ashost : $ashost.val(),
            port : $port.val()
        });
        
        alert(chkPortConnRes.msg);
    }
    
    async function conn(){
        let $ashost = $('#ashost'),
//            $port = $('#port'),
            $sysnr = $('#sysnr'),
            $client = $('#client'),
            $user = $('#user'),
            $passwd = $('#passwd'),
            falseMsg = '',
            target = null;
        
        if(!$ashost.val()){
            falseMsg = '호스트를 입력해주세요.';
            target = $ashost;
        }
//        else if(!$port.val()){
//            falseMsg = '포트를 입력해주세요.';
//            target = $port;
//        }
        else if(!$sysnr.val()){
            falseMsg = '시스템 번호를 입력해주세요.';
            target = $sysnr;
        }else if(!$client.val()){
            falseMsg = '클라이언트 번호를 입력해주세요.';
            target = $client;
        }else if(!$user.val()){
            falseMsg = '사용자 이름을 입력해주세요.';
            target = $user;
        }else if(!$passwd.val()){
            falseMsg = '비밀번호를 입력해주세요.';
            target = $passwd;
        }
        
        if(target != null){
            alert(falseMsg);
            target.focus();
            return;
        }
                
        const connRes = await postJson('./ajaxOjcRfc.php', {
            mode : 'conn',
            ashost : $ashost.val(),
//            port : $port.val(),
            sysnr : $sysnr.val(),
            client : $client.val(),
            user : $user.val(),
            passwd : $passwd.val()
        });
        
        alert(connRes.msg);
        
        window.open(`./ojcRfcResult.php?ashost=${$ashost.val()}&sysnr=${$sysnr.val()}&client=${$client.val()}&user=${$user.val()}&passwd=${$passwd.val()}`);
    }
    
</script>

