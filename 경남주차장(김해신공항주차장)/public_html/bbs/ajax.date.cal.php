<?php
	include_once("./_common.php");
class LunarCalendar
{
    var $lunarMonthType = array();
    //  var $accumulateLunarDate = array();

    var $SolarToLunar = array();
    var $LunarToSolar = array();
    var $error = "";
    var $solar_start = "1881-01-30";
    var $lunar_start = '18810101';

    function __construct()
    {
        // 음력 달력의 달형태를 저장한다.
        // 각 해는 13월로 표현되고,  1 작은달, 2 큰달, 3 작은 윤달, 4 큰 윤달 이다. 0 은 윤달이 없는 해에 자리를 채우는 것이다.
        // 1881년 1월 30일은 음력 1881년 1월 1일 임으로 이를 기준으로 계산한다.
        $monthTypeMark = "1212122322121" . "1212121221220" . "1121121222120" . "2112132122122" . "2112112121220" . "2121211212120" . "2212321121212" . "2122121121210" . "2122121212120"
            . "1232122121212" . "1212121221220" . "1121123221222" . "1121121212220" . "1212112121220" . "2121231212121" . "2221211212120" . "1221212121210" . "2123221212121" . "2121212212120"
            . "1211212232212" . "1211212122210" . "2121121212220" . "1212132112212" . "2212112112210" . "2212211212120" . "1221412121212" . "1212122121210" . "2112212122120" . "1231212122212"
            . "1211212122210" . "2121123122122" . "2121121122120" . "2212112112120" . "2212231212112" . "2122121212120" . "1212122121210" . "2132122122121" . "2112121222120" . "1211212322122"
            . "1211211221220" . "2121121121220" . "2122132112122" . "1221212121120" . "2121221212110" . "2122321221212" . "1121212212210" . "2112121221220" . "1231211221222" . "1211211212220"
            . "1221123121221" . "2221121121210" . "2221212112120" . "1221241212112" . "1212212212120" . "1121212212210" . "2114121212221" . "2112112122210" . "2211211412212" . "2211211212120"
            . "2212121121210" . "2212214112121" . "2122122121120" . "1212122122120" . "1121412122122" . "1121121222120" . "2112112122120" . "2231211212122" . "2121211212120" . "2212121321212"
            . "2122121121210" . "2122121212120" . "1212142121212" . "1211221221220" . "1121121221220" . "2114112121222" . "1212112121220" . "2121211232122" . "1221211212120" . "1221212121210"
            . "2121223212121" . "2121212212120" . "1211212212210" . "2121321212221" . "2121121212220" . "1212112112210" . "2223211211221" . "2212211212120" . "1221212321212" . "1212122121210"
            . "2112212122120" . "1211232122212" . "1211212122210" . "2121121122210" . "2212312112212" . "2212112112120" . "2212121232112" . "2122121212110" . "2212122121210" . "2112124122121"
            . "2112121221220" . "1211211221220" . "2121321122122" . "2121121121220" . "2122112112322" . "1221212112120" . "1221221212110" . "2122123221212" . "1121212212210" . "2112121221220"
            . "1211231212222" . "1211211212220" . "1221121121220" . "1223212112121" . "2221212112120" . "1221221232112" . "1212212122120" . "1121212212210" . "2112132212221" . "2112112122210"
            . "2211211212210" . "2221321121212" . "2212121121210" . "2212212112120" . "1232212122112" . "1212122122120" . "1121212322122" . "1121121222120" . "2112112122120" . "2211231212122"
            . "2121211212120" . "2122121121210" . "2124212112121" . "2122121212120" . "1212121223212" . "1211212221220" . "1121121221220" . "2112132121222" . "1212112121220" . "2121211212120"
            . "2122321121212" . "1221212121210" . "2121221212120" . "1232121221212" . "1211212212210" . "2121123212221" . "2121121212220" . "1212112112220" . "1221231211221" . "2212211211220"
            . "1212212121210" . "2123212212121" . "2112122122120" . "1211212322212" . "1211212122210" . "2121121122120" . "2212114112122" . "2212112112120" . "2212121211210" . "2212232121211"
            . "2122122121210" . "2112122122120" . "1231212122212" . "1211211221220" . "2121121321222" . "2121121121220" . "2122112112120" . "2122141211212" . "1221221212110" . "2121221221210"
            . "2114121221221";

        //      $monthTypeMark = "1212122322121" . "1212121221220"; // 디버깅용 데이터.

        // $monthTypeMark 에 대응하는 날의수
        $dateCount = array(
            0,
            29,
            30,
            29,
            30
        );
        //문자열 입력을 배열로 컷팅.
        $perYear = str_split($monthTypeMark, 13);
        foreach ($perYear as $yearData)
        {
            $arr = str_split($yearData);
            $lunarMonthType[] = $arr;
        }

        //인덱스 구축.
        $solarDate = new DateTime($this->solar_start);
        $lastSol = $solarDate->format('Ymd');
        $lastLuna = $this->lunar_start;
        $lunarYear = (int) substr($this->lunar_start, 0, 4);
        foreach ($lunarMonthType as $yearArr)
        {
            $accArr = array();

            $lunarMonth = 0;
            foreach ($yearArr as $monthType)
            {
                if ($monthType == '0')
                    continue;
                $dcnt = $dateCount[$monthType];

                $isLeapMonth = false;
                if ($monthType == '3' || $monthType == '4')
                    $isLeapMonth = true;
                else
                    $lunarMonth++;

                $lunarYMD = sprintf('%d%02d%02d%s', $lunarYear, $lunarMonth, 1, $isLeapMonth ? 'L' : ' ');

                if (isset($this->SolarToLunar[$solarDate->format('Ym')]) == false)
                {
                    $this->SolarToLunar[$solarDate->format('Ym')][$lastSol] = $lastLuna;
                }

                $this->SolarToLunar[$solarDate->format('Ym')][$solarDate->format('Ymd')] = $lunarYMD;
                $this->LunarToSolar[$lunarYMD] = $solarDate->format('Ymd');

                $lastSol = $solarDate->format('Ymd');
                $lastLuna = $lunarYMD;

                $solarDate->add(new DateInterval('P' . $dcnt . 'D'));
            }
            $lunarYear++;
        }

    }

