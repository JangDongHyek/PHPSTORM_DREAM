-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: busandrugCi3
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bs_board`
--

DROP TABLE IF EXISTS `bs_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_board` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제 여부',
  `category` varchar(30) DEFAULT NULL COMMENT '게시판구분',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '아이디',
  `mb_name` varchar(30) DEFAULT NULL COMMENT '이름',
  `fix_yn` char(1) DEFAULT 'N' COMMENT '상단고정여부',
  `title` varchar(100) DEFAULT NULL COMMENT '제목',
  `content` longtext COMMENT '내용',
  `view_cnt` int(11) DEFAULT '0' COMMENT '조회수',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '수정/삭제일자',
  `mod_mb_id` varchar(30) DEFAULT NULL COMMENT '수정자 아이디',
  `file_name_json` text COMMENT '파일명',
  `secret_yn` char(1) DEFAULT 'N' COMMENT '비밀글 여부',
  `ref_idx` int(11) DEFAULT '0' COMMENT '상품인덱스',
  `state` char(1) DEFAULT '1' COMMENT '처리상태',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='게시판';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_board_comment`
--

DROP TABLE IF EXISTS `bs_board_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_board_comment` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제 여부',
  `board_idx` int(11) DEFAULT '0' COMMENT '원글 인덱스',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '작성자 아이디',
  `mb_name` varchar(30) DEFAULT NULL COMMENT '작성자명',
  `content` longtext COMMENT '내용',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '수정/삭제일자',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='게시판 코멘트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_config`
--

