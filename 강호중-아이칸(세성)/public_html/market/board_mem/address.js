var sojaeji = new Array();


<?
$array1 = array("서울","부산","대구");
for($i=0;$i<=count($array1);$i++){
?>
	sojaeji['<?=$array1[$i]?>'] = '소정면,전의면,연서면,연기면,한솔동,장군면,전동면,조치원읍,연동면,부강면,금남면';

<?}?>
/*
    sojaeji['시도'] = '서울,경기,인천,대전,부산,대구,울산,세종,광주,경남,경북,강원,전남,전북,충남,충북,제주';
    sojaeji['세종'] = '소정면,전의면,연서면,연기면,한솔동,장군면,전동면,조치원읍,연동면,부강면,금남면';
    sojaeji['강원'] = '강릉시,고성군,동해시,삼척시,속초시,양구군,양양군,영월군,원주시,인제군,정선군,철원군,춘천시,태백시,평창군,홍천군,화천군,횡성군';
    sojaeji['경기'] = '가평군,고양시,고양시 덕양구,고양시 일산동구,고양시 일산서구,과천시,광명시,광주시,구리시,군포시,김포시,남양주시,동두천시,부천시,부천시 소사구,부천시 오정구,부천시 원미구,성남시, 성남시 분당구,성남시 수정구,성남시 중원구,수원시,수원시 장안구,수원시 권선구,수원시 팔달구,수원시 영통구,시흥시,안산시,안산시 단원구,안산시 상록구,안성시,안양시,안양시 동안구,안양시 만안구,양주시,양평군,여주군,연천군,오산시,용인시,용인시 수지구,용인시 기흥구,용인시 처인구,의왕시,의정부시,이천시,파주시,평택시,포천시,하남시,화성시';
    sojaeji['경남'] = '거제시,거창군,고성군,김해시,남해군,밀양시,사천시,산청군,양산시,의령군,진주시,창녕군,창원시 마산합포구,창원시 마산회원구,창원시 성산구,창원시 의창구,창원시 진해구,통영시,하동군,함안군,함양군,합천군';
*/
	
	function sidochange() 
    {
        var f = document.fwrite;

        gugunview(f.sido.value);
        dongview(f.sido.value, f.gugun.value);
    }

    function gugunchange() 
    {
        var f = document.fwrite;

        //dongview(f.sido.value, f.gugun.value);
    }

    function dongview(sido, gugun)
    {
        var f = document.fwrite;

        f.dong.options.length = 1;
        f.dong.options[0].text = "읍/면/동(전체)";
        f.dong.options[0].selected = true;
        if (!sido || !gugun) {
            return;
        }

        sojae = sojaeji[sido+"->"+gugun].split(",");
        f.dong.options.length = sojae.length+1;
        for (i=0; i<sojae.length; i++) {
            f.dong.options[i+1].value = sojae[i];
            f.dong.options[i+1].text = sojae[i];

        }
    }

    function gugunview(sido)
    {
        var f = document.fwrite;

        f.gugun.options.length = 1;
        f.gugun.options[0].text = "시/군/구(전체)";
        f.gugun.options[0].selected = true;
        if (!sido) {
            return;
        }

        sojae = sojaeji[sido].split(",");
        f.gugun.options.length = sojae.length+1;
        for (i=0; i<sojae.length; i++) {
            f.gugun.options[i+1].value = sojae[i];
            f.gugun.options[i+1].text = sojae[i];

        }
    }

 function sidoview()
    {
        var f = document.fwrite;

        f.sido.options.length = 1;
        f.sido.options[0].text = "시/도(전체)";
        sojae = sojaeji["시도"].split(",");
        f.sido.options.length = sojae.length+1;
        for (i=0; i<sojae.length; i++) {
            f.sido.options[i+1].value = sojae[i];
            f.sido.options[i+1].text = sojae[i];
        }
    }

