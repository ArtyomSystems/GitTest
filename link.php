<?php

set_Database_Connect();

set_Bangumi_Connect();

//¥Ç¡¼¥¿¥Ù¡¼¥¹¤Ø¥Ç¡¼¥¿¤òÁ÷¤ê¤Þ¤¹
function set_Database_Connect() {

//***¥Æ¥¹¥È¡¦¥Ç¡¼¥¿¥Ù¡¼¥¹***
//	$SERVER="localhost";
//	$USERNAME="root";
//	$PASSWORD="";
//	$DBNAME="bangumi";				/** µì¥Ç¡¼¥¿¥Ù¡¼¥¹ **/
	//$DBNAME="weekbangumi";		/** ¿·¥Ç¡¼¥¿¥Ù¡¼¥¹(aouto increment ÀßÄêÍ­¤ê)

//***ËÜÈÖ¥Ç¡¼¥¿¥Ù¡¼¥¹***
	$SERVER="localhost";
	$USERNAME="oujuser";
	$PASSWORD="ouj20100401";
	$DBNAME="bangumi";				/** µì¥Ç¡¼¥¿¥Ù¡¼¥¹ **/
	//$DBNAME="weekbangumi";		/** ¿·¥Ç¡¼¥¿¥Ù¡¼¥¹(aouto increment ÀßÄêÍ­¤ê)**/
//***ËÜÈÖ¥Ç¡¼¥¿¥Ù¡¼¥¹***

//¡ÖMysql¡×¥µ¡¼¥Ð¤ËÀÜÂ³¤¹¤ë
	$conn = mysql_connect($SERVER, $USERNAME, $PASSWORD);
	if (!$conn){
		die("¡ÚMySQL Server¡Û¤ËÀÜÂ³¤Ç¤­¤Þ¤»¤ó¡£");
	}

//¡Öbangumi¡×¥Ç¡¼¥¿¥Ù¡¼¥¹¤òÀÜÂ³¤¹¤ë
	mysql_select_db($DBNAME, $conn) or die("¥Ç¡¼¥¿¥Ù¡¼¥¹¤¬ÁªÂò¤Ç¤­¤Þ¤»¤ó.".mysql.error($conn));

// *** start added k.hamada 2014/0605
	mysql_query('set character set eucjpms');
	mysql_set_charset("eucjpms"); 
// *** end added k.hamada 2014/0605

	mysql_query("TRUNCATE table bangumidata", $conn);

	$arr_Link = get_Link_Sankyu();

//print_r($arr_Link);


	//$int_ID = 0;
	$int_ID = 1;

	for($i=0; $i<count($arr_Link); $i=$i+2) {
		$sql = "INSERT INTO bangumidata VALUES ($int_ID, '".$arr_Link[$i]."', '".$arr_Link[$i + 1]."')";
		mysql_query( $sql, $conn);
		$int_ID ++;
	}
//**********************************
//***  ¥ê¥ó¥¯¤ò¼êÆþ¤ì¤Þ¤¹        ***
//**********************************
//ÊüÁ÷Âç³Ø¥¤¥á¡¼¥¸¥½¥ó¥°¡¦³Ø²Î
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÊüÁ÷Âç³Ø¥¤¥á¡¼¥¸¥½¥ó¥°¡¦³Ø²Î', 'https://www.ouj.ac.jp/hp/gaiyo/school_song.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;

//*** 2018-09-07 add *start*
//­¡BS¥­¥ã¥ó¥Ñ¥¹exÆÃ½¸
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'BS¥­¥ã¥ó¥Ñ¥¹exÆÃ½¸', 'https://bangumi.ouj.ac.jp/bslife/category01.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­¢¡È²Ê³Ø¡É¤«¤é¤Î¾·ÂÔ¾õ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¡È²Ê³Ø¡É¤«¤é¤Î¾·ÂÔ¾õ', 'https://bangumi.ouj.ac.jp/bslife/category02.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­£¸ø³«¹ÖºÂ¥»¥ì¥¯¥·¥ç¥ó
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¸ø³«¹ÖºÂ¥»¥ì¥¯¥·¥ç¥ó', 'https://bangumi.ouj.ac.jp/bslife/category03.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­¤ÆÃÊÌ¹ÖµÁ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÆÃÊÌ¹ÖµÁ', 'https://bangumi.ouj.ac.jp/bslife/category04.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­¥¥¯¥í¥¹Æ¤ÏÀ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¥¯¥í¥¹Æ¤ÏÀ', 'https://bangumi.ouj.ac.jp/bslife/category05.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­¦¥¹¥Ú¥·¥ã¥ë¹Ö±é
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¥¹¥Ú¥·¥ã¥ë¹Ö±é', 'https://bangumi.ouj.ac.jp/bslife/category06.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­§£±£¶ÈÖÌÜ¤Î¼ø¶È
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '£±£¶ÈÖÌÜ¤Î¼ø¶È', 'https://bangumi.ouj.ac.jp/bslife/category07.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­¨ÊüÁ÷Âç³Ø¥¢¡¼¥«¥¤¥Ö¥¹¡¦ÃÎ¤ÎÈâ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÊüÁ÷Âç³Ø¥¢¡¼¥«¥¤¥Ö¥¹¡¦ÃÎ¤ÎÈâ', 'https://bangumi.ouj.ac.jp/bslife/category08.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­©¤â¤¦°ìÅÙ¤ß¤¿¤¤Ì¾¹ÖµÁ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¤â¤¦°ìÅÙ¤ß¤¿¤¤Ì¾¹ÖµÁ', 'https://bangumi.ouj.ac.jp/bslife/category09.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­ª³Ø½¬¥»¥ó¥¿¡¼¤á¤°¤ê
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '³Ø½¬¥»¥ó¥¿¡¼¤á¤°¤ê', 'https://bangumi.ouj.ac.jp/bslife/category10.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­«¥Ç¡¼¥¿¥µ¥¤¥¨¥ó¥¹
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¥Ç¡¼¥¿¥µ¥¤¥¨¥ó¥¹', 'https://bangumi.ouj.ac.jp/bslife/category11.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­¬¥µ¥¤¥Ð¡¼¥»¥­¥å¥ê¥Æ¥£
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¥µ¥¤¥Ð¡¼¥»¥­¥å¥ê¥Æ¥£', 'https://bangumi.ouj.ac.jp/bslife/category12.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//­­ÆÃÊÌÈÖÁÈ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÆÃÊÌÈÖÁÈ', 'https://bangumi.ouj.ac.jp/bslife/category99.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//*** 2018-09-07 add *end*

//2018-07-06 add *start*
//ÆÃÊÌÈÖÁÈ  <=== 18-09-07 Deleted
//	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÆÃÊÌÈÖÁÈ', 'https://bangumi.ouj.ac.jp/life/tokuban.html')";
//	mysql_query( $sql, $conn);
//	$int_ID ++;
//¤â¤¦°ìÅÙ¤ß¤¿¤¤Ì¾¹ÖµÁ¡ÁÊüÁ÷Âç³Ø¥¢¡¼¥«¥¤¥Ö¥¹
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¤â¤¦°ìÅÙ¤ß¤¿¤¤Ì¾¹ÖµÁ¡ÁÊüÁ÷Âç³Ø¥¢¡¼¥«¥¤¥Ö¥¹', 'https://bangumi.ouj.ac.jp/life/archives.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//ÆÃÊÌ¹ÖµÁ  <=== 18-09-07 Deleted
//	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÆÃÊÌ¹ÖµÁ', 'https://bangumi.ouj.ac.jp/life/index.html')";
//	mysql_query( $sql, $conn);
//	$int_ID ++;
//ÊüÁ÷Âç³Ø¥­¥ã¥ó¥Ñ¥¹¥¬¥¤¥É
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'ÊüÁ÷Âç³Ø¥­¥ã¥ó¥Ñ¥¹¥¬¥¤¥É', 'https://bangumi.ouj.ac.jp/life/calendar.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//2018-07-06 add *end*

//£Ô£è£á£ô¡Ç£ó¡¡ÊüÁ÷Âç³Ø¡ÁÂç³Ø¤ÎÁë
	// repair 2013/10/11 start
	//$sql = "INSERT INTO bangumidata VALUES ($int_ID, '£Ô£è£á£ô¡Ç£ó¡¡ÊüÁ÷Âç³Ø¡ÁÂç³Ø¤ÎÁë', 'http://www.ouj.ac.jp/hp/eizou/that/st_top.html')";
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '£Ô£è£á£ô¡Ç£ó¡¡ÊüÁ÷Âç³Ø¡ÁÂç³Ø¤ÎÁë', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	// repair 2013/10/11 end
	mysql_query( $sql, $conn);
	$int_ID ++;
//2017-11-15 ÄÉ²Ã
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '£Ô£è£á£ô¡Ç£óÊüÁ÷Âç³Ø¡ÁÂç³Ø¤ÎÁë', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//2017-11-15 ÄÉ²Ã

// delete 2013/10/11 start
/*
//Âç³Ø¤ÎÁë
    $str_Nam = "http://www.ouj.ac.jp/hp/eizou/mado/tv/jm_h2";
    $str_year = substr(get_Heiseiyear(), 1, 1);
    for($i = $str_year; $i>=0; $i--) {
      $str_Name = $str_Nam.$i.".html";
      if ($fp = fopen ($str_Name, "r")) {
        //¥Õ¥¡¥¤¥ë¤òÊÄ¤¸¤ë
        fclose ($fp);
        break;
      }
      else {
        $str_Name = "";
      }
    }
    if($str_Name != "") {
      $sql = "INSERT INTO bangumidata VALUES ($int_ID, 'Âç³Ø¤ÎÁë', '".$str_Name."')";
      mysql_query( $sql, $conn);
      $int_ID ++;
    }
*/
// add 2013/10/11 start
//¼ø¶È²ÊÌÜ°ÆÆâ¡ÁÂç³Ø¤ÎÁë¡Á
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¼ø¶È²ÊÌÜ°ÆÆâ¡ÁÂç³Ø¤ÎÁë¡Á', 'https://www.ouj.ac.jp/hp/eizou/annai/kiban/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//¼ø¶È²ÊÌÜ°ÆÆâ¡ÁÂç³Ø¤ÎÁë
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¼ø¶È²ÊÌÜ°ÆÆâ¡ÁÂç³Ø¤ÎÁë', 'https://www.ouj.ac.jp/hp/eizou/annai/kiban/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//Âç³Ø¤ÎÁë
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'Âç³Ø¤ÎÁë', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//£Ô£è£á£ô¡Ç£óÊüÁ÷Âç³Ø
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '£Ô£è£á£ô¡Ç£óÊüÁ÷Âç³Ø', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//¤¢¤Ê¤¿¤ÎÃÎ¤ê¤¿¤¤ÊüÁ÷Âç³Ø
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '¤¢¤Ê¤¿¤ÎÃÎ¤ê¤¿¤¤ÊüÁ÷Âç³Ø', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
// add 2013/10/11 end
	
	mysql_close($conn);

}

