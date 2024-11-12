<?php
include 'class.seed.php';
class Crypto
{
	private $block= 16; 

	//TEST��ĪŰ �Դϴ�. EZWEL�� ���� �� EZWEL�� �����Ͽ� ��ĪŰ�� �����ž� �մϴ�.(16�ڸ� ����)
	public $pbUserKey	= 'jam20131218XXXXX'; 


	private $paddingValue = 0;
	private $pdwRoundKey = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32);

	public function __contruct()
	{
		
	}

	public function encrypt($str)
	{
		$str = iconv("EUC-KR", "UTF-8", $str);
		
		$planBytes = array_slice(unpack('c*',$str), 0);  
		if (count($planBytes) == 0) {
			return $str;
		}

		$paddingResult = null;
		for ($i=0; $i < count($planBytes); $i++) 
  		{
  			$paddingResult .= $planBytes[$i];
			}

		$seed = new Seed();
		$seed->SeedRoundKey($this->pdwRoundKey, array_slice(unpack('c*',$this->pbUserKey), 0)); // ����Ű ����


		$inDataBuffer = $this->addPadding($planBytes,$this->block);

		
		$encryptBytes = null;
		$rt = count($inDataBuffer) / $this->block;

		for ($i=0; $i < $rt; $i++) 
		{
			$sSource = null;
			$sTarget = null;
			
			$this->arraycopy($inDataBuffer, ($i * $this->block) , $sSource, 0, $this->block);
			$seed->SeedEncrypt($sSource, $this->pdwRoundKey, $sTarget); // ��ȣ����� SEED�� ��ȣȭ
			$this->arraycopy($sTarget, 0, $encryptBytes,($i * $this->block),count($sTarget));
		}
		return base64_encode(call_user_func_array("pack", array_merge(array("c*"), $encryptBytes)));  

	}

	public function decrypt($str)
	{
		$str = iconv("EUC-KR", "UTF-8", $str);
		$str =  base64_decode($str);
		
		$planBytes = array_slice(unpack('c*',$str), 0); // ���� ����Ʈ �迭�� ��ȯ  
		if (count($planBytes) == 0) {
			return $str;
		}
		
		$seed = new Seed();
		$seed->SeedRoundKey($this->pdwRoundKey, array_slice(unpack('c*',$this->pbUserKey), 0)); // ����Ű ����
		
		$rt = count($planBytes) / $this->block;
		$sSource = null;
		$sTarget = null;
		$decryptBytes = null;
		
		for ($i=0; $i < $rt; $i++) 
		{	
			$this->arraycopy($planBytes, ($i * $this->block) , $sSource, 0, $this->block);
			$seed->SeedDecrypt($sSource, $this->pdwRoundKey, $sTarget); // ��ȣ����� SEED�� ��ȣȭ
			$this->arraycopy($sTarget, 0, $decryptBytes,($i * $this->block),$this->block);
		}
		

		$decryptBytesPadding = $this->removePadding($decryptBytes,$this->block);	
		
		$decryptBytesPaddingResult = null;
		for ($i=0; $i < count($decryptBytesPadding); $i++) 
		{
			  $decryptBytesPaddingResult .= chr($this->convertMinus128($decryptBytesPadding[$i]));
		}
		
		return $decryptBytesPaddingResult;
		
	}
	
	/**
	 * Java�� arraycopy �Լ��� php�� ����
	 * ���� �迭�� �ش� ��ġ���� ������ ���� ������ �迭�� ��ġ�� ������ ���̸�ŭ ��ġ��������, ������ �迭�� ��ȯ
	 *
	 * @param array $src Source array.
	 * @param integer $srcPos Start position of source array.
	 * @param array $dest Destination array.
	 * @param integer $destPos Start position of destination array.
	 * @param integer $length Integer to count the arrays of..
	 *
	 * @return array Return destination source array.
	 */
	public function arraycopy($src, $srcPos, &$dest, $destPos, $length)
	{
		for ($i=$srcPos; $i < $srcPos+$length; $i++) {
			$dest[$destPos] = $src[$i];
			$destPos++;
		}
	}


	/**
	 * Bytes���� Minus 128 ǥ�������� ��ȯ
	 * 32bit���� Bytes��ü�� 8��° �ڸ����� 1�� ��� ������ ǥ��
	 * 64bit���� ����� ǥ���Ǳ� ������ ������ ������ 32bit�� �ν��ϰ��� �����÷ο� ���� ������ ǥ��ǵ��� ��ȯ ������
	 *
	 * @param mixed[] $bytes Array of bytes or continuous string of hex.
	 *
	 * @return array List of hex lists or string of hex.
	 */
	private function convertMinus128($bytes)
	{
		if(PHP_INT_SIZE > 4) { // 64��Ʈ�� �ƴ� ��� �״�� ���
			return $bytes;
		}

		if (is_array($bytes)) {
			$ret = array();
			foreach($bytes as $val) {
				$ret[] = (($val+128) % 256) -128;
			}
			return $ret;
		}
		return (($bytes+128) % 256) -128;
	}

 /**
	 * ��û�� Block Size�� ���߱� ���� Padding�� �߰��Ѵ�.
	 * 
	 * @param source
	 *            byte[] �е��� �߰��� bytes
	 * @param blockSize
	 *            int block size
	 * @return byte[] �е��� �߰� �� ��� bytes
	 */
  public function addPadding($planBytes, $block)
  {
  	
  	$paddingResult = array();
  	$paddingCnt = count($planBytes) % $block;
  	$addPaddingCnt = $block - $paddingCnt;
  	
  	if($paddingCnt != 0) 
  	{
  		$this->arraycopy($planBytes, 0, $paddingResult, 0, count($planBytes));
  		
  		for ($i=0; $i < $addPaddingCnt; $i++) 
  		{
  			$paddingResult[count($planBytes)+$i] = $this->paddingValue;
			}
  		$paddingResult[count($paddingResult) - 1] = $addPaddingCnt;
  		
  		return $paddingResult;
  	} else {
			return $planBytes;
		}
		
		
  }
  /**
	 * ��û�� Block Size�� ���߱� ���� �߰� �� Padding�� �����Ѵ�.
	 * 
	 * @param source
	 *            byte[] �е��� ������ bytes
	 * @param blockSize
	 *            int block size
	 * @return byte[] �е��� ���� �� ��� bytes
	 */
  public function removePadding($planBytes, $block)
  {
  	$paddingResult = array();
  	$isPadding = FALSE; 

  	$lastValue = $planBytes[count($planBytes)-1];

  	if($lastValue <= ($block -1)) 
  	{
  		$zeroPaddingCount = $lastValue -1;
  		for ($i=2; $i < ($zeroPaddingCount+2); $i++) 
  		{
  			if($planBytes[count($planBytes)-1] != $this->paddingValue)
  			{
  				$isPadding = FALSE;
  				break;
  			}
			}
			$isPadding = TRUE;	
  		
  	} else {

			$isPadding = FALSE;
  		
  	}
  	
  
  	if($isPadding)
  	{
  		$paddingResultCount = count($planBytes) - $lastValue;
  		$this->arraycopy($planBytes, 0, $paddingResult, 0, $paddingResultCount);
  	}	else {
  	
  		$paddingResult = $planBytes;
  	}
  
  	
		return $paddingResult;
  	
  }
  
}
