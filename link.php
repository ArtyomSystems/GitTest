<?php

set_Database_Connect();

set_Bangumi_Connect();

//�ǡ����١����إǡ���������ޤ�
function set_Database_Connect() {

//***�ƥ��ȡ��ǡ����١���***
//	$SERVER="localhost";
//	$USERNAME="root";
//	$PASSWORD="";
//	$DBNAME="bangumi";				/** ��ǡ����١��� **/
	//$DBNAME="weekbangumi";		/** ���ǡ����١���(aouto increment ����ͭ��)

//***���֥ǡ����١���***
	$SERVER="localhost";
	$USERNAME="oujuser";
	$PASSWORD="ouj20100401";
	$DBNAME="bangumi";				/** ��ǡ����١��� **/
	//$DBNAME="weekbangumi";		/** ���ǡ����١���(aouto increment ����ͭ��)**/
//***���֥ǡ����١���***

//��Mysql�ץ����Ф���³����
	$conn = mysql_connect($SERVER, $USERNAME, $PASSWORD);
	if (!$conn){
		die("��MySQL Server�ۤ���³�Ǥ��ޤ���");
	}

//��bangumi�ץǡ����١�������³����
	mysql_select_db($DBNAME, $conn) or die("�ǡ����١���������Ǥ��ޤ���.".mysql.error($conn));

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
//***  ��󥯤������ޤ�        ***
//**********************************
//������إ��᡼�����󥰡��ز�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '������إ��᡼�����󥰡��ز�', 'https://www.ouj.ac.jp/hp/gaiyo/school_song.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;

//*** 2018-09-07 add *start*
//��BS�����ѥ�ex�ý�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, 'BS�����ѥ�ex�ý�', 'https://bangumi.ouj.ac.jp/bslife/category01.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���Ȳʳءɤ���ξ��Ծ�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�Ȳʳءɤ���ξ��Ծ�', 'https://bangumi.ouj.ac.jp/bslife/category02.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�������ֺ¥��쥯�����
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�����ֺ¥��쥯�����', 'https://bangumi.ouj.ac.jp/bslife/category03.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�����ֵ̹�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '���ֵ̹�', 'https://bangumi.ouj.ac.jp/bslife/category04.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//������Ƥ��
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '����Ƥ��', 'https://bangumi.ouj.ac.jp/bslife/category05.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�����ڥ����ֱ�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '���ڥ����ֱ�', 'https://bangumi.ouj.ac.jp/bslife/category06.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���������ܤμ���
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�������ܤμ���', 'https://bangumi.ouj.ac.jp/bslife/category07.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��������إ��������֥����Τ���
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '������إ��������֥����Τ���', 'https://bangumi.ouj.ac.jp/bslife/category08.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���⤦���٤ߤ���̾�ֵ�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�⤦���٤ߤ���̾�ֵ�', 'https://bangumi.ouj.ac.jp/bslife/category09.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���ؽ����󥿡��ᤰ��
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�ؽ����󥿡��ᤰ��', 'https://bangumi.ouj.ac.jp/bslife/category10.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���ǡ�����������
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�ǡ�����������', 'https://bangumi.ouj.ac.jp/bslife/category11.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�������С��������ƥ�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�����С��������ƥ�', 'https://bangumi.ouj.ac.jp/bslife/category12.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//����������
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '��������', 'https://bangumi.ouj.ac.jp/bslife/category99.php')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//*** 2018-09-07 add *end*

//2018-07-06 add *start*
//��������  <=== 18-09-07 Deleted
//	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '��������', 'https://bangumi.ouj.ac.jp/life/tokuban.html')";
//	mysql_query( $sql, $conn);
//	$int_ID ++;
//�⤦���٤ߤ���̾�ֵ���������إ��������֥�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�⤦���٤ߤ���̾�ֵ���������إ��������֥�', 'https://bangumi.ouj.ac.jp/life/archives.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���ֵ̹�  <=== 18-09-07 Deleted
//	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '���ֵ̹�', 'https://bangumi.ouj.ac.jp/life/index.html')";
//	mysql_query( $sql, $conn);
//	$int_ID ++;
//������إ����ѥ�������
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '������إ����ѥ�������', 'https://bangumi.ouj.ac.jp/life/calendar.html')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//2018-07-06 add *end*

