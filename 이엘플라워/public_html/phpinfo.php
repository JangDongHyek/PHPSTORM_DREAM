<script>
function test() {
 Div1.innerText -= 1; //숫자 줄여주고...
 if(Div1.innerText==0) Div2.innerText = 'ㅋㅋㅋ'; //0이면 글자 변경...
 else setTimeout("test()", 1000); //아니면 1초 경과 후 다시 호출...
}
onload=function() {
 setTimeout("test()", 5000); //로드후 1초 뒤에 test함수 호출...
}
</script>


<div id="Div1">5</div>
<div id="Div2">테스트</div>