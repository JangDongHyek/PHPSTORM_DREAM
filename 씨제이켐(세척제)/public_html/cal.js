	function cal_pre(field)
	{
		var tmpStr;
		var form = eval ("document.f." + field);
		tmpStr = form.value;
		cal_byte(field, tmpStr);
	}

	//�޼���â�� byte ���
	function cal_byte(field, aquery) 
	{
		var tmpStr;
		var temp=0;
		var onechar;
		var tcount;
		tcount = 0;
		 
		tmpStr = new String(aquery);
		temp = tmpStr.length;

		for (k=0;k<temp;k++)
		{
			onechar = tmpStr.charAt(k);

			if (escape(onechar).length > 4) {
				tcount += 2;
			}
			else if (onechar!='\r') {
				tcount++;
			}
		}

		var cbyte_form = eval ("document.f." + field + "_cbyte");
		var value_form = eval ("document.f." + field);
		cbyte_form.value = tcount;

		if (tcount > 78) {
			reserve = tcount - 78;
			alert("�޽��� ������ 78����Ʈ �̻��� �����ϽǼ� �����ϴ�.\r\n ���� �޽����� "+reserve+"����Ʈ�� �ʰ��Ǿ����ϴ�.\r\n �ʰ��� �κ��� �ڵ����� �����˴ϴ�."); 
			nets_check(field, value_form.value, 78);
			return;
		}	
	}

	function nets_check(field, aquery, max)
	{
		var tmpStr;
		var temp=0;
		var onechar;
		var tcount;
		tcount = 0;
		 
		tmpStr = new String(aquery);
		temp = tmpStr.length;

		for(k=0;k<temp;k++)
		{
			onechar = tmpStr.charAt(k);
			
			if(escape(onechar).length > 4) {
				tcount += 2;
			}
			else if(onechar!='\r') {
				tcount++;
			}
			if(tcount>max) {
				tmpStr = tmpStr.substring(0,k);			
				break;
			}
		}
		
		if (max == 78) {
			var form = eval ("document.f." + field);
			form.value = tmpStr;
			cal_byte(field, tmpStr);
		}
		
		return tmpStr;
	}
