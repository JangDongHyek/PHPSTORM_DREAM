var sojaeji = new Array();


<?
$array1 = array("����","�λ�","�뱸");
for($i=0;$i<=count($array1);$i++){
?>
	sojaeji['<?=$array1[$i]?>'] = '������,���Ǹ�,������,�����,�Ѽֵ�,�屺��,������,��ġ����,������,�ΰ���,�ݳ���';

<?}?>
/*
    sojaeji['�õ�'] = '����,���,��õ,����,�λ�,�뱸,���,����,����,�泲,���,����,����,����,�泲,���,����';
    sojaeji['����'] = '������,���Ǹ�,������,�����,�Ѽֵ�,�屺��,������,��ġ����,������,�ΰ���,�ݳ���';
    sojaeji['����'] = '������,����,���ؽ�,��ô��,���ʽ�,�籸��,��籺,������,���ֽ�,������,������,ö����,��õ��,�¹��,��â��,ȫõ��,ȭõ��,Ⱦ����';
    sojaeji['���'] = '����,����,���� ���籸,���� �ϻ굿��,���� �ϻ꼭��,��õ��,�����,���ֽ�,������,������,������,�����ֽ�,����õ��,��õ��,��õ�� �һ籸,��õ�� ������,��õ�� ���̱�,������, ������ �д籸,������ ������,������ �߿���,������,������ ��ȱ�,������ �Ǽ���,������ �ȴޱ�,������ ���뱸,�����,�Ȼ��,�Ȼ�� �ܿ���,�Ȼ�� ��ϱ�,�ȼ���,�Ⱦ��,�Ⱦ�� ���ȱ�,�Ⱦ�� ���ȱ�,���ֽ�,����,���ֱ�,��õ��,�����,���ν�,���ν� ������,���ν� ���ﱸ,���ν� ó�α�,�ǿս�,�����ν�,��õ��,���ֽ�,���ý�,��õ��,�ϳ���,ȭ����';
    sojaeji['�泲'] = '������,��â��,����,���ؽ�,���ر�,�о��,��õ��,��û��,����,�Ƿɱ�,���ֽ�,â�籺,â���� ����������,â���� ����ȸ����,â���� ���걸,â���� ��â��,â���� ���ر�,�뿵��,�ϵ���,�Ծȱ�,�Ծ籺,��õ��';
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
        f.dong.options[0].text = "��/��/��(��ü)";
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
        f.gugun.options[0].text = "��/��/��(��ü)";
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
        f.sido.options[0].text = "��/��(��ü)";
        sojae = sojaeji["�õ�"].split(",");
        f.sido.options.length = sojae.length+1;
        for (i=0; i<sojae.length; i++) {
            f.sido.options[i+1].value = sojae[i];
            f.sido.options[i+1].text = sojae[i];
        }
    }

