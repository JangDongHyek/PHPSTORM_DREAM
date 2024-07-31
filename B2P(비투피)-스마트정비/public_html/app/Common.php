<?php
require_once(APPPATH . '/Libraries/common.lib.php');
require_once(APPPATH . '/Libraries/db.lib.php');
require_once(APPPATH . '/Libraries/data.lib.php');
/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

define("GMAC_KEY","sa8zrfoOdkmz5VqPLhxAgg==");
define("GMAC", "gmarket_auction");
define("GMAC_CAR_CATE", "00300000000000000000");

define("AC","auction");
define("AC_CAR_CATE", "04000000");

define("GM","gmarket");
define("GM_CAR_CATE", "100000030");

// 나이스본인인증
define("NICE_SITECODE","CD833");
define("NICE_SITEPASSWD", "ORxOLTTOscqW");
define("CB_ENCODE_PATH", APPPATH . 'ThirdParty/CPClient/CPClient_linux_x64');

// 나이스계좌인증
define("BANK_SITECODE","NID208691");
define("BANK_SITEPASSWD", "00000000");