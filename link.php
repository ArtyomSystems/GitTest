<?php

set_Database_Connect();

set_Bangumi_Connect();

//データベースへデータを送ります
function set_Database_Connect() {

//***テスト・データベース***
//	$SERVER="localhost";
//	$USERNAME="root";
//	$PASSWORD="";
//	$DBNAME="bangumi";				/** 旧データベース **/
	//$DBNAME="weekbangumi";		/** 新データベース(aouto increment 設定有り)

//***本番データベース***
	$SERVER="localhost";
	$USERNAME="oujuser";
	$PASSWORD="ouj20100401";
	$DBNAME="bangumi";				/** 旧データベース **/
	//$DBNAME="weekbangumi";		/** 新データベース(aouto increment 設定有り)**/
//***本番データベース***

//「Mysql」サーバに接続する
	$conn = mysql_connect($SERVER, $USERNAME, $PASSWORD);
	if (!$conn){
		die("【MySQL Server】に接続できません。");
	}

//「bangumi」データベースを接続する
	mysql_select_db($DBNAME, $conn) or die("データベースが選択できません.".mysql.error($conn));

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
//***  リンクを手入れます        ***
//**********************************
//放送大学イメージソング・学歌
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '放送大学イメージソング・学歌', 'https://www.ouj.ac.jp/hp/gaiyo/school_song.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;

//*** 2018-09-07 add *start*
//��BSキャンパスex特集
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'BSキャンパスex特集', 'https://bangumi.ouj.ac.jp/bslife/category01.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�◆伐奮悄匹�らの招待状
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '“科学”からの招待状', 'https://bangumi.ouj.ac.jp/bslife/category02.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�８�開講座セレクション
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '公開講座セレクション', 'https://bangumi.ouj.ac.jp/bslife/category03.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�て段鵡峙�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '特別講義', 'https://bangumi.ouj.ac.jp/bslife/category04.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�ゥ�ロス討論
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'クロス討論', 'https://bangumi.ouj.ac.jp/bslife/category05.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�Ε好撻轡礇觜岷�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'スペシャル講演', 'https://bangumi.ouj.ac.jp/bslife/category06.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�В隠業嵬椶亮�業
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '１６番目の授業', 'https://bangumi.ouj.ac.jp/bslife/category07.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��放送大学アーカイブス・知の扉
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '放送大学アーカイブス・知の扉', 'https://bangumi.ouj.ac.jp/bslife/category08.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��もう一度みたい名講義
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'もう一度みたい名講義', 'https://bangumi.ouj.ac.jp/bslife/category09.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��学習センターめぐり
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '学習センターめぐり', 'https://bangumi.ouj.ac.jp/bslife/category10.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��データサイエンス
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'データサイエンス', 'https://bangumi.ouj.ac.jp/bslife/category11.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��サイバーセキュリティ
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'サイバーセキュリティ', 'https://bangumi.ouj.ac.jp/bslife/category12.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��特別番組
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '特別番組', 'https://bangumi.ouj.ac.jp/bslife/category99.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//*** 2018-09-07 add *end*

//2018-07-06 add *start*
//特別番組  <=== 18-09-07 Deleted
//	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '特別番組', 'https://bangumi.ouj.ac.jp/life/tokuban.html')";
//	mysql_query( $sql, $conn);
//	$int_ID ++;
//もう一度みたい名講義〜放送大学アーカイブス
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'もう一度みたい名講義〜放送大学アーカイブス', 'https://bangumi.ouj.ac.jp/life/archives.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//特別講義  <=== 18-09-07 Deleted
//	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '特別講義', 'https://bangumi.ouj.ac.jp/life/index.html')";
//	mysql_query( $sql, $conn);
//	$int_ID ++;
//放送大学キャンパスガイド
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '放送大学キャンパスガイド', 'https://bangumi.ouj.ac.jp/life/calendar.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//2018-07-06 add *end*

//Ｔｈａｔ’ｓ　放送大学〜大学の窓
	// repair 2013/10/11 start
	//$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'Ｔｈａｔ’ｓ　放送大学〜大学の窓', 'http://www.ouj.ac.jp/hp/eizou/that/st_top.html')";
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'Ｔｈａｔ’ｓ　放送大学〜大学の窓', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	// repair 2013/10/11 end
	mysql_query( $sql, $conn);
	$int_ID ++;
//2017-11-15 追加
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'Ｔｈａｔ’ｓ放送大学〜大学の窓', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//2017-11-15 追加

// delete 2013/10/11 start
/*
//大学の窓
    $str_Nam = "http://www.ouj.ac.jp/hp/eizou/mado/tv/jm_h2";
    $str_year = substr(get_Heiseiyear(), 1, 1);
    for($i = $str_year; $i>=0; $i--) {
      $str_Name = $str_Nam.$i.".html";
      if ($fp = fopen ($str_Name, "r")) {
        //ファイルを閉じる
        fclose ($fp);
        break;
      }
      else {
        $str_Name = "";
      }
    }
    if($str_Name != "") {
      $sql = "INSERT INTO bangumidata VALUES ($int_ID, '大学の窓', '".$str_Name."')";
      mysql_query( $sql, $conn);
      $int_ID ++;
    }
*/
// add 2013/10/11 start
//授業科目案内〜大学の窓〜
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '授業科目案内〜大学の窓〜', 'https://www.ouj.ac.jp/hp/eizou/annai/kiban/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//授業科目案内〜大学の窓
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '授業科目案内〜大学の窓', 'https://www.ouj.ac.jp/hp/eizou/annai/kiban/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//大学の窓
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '大学の窓', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//Ｔｈａｔ’ｓ放送大学
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'Ｔｈａｔ’ｓ放送大学', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//あなたの知りたい放送大学
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'あなたの知りたい放送大学', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
// add 2013/10/11 end
	
	mysql_close($conn);

}

