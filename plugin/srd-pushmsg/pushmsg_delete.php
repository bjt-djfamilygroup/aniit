<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
/*
	프로그램 : srd_pushmsg 
	그누보드5의 알림서비스 플러그인
	ver . beta 0.1
	개발자 : salrido@korea.com
	그누보드 : rido
	개발일 : 2015 05 29
	- 세상만사 다 귀찮다 -_- 킁 먹고살기 힘들다.
	- 소스 수정 / 사용은 알아서들 하시고 재배포 및 소스포함시 저작권만 유지해주세요 
	- 수정시 수정사항을 메일로 피드백 해주시면 감사하겠습니다.
*/

$date = G5_TIME_YMD;
$where = 'and (';
$fori = 0;
foreach ($chk_bn_id as $value) {
	if($fori ==0) {
		$where .= "msg_id = {$value}";
	} else {
		$where .= " or msg_id = {$value}";
	} 	
	$fori++;
}
$where .= ')';

if ($p_type == 'del') {					//삭제처리
$query = "
		delete from {$g5['g5_srd_pushmsg']}  where mb_id = '{$member['mb_id']}' 
		{$where}
	";	
} else if ($p_type == 'read') {		//읽음처리
	$query = "
		update {$g5['g5_srd_pushmsg']}  set msg_check = 'y' , msg_date = '{$date}' where mb_id = '{$member['mb_id']}' 
		{$where}
	";
}
//echo $query;
@sql_query ($query);
?>

<script>
	alert('해당 알림이 수정/삭제 되었습니다.');
	var href = "<?php echo G5_URL?>/plugin/srd-pushmsg/?page=<?php echo $page?>";
	document.location.replace(href);
</script>