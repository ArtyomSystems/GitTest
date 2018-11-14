<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="euc-jp">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/head.html'; ?>
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>��������ɽ | ������� - �ƥ�ӡ��饸���ǳؤ��̿������</title>
<meta name="googlebot" content="noindex">
<meta name="keywords" content="����ɽ,��������ɽ,�ذ�,���,�̿�, �ֺ�,�ػ�,����,���,����饤��,�����ؽ�,��������">
<meta name="description" content="������ؤΡֽ�������ɽ�פ˴ؤ���ڡ����Ǥ���">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/styles.html'; ?>
<link rel="stylesheet" href="/assets/common/styles/bangumi.css">

<!-- old source -->
<link rel="stylesheet" href="/assets/common/styles/bangumi.css">
<script type="text/javascript" src="script/main.js" charset="euc-jp"></script>
<script type="text/javascript" src="script/print.js"></script>
<script type="text/javascript" src="script/image.js"></script>
</head>
<!-- old source -->
<?php
  include("sub.php");
  site_view();
?>
<body id="category-5">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/tagmanager_01.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/skipnav/g_1cols.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/header.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/gnav.html'; ?>

<div id="mod-content" class="mod-1cols">
<p class="mod-skipnav"><a id="contentStart" name="contentStart">����������ʸ�Ǥ�</a><!-- /mod-skipnav --></p>
<div id="mod-main">
<div id="mod-main-inner">
<div id="mod-breadcrumb">
<ul>
<li><a href="/"><img src="/assets/common/images/mod-breadcrumb/home_btn_01.gif" width="24" height="28" alt="�ۡ���"></a></li>
<li><a href="/hp/bangumi/">����ɽ</a></li>
<li>��������ɽ</li>
</ul>
<!-- /mod-breadcrumb --></div>

<div id="mod-article">

<div class="mod-hdg-lv1-01 ico-bangumi">
<h1>��������ɽ</h1>
<span class="mod-bangumi2-h1-ico"><img src="assets/images/ico_h1_fm.gif" width="97" height="38" alt="�饸����"></span>
<!-- /hdg-lv1-01 --></div>

<h4>&gt;���Ȳ��ܰ���ʥ���Х��ˤ�<a href="http://www.ouj.ac.jp/hp/kamoku/" class="mod-link-01">������</a></h4>
<p>&nbsp;</p>
<div class="mod-section-bangumi">
<div class="program-header">
<div class="button-area">
<div id="btn-bangumi-program" class="button-left">
<?php
	$now_month = get_month();
	$now_date = get_date();
	echo "<p class='mod-btn'><a href='/hp/bangumi2/bangumi.php?month=".$now_month."&date=".$now_date."' class='tv-btn'><img src='assets/images/bangumi2_btn_01.png' width='102' height='76' alt='�ƥ��'></a></p>\n";
	echo "<p class='mod-btn stay'><a href='/hp/bangumi2/bangumi_radio.php?month=".$now_month."&date=".$now_date."' class='fm-btn'><img src='assets/images/bangumi2_btn_02.png' width='102' height='76' alt='�饸��'></a></p>\n";
?>
<!-- /button-left --></div>
<div class="button-right">
<p class="mod-link-support"><a href="/hp/bangumi/howto.html">��İ��ˡ</a></p>
<p class="mod-btn"><a href="/hp/bangumi/year_tv.html"><img src="assets/images/bangumi2_btn_03.png" width="123" height="30" alt="ǯ������ɽ"></a></p>
<!-- /button-right --></div>
<!-- /button-area --></div>

<div class="mod-scroll-tab">
<p class="btn-left"><img src="assets/images/bangumi2_arrow_left.png" width="25" height="24" alt=""></p>
<div class="list-tab-daily">
<div class="list-tab-daily-inner">
<ul>
<?php
	$now_month = get_month();
	$now_date = get_date();
	echo "<script type='text/javascript'>\n";
	echo "<!--\n";
	echo "set_Calendar_Display('FM',".$now_month.", ".$now_date.");\n";
	echo "//-->\n";
	echo "</script>\n";
?>
</ul>
<!-- /list-tab-daily-inner --></div>
<!-- /list-tab-daily --></div>
<p class="btn-right"><img src="assets/images/bangumi2_arrow_right.png" width="25" height="24" alt=""></p>
<!-- /mod-scroll-tab --></div>
<!-- /program-header --></div>

<div class="program-content">
<div class="programe-time-area">
<p class="mod-time"><span>
<?php 
//  2014.06.15 k.hamada modified *** AM,PM����ɽ�� ***
//echo date('A H:i');
echo date('H:i');
?>
</span></p>
<!-- /programe-time-area --></div>

<?php
	/*--- 2018-08-27 add k.h ----------------------*
	 * BS�������ϰʹߤǤ��뤫Ƚ�Ǥ���              *
	 * 2018/10/01�ʹߡ�BS����                      *
	 * 0 :������ͥ������   1 :BS�������ͥ����� *
	 *---------------------------------------------*/
	$now_month = get_month();
	$now_date = get_date();

	$BS2_flg = check_BS2($now_month, $now_date);
?>

<div class="program-tab">
<div id="fm-program" class="program-details">
<div class="current-details">
<?php if ( $BS2_flg == 0 ) { ?>
	<div class="fixed-title"><img src="/hp/bangumi2/assets/images/bangumi2_tit_02.gif" width="896" height="38" alt="�饸������"></div>
<?php } else { ?>
	<div class="fixed-title"><img src="/hp/bangumi2/assets/images/bangumi2_tit_06.gif" width="896" height="39" alt="�饸������"></div>
<?php } ?>

<table class="tbl-current-program">
<colgroup>
<col style="width:32px">
<col style="width:850px;">
</colgroup>
<tr class="current-program">
<th>���λ�����</th>
<td>
<?php
	if ( $BS2_flg == 0 ) {
		set_Export_Onair("FM", "FM", $BS2_flg);
	} else {
		set_Export_Onair("BSR", "BSR", $BS2_flg);
	}
?>
</td>
<!-- /tbl-current-program --></table>
<!-- /current-details --></div>
<?php
	if ( $BS2_flg == 0 ) {
		set_Export_Data("FM", $BS2_flg);
	} else {
		set_Export_Data("BSR", $BS2_flg);
	}
?>
<!-- /program-details --></div>


<!-- /program-tab --></div>
<!-- /program-content --></div>
<!-- /mod-section-bangumi --></div>



<!-- /mod-article --></div>
<!-- /mod-main-inner --></div>
<!-- /mod-main --></div>


<!-- /mod-content --></div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/footer.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/scripts.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/common/includes/euc/tagmanager_02.html'; ?>
</body>
</html>