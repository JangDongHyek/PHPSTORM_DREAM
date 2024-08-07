<?php

namespace CatchLocSDK;

class CatchLoc
{
	private $baseUrl = 'http://cms.catchloc.com/';

	private $endpoints = array(
		'last_location' => 'api.get.member.location.last.php',
		'location_list' => 'api.get.member.location.list.php',
		'objects'       => 'api.get.member.info.all.php',
		'group_common'  => 'api.partner.common.php',
	);

	private $groupApiCodes = array(
		'list'          => 'api.common.group.get.list',
		'with_object'   => 'api.common.group.get.object.group.list',
		'members'       => 'api.common.group.get.group.object.list',
		'create'        => 'api.common.group.set.add',
		'edit_name'     => 'api.common.group.set.modify',
		'remove'        => 'api.common.group.set.delete',
		'remove_member' => 'api.common.group.set.object.delete',
		'add_member'    => 'api.common.group.set.object.add'
	);

	private $timestamp = 'n';
	private $apiKey    = 'n';
	private $serverKey = 'n';

	public function __construct($apiKey = '', $serverKey = '')
	{
		$this->timestamp = time();
		$this->apiKey    = $apiKey;
		$this->serverKey = $serverKey;
	}

	public function setApiKey($apiKey)
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	public function setServerKey($serverKey)
	{
		$this->serverKey = $serverKey;

		return $this;
	}

	public function getLastData($memberKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiName = 'last_location';

		$params = array(
			'api_key'    => $this->apiKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function getDataBetween24Hours($memberKey, $fromDate, $toDate)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiName = 'location_list';

		$params = array(
			'api_key'    => $this->apiKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey(),
			'from_date'  => $fromDate,
			'to_date'    => $toDate
		);

		return $this->getAPI($apiName, $params);
	}

	public function getObjectsData($memberKey, $page)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiName = 'objects';

		$params = array(
			'api_key'    => $this->apiKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey(),
			'page'       => $page
		);

		return $this->getAPI($apiName, $params);
	}

	public function getGroups($memberKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiCodeKey = 'list';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'        => $this->groupApiCodes[$apiCodeKey],
			'api_key'    => $this->apiKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function getGroupsWithObject($memberKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiCodeKey = 'with_object';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'        => $this->groupApiCodes[$apiCodeKey],
			'api_key'    => $this->apiKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function getGroupMembers($groupKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiCodeKey = 'members';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'       => $this->groupApiCodes[$apiCodeKey],
			'api_key'   => $this->apiKey,
			'group_key' => $groupKey,
			'timestamp' => $this->timestamp,
			'cert_key'  => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function createGroup($groupName)
	{
		$apiCodeKey = 'create';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'        => $this->groupApiCodes[$apiCodeKey],
			'api_key'    => $this->apiKey,
			'group_name' => $groupName,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function editGroupName($groupKey, $newGroupName)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiCodeKey = 'edit_name';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'        => $this->groupApiCodes[$apiCodeKey],
			'api_key'    => $this->apiKey,
			'group_key'  => $groupKey,
			'group_name' => $groupName,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function removeGroup($groupKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}
		
		$apiCodeKey = 'remove';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'       => $this->groupApiCodes[$apiCodeKey],
			'api_key'   => $this->apiKey,
			'group_key' => $groupKey,
			'timestamp' => $this->timestamp,
			'cert_key'  => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function addGroupMember($groupKey, $memberKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}

		$apiCodeKey = 'add_member';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'        => $this->groupApiCodes[$apiCodeKey],
			'api_key'    => $this->apiKey,
			'group_key'  => $groupKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	public function removeGroupMember($groupKey, $memberKey)
	{
		if (!$this->hasKey())
		{
			return array(
				'result' => 'FAIL',
				'message' => 'key'
			);
		}

		$apiCodeKey = 'remove_member';
		$apiName    = 'group_' . $apiCodeKey;

		$params = array(
			'api'        => $this->groupApiCodes[$apiCodeKey],
			'api_key'    => $this->apiKey,
			'group_key'  => $groupKey,
			'member_key' => $memberKey,
			'timestamp'  => $this->timestamp,
			'cert_key'   => $this->getCertKey()
		);

		return $this->getAPI($apiName, $params);
	}

	private function hasKey()
	{
		if ($this->apiKey === 'n' || $this->serverKey === 'n')
		{
			return false;
		}

		$this->setTimestamp();

		return true;
	}

	private function setTimestamp()
	{
		if ($this->timestamp === 'n')
		{
			$this->timestamp = time();
		}
	}

	private function unsetTimestamp()
	{
		$this->timestamp = 'n';
	}

	private function getCertKey()
	{
		$apiKey    = $this->apiKey;
		$serverKey = $this->serverKey;
		$timestamp = $this->timestamp;

		$hashString = $timestamp."|".$apiKey."|".$serverKey;
		$hashed     = sha1($hashString);
		$hashKey    = substr("0000000".trim($hashed), -40);

		return $hashKey;
	}

	private function getResponseType($apiName, $params)
	{
		if ($apiName !== 'group_common')
		{
			if ($apiName === 'last_location')
			{
				return 'map';
			}

			if ($apiName === 'location_list' || $apiName === 'objects')
			{
				return 'array';
			}
		}

		$apiCode = $params['api'];
		$apiCodeParts = explode('.', $apiCode);
		$lastApiCodePartsIdx = count($apiCodeParts) - 1;

		if ($apiCodeParts[$lastApiCodePartsIdx] === 'list')
		{
			return 'array';
		}
		else
		{
			return 'map';
		}
	}

	private function getApi($apiName, $params = array())
	{
		$baseUrl  = $this->baseUrl;
		$endpoint = $this->getEndpoint($apiName);
		$apiUrl   = $baseUrl . $endpoint;

		$url = $apiUrl.'?'.http_build_query($params, '', '&');
		$ch  = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

		$resMap = json_decode($response, true);

		$resultMap = array();

		$r = $response;

		if (!array_key_exists('result', $resMap))
		{
			$resultMap['result']  = 'ok';
			$resultMap['type']    = $this->getResponseType($apiName, $params);
			$resultMap['message'] = $resMap;

			$r = json_encode($resultMap);
		}

		curl_close($ch);

		$this->unsetTimestamp();

		return $r;
	}

	private function getEndpoint($apiName)
	{
		$endpoint = '';

		$apiNameParts = explode('_', $apiName);
		$prefix = $apiNameParts[0];

		if ($prefix === 'group')
		{
			$endpoint = $this->endpoints['group_common'];
		}
		else
		{
			$endpoint = $this->endpoints[$apiName];
		}

		return $endpoint;
	}
}