/**--------------------**
 ** 和暦変換用の関数
 **--------------------**/
function get_Heiseiyear()
{
    $now = getdate();
    $y = $now["year"];
    $m = $now["mon"];
    $d = $now["mday"];

    //年月日を文字列として結合
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
 ** 授業科目案内の.htmlソースよりリンク先を取得
 ** 　教養学部
 ** 　大学院修士課程
 ** 　大学院博士後期課程
 **----------------------------------------------------------------------------**/
//3級のリンクからリンクを取得
function get_Link_Sankyu() {

//H30-02-05 再修正 -----------------------------------------------------
//H29-11-20 修正 -------------------
// H29/12 よりH30年度のシラバスを広報ページで表示したい。
// 番組表は、H29年度のシラバスを表示したい。
// 新年度(H30)になったら元にもどすこと。
//
// "20180323" 切替日の確認は、広報課(中川氏)と打ち合わせた
//
//	$str_Moto_Link = "http://www.ouj.ac.jp/hp/kamoku/index.html";

	$YMD = get_Today();

//H30-07-04 修正 -------------------
	if ($YMD < "20190322") {
	    $str_Moto_Link = "https://www.ouj.ac.jp/hp/kamoku/h30index.html";
	} else {
    	$str_Moto_Link = "https://www.ouj.ac.jp/hp/kamoku/index.html";
	}
//H29-11-20 修正 -------------------
//H30-02-05 再修正 ------------------------------------------------------

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
//　シラバスのURL取得方法の変更のため、以下未使用

//	for($i = 0; $i<count($arr_Link_Nikyu); $i++) {
	for($i = 0; $i<1; $i++) {
		if ($fp = fopen ($arr_Link_Nikyu[$i], "r")) {
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);

				// mb_language('Japanese');  // added k.hamada 2014/06/05 呪文
				// $str_Row = mb_convert_encoding($str_Row, "eucjp-win", "auto");
				// auto 指定はphp,ini 言語設定を受けるので危険
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

	         //ファイルを閉じる
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
 ** 現在の日付を取得(YYYYMMDD)
 ** 4月1日経過を判断する為
 **------------------------------------**/
function get_Today()
{
    $now = getdate();
    $y = $now["year"];
    $m = $now["mon"];
    $d = $now["mday"];

    //年月日を文字列として結合
    $ymd = sprintf("%02d%02d%02d", $y, $m, $d);

    return $ymd;
}


/**----------------------------------------------------**
 ** 週間番組表Webページを表示
 **----------------------------------------------------**/
//Bangumiサイトへ移動ます
function set_Bangumi_Connect(){

	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "location.href = \"bangumi.php\"\n";
	echo "// -->\n";
	echo "</script>\n";

}

/**---------------------------------------------------------**
 ** 授業科目案内のindex.htmlソースよりリンク先を取得する。
 ** 　教養学部
 ** 　　/H28/kyouyou/C/index.html
 ** 　大学院修士課程
 ** 　　/H28/daigakuin/B/index.html
 ** 　大学院博士後期課程
 ** 　　/H28/hakase/index.html
 **---------------------------------------------------------**/
//元リンクからリンクを取得
function get_Moto_Link($str_Moto_Link) {

	//H30-02-05 Add K.hamada-------------
	$YMD = get_Today();
	//H30-02-05 Add K.hamada-------------

	if ($fp = fopen ($str_Moto_Link, "r")) {
		$arr_count = 0;
		while (! feof ($fp)) {
			$str_Row = fgets ($fp, 4096);

			// mb_language('Japanese');  // added k.hamada 2014/06/05 呪文
			// auto 指定はphp,ini 言語設定を受けるので危険
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
//H30-02-05 再修正 --------------------------------------
//H29-11-20 修正 -------------------
//新年度(H30)になったら元にもどすこと。
		              //$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Sub_Link;
        		      //$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("h29index.html")).$str_Sub_Link;
//H29-11-20 修正 -------------------
//H30-07-04 修正 -------------------
						if ($YMD < "20190322") {
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("h30index.html")).$str_Sub_Link;
						} else {
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Sub_Link;
						}
//H30-02-05 再修正 --------------------------------------

						$arr_count ++;

					/**--------------------------------------------------------------**
					 ** 授業科目案内の index.html ソースには、A,Bティレクトリ情報
					 ** (リンク先情報)は含まれていない。
					 ** 　教養学部は、A、B、Cが存在するが、CがA、Bを包含している。
					 ** 　大学院(修士課程)は、Bのみ存在する。
					 ** 　後期博士課程には、ABCは存在しない。
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
		//ファイルを閉じる
		fclose ($fp) ;
	}
/**----------------------------------------------------------------------------------------------**
 ** 当年度開設のシラバスへしかリンクしない。
 ** よって、過去のシラバスのリンク先を取得する必要はない。
 ** (過去の番組用シラバスは存在しない。)
 **------- 2016-09-12 deleted by HSJ)k.h --------------------------------------------------------**
//H21 からのサイトを取得
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

//H19, H20 のサイトを取得
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H20/kyouyou/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H20/daigakuin/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H19/kyouyou/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H19/daigakuin/index.html";
 **------- 2016-09-12 deleted by HSJ)k.h --------------------------------------------------------**/

	return($arr_Moto_Link);

}

/**----------------------------------------------------------------------------**
 ** 教養学部、大学院修士課程、大学院博士後期課程の各index.htmlソースより
 ** カリキュラム別のリンク先を取得する。
 ** 　教養学部（例）
 **     [0] => http://www.ouj.ac.jp/hp/kamoku/H28/kyouyou/C/kiban_kiban/index.html
 **     [1] => http://www.ouj.ac.jp/hp/kamoku/H28/kyouyou/C/kiban_gaikokugo/index.html
 **
 ** 　大学院修士課程（例）
 **     [12] => http://www.ouj.ac.jp/hp/kamoku/H28/daigakuin/B/seikatu/index.html
 **     [13] => http://www.ouj.ac.jp/hp/kamoku/H28/daigakuin/B/ningen/index.html
 **
 ** 　大学院博士後期課程（例）
 **     [20] => http://www.ouj.ac.jp/hp/kamoku/H28/hakase/kiban_seikatu/index.html
 **     [21] => http://www.ouj.ac.jp/hp/kamoku/H28/hakase/kiban_ningen/index.html
 **
 **----------------------------------------------------------------------------**/
//2級のリンクからリンクを取得
function get_Link_Nikyu($arr_Moto_Link) {

	$arr_count = 0;

	for($i = 0; $i<count($arr_Moto_Link); $i++) {

		if ($fp = fopen ($arr_Moto_Link[$i], "r")) {
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);

				// mb_language('Japanese');  // added k.hamada 2014/06/05 呪文
				// auto 指定はphp,ini 言語設定を受けるので危険
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
			//ファイルを閉じる
			fclose ($fp) ;
		}
	} /** end for **/
	
	return($arr_2kyu_Link);

}

/**------------------------------------**
 //記号の変換
 **------------------------------------**/
function get_Change_Link($str) {

	$str = str_replace('"', '”', $str);
	$str = str_replace("'", "’", $str);
	$str = str_replace("―", "ー", $str);
	$str = str_replace("-", "ー", $str);
	$str = str_replace("−", "ー", $str);
	$str = str_replace("\\", "￥", $str);

/**----- 機種依存文字対応 2016-09-13 HSJ)k.h ---------------**/
	$str = str_replace("&#8544;", "１", $str);
	$str = str_replace("&#8545;", "２", $str);
	$str = str_replace("&#8546;", "３", $str);
	$str = str_replace("&#8547;", "４", $str);
	$str = str_replace("&#8548;", "５", $str);
	$str = str_replace("&#8549;", "６", $str);
	$str = str_replace("&#8550;", "７", $str);
	$str = str_replace("&#8551;", "８", $str);
	$str = str_replace("&#8552;", "９", $str);
	$str = str_replace("&#8553;", "１０", $str);

	$str = mb_ereg_replace("��", "１", $str);
	$str = mb_ereg_replace("��", "２", $str);
	$str = mb_ereg_replace("��", "３", $str);
	$str = mb_ereg_replace("��", "４", $str);
	$str = mb_ereg_replace("��", "５", $str);
	$str = mb_ereg_replace("��", "６", $str);
	$str = mb_ereg_replace("��", "７", $str);
	$str = mb_ereg_replace("��", "８", $str);
	$str = mb_ereg_replace("��", "９", $str);
	$str = mb_ereg_replace("��", "１０", $str);
/**---- 全角数字に変換 ---------------------------------------**
// add 2013/10/11 start thuong
	$str = mb_ereg_replace("��", "1", $str);
	$str = mb_ereg_replace("��", "2", $str);
	$str = mb_ereg_replace("��", "3", $str);
	$str = mb_ereg_replace("��", "4", $str);
	$str = mb_ereg_replace("��", "5", $str);
	$str = mb_ereg_replace("��", "6", $str);
	$str = mb_ereg_replace("��", "7", $str);
	$str = mb_ereg_replace("��", "8", $str);
	$str = mb_ereg_replace("��", "9", $str);
	$str = mb_ereg_replace("��", "10", $str);
	// add 2013/10/11 end thuong
 **---- 機種依存文字対応 2016-09-13 HSJ)k.h -------------------**/

//	$str = mb_convert_kana($str, A, "EUC-JP");
	$str = mb_convert_kana($str, "A", "EUC-JP"); // modified k.hamada 2014/06/05
	
	return($str);

}

?>