    /**
     * 디버깅용 인덱스 출력함수
     *
     */
    function print_index()
    {
        //      foreach ($this->SolarToLunar as $k=> $l)
        //      {
        //          if(count($l) >1)
        //          {
        //              print_r("$k => ");
        //              print_r($l);
        //          }
        //      }
        print_r($this->SolarToLunar);
    }

    /**
     * getLunarDate의 반환값을 포맷팅 하기 위한 함수
     * 아래 포맷을 지원함
     *  *Y-m-d  :  2010-02-03  형태
     *  *YmdL : 20100203L 형태, L이 붙으면 윤달 그렇지 않으면 윤달 아님.
     * @param unknown_type $lunarDate
     * @param unknown_type $fmt
     */
    static function formatLunar($lunar, $fmt = 'Y-m-d')
    {
        $lunarYear = $lunar['year'];
        $lunarMonth = $lunar['month'];
        $lunarDate = $lunar['date'];
        $isLeapMonth = $lunar['is_leap_month'];

        return LunarCalendar::formatLunar2($lunarYear, $lunarMonth, $lunarDate, $isLeapMonth, $fmt);
    }

    /**
     * 포맷팅 지원함수.
     * @param unknown_type $lunarYear
     * @param unknown_type $lunarMonth
     * @param unknown_type $lunarDate
     * @param unknown_type $isLeapMonth
     * @param unknown_type $fmt
     */
    static function formatLunar2($lunarYear, $lunarMonth, $lunarDate, $isLeapMonth, $fmt)
    {
        switch ($fmt)
        {
            case 'Y-m-d':
                $lunarYMD = sprintf('%04d-%02d-%02d', $lunarYear, $lunarMonth, $lunarDate);
                break;
            case 'YmdL':
                $lunarYMD = sprintf('%04d%02d%02d%s', $lunarYear, $lunarMonth, $lunarDate, $isLeapMonth ? 'L' : ' ');
                break;
        }
        return $lunarYMD;
    }

    /**
     * getLunarDate의 쓰기 편한 형태
     * 2010-03-18 형태로 아규먼트를 넣을수 있음.
     *
     * @param unknown_type $Y_m_d
     */
    function getLunarDateYmd($Y_m_d)
    {
        //      print_r('$Y_m_d' .$Y_m_d);
        $format = "Y-m-d";
        $tm = date_parse_from_format($format, $Y_m_d);
        $year = $tm["year"];
        $month = $tm["month"];
        $date = $tm["day"];
        //      print_r($tm);
        return $this->getLunarDate($year, $month, $date);
    }
    /**
     *
     * 음력으로 돌려줌.
     * 반환은 아래 형태
            Array
            (
                [year] => 2050
                [month] => 03
                [date] => 9
                [is_leap_month] => 0 // 윤달 여부, 1이면 윤달.
            )
     * 계산 범위 초과시 null
     * @param unknown_type $year
     * @param unknown_type $month
     * @param unknown_type $date
     */
    function getLunarDate($year, $month, $date)
    {
        $this->error = "";
        list($nearSol, $nearLuna) = $this->_getNearData($year, $month, $date);

        if (empty($nearSol))
            return null;

        //키와 입력과의 날짜 차이만금, lunarPinDate에 더한다.  
        $targetJD = cal_to_jd(CAL_GREGORIAN, $month, $date, $year);
        $keyJD = cal_to_jd(CAL_GREGORIAN, substr($nearSol, 4, 2), substr($nearSol, 6, 2), substr($nearSol, 0, 4));

        $diff = $targetJD - $keyJD;

        $lunarYear = substr($nearLuna, 0, 4);
        $lunarMonth = substr($nearLuna, 4, 2);
        $lunarDate = substr($nearLuna, 6, 2);
        $lunarLeapMonth = substr($nearLuna, 8, 1);

        $lunarDate += $diff;
        return array(
            'year' => $lunarYear,
            'month' => $lunarMonth,
            'date' => $lunarDate,
            'is_leap_month' => $lunarLeapMonth == 'L' ? 1 : 0,
        );
    }