//�ԣ����ǣ�������ء���ؤ���
	// repair 2013/10/11 start
	//$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�ԣ����ǣ�������ء���ؤ���', 'http://www.ouj.ac.jp/hp/eizou/that/st_top.html')";
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�ԣ����ǣ�������ء���ؤ���', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	// repair 2013/10/11 end
	mysql_query( $sql, $conn);
	$int_ID ++;
//2017-11-15 �ɲ�
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�ԣ����ǣ�������ء���ؤ���', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//2017-11-15 �ɲ�

// delete 2013/10/11 start
/*
//��ؤ���
    $str_Nam = "http://www.ouj.ac.jp/hp/eizou/mado/tv/jm_h2";
    $str_year = substr(get_Heiseiyear(), 1, 1);
    for($i = $str_year; $i>=0; $i--) {
      $str_Name = $str_Nam.$i.".html";
      if ($fp = fopen ($str_Name, "r")) {
        //�ե�������Ĥ���
        fclose ($fp);
        break;
      }
      else {
        $str_Name = "";
      }
    }
    if($str_Name != "") {
      $sql = "INSERT INTO bangumidata VALUES ($int_ID, '��ؤ���', '".$str_Name."')";
      mysql_query( $sql, $conn);
      $int_ID ++;
    }
*/
// add 2013/10/11 start
//���Ȳ��ܰ������ؤ����
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '���Ȳ��ܰ������ؤ����', 'https://www.ouj.ac.jp/hp/eizou/annai/kiban/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���Ȳ��ܰ������ؤ���
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '���Ȳ��ܰ������ؤ���', 'https://www.ouj.ac.jp/hp/eizou/annai/kiban/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//��ؤ���
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '��ؤ���', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//�ԣ����ǣ��������
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '�ԣ����ǣ��������', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
//���ʤ����Τꤿ���������
	$sql = "INSERT INTO bangumidata VALUES ($int_ID, '���ʤ����Τꤿ���������', 'https://www.ouj.ac.jp/hp/eizou/mado/tv/')";
	mysql_query( $sql, $conn);
	$int_ID ++;
// add 2013/10/11 end
	
	mysql_close($conn);

}

/**--------------------**
 ** �����Ѵ��Ѥδؿ�
 **--------------------**/