/**--------------------**
 ** ÏÂÎñÊÑ´¹ÍÑ¤Î´Ø¿ô
 **--------------------**/
function get_Heiseiyear()
{
    $now = getdate();
    $y = $now["year"];
    $m = $now["mon"];
    $d = $now["mday"];

    //Ç¯·îÆü¤òÊ¸»úÎó¤È¤·¤Æ·ë¹ç
    $ymd = sprintf("%02d%02d%02d", $y, $m, $d);
    if ($ymd <= "19120729") {
        $yy = $y - 1867;
    } elseif ($ymd >= "19120730" && $ymd <= "19261224") {
        $yy = $y - 1911;
    } elseif ($ymd >= "19261225" && $ymd <= "19890107") {
        $yy = $y - 1925;
    } elseif ($ymd >= "19890108") {
        $yy = $y - 1988;
    }
    return $yy;
}


/**----------------------------------------------------------------------------**
 ** ¼ø¶È²ÊÌÜ°ÆÆâ¤Î.html¥½¡¼¥¹¤è¤ê¥ê¥ó¥¯Àè¤ò¼èÆÀ
 ** ¡¡¶µÍÜ³ØÉô
 ** ¡¡Âç³Ø±¡½¤»Î²ÝÄø
 ** ¡¡Âç³Ø±¡Çî»Î¸å´ü²ÝÄø
 **----------------------------------------------------------------------------**/
//3µé¤Î¥ê¥ó¥¯¤«¤é¥ê¥ó¥¯¤ò¼èÆÀ
function get_Link_Sankyu() {

//H30-02-05 ºÆ½¤Àµ -----------------------------------------------------
//H29-11-20 ½¤Àµ -------------------
// H29/12 ¤è¤êH30Ç¯ÅÙ¤Î¥·¥é¥Ð¥¹¤ò¹­Êó¥Ú¡¼¥¸¤ÇÉ½¼¨¤·¤¿¤¤¡£
// ÈÖÁÈÉ½¤Ï¡¢H29Ç¯ÅÙ¤Î¥·¥é¥Ð¥¹¤òÉ½¼¨¤·¤¿¤¤¡£
// ¿·Ç¯ÅÙ(H30)¤Ë¤Ê¤Ã¤¿¤é¸µ¤Ë¤â¤É¤¹¤³¤È¡£
//
// "20180323" ÀÚÂØÆü¤Î³ÎÇ§¤Ï¡¢¹­Êó²Ý(ÃæÀî»á)¤ÈÂÇ¤Á¹ç¤ï¤»¤¿
//
//	$str_Moto_Link = "http://www.ouj.ac.jp/hp/kamoku/index.html";

	$YMD = get_Today();

//H30-07-04 ½¤Àµ -------------------
	if ($YMD < "20190322") {
	    $str_Moto_Link = "https://www.ouj.ac.jp/hp/kamoku/h30index.html";
	} else {
    	$str_Moto_Link = "https://www.ouj.ac.jp/hp/kamoku/index.html";
	}
//H29-11-20 ½¤Àµ -------------------
//H30-02-05 ºÆ½¤Àµ ------------------------------------------------------

	$arr_Moto_Link = get_Moto_Link($str_Moto_Link);

//echo('<pre>');
//var_dump($arr_Moto_Link);
//echo('</pre>');

	$arr_Link_Nikyu = get_Link_Nikyu($arr_Moto_Link);

//echo('<pre>');
//var_dump($arr_Link_Nikyu);
//echo('</pre>');

	$int_ID = 0;
	$arr_bangum = array();

	for($i = 0; $i<count($arr_Link_Nikyu); $i++) {

		$str = file_get_contents($arr_Link_Nikyu[$i]);

		$str = mb_convert_encoding($str, "EUC-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

		preg_match_all("|<a href=\"(.*?)\".*?>(.*?)</a>|mis",$str,$matches);

		$cnt_row = 0;

		foreach ($matches[1] as $urlvalue) {

//echo('<pre>');
//var_dump($urlvalue);
//echo('</pre>');

			$int_Start_Pos = strpos($urlvalue, "//www.wakaba.ouj.ac.jp/kyoumu");

//echo('<pre>');
//var_dump($int_Start_Pos);
//echo('</pre>');

			if($int_Start_Pos) {
				$arr_bangumi[$int_ID] = get_Change_Link($matches[2][$cnt_row]);

				$arr_bangumi[$int_ID + 1] = trim($urlvalue);
				$int_ID = $int_ID + 2;
			}

			$cnt_row = $cnt_row + 1;

		}
 
	} //**end for **

/******* 2018-07-04 ****************************************************************************
//¡¡¥·¥é¥Ð¥¹¤ÎURL¼èÆÀÊýË¡¤ÎÊÑ¹¹¤Î¤¿¤á¡¢°Ê²¼Ì¤»ÈÍÑ

//	for($i = 0; $i<count($arr_Link_Nikyu); $i++) {
	for($i = 0; $i<1; $i++) {
		if ($fp = fopen ($arr_Link_Nikyu[$i], "r")) {
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);

				// mb_language('Japanese');  // added k.hamada 2014/06/05 ¼öÊ¸
				// $str_Row = mb_convert_encoding($str_Row, "eucjp-win", "auto");
				// auto »ØÄê¤Ïphp,ini ¸À¸ìÀßÄê¤ò¼õ¤±¤ë¤Î¤Ç´í¸±
				$str_Row = mb_convert_encoding($str_Row, "EUC-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

				$str_Row = trim($str_Row);
				$str_Key = "<a";
				$int_Start_Pos = strpos($str_Row, $str_Key);
				if($int_Start_Pos) {
					$str_Key = ".html\">";
					$int_End_Pos = strpos($str_Row, $str_Key);
					if($int_End_Pos) {
						$str_Sub_Link = trim(substr($str_Row, $int_Start_Pos + 9, $int_End_Pos - $int_Start_Pos - 4));
						if (! strpos($str_Sub_Link, "index.html")) {
							$str_Moto_Link = substr($arr_Link_Nikyu[$i], 0, strlen($arr_Link_Nikyu[$i])-strlen("index.html"));
							if(preg_match("/^..\/..\/..\/..\//", $str_Sub_Link, $matches)) {
								$int_Moto_Link = strpos($arr_Link_Nikyu[$i],"H");
								$str_Moto_Link = substr($arr_Link_Nikyu[$i], 0, $int_Moto_Link);
								$int_Sub_Link = strpos($str_Sub_Link,"H");
								$str_Sub_Link = substr($str_Sub_Link, $int_Sub_Link);
							}
							elseif(preg_match("/^..\/..\/..\//", $str_Sub_Link, $matches))  {
								$int_Moto_Link = strpos($arr_Link_Nikyu[$i],"H");
								$str_Moto_Link = substr($arr_Link_Nikyu[$i], 0, $int_Moto_Link);
								$int_Sub_Link = strpos($str_Sub_Link,"H");
								$str_Sub_Link = substr($str_Sub_Link, $int_Sub_Link);
							}
							$int_Start_Ketpost = $int_End_Pos;
							$str_Key = "</a>";
							$int_End_Ketpost = strpos($str_Row, $str_Key);
							if (($int_End_Ketpost) && ($int_End_Ketpost > $int_Start_Ketpost)) {
								$str_Key = trim(substr($str_Row, $int_Start_Ketpost + strlen(".html\">"), $int_End_Ketpost - $int_Start_Ketpost - strlen(".html\">")));
								
								$arr_bangumi[$int_ID] = get_Change_Link(trim($str_Key));
								
								$arr_bangumi[$int_ID + 1] = trim($str_Moto_Link.$str_Sub_Link);
								$int_ID = $int_ID + 2;
							}
						}
					}
				}
			}  //** end while **

	         //¥Õ¥¡¥¤¥ë¤òÊÄ¤¸¤ë
    	    fclose ($fp) ;
		}
	} //**end for ***
*******************************************************************/

//echo('<pre>');
//var_dump($arr_bangumi);
//echo('</pre>');

	return($arr_bangumi);

}


/**----H30-20-05 Add K.hamada-----------**
 ** ¸½ºß¤ÎÆüÉÕ¤ò¼èÆÀ(YYYYMMDD)
 ** 4·î1Æü·Ð²á¤òÈ½ÃÇ¤¹¤ë°Ù
 **------------------------------------**/
function get_Today()
{
    $now = getdate();
    $y = $now["year"];
    $m = $now["mon"];
    $d = $now["mday"];

    //Ç¯·îÆü¤òÊ¸»úÎó¤È¤·¤Æ·ë¹ç
    $ymd = sprintf("%02d%02d%02d", $y, $m, $d);

    return $ymd;
}


/**----------------------------------------------------**
 ** ½µ´ÖÈÖÁÈÉ½Web¥Ú¡¼¥¸¤òÉ½¼¨
 **----------------------------------------------------**/
//Bangumi¥µ¥¤¥È¤Ø°ÜÆ°¤Þ¤¹
function set_Bangumi_Connect(){

	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "location.href = \"bangumi.php\"\n";
	echo "// -->\n";
	echo "</script>\n";

}

/**---------------------------------------------------------**
 ** ¼ø¶È²ÊÌÜ°ÆÆâ¤Îindex.html¥½¡¼¥¹¤è¤ê¥ê¥ó¥¯Àè¤ò¼èÆÀ¤¹¤ë¡£
 ** ¡¡¶µÍÜ³ØÉô
 ** ¡¡¡¡/H28/kyouyou/C/index.html
 ** ¡¡Âç³Ø±¡½¤»Î²ÝÄø
 ** ¡¡¡¡/H28/daigakuin/B/index.html
 ** ¡¡Âç³Ø±¡Çî»Î¸å´ü²ÝÄø
 ** ¡¡¡¡/H28/hakase/index.html
 **---------------------------------------------------------**/
//¸µ¥ê¥ó¥¯¤«¤é¥ê¥ó¥¯¤ò¼èÆÀ
function get_Moto_Link($str_Moto_Link) {

	//H30-02-05 Add K.hamada-------------
	$YMD = get_Today();
	//H30-02-05 Add K.hamada-------------

	if ($fp = fopen ($str_Moto_Link, "r")) {
		$arr_count = 0;
		while (! feof ($fp)) {
			$str_Row = fgets ($fp, 4096);

			// mb_language('Japanese');  // added k.hamada 2014/06/05 ¼öÊ¸
			// auto »ØÄê¤Ïphp,ini ¸À¸ìÀßÄê¤ò¼õ¤±¤ë¤Î¤Ç´í¸±
			// $str_Row = mb_convert_encoding($str_Row, "EUC-JP", "auto");
			$str_Row = mb_convert_encoding($str_Row, "EUC-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

			$str_Row = trim($str_Row);
			$str_Key = "<a";
			$int_Start_Pos = strpos($str_Row, $str_Key);
			if($int_Start_Pos) {
				$str_Key = ".html\">";
				$int_End_Pos = strpos($str_Row, $str_Key);
				if($int_End_Pos) {
					$str_Sub_Link = trim(substr($str_Row, $int_Start_Pos + 9, $int_End_Pos - $int_Start_Pos - 4));
					if(! preg_match("/^..\//", $str_Sub_Link, $matches)) {
//H30-02-05 ºÆ½¤Àµ --------------------------------------
//H29-11-20 ½¤Àµ -------------------
//¿·Ç¯ÅÙ(H30)¤Ë¤Ê¤Ã¤¿¤é¸µ¤Ë¤â¤É¤¹¤³¤È¡£
		              //$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Sub_Link;
        		      //$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("h29index.html")).$str_Sub_Link;
//H29-11-20 ½¤Àµ -------------------
//H30-07-04 ½¤Àµ -------------------
						if ($YMD < "20190322") {
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("h30index.html")).$str_Sub_Link;
						} else {
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Sub_Link;
						}
//H30-02-05 ºÆ½¤Àµ --------------------------------------

						$arr_count ++;

					/**--------------------------------------------------------------**
					 ** ¼ø¶È²ÊÌÜ°ÆÆâ¤Î index.html ¥½¡¼¥¹¤Ë¤Ï¡¢A,B¥Æ¥£¥ì¥¯¥È¥ê¾ðÊó
					 ** (¥ê¥ó¥¯Àè¾ðÊó)¤Ï´Þ¤Þ¤ì¤Æ¤¤¤Ê¤¤¡£
					 ** ¡¡¶µÍÜ³ØÉô¤Ï¡¢A¡¢B¡¢C¤¬Â¸ºß¤¹¤ë¤¬¡¢C¤¬A¡¢B¤òÊñ´Þ¤·¤Æ¤¤¤ë¡£
					 ** ¡¡Âç³Ø±¡(½¤»Î²ÝÄø)¤Ï¡¢B¤Î¤ßÂ¸ºß¤¹¤ë¡£
					 ** ¡¡¸å´üÇî»Î²ÝÄø¤Ë¤Ï¡¢ABC¤ÏÂ¸ºß¤·¤Ê¤¤¡£
					 **------- 2016-09-12 deleted by HSJ)k.h --------------------------**
						$int_Apos = strpos($str_Sub_Link, "B", 1);
						if($int_Apos) {
							$str_Alink = substr($str_Sub_Link, 0, $int_Apos)."A/index.html";
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Alink;
							$arr_count ++;
						}
						$int_Bpos = strpos($str_Sub_Link, "A", 1);
						if($int_Bpos) {
							$str_Blink = substr($str_Sub_Link, 0, $int_Apos)."B/index.html";
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Blink;
							$arr_count ++;
						}
					 **------- 2016-09-12 deleted by HSJ)k.h --------------------------**/

					}
				}
			}
		}
		//¥Õ¥¡¥¤¥ë¤òÊÄ¤¸¤ë
		fclose ($fp) ;
	}
/**----------------------------------------------------------------------------------------------**
 ** ÅöÇ¯ÅÙ³«Àß¤Î¥·¥é¥Ð¥¹¤Ø¤·¤«¥ê¥ó¥¯¤·¤Ê¤¤¡£
 ** ¤è¤Ã¤Æ¡¢²áµî¤Î¥·¥é¥Ð¥¹¤Î¥ê¥ó¥¯Àè¤ò¼èÆÀ¤¹¤ëÉ¬Í×¤Ï¤Ê¤¤¡£
 ** (²áµî¤ÎÈÖÁÈÍÑ¥·¥é¥Ð¥¹¤ÏÂ¸ºß¤·¤Ê¤¤¡£)
 **------- 2016-09-12 deleted by HSJ)k.h --------------------------------------------------------**
//H21 ¤«¤é¤Î¥µ¥¤¥È¤ò¼èÆÀ
	$int_Length = count($arr_Moto_Link);
	for($i = 0; $i < count($arr_Moto_Link); $i++) {
		$int_Post   = strpos($arr_Moto_Link[$i], "H2", 1);
		if($int_Post) {
			$str_Search  = substr($arr_Moto_Link[$i], $int_Post, 3);
			$str_Year    = substr($str_Search, 2, 1);
			if(is_numeric($str_Year)) {
				$str_Repeat = $str_Year - 1;
				for($j = 1; $j<=$str_Repeat; $j++) {
					$str_Replace = "H2".$j;
					$str_After_Replace = str_replace($str_Search, $str_Replace, $arr_Moto_Link[$i]);
					$arr_Moto_Link[count($arr_Moto_Link)] = $str_After_Replace;
				}
			}

		}
	}

//H19, H20 ¤Î¥µ¥¤¥È¤ò¼èÆÀ
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H20/kyouyou/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H20/daigakuin/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H19/kyouyou/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H19/daigakuin/index.html";
 **------- 2016-09-12 deleted by HSJ)k.h --------------------------------------------------------**/

	return($arr_Moto_Link);

}

/**----------------------------------------------------------------------------**
 ** ¶µÍÜ³ØÉô¡¢Âç³Ø±¡½¤»Î²ÝÄø¡¢Âç³Ø±¡Çî»Î¸å´ü²ÝÄø¤Î³Æindex.html¥½¡¼¥¹¤è¤ê
 ** ¥«¥ê¥­¥å¥é¥àÊÌ¤Î¥ê¥ó¥¯Àè¤ò¼èÆÀ¤¹¤ë¡£
 ** ¡¡¶µÍÜ³ØÉô¡ÊÎã¡Ë
 **     [0] => http://www.ouj.ac.jp/hp/kamoku/H28/kyouyou/C/kiban_kiban/index.html
 **     [1] => http://www.ouj.ac.jp/hp/kamoku/H28/kyouyou/C/kiban_gaikokugo/index.html
 **
 ** ¡¡Âç³Ø±¡½¤»Î²ÝÄø¡ÊÎã¡Ë
 **     [12] => http://www.ouj.ac.jp/hp/kamoku/H28/daigakuin/B/seikatu/index.html
 **     [13] => http://www.ouj.ac.jp/hp/kamoku/H28/daigakuin/B/ningen/index.html
 **
 ** ¡¡Âç³Ø±¡Çî»Î¸å´ü²ÝÄø¡ÊÎã¡Ë
 **     [20] => http://www.ouj.ac.jp/hp/kamoku/H28/hakase/kiban_seikatu/index.html
 **     [21] => http://www.ouj.ac.jp/hp/kamoku/H28/hakase/kiban_ningen/index.html
 **
 **----------------------------------------------------------------------------**/
//2µé¤Î¥ê¥ó¥¯¤«¤é¥ê¥ó¥¯¤ò¼èÆÀ
function get_Link_Nikyu($arr_Moto_Link) {

	$arr_count = 0;

	for($i = 0; $i<count($arr_Moto_Link); $i++) {

		if ($fp = fopen ($arr_Moto_Link[$i], "r")) {
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);

				// mb_language('Japanese');  // added k.hamada 2014/06/05 ¼öÊ¸
				// auto »ØÄê¤Ïphp,ini ¸À¸ìÀßÄê¤ò¼õ¤±¤ë¤Î¤Ç´í¸±
				// $str_Row = mb_convert_encoding($str_Row, "EUC-JP", "auto");
				$str_Row = mb_convert_encoding($str_Row, "EUC-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

				$str_Row = preg_replace(array('/&szlig;/','/&(..)lig;/', '/&([aouAOU])uml;/','/&(.)[^;]*;/'), array('ss',"$1","$1".'e',"$1"), $str_Row);
				$str_Row = trim($str_Row);
				$str_Key = "<a";
				$int_Start_Pos = strpos($str_Row, $str_Key);
				if($int_Start_Pos) {
					$str_Key = ".html\">";
					$int_End_Pos = strpos($str_Row, $str_Key);
					if($int_End_Pos) {
						$str_Sub_Link = trim(substr($str_Row, $int_Start_Pos + 9, $int_End_Pos - $int_Start_Pos - 4));
						if((! preg_match("/^..\//", $str_Sub_Link, $matches)) && (! preg_match("/^info_map/", $str_Sub_Link, $matches)) && (strcmp($str_Sub_Link,"index.html") != 0)) {
							$arr_2kyu_Link[$arr_count] = substr($arr_Moto_Link[$i], 0, strlen($arr_Moto_Link[$i])-strlen("index.html")).$str_Sub_Link;
							$arr_count ++;
						}
					}
				}
			} /** end while **/
			//¥Õ¥¡¥¤¥ë¤òÊÄ¤¸¤ë
			fclose ($fp) ;
		}
	} /** end for **/
	
	return($arr_2kyu_Link);

}