    function _getNearData($year, $month, $date)
    {
        $ym = sprintf('%d%02d', $year, $month);
        $ymd = sprintf('%d%02d%02d', $year, $month, $date);

        if (false == isset($this->SolarToLunar[$ym]))
        {
            $this->error = '계산할수 있는 범위가 아닙니다.';
            return null;
        }
        $pair = $this->SolarToLunar[$ym];
        $lastLuna = '';
        $lastSol = "";
        //      print_r($pair);
        foreach ($pair as $sol => $luna)
        {
            //          print_r('$ymd < $keys[$i]    ' . "$ymd < $keys[$i]\n");
            //      print_r("$ymd $sol  $luna");
            if ($ymd < $sol)
            {
                return array(
                    $lastSol,
                    $lastLuna
                );
            }
            else if ($ymd == $sol)
            {
                return array(
                    $sol,
                    $luna
                );
            }
            $lastSol = $sol;
            $lastLuna = $luna;
        }
        return array(
            $lastSol,
            $lastLuna
        );
    }
    /**
     * 음력에 대응하는 양력 날짜 구하기.
     * @param unknown_type $lunarYear
     * @param unknown_type $lunarMonth
     * @param unknown_type $lunarDate
     * @param unknown_type $isLeapMonth
     */
    function getSolarDate($lunarYear, $lunarMonth, $lunarDate, $isLeapMonth = false)
    {
        $this->error = "";

        $nearKey = sprintf('%d%02d%02d%s', $lunarYear, $lunarMonth, 1, $isLeapMonth ? 'L' : ' ');

        if (false == isset($this->LunarToSolar[$nearKey]))
        {
            $this->error = '계산할수 있는 범위가 아닙니다.';
            return null;
        }

        $solarPinDate = $this->LunarToSolar[$nearKey];

        //키와 입력과의 날짜 차이만금, $solarPinDate 더한다.  
        $keyDate = substr($nearKey, 6, 2);
        $keyIsLeapMonth = ('L' == substr($nearKey, 8, 1) ? true : false);
        if ($keyIsLeapMonth != $isLeapMonth)
        {
            $this->error = ($isLeapMonth ? "윤달" : "평달") . "$lunarYear-$lunarMonth-$lunarDate" . '는 없음.';
            return null;
        }

        $diff = $lunarDate - $keyDate;

        $date = DateTime::createFromFormat('Ymd', $solarPinDate);
        //      print_r($date);
        $date->add(new DateInterval('P' . $diff . 'D'));
        //      print_r($date);

        return $date->format('Y-m-d');
    }
}

	$LunarCalendar = new LunarCalendar();
	
	
	$priceArr=array("0"=>"8000",
					"1"=>"6000",
					"2"=>"6000",
					"3"=>"6000",
					"4"=>"6000",
					"5"=>"8000",
					"6"=>"8000");
	$holidayArr = array("01-01","03-01","05-05","06-06","08-15","10-03","10-09","12-25");
	$lunarHolidayArr = array("12-29","01-01","01-02","04-08","08-14","08-15","08-16");

	$day=ceil((strtotime($enddate)-strtotime($startdate))/86400)+1;
	$weekPrice=0;
	if($day!="1"){
		for($i=0;$i<$day;$i++){
			$days=date("m-d",strtotime($startdate)+(86400*$i));
			//음력환산
			$liftDays=explode("-",date("Y-m-d",strtotime($startdate)+(86400*$i)));
			$lunarDate=$LunarCalendar->getLunarDate($liftDays[0],$liftDays[1], $liftDays[2]);
			$rst = substr($LunarCalendar->formatLunar($lunarDate),"5","10");
			
			//양력 공휴일
			if(array_search($days,$holidayArr)){
				$week="0";
			//음력공휴일
			}else if(-1<array_search($rst,$lunarHolidayArr)!=""){
				
				$week="0";
			}else{
				$week=date("w",ceil(strtotime($startdate)+(86400*$i)));	
			}
			$weekPrice+=$priceArr[$week];
		}
	}else{
		$weekPrice=8000;
	}

	if(0<$day){
		$jsonArray["day"]=$day."일";
		$jsonArray["price"]=number_format($weekPrice);
		$jsonArray["wr_8"]=$weekPrice;
	}else{
		$week=date("w",strtotime($startdate));
		$price=ceil(((strtotime($endTime)-strtotime($startTime))/3600))*2000;
		$day=ceil((strtotime($endTime)-strtotime($startTime))/3600);
		if($weekPrice[$week]<$price){
			$price=$priceArr[$week];
		}
		$jsonArray["day"]=$day."시간";
		$jsonArray["price"]=number_format($price);
		$jsonArray["wr_8"]=$price;
	}
	$output=json_encode($jsonArray,JSON_UNESCAPED_UNICODE);
		echo $output;
?>