function get_Heiseiyear()
{
    $now = getdate();
    $y = $now["year"];
    $m = $now["mon"];
    $d = $now["mday"];

    //ǯ������ʸ����Ȥ��Ʒ��
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
 ** ���Ȳ��ܰ����.html�����������������
 ** �����ܳ���
 ** ����ر����β���
 ** ����ر���θ������
 **----------------------------------------------------------------------------**/
//3��Υ�󥯤����󥯤����
function get_Link_Sankyu() {

//H30-02-05 �ƽ��� -----------------------------------------------------
//H29-11-20 ���� -------------------
// H29/12 ���H30ǯ�٤Υ���Х�����ڡ�����ɽ����������
// ����ɽ�ϡ�H29ǯ�٤Υ���Х���ɽ����������
// ��ǯ��(H30)�ˤʤä��鸵�ˤ�ɤ����ȡ�
//
// "20180323" �������γ�ǧ�ϡ������(�����)���Ǥ���碌��
//
//	$str_Moto_Link = "http://www.ouj.ac.jp/hp/kamoku/index.html";

	$YMD = get_Today();

//H30-07-04 ���� -------------------
	if ($YMD < "20190322") {
	    $str_Moto_Link = "https://www.ouj.ac.jp/hp/kamoku/h30index.html";
	} else {
    	$str_Moto_Link = "https://www.ouj.ac.jp/hp/kamoku/index.html";
	}
//H29-11-20 ���� -------------------
//H30-02-05 �ƽ��� ------------------------------------------------------

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
//������Х���URL������ˡ���ѹ��Τ��ᡢ�ʲ�̤����

//	for($i = 0; $i<count($arr_Link_Nikyu); $i++) {
	for($i = 0; $i<1; $i++) {
		if ($fp = fopen ($arr_Link_Nikyu[$i], "r")) {
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);

				// mb_language('Japanese');  // added k.hamada 2014/06/05 ��ʸ
				// $str_Row = mb_convert_encoding($str_Row, "eucjp-win", "auto");
				// auto �����php,ini ��������������ΤǴ�
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

	         //�ե�������Ĥ���
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
 ** ���ߤ����դ����(YYYYMMDD)
 ** 4��1���в��Ƚ�Ǥ����
 **------------------------------------**/
function get_Today()
{
    $now = getdate();
    $y = $now["year"];
    $m = $now["mon"];
    $d = $now["mday"];

    //ǯ������ʸ����Ȥ��Ʒ��
    $ymd = sprintf("%02d%02d%02d", $y, $m, $d);

    return $ymd;
}


/**----------------------------------------------------**
 ** ��������ɽWeb�ڡ�����ɽ��
 **----------------------------------------------------**/
//Bangumi�����Ȥذ�ư�ޤ�
function set_Bangumi_Connect(){

	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "location.href = \"bangumi.php\"\n";
	echo "// -->\n";
	echo "</script>\n";

}

/**---------------------------------------------------------**
 ** ���Ȳ��ܰ����index.html��������������������롣
 ** �����ܳ���
 ** ����/H28/kyouyou/C/index.html
 ** ����ر����β���
 ** ����/H28/daigakuin/B/index.html
 ** ����ر���θ������
 ** ����/H28/hakase/index.html
 **---------------------------------------------------------**/
//����󥯤����󥯤����
function get_Moto_Link($str_Moto_Link) {

	//H30-02-05 Add K.hamada-------------
	$YMD = get_Today();
	//H30-02-05 Add K.hamada-------------

	if ($fp = fopen ($str_Moto_Link, "r")) {
		$arr_count = 0;
		while (! feof ($fp)) {
			$str_Row = fgets ($fp, 4096);

			// mb_language('Japanese');  // added k.hamada 2014/06/05 ��ʸ
			// auto �����php,ini ��������������ΤǴ�
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
//H30-02-05 �ƽ��� --------------------------------------
//H29-11-20 ���� -------------------
//��ǯ��(H30)�ˤʤä��鸵�ˤ�ɤ����ȡ�
		              //$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Sub_Link;
        		      //$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("h29index.html")).$str_Sub_Link;
//H29-11-20 ���� -------------------
//H30-07-04 ���� -------------------
						if ($YMD < "20190322") {
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("h30index.html")).$str_Sub_Link;
						} else {
							$arr_Moto_Link[$arr_count] = substr($str_Moto_Link, 0, strlen($str_Moto_Link)-strlen("index.html")).$str_Sub_Link;
						}
//H30-02-05 �ƽ��� --------------------------------------

						$arr_count ++;

					/**--------------------------------------------------------------**
					 ** ���Ȳ��ܰ���� index.html �������ˤϡ�A,B�ƥ��쥯�ȥ����
					 ** (��������)�ϴޤޤ�Ƥ��ʤ���
					 ** �����ܳ����ϡ�A��B��C��¸�ߤ��뤬��C��A��B����ޤ��Ƥ��롣
					 ** ����ر�(���β���)�ϡ�B�Τ�¸�ߤ��롣
					 ** �������β����ˤϡ�ABC��¸�ߤ��ʤ���
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
		//�ե�������Ĥ���
		fclose ($fp) ;
	}
/**----------------------------------------------------------------------------------------------**
 ** ��ǯ�ٳ��ߤΥ���Х��ؤ�����󥯤��ʤ���
 ** ��äơ����Υ���Х��Υ������������ɬ�פϤʤ���
 ** (���������ѥ���Х���¸�ߤ��ʤ���)
 **------- 2016-09-12 deleted by HSJ)k.h --------------------------------------------------------**
//H21 ����Υ����Ȥ����
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

//H19, H20 �Υ����Ȥ����
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H20/kyouyou/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H20/daigakuin/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H19/kyouyou/index.html";
	$arr_Moto_Link[count($arr_Moto_Link)] = "http://www.ouj.ac.jp/hp/kamoku/H19/daigakuin/index.html";
 **------- 2016-09-12 deleted by HSJ)k.h --------------------------------------------------------**/

	return($arr_Moto_Link);

}

/**----------------------------------------------------------------------------**
 ** ���ܳ�������ر����β�������ر���θ�������γ�index.html���������
 ** ���ꥭ�����̤Υ�����������롣
 ** �����ܳ��������
 **     [0] => http://www.ouj.ac.jp/hp/kamoku/H28/kyouyou/C/kiban_kiban/index.html
 **     [1] => http://www.ouj.ac.jp/hp/kamoku/H28/kyouyou/C/kiban_gaikokugo/index.html
 **
 ** ����ر����β��������
 **     [12] => http://www.ouj.ac.jp/hp/kamoku/H28/daigakuin/B/seikatu/index.html
 **     [13] => http://www.ouj.ac.jp/hp/kamoku/H28/daigakuin/B/ningen/index.html
 **
 ** ����ر���θ�����������
 **     [20] => http://www.ouj.ac.jp/hp/kamoku/H28/hakase/kiban_seikatu/index.html
 **     [21] => http://www.ouj.ac.jp/hp/kamoku/H28/hakase/kiban_ningen/index.html
 **
 **----------------------------------------------------------------------------**/
//2��Υ�󥯤����󥯤����
function get_Link_Nikyu($arr_Moto_Link) {

	$arr_count = 0;

	for($i = 0; $i<count($arr_Moto_Link); $i++) {

		if ($fp = fopen ($arr_Moto_Link[$i], "r")) {
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);

				// mb_language('Japanese');  // added k.hamada 2014/06/05 ��ʸ
				// auto �����php,ini ��������������ΤǴ�
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
			//�ե�������Ĥ���
			fclose ($fp) ;
		}
	} /** end for **/
	
	return($arr_2kyu_Link);

}

/**------------------------------------**
 //������Ѵ�
 **------------------------------------**/
function get_Change_Link($str) {

	$str = str_replace('"', '��', $str);
	$str = str_replace("'", "��", $str);
	$str = str_replace("��", "��", $str);
	$str = str_replace("-", "��", $str);
	$str = str_replace("��", "��", $str);
	$str = str_replace("\\", "��", $str);

/**----- �����¸ʸ���б� 2016-09-13 HSJ)k.h ---------------**/
	$str = str_replace("&#8544;", "��", $str);
	$str = str_replace("&#8545;", "��", $str);
	$str = str_replace("&#8546;", "��", $str);
	$str = str_replace("&#8547;", "��", $str);
	$str = str_replace("&#8548;", "��", $str);
	$str = str_replace("&#8549;", "��", $str);
	$str = str_replace("&#8550;", "��", $str);
	$str = str_replace("&#8551;", "��", $str);
	$str = str_replace("&#8552;", "��", $str);
	$str = str_replace("&#8553;", "����", $str);

	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "��", $str);
	$str = mb_ereg_replace("��", "����", $str);
/**---- ���ѿ������Ѵ� ---------------------------------------**
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
 **---- �����¸ʸ���б� 2016-09-13 HSJ)k.h -------------------**/

//	$str = mb_convert_kana($str, A, "EUC-JP");
	$str = mb_convert_kana($str, "A", "EUC-JP"); // modified k.hamada 2014/06/05
	
	return($str);

}

?>