DROP TABLE IF EXISTS `bs_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_config` (
  `cf_delivery_fee` int(11) DEFAULT '0' COMMENT '기본배송비',
  `cf_free_ship_over_amt` int(11) DEFAULT '0' COMMENT '조건부무료배송금액',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '등록/수정일자'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='기본설정';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_member`
--

DROP TABLE IF EXISTS `bs_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_member` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `auth_yn` char(1) DEFAULT 'N' COMMENT '승인 여부',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제 여부',
  `misu_yn` char(1) DEFAULT 'N' COMMENT '미수업체 여부',
  `group_idx` int(11) DEFAULT '1' COMMENT '그룹 인덱스',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '아이디',
  `mb_password` varchar(200) DEFAULT NULL COMMENT '비밀번호',
  `mb_name` varchar(25) DEFAULT NULL COMMENT '이름',
  `mb_birth` varchar(10) DEFAULT NULL COMMENT '생년월일',
  `mb_hp` varchar(20) DEFAULT NULL COMMENT '휴대폰번호',
  `mb_level` int(11) DEFAULT '5' COMMENT '등급',
  `cn_name` varchar(40) DEFAULT NULL COMMENT '한의원명',
  `biz_rno` varchar(13) DEFAULT NULL COMMENT '사업자등록번호',
  `cn_addr` varchar(200) DEFAULT NULL COMMENT '기본주소',
  `cn_addr_detail` varchar(200) DEFAULT NULL COMMENT '상세주소',
  `cn_zcode` char(5) DEFAULT NULL COMMENT '우편번호',
  `rep_name` varchar(30) DEFAULT NULL COMMENT '대표자명',
  `biz_type` varchar(30) DEFAULT NULL COMMENT '업태',
  `cn_tel` varchar(15) DEFAULT NULL COMMENT '대표전화',
  `cn_fax` varchar(15) DEFAULT NULL COMMENT '팩스번호',
  `cn_email` varchar(200) DEFAULT NULL COMMENT '이메일',
  `file_nm_biz` varchar(200) DEFAULT NULL COMMENT '사업자등록증(면허증) 파일명',
  `file_nm_contract` varchar(200) DEFAULT NULL COMMENT '원외탕전실 계약서 파일명',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '수정일자',
  `auth_date` varchar(30) DEFAULT NULL COMMENT '승인 처리일자',
  `login_ip` varchar(20) DEFAULT NULL COMMENT '로그인 아이피',
  `login_date` varchar(30) DEFAULT NULL COMMENT '마지막 로그인일자',
  `user_agent` varchar(200) DEFAULT NULL COMMENT '로그인 정보',
  PRIMARY KEY (`idx`),
  UNIQUE KEY `mb_id_UNIQUE` (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='회원';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_member_group`
--

DROP TABLE IF EXISTS `bs_member_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_member_group` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제 여부',
  `group_name` varchar(30) DEFAULT NULL COMMENT '그룹명',
  `premium_rate` float DEFAULT '0' COMMENT '할증률',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '수정일자',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='회원/한의원 그룹관리';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_misu`
--

DROP TABLE IF EXISTS `bs_misu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_misu` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제 여부',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '아이디',
  `trans_type` varchar(20) DEFAULT NULL COMMENT '거래구분',
  `trans_date` varchar(30) DEFAULT NULL COMMENT '거래일자',
  `trans_content` varchar(250) DEFAULT NULL COMMENT '거래내용',
  `credit_price` int(11) DEFAULT '0' COMMENT '외상금액',
  `deposit` int(11) DEFAULT '0' COMMENT '입금액',
  `balance` int(11) DEFAULT '0' COMMENT '잔액',
  `sales_price` int(11) DEFAULT '0' COMMENT '(월말결제 외 나머지 결제 건) 잔액에 계산되지 않는 매출금액',
  `ord_idx` int(11) DEFAULT '0' COMMENT '주문 인덱스',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '수정일자',
  `del_date` varchar(30) DEFAULT NULL COMMENT '삭제일자',
  `sort` int(11) DEFAULT '0' COMMENT '잔액계산후 재정렬번호 (ASC)',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='한의원 미수금 관리';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_order`
--

DROP TABLE IF EXISTS `bs_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_order` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `del_yn` char(1) DEFAULT 'N',
  `tmp_save_yn` char(1) DEFAULT 'N' COMMENT '임시저장여부',
  `mb_id` varchar(100) DEFAULT NULL COMMENT '아이디',
  `ord_no` varchar(20) DEFAULT NULL COMMENT '주문번호',
  `ord_status` char(2) DEFAULT 'R' COMMENT '주문상태',
  `payment_status` char(1) DEFAULT 'R' COMMENT '결제상태',
  `ord_cancel_yn` char(1) DEFAULT 'N' COMMENT '주문취소요청여부',
  `ord_cancel_date` varchar(30) DEFAULT NULL COMMENT '주문취소요청 일자',
  `delivery_fee` int(11) DEFAULT '0' COMMENT '배송비',
  `subtotal_price` int(11) DEFAULT '0' COMMENT '상품금액',
  `order_price` int(11) DEFAULT '0' COMMENT '총주문금액',
  `use_point` int(11) DEFAULT '0' COMMENT '사용포인트',
  `discount_price` int(11) DEFAULT '0' COMMENT '할인금액',
  `total_price` int(11) DEFAULT '0' COMMENT '총금액',
  `prod_name` varchar(200) DEFAULT NULL COMMENT '상품명(|구분)',
  `tracking_no` varchar(300) DEFAULT NULL COMMENT '운송장번호',
  `courier` varchar(10) DEFAULT NULL COMMENT '택배사',
  `ord_name` varchar(30) DEFAULT NULL COMMENT '주문자 이름',
  `ord_zcode` varchar(5) DEFAULT NULL COMMENT '주문자 우편번호',
  `ord_addr` varchar(100) DEFAULT NULL COMMENT '주문자 기본주소',
  `ord_addr_detail` varchar(100) DEFAULT NULL COMMENT '주문자 상세주소',
  `ord_tel` varchar(15) DEFAULT NULL COMMENT '주문자 연락처',
  `rec_name` varchar(30) DEFAULT NULL COMMENT '받는사람 이름',
  `rec_zcode` varchar(5) DEFAULT NULL COMMENT '받는사람 우편번호',
  `rec_addr` varchar(100) DEFAULT NULL COMMENT '받는사람 기본주소',
  `rec_addr_detail` varchar(100) DEFAULT NULL COMMENT '받는사람 상세주소',
  `rec_tel` varchar(15) DEFAULT NULL COMMENT '받는사람 연락처',
  `rec_memo` varchar(100) DEFAULT NULL COMMENT '배송요청사항',
  `pay_method` varchar(10) DEFAULT 'CARD' COMMENT '결제수단',
  `cash_issue_type` char(1) DEFAULT '3' COMMENT '발행선택',
  `invoice_biz_num` varchar(100) DEFAULT NULL COMMENT '계산서 사업자번호',
  `invoice_email` varchar(100) DEFAULT NULL COMMENT '계산서 이메일',
  `invoice_rep_name` varchar(100) DEFAULT NULL COMMENT '계산서 대표자명',
  `cash_receipt_type` char(1) DEFAULT '1' COMMENT '현금영수증 발급분류',
  `cash_receipt_auth_num` varchar(100) DEFAULT NULL COMMENT '현금영수증 휴대폰번호or사업자번호',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `ord_date` datetime DEFAULT NULL COMMENT '정렬일자(최종결제일자)',
  `ord_fin_date` varchar(10) DEFAULT NULL COMMENT '주문상태 `배송완료` 변경일자',
  `refund_point_yn` char(1) DEFAULT 'N' COMMENT '주문취소시 포인트환불 여부',
  `mod_date` datetime DEFAULT NULL COMMENT '수정일자(삭제일자)',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='주문서';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_order_item`
--

DROP TABLE IF EXISTS `bs_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_order_item` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `ord_idx` bigint(20) unsigned DEFAULT '0' COMMENT '주문 인덱스',
  `product_idx` int(11) DEFAULT '0' COMMENT '상품 인덱스 인덱스',
  `item_name` varchar(100) DEFAULT NULL COMMENT '상품명',
  `item_price` int(11) DEFAULT '0' COMMENT '상품 가격',
  `item_cnt` int(11) DEFAULT '0' COMMENT '상품 수량',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '아이디',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  PRIMARY KEY (`idx`),
  KEY `idx_ord_product` (`product_idx`,`ord_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COMMENT='주문서 상품정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_payment`
--

DROP TABLE IF EXISTS `bs_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_payment` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `pay_status` char(1) DEFAULT 'F' COMMENT '결제상태',
  `pay_method` varchar(10) DEFAULT NULL COMMENT '지불수단',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '아이디',
  `goods_cnt` int(11) DEFAULT '0' COMMENT '상품수량',
  `goods_name` varchar(40) DEFAULT NULL COMMENT '상품명',
  `amt` int(11) DEFAULT '0' COMMENT '거래금액',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `cancel_date` varchar(30) DEFAULT NULL COMMENT '취소일자',
  `cancel_mb_id` varchar(30) DEFAULT NULL COMMENT '취소처리 아이디',
  `moid` varchar(100) DEFAULT NULL COMMENT '주문번호',
  `tid` varchar(100) DEFAULT NULL COMMENT 'PG거래번호',
  `auth_date` varchar(100) DEFAULT NULL COMMENT '승인일자',
  `auth_code` varchar(100) DEFAULT NULL COMMENT '승인번호',
  `result_code` varchar(100) DEFAULT NULL COMMENT '결과코드',
  `result_msg` varchar(100) DEFAULT NULL COMMENT '결과메시지',
  `mall_reserved` varchar(100) DEFAULT NULL COMMENT '상점예비정보',
  `fn_code` varchar(5) DEFAULT NULL COMMENT '결제카드사코드',
  `fn_name` varchar(100) DEFAULT NULL COMMENT '결제카드사명',
  `acqu_card_code` varchar(5) DEFAULT NULL COMMENT '매입사 코드',
  `acqu_card_name` varchar(100) DEFAULT NULL COMMENT '매입사카드명',
  `card_quota` varchar(5) DEFAULT NULL COMMENT '할부개월수',
  `receipt_type` varchar(5) DEFAULT NULL COMMENT '현금영수증용도구분',
  `vbank_exp_date` varchar(10) DEFAULT NULL COMMENT '가상계좌 입금기한',
  `vbank_name` varchar(30) DEFAULT NULL COMMENT '가상계좌 은행명',
  `vbank_num` varchar(30) DEFAULT NULL COMMENT '가상계좌번호',
  `vbank_account_name` varchar(30) DEFAULT NULL COMMENT '입금자명',
  `error_msg` varchar(100) DEFAULT NULL COMMENT '메시지',
  `error_code` varchar(10) DEFAULT NULL COMMENT '에러코드',
  `mid` varchar(20) DEFAULT NULL COMMENT '상점ID',
  `noti_pg_app_date` varchar(20) DEFAULT NULL COMMENT '(노티) PG 승인일자',
  `noti_pg_app_time` varchar(20) DEFAULT NULL COMMENT '(노티) PG 승인시간',
  `noti_pg_result_code` varchar(20) DEFAULT NULL COMMENT '(노티) PG 결과코드',
  `noti_pg_result_msg` varchar(150) DEFAULT NULL COMMENT '(노티) PG 결과 메시지',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='결제';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_popup`
--

DROP TABLE IF EXISTS `bs_popup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_popup` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `target` char(1) DEFAULT 'C' COMMENT '노출 대상',
  `display_position` char(1) DEFAULT '0' COMMENT '노출 위치',
  `hide_duration_hour` int(11) DEFAULT '24' COMMENT '다시보지않을 시간',
  `start_date` varchar(30) DEFAULT NULL COMMENT '시작시간',
  `end_date` varchar(30) DEFAULT NULL COMMENT '종료시간',
  `layer_left` int(11) DEFAULT '0' COMMENT '팝업 좌측 위치',
  `layer_top` int(11) DEFAULT '0' COMMENT '팝업 상단 위치',
  `title` varchar(30) DEFAULT NULL COMMENT '제목',
  `file_nm` varchar(100) DEFAULT NULL COMMENT '이미지 파일명',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='팝업 관리';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_product`
--

DROP TABLE IF EXISTS `bs_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_product` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제 여부',
  `use_yn` char(1) DEFAULT 'Y' COMMENT '노출 여부',
  `category` char(4) DEFAULT 'CA01' COMMENT '카테고리',
  `first_consonant` char(1) DEFAULT NULL COMMENT '초성카테고리',
  `prod_order` int(11) DEFAULT '0' COMMENT '정렬',
  `prod_name` varchar(100) DEFAULT NULL COMMENT '상품명',
  `prod_price` int(11) DEFAULT '0' COMMENT '기본판매가격',
  `prod_origin` varchar(100) DEFAULT NULL COMMENT '원산지',
  `package_method` varchar(100) DEFAULT NULL COMMENT '포장방법',
  `prod_format` varchar(100) DEFAULT NULL COMMENT '상품구성',
  `shipping_info` varchar(100) DEFAULT NULL COMMENT '배송안내',
  `shipping_free_yn` char(1) DEFAULT 'N' COMMENT '무료배송 여부',
  `pay_method_list` varchar(40) DEFAULT NULL COMMENT '결제방법(콤마구분)',
  `content` longtext COMMENT '상세설명',
  `file_name_list` text COMMENT '이미지 파일명(콤마구분)',
  `soldout_yn` char(1) DEFAULT 'N' COMMENT '임시품절 여부',
  `md_rec_yn` char(1) DEFAULT 'N' COMMENT 'MD추천여부',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mod_date` varchar(30) DEFAULT NULL COMMENT '수정/삭제일자',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='상품';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bs_product_cart`
--

DROP TABLE IF EXISTS `bs_product_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_product_cart` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `add_cart_yn` char(1) DEFAULT 'N' COMMENT '장바구니등록 or 바로구매하기',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '아이디',
  `product_idx` bigint(20) unsigned DEFAULT '0' COMMENT '상품 인덱스',
  `product_cnt` int(11) DEFAULT '0' COMMENT '기본상품수량',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `ord_idx` int(10) unsigned DEFAULT '0' COMMENT '주문 인덱스 (주문 후 삭제용)',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COMMENT='장바구니';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test_table`
--

DROP TABLE IF EXISTS `test_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_table` (
  `content` varchar(200) DEFAULT NULL,
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='테스트?!';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-22 16:12:47