/**------------------------------------**
 //µ­¹æ¤ÎÊÑ´¹
 **------------------------------------**/
function get_Change_Link($str) {

	$str = str_replace('"', '¡É', $str);
	$str = str_replace("'", "¡Ç", $str);
	$str = str_replace("¡½", "¡¼", $str);
	$str = str_replace("-", "¡¼", $str);
	$str = str_replace("¡Ý", "¡¼", $str);
	$str = str_replace("\\", "¡ï", $str);

/**----- µ¡¼ï°ÍÂ¸Ê¸»úÂÐ±þ 2016-09-13 HSJ)k.h ---------------**/
	$str = str_replace("&#8544;", "£±", $str);
	$str = str_replace("&#8545;", "£²", $str);
	$str = str_replace("&#8546;", "£³", $str);
	$str = str_replace("&#8547;", "£´", $str);
	$str = str_replace("&#8548;", "£µ", $str);
	$str = str_replace("&#8549;", "£¶", $str);
	$str = str_replace("&#8550;", "£·", $str);
	$str = str_replace("&#8551;", "£¸", $str);
	$str = str_replace("&#8552;", "£¹", $str);
	$str = str_replace("&#8553;", "£±£°", $str);

	$str = mb_ereg_replace("­µ", "£±", $str);
	$str = mb_ereg_replace("­¶", "£²", $str);
	$str = mb_ereg_replace("­·", "£³", $str);
	$str = mb_ereg_replace("­¸", "£´", $str);
	$str = mb_ereg_replace("­¹", "£µ", $str);
	$str = mb_ereg_replace("­º", "£¶", $str);
	$str = mb_ereg_replace("­»", "£·", $str);
	$str = mb_ereg_replace("­¼", "£¸", $str);
	$str = mb_ereg_replace("­½", "£¹", $str);
	$str = mb_ereg_replace("­¾", "£±£°", $str);
/**---- Á´³Ñ¿ô»ú¤ËÊÑ´¹ ---------------------------------------**
// add 2013/10/11 start thuong
	$str = mb_ereg_replace("­µ", "1", $str);
	$str = mb_ereg_replace("­¶", "2", $str);
	$str = mb_ereg_replace("­·", "3", $str);
	$str = mb_ereg_replace("­¸", "4", $str);
	$str = mb_ereg_replace("­¹", "5", $str);
	$str = mb_ereg_replace("­º", "6", $str);
	$str = mb_ereg_replace("­»", "7", $str);
	$str = mb_ereg_replace("­¼", "8", $str);
	$str = mb_ereg_replace("­½", "9", $str);
	$str = mb_ereg_replace("­¾", "10", $str);
	// add 2013/10/11 end thuong
 **---- µ¡¼ï°ÍÂ¸Ê¸»úÂÐ±þ 2016-09-13 HSJ)k.h -------------------**/

//	$str = mb_convert_kana($str, A, "EUC-JP");
	$str = mb_convert_kana($str, "A", "EUC-JP"); // modified k.hamada 2014/06/05
	
	return($str);

}

?>
