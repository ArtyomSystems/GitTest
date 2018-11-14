<?php

	$glo_Length = get_Length();
	$glo_Rajio_Length = 40;
	$glo_Space_Length = 30;

/***--------------------------***
 *** サイトビューアーを数える ***
 ***--------------------------***/
	function site_view() {
		$SERVER		= "localhost";
		$USERNAME	= "oujuser";
		$PASSWORD	= "ouj20100401";
		$DBNAME		= "bancounter";

		//「Mysql」サーバに接続する
		$conn = mysql_connect($SERVER, $USERNAME, $PASSWORD);
		if (!$conn){
			die("【MySQL Server】に接続できません。");
		}

		//「bancounter」データベースを接続する
		if(mysql_select_db($DBNAME, $conn)) {
			$now = getdate();
			$now_date = $now['mday'];
			if($now_date == 28) {
				mysql_query("update bancounter_data set int_count=int_count+'1'", $conn);
			} else {
				mysql_query("update bancounter_data set int_count='0'", $conn);
			}

			// ビューアー数を数える
			$sql_select = "SELECT int_count FROM bancounter_data";
			$sql_result = mysql_query($sql_select, $conn);
			if ($sql_result) {
				$row=mysql_fetch_assoc($sql_result);
				if($row['int_count']==1) {
					echo "<script type=\"text/javascript\">\n";
					echo "<!--\n";
					echo "location.href = \"link.php\"\n";
					echo "// -->\n";
					echo "</script>\n";
				}
			}
		} else {
			//出た件数を数える

			/*************************************************************
		 	*** 以下、処理意味なし（条件発生しない）
			**************************************************************
			//見つけた場合    
			if ($sql_count>0) {
				while($sql_row=mysql_fetch_array($sql_result)) {
					if (trim($sql_row['STR_VALUE']) != "") {
						$str_Link = $sql_row['STR_VALUE'];
						break;
					}
				} //end(while)
			}
			*************************************************************/
		}

		mysql_close($conn);
	}

/******************************
 *** 番組構築のクラスを作成 ***
 ******************************/
	class bangumi_struct {
		var $time    = 0;
		var $subject = "";
		var $link    = "";
		var $content = "";
		var $charge  = "";
		var $length  = 147;
		var $class   = "odd";
	}

	class time_sheet {
		var $time    = "05";
		var $length  = 197;
	}


/***----------------------------***
 ***「URL」文字から月を取り出す ***
 ***----------------------------***/
	function get_month() {
		$now_month = htmlspecialchars(@$_GET['month']);
		if ($now_month == '') {
			$now = getdate();
			$now_month = $now['mon'];
		};
		return($now_month);
	}

/***----------------------------***
 ***「URL」文字から日を取り出す ***
 ***----------------------------***/
	function get_date() {
		$now_date = htmlspecialchars(@$_GET['date']);
		if ($now_date == '') {
			$now = getdate();
			$now_date = $now['mday'];
		};
		return($now_date);
	}

/***--- 2018-08-27 add k.h ---------------------------------***
 *** BS放送開始以降であるか判断する                         ***
 *** 2018/10/01以降、BS放送                                 ***
 *** Return ( 0 :３チャネル−放送   1 :BS２チャンネル放送 ) ***
 ***--------------------------------------------------------***/
	function check_BS2($now_month, $now_date) {
		//日付
		$now = getdate();
		//年度
		$disp_year = $now['year'];

		//例）2018/12/18以降 に　2019/1/1 をクリックした場合等
		$wk_month =  $now['mon'];
		if ( $now_month < $wk_month ) {
			$disp_year = $disp_year + 1;
		}

		//月
		$disp_month = get_2Byte($now_month);
		//日
		$disp_date = get_2Byte($now_date);

		$disp_YMD = $disp_year . $disp_month . $disp_date;

		if ( $disp_YMD > 20180930 ) {	//2018年10月01日よりBS2チャンネル放送開始
		//if ( $disp_YMD > 20180915 ) {	//2018年09月16日テスト用
			return(1);	//BS2チャンネル放送
		} else {
			return(0);	//3チャンネル放送
		}

	}

/***------------------------***
 *** 現在放送中の番組を出力 ***
 ***------------------------***/
	function set_Export_Onair($str_Channel, $str_Type, $BS2_flg) {

		//データファイルを読み、配列に置きます
		$now		= getdate();
		$now_month	= $now['mon'];
		$now_date	= $now['mday'];
		// repair thuong 2013/5/16 start
		$now_hour	= $now['hours'];
		if($now_hour < 4) {
			$yesterday = getdate(time() - 86400);
			$now_month = $yesterday['mon'];
			$now_date = $yesterday['mday'];
		}
		echo "<!-- month = ".$now_month.", day = ".$now_date."-->";
		// repair thuong 2013/5/16 end
		$arr_channel = get_File_Read($str_Type, $now_month, $now_date, $BS2_flg);

		switch ($str_Channel) {
			case "TV01":
				$int_Pos = 0;
				$str_Bordercolor = '#8DCBE9';
				break;
			case "TV02":
				$int_Pos = 1;
				$str_Bordercolor = '#FF8A8A';
				break;
			case "TV03":
				$int_Pos = 2;
				$str_Bordercolor = '#FFB23F';
				break;
			case "FM":
				$int_Pos = 0;
				$str_Bordercolor = '#8DCBE9';
				break;
			case "BSR":
				$int_Pos = 0;
				$str_Bordercolor = '#8DCBE9';
				break;
		}

		if(count($arr_channel[$int_Pos])>1){
			set_Onair($arr_channel[$int_Pos], $str_Bordercolor);
		}

	}

/***--------------------------------***
 *** チャンネル別の放送中番組を設定 ***
 ***--------------------------------***/
	function  set_Onair($arr_Channel, $str_Bordercolor) {

		if(get_Sum_Minute($arr_Channel[count($arr_Channel) - 1]->time) <= get_Now_Sum()) {
			if((get_Sum_Minute($arr_Channel[count($arr_Channel) - 1]->time) + 45) >= get_Now_Sum()) {
				set_Onair_Display($arr_Channel[count($arr_Channel) - 1], $str_Bordercolor);
			}
		} else {
			$int_Run = 0;
			while ((get_Now_Sum() >= get_Sum_Minute($arr_Channel[$int_Run]->time)) && ($int_Run < count($arr_Channel))) {
				$int_Run ++;
			}
			if($int_Run >0) {
				$int_Run --;
				if((get_Sum_Minute($arr_Channel[$int_Run]->time) + 45) >= get_Now_Sum()) {
					set_Onair_Display($arr_Channel[$int_Run], $str_Bordercolor);
				}
			}
		}

	}

/***------------------***
 *** 放送中番組の表示 ***
 ***------------------***/
	function set_Onair_Display($cls_Channel, $str_Bordercolor) {

		//2013.06.15 k.hamada modified *** AM,PM の非表示 ***
		//echo "<span class='time-program'>".date( 'A H:i', strtotime($cls_Channel->time))."</span>";
		echo "<span class='time-program'>".date( 'H:i', strtotime($cls_Channel->time))."</span>";
		if(trim($cls_Channel->link) != "") {
			echo "<dl><dt><a href='".$cls_Channel->link."'>".$cls_Channel->subject."</a></dt>";
		} else {
			echo "<dl><dt>".$cls_Channel->subject."</dt>";
		}
		echo "<dd>".$cls_Channel->content."<br>\n".$cls_Channel->charge."<br>\n</dd></dl>";

	}

/***----------------------------***
 *** 現在時分の合計で分数に戻る ***
 ***----------------------------***/
	function get_Now_Sum() {

		$now = getdate();
		$lng_Hour = $now["hours"];
		if($lng_Hour<4) {
			$lng_Hour = $lng_Hour + 24;
		}
		$lng_Minute = $now["minutes"];

		return($lng_Hour * 60 + $lng_Minute);

	}

/***--------------------***
 *** 全番組を出力します ***
 ***--------------------***/
	function set_Export_Data($str_Type, $BS2_flg) {

		global $glo_Space_Length;

		//データファイルを読み、配列に置きます
		$now_month = get_month();
		$now_date  = get_date(); 
		$arr_channel = get_File_Read($str_Type, $now_month, $now_date, $BS2_flg);

		//番組タイム一覧配列に置きます
		$arr_Time    = get_Time_List($arr_channel);

		//番組の高さを定義
		set_Bangumi_Length($arr_channel, $arr_Time, $str_Type);

		//番組のクラスを定義
		set_Bangumi_Class($arr_channel, $arr_Time);

		//時刻一覧配列に表示
		$arr_Time_Sheet = get_Time_Sheet($arr_Time, $str_Type);

		//チャンネルの長さ
		$int_Width = 0;
		for($i=0; $i<count($arr_channel); $i++){
			if(count($arr_channel[$i])>0) {
				$int_Width ++;
			}
		}

		switch (count($arr_channel)) {
			case 1:
				$lng_Width = 687;
				break;
			case 2:	//2018-08-27 add h.k BS2チャンネル対応
				switch ($int_Width) {
					case 1:
						$lng_Width = 223;
						break;
					case 2:
						$lng_Width = 224;
						break;
					case 3:
						$lng_Width = 224;
						break;
				}
			case 3:
				switch ($int_Width) {
					case 1:
						$lng_Width = 223;
						break;
					case 2:
						$lng_Width = 224;
						break;
					case 3:
						$lng_Width = 224;
						break;
				}
		}

		echo "<table class='tbl-list-program'>\n";
		if ($str_Type == "TV") {
			if ( $BS2_flg == 0) {	//3チャネル放送
				echo "<colgroup>\n";
				echo "<col class='c-time'>\n";
				echo "<col class='c-content'>\n";
				echo "<col class='c-content'>\n";
				echo "<col class='c-content'>\n";
				echo "</colgroup>\n";
			} else {				//BS2チャネル放送
				//echo "<colgroup>\n";
				//echo "<col class='c-time'>\n";
				//echo "<col class='c-content'>\n";
				//echo "<col class='c-content'>\n";
				//echo "<col class='c-content'>\n";
				//echo "</colgroup>\n";
				
				echo "<colgroup>\n";
				echo "<col class='c-time'>\n";
				echo "<col class='c-content2'>\n";
				echo "<col class='c-content2'>\n";
				echo "</colgroup>\n";
			}
		} else if ($str_Type == "FM") {
			echo "<colgroup>\n";
			echo "<col style='width:32px'>\n";
			echo "<col style='width:850px;'>\n";
			echo "</colgroup>\n";		
		} else if ($str_Type == "BSR") {
			echo "<colgroup>\n";
			echo "<col style='width:32px'>\n";
			echo "<col style='width:850px;'>\n";
			echo "</colgroup>\n";		
		}
		echo "            <script type='text/javascript'>\n";
		echo "            <!--\n";
		echo "              document.open();\n";
		echo "              var int_width = ".$lng_Width." + add_browser_width();\n";

		echo "              document.write(\"<tr>\");\n";

		//チャンネル時刻一覧表示
		echo "document.write(\"<th width='32'>\");\n";
		for($i=0; $i<count($arr_Time_Sheet); $i++) {
			//echo "var int_height = ". $arr_Time_Sheet[$i]->length ." + add_browser();\n";
			echo "var int_height = ". $arr_Time_Sheet[$i]->length ." + 3;\n";
			echo "document.write(\"<div>\");\n";
			echo "document.write(\"<p style='height:\"+ int_height + \"px'>\");\n";
			echo "document.write(\"". convert_Text_Time($arr_Time_Sheet[$i]->time)."\");\n";
			// echo "document.write(\"".$arr_Time_Sheet[$i]->time."\");\n";
			echo "document.write(\"</p>\");\n";
			echo "document.write(\"</div>\");\n";
    	}
		echo "document.write(\"</th>\");\n";

		//チャンネル一覧表示
		for ($i=0; $i<count($arr_channel); $i++) {
			echo "              document.write(\"<td>\");\n";
			echo "              document.write(\"<TABLE class='tbl-ct-program'>\");\n";
			$lng_Height = 0;
			if (get_Minute($arr_Time[0]) > 0) {
				$lng_Height = $glo_Space_Length;
			}

			if(get_Cell_Space($arr_channel[$i], $arr_Time) > 0) {
				$lng_Height = get_Cell_Space($arr_channel[$i], $arr_Time) + $lng_Height;
			}

			if(($lng_Height>3) && (count($arr_channel[$i]) > 0)) {
				$lng_Height = $lng_Height - 3;
				//echo "              var int_height = ".$lng_Height." + add_browser();\n";
				echo "              var int_height = ".$lng_Height." + 3;\n";
				echo "              document.write(\"<TR>\");\n";
				echo "              document.write(\"<TD style='height:\" + int_height + \"px;'><br /></TD>\");\n";
				echo "              document.write(\"</TR>\");\n";
			}

			for ($k=0; $k<count($arr_channel[$i]); $k++) {
				if(count($arr_channel[$i]) > 1) {
					echo "              document.write(\"<TR>\");\n";
					//echo "              var int_height = ".$arr_channel[$i][$k]->length." + add_browser();\n";
					echo "              var int_height = ".$arr_channel[$i][$k]->length." + 3;\n";
					echo "              document.write(\"<TD style='height:\" + int_height + \"px;'><div>\");\n";
					//echo "              document.write(\"<span class='time-program'>".date( 'A H:i', strtotime($arr_channel[$i][$k]->time ))."</span>\");\n";
					echo "              document.write(\"<span class='time-program'>".$arr_channel[$i][$k]->time."</span>\");\n";
					echo "              document.write(\"<dl>\");\n";
					if((trim($arr_channel[$i][$k]->link) != "") && (htmlspecialchars(@$_GET['type'])=="")) {
						echo "              document.write(\"<dt><A href='".$arr_channel[$i][$k]->link."' target='_blank' style='color:blue'>".$arr_channel[$i][$k]->subject."</A></dt>\");\n";
					} else {
						echo "              document.write(\"<dt>". $arr_channel[$i][$k]->subject."</dt>\");\n";
					}
					echo "              document.write(\"<dd>".$arr_channel[$i][$k]->content."<br>\");\n";
					echo "              document.write(\"".$arr_channel[$i][$k]->charge."</dd>\");\n";
					echo "              document.write(\"</dl>\");\n";
					echo "              document.write(\"</div></TD>\");\n";
					echo "              document.write(\"</TR>\");\n";
				}
			}	//end for($k)
			echo "              document.write(\"</TABLE>\");\n";
			echo "              document.write(\"</td>\");\n";
		}	//end for($i)
		echo "              document.write(\"</tr>\");\n";
		echo "              document.close();\n";
		echo "              browser_response('".$str_Type."', ".$int_Width.");\n";
		echo "            //-->\n";
		echo "            </script>\n";
		echo "            </Table>\n";

	}

/***------------------------***
 *** 時刻の表示時刻への変換 ***
 ***------------------------***/
// convert time num to text
	function convert_Text_Time($num_Time){
		switch($num_Time)
		{
			case "01":
				return "午前1時";  
				break;
			case "02":
				return "午前2時";  
				break;
			case "03":
				return "午前3時";  
				break;
			case "04":
				return "午前4時";  
				break;
			case "05":
				return "午前5時";  
				break;
			case "06":
				return "午前6時";  
				break;
			case "07":
				return "午前7時";  
				break;
			case "08":
				return "午前8時";  
				break;
			case "09":
				return "午前9時";  
				break;
			case "10":
				return "午前10時";  
				break;
			case "11":
				return "午前11時";  
				break;
			case "12":
//				return "午前12時";  2014.06.15 k.hamada modified
				return "午後0時";  
				break;
			case "13":
				return "午後1時";  
				break;
			case "14":
				return "午後2時";    
				break;
			case "15":
				return "午後3時";    
				break;
			case "16":
				return "午後4時";
				break;
			case "17":
				return "午後5時";  
				break;
			case "18":
				return "午後6時";  
				break;
			case "19":
				return "午後7時";  
				break;
			case "20":
				return "午後8時";  
				break;
			case "21":
				return "午後9時";  
				break;
			case "22":
				return "午後10時";  
				break;
			case "23":
				return "午後11時";  
				break;
			case "24":
//				return "午前12時";  2014.06.15 k.hamada modified
				return "午前0時";  
				break;
			case "25":
				return "午前1時";  
				break;
// 2014.06.15 k.hamada added ***日の切替は、AM4:00が基準***																									
			case "26":
				return "午前2時";  
				break;																									
			case "27":
				return "午前3時";  
				break;																									
// 2014.06.15 k.hamada added ***日の切替は、AM4:00が基準***																									
			default:
				return "午前00時";  
				break;
		}
	}
	

/***----------------***
 *** 時刻一覧を設定 ***
 ***----------------***/
	function get_Time_Sheet($arr_Time, $str_Type) {

		$int_Time = 0;
		$int_Time_Start = get_Hour($arr_Time[0]);
		$int_Time_End = get_Hour($arr_Time[count($arr_Time)-1]);
		for($i=$int_Time_Start; $i<=$int_Time_End; $i++) {
			$arr_Time_Sheetl[$int_Time] = new time_sheet();
			$arr_Time_Sheetl[$int_Time]->time   = get_Number_2byte($i);
			$arr_Time_Sheetl[$int_Time]->length = get_Time_Length($arr_Time, $i, $int_Time_End, $str_Type);
			$int_Time ++;
		}
		return($arr_Time_Sheetl);

	}

/***------------------------***
 *** 時刻の表示時刻への変換 ***
 ***------------------------***/
//時刻のところで時間別について高さを取得
	function get_Time_Length($arr_Time, $i, $int_Time_End, $str_Type) {

		global $glo_Length, $glo_Space_Length, $glo_Rajio_Length;

		switch($str_Type) {
			case "TV":
				$int_Minus = 0;
				break;
			case "FM":
				$int_Minus = $glo_Rajio_Length;
				break;
			case "BSR":
				$int_Minus = $glo_Rajio_Length;
				break;
		}
		$int_Length = $glo_Length - $int_Minus;

		$lng_Length = 0;
		if ($i == get_Hour($arr_Time[0])) {
			if ($i * 60 < get_Sum_Minute($arr_Time[0])) {
				$lng_Length = $lng_Length + $glo_Space_Length;
			}
			
			if( $int_Time_End == $i) {
				$lng_Length = $lng_Length + $int_Length;
			} else {
				$int_Run = 0;
				while((($i+1) * 60 >= get_Sum_Minute($arr_Time[$int_Run])) && (count($arr_Time)>$int_Run)) {
					$int_Run ++;
				} //end whille

				if (count($arr_Time) == $int_Run) {
					$lng_Length = $lng_Length + $int_Length * $int_Run;
				} else {
					$int_Run = $int_Run - 1;
					if (($i+1) * 60 == get_Sum_Minute($arr_Time[$int_Run])) {
						$lng_Length = $lng_Length + $int_Length * $int_Run;
					} else {
						$lng_Length = $lng_Length + $int_Length * ($int_Run + 1/2);
					}
				}
			}
		} elseif ($i == $int_Time_End){
			$int_Run = 0;
			while(($i * 60 > get_Sum_Minute($arr_Time[$int_Run])) && (count($arr_Time)>$int_Run)) {
				$int_Run ++;
			} //end while
			
			if(count($arr_Time) == $int_Run) {
				$lng_Length = $int_Length;
			} elseif ($i * 60 == get_Sum_Minute($arr_Time[$int_Run])) {
				$lng_Length = $int_Length * (count($arr_Time) - $int_Run);
			} else {
				$lng_Length = $int_Length * (count($arr_Time) - $int_Run + 1/2);
			}
		} else {
			$int_Run = 0;
			while(($i * 60 > get_Sum_Minute($arr_Time[$int_Run])) && (count($arr_Time)>$int_Run)) {
				$int_Run ++;
			} //end while

			if (count($arr_Time)>$int_Run) {
				$lng_Sentou = 0;
				if ($i * 60 != get_Sum_Minute($arr_Time[$int_Run])) {
					$lng_Sentou = $int_Length / 2;
				}

				$int_End = 0;
				while( (count($arr_Time)>$int_Run) && (($i+1) * 60 >= get_Sum_Minute($arr_Time[$int_Run]))) {
					$int_Run ++;
					$int_End ++;
				} //end while
				$int_Run --;
				$int_End --;
				if(count($arr_Time)>$int_Run) {
					if (($i+1) * 60 != get_Sum_Minute($arr_Time[$int_Run])) {
						$lng_Sentou = $lng_Sentou + $int_Length / 2;
					}
					$lng_Length = $lng_Sentou + $int_Length * $int_End;
				}
			}
		}
		$lng_Length = $lng_Length - 3;
		return($lng_Length);

	}

/***--------------------***
 *** タイムから時を取得 ***
 ***--------------------***/
	function get_Hour($day_Time) {

		$lng_Hour = substr($day_Time, 0, 2);
		return(number_format($lng_Hour));

	}

/***--------------------***
 *** タイムから分を取得 ***
 ***--------------------***/
	function get_Minute($day_Time) {

		$lng_Minute = substr($day_Time, 3, 2);
		return(number_format($lng_Minute));

	}

/***----------------------***
 *** タイムから分数を取得 ***
 ***----------------------***/
	function get_Sum_Minute($day_Time) {

		if($day_Time != 0) {
			$lng_Hour   = substr($day_Time, 0, 2);
			$lng_Minute = substr($day_Time, 3, 2);
			$lng_Sum    = number_format($lng_Hour) * 60 + number_format($lng_Minute);
		} else {
			$lng_Sum = 0;
		}
		return($lng_Sum);

	}

/***----------------------***
 *** 空白セルを先頭に追加 ***
 ***----------------------***/
	function get_Cell_Space($arr_channel, $arr_Time) {

		global $glo_Length;
		$int_Cell = 0;
		if(count($arr_channel) > 1) {
			for ($k=0; $k<count($arr_Time); $k++) {
				if($arr_channel[0]->time > $arr_Time[$k]) {
					$int_Cell++;
				} else {
					break;
				}
			} //end for($k)
		}
		if(count($arr_channel) == 1) {
			$int_Cell = count($arr_Time) ;
		}
		return($int_Cell * $glo_Length);

	}

/***--------------------***
 *** 番組のクラスを定義 ***
 ***--------------------***/
	function set_Bangumi_Class($arr_channel, $arr_Time) {

		for ($i=0; $i<count($arr_channel); $i++) {
			if ($i==0) {
				for ($j=0; $j<count($arr_channel[$i]); $j++) {
					if ($j % 2) {
						$arr_channel[$i][$j]->class = "even";
					} else {
						$arr_channel[$i][$j]->class = "odd";
					}
				} //end for($j)
			} else {
				if (count($arr_channel[$i]) > 1) {
					for ($j=0; $j<count($arr_channel[$i]); $j++) {
						$str_class = get_Channel_Check($arr_channel[$i][$j]->time, $arr_channel[0]);
						if($str_class != "") {
							$arr_channel[$i][$j]->class = $str_class;
						} else {
							if($j % 2) {
								$arr_channel[$i][$j]->class = "even";
							} else {
								$arr_channel[$i][$j]->class = "odd";
							}
						}
					} //end for($j)
				}
			}
		} //end for($i)
	}

/***-----------------------------------------------------------***
 *** チャンネル1で指定した番組タイムが存在するかどうかチェック ***
 ***-----------------------------------------------------------***/
	function get_Channel_Check($Time, $arr_channel) {

		$int_Position = "";
		for ($i=0; $i<count($arr_channel); $i++) {
			if($arr_channel[$i]->time == $Time) {
				$int_Position = $arr_channel[$i]->class;
				break;
			}
		} //end for($i)
		return($int_Position);

	}

/***--------------------------------***
 *** 番組を表示されるため高さを設定 ***
 ***--------------------------------***/
	function set_Bangumi_Length($arr_channel, $arr_Time, $str_Type) {

		global $glo_Length, $glo_Rajio_Length;
		switch($str_Type) {
			case "TV":
				$int_Minus = 0;
				break;
			case "FM":
				$int_Minus = $glo_Rajio_Length;
				break;
			case "BSR":
				$int_Minus = $glo_Rajio_Length;
				break;
		}

		for ($i=0; $i<count($arr_channel); $i++) {
			if (count($arr_channel[$i]) > 1) {
				for ($j=0; $j<count($arr_channel[$i]); $j++) {
					for ($k=0; $k<count($arr_Time); $k++) {
						if(($arr_Time[$k] == $arr_channel[$i][$j]->time) && (count($arr_Time)>$k + 1)) {
							$int_Count = 0;
							if(count($arr_channel[$i])>$j + 1) {
								for($l=$k; $l<count($arr_Time); $l++) {
									if($arr_Time[$l] < $arr_channel[$i][$j+1]->time) { 
										$int_Count ++;
									}
								} //end for($l)
							} else {
								$int_Count = count($arr_Time) - $k;
							}
							$arr_channel[$i][$j]->length = $int_Count * ($glo_Length - $int_Minus) - 3;
						}
					} //end for($k)
				} //end for($j)
			}
		} ////end for($i)
	}

/***--------------------***
 *** 時間一覧配列に格納 ***
/***--------------------***/
	function get_Time_List($arr_channel){

		$int_Post = 0;
		for ($i=0; $i<count($arr_channel); $i++) {
			if (count($arr_channel[$i]) > 1) {
				if ($int_Post == 0 ) {
					for ($k=0; $k<count($arr_channel[$i]); $k++) {
						$arr_Time[$k] = $arr_channel[$i][$k]->time;
					} //end for($k)
					$int_Post = count($arr_Time);
				} else {
					for ($k=0; $k<count($arr_channel[$i]); $k++) {
						if(! (get_Time_Check($arr_Time, $arr_channel[$i][$k]->time))) {
							$int_Post = count($arr_Time);
							$arr_Time[$int_Post] = $arr_channel[$i][$k]->time;
						}
					} //end for($k)
				}
			}
		} //end for($i)

		sort($arr_Time);
		return($arr_Time);

	}

/***----------------------------------------------------***
 *** 配列の中で指定された項目が存在するかどうかチェック ***
 ***----------------------------------------------------***/
	function get_Time_Check($arr_Time, $str_Time) {

		$check = false;
		for ($i=0; $i<count($arr_Time); $i++) {
			if($arr_Time[$i] == $str_Time) {
				$check = true;
				break;
			}
		}
		return($check);

	}

/***----------------------------------------------------------***
 *** 番組データファイル(.TXT)からデータを読み、配列に書き出す ***
 ***----------------------------------------------------------***/
	function get_File_Read($str_Type, $now_month, $now_date, $BS2_flg) {

		$j = 0;
		$int_read = 0;

		switch ($str_Type) {
			case "TV":
				if ( $BS2_flg == 0 ) {	//3チャネル放送
					$k = 3;
				} else {				//BS2チャネル放送
					$k = 2;
				}
				break;
			case "FM":
				$k = 1;
				break;
			case "BSR":
				$k = 1;
				break;
		}

		for($i=1; $i<=$k; $i++) {
			//ファイル名を取得
			if ( $str_Type == "TV" ) {
					$str_filename = "data/".get_2Byte($now_month).get_2Byte($now_date).$str_Type.get_2Byte($i).".TXT";

			} else {	//$str_Type : "FM"、"BSR" の場合有り
				$TodayBS2_flg = check_BS2($now_month, $now_date);

				//ファイル名を取得
				if ( $TodayBS2_flg == 0 ) {		//3チャネル放送期間
					$str_filename = "data/".get_2Byte($now_month).get_2Byte($now_date)."FM01.TXT";
				} else {						//BS2チャンネル放送
					$str_filename = "data/".get_2Byte($now_month).get_2Byte($now_date)."BSR.TXT";
				}
			}

			//ファイルを読み込み
			if (file_exists($str_filename)) {
				if ($fp = fopen ($str_filename, "r")) {
					$arr_channel[$int_read] = get_channel($str_filename, $fp, $str_Type);
					$int_read ++;

					//ファイルを閉じる
					fclose ($fp) ;
				} else {
					$arr_channel[$int_read][$int_read] = new bangumi_struct();
					$int_read ++;
				}
			} else {
				$arr_channel[$int_read][$int_read] = new bangumi_struct();
				$int_read ++;
			}

		} //end for($i)
		
		return($arr_channel);

}

/***------------------------------***
 *** 配列にファイル内容を設定する ***
 ***------------------------------***/
	function get_channel($str_filename, $fp, $str_Type){

		$arr_Time_Count = -1;
		global $glo_Length, $glo_Rajio_Length;

		switch($str_Type) {
			case "TV":
				$int_Minus = 0;
				break;
			case "FM":
				$int_Minus = $glo_Rajio_Length;
				break;
			case "BSR":
				$int_Minus = $glo_Rajio_Length;
				break;
		};

		//ファイルの読み込みと出力
		while (! feof ($fp)) {
			$str_Row = fgets ($fp, 4096);
			$str_Row = mb_convert_encoding($str_Row, "eucjp-win", "Shift_JIS");
			$int_Row = Get_Row_Type($str_Row);
			if ($int_Row == 3) {
				$arr_Time_Count ++;
				$arr_bangumi[$arr_Time_Count] = new bangumi_struct();
				$arr_TSC = get_Time_Subject_Content($str_Row);

				if (count($arr_TSC) > 0) {
					$arr_bangumi[$arr_Time_Count]->time    = trim($arr_TSC[0]);
				} else {
					$arr_bangumi[$arr_Time_Count]->time    = "";
				}

				if (count($arr_TSC) > 1) {
					$arr_bangumi[$arr_Time_Count]->subject = get_Double_Co(trim($arr_TSC[1]));
				} else {
					$arr_bangumi[$arr_Time_Count]->subject = "";	
				}

				if (count($arr_TSC) > 2) {
					$arr_bangumi[$arr_Time_Count]->content = get_Double_Co(trim($arr_TSC[2]));
				} else {
					$arr_bangumi[$arr_Time_Count]->content = "";
				}

				$arr_bangumi[$arr_Time_Count]->link    = get_Link_Sub($arr_bangumi[$arr_Time_Count]->subject);

				$arr_bangumi[$arr_Time_Count]->length  = $glo_Length - $int_Minus - 3;
			}

			if ($int_Row == 0) {
				$arr_bangumi[$arr_Time_Count]->content = get_Double_Co($arr_bangumi[$arr_Time_Count]->content.trim($str_Row));
			}

			if ($int_Row ==4) {	//担当講師
				$arr_bangumi[$arr_Time_Count]->charge = get_Double_Co(trim($str_Row));
			}
		} //end while

		if ($arr_Time_Count == -1) {
			$arr_bangumi[0] = new bangumi_struct();
		}

		return($arr_bangumi);

	}

/***------------------------------------------------------***
 *** 一行で時間、科目名、内容が含まれている場合、分割する ***
 ***------------------------------------------------------***/
	function get_Time_Subject_Content($str_Row) {

		$arr_bunrui = explode("  ", $str_Row, 3);
		return($arr_bunrui);

	}

/***----------------***
 *** 行の種類を取得 ***
 ***----------------***/
	function Get_Row_Type($str_Row) {

		$int_Row = 0;  //番組担当講師行の場合
		if (trim($str_Row) =="") {
			$int_Row = 1;
		} elseif (preg_match("/^SUB/", $str_Row, $matches)) {
			$int_Row = 2;
		} elseif (preg_match("/^\d\d:\d\d/", $str_Row, $matches)) {
			$int_Row = 3;
		} elseif (preg_match("/^担当講師/", $str_Row, $matches)) {
			$int_Row = 4;
		}
		return($int_Row);

	}

/***-------------------------***
 *** 月、日の2桁の形式を設定 ***
 ***-------------------------***/
	function get_2Byte($int_input) {

		if ($int_input < 10) {
			$int_output = "0".$int_input;
		} else {
			$int_output = $int_input;
		}
		return($int_output);

	}

/***------------------------------------------------***
 *** 科目名から放送大学サイトの中で科目リンクを取得 ***
 ***------------------------------------------------***/
	function get_Link_Sub($subject) {
		$SERVER		= "localhost";
		$USERNAME	= "oujuser";
		$PASSWORD	= "ouj20100401";
		$DBNAME		= "bangumi";

		$str_Link	= "";

		//*** start added k.hamada 2014/06/05
		//本番環境では、実行時間のタイムオーバー発生していない。
		ini_set("max_execution_time",180);
		set_time_limit(180);
		//*** end added k.hamada 2014/06/05

		//「Mysql」サーバに接続する
		$conn = mysql_connect($SERVER, $USERNAME, $PASSWORD);
		if (!$conn){ 
			$str_Link = "";
		}

		//「bangumi」データベースを接続する
		if (!mysql_select_db($DBNAME, $conn)) {
			$str_Link = "";
		}

		$str_Subject =  get_Change($subject);
		$sql_select = "SELECT * FROM bangumidata WHERE STR_KEY like binary '".$str_Subject."'";
		$sql_result = mysql_query($sql_select, $conn);
		if (!$sql_result) {
			$str_Link = "";
		} else {
			//出た件数を数える
			$sql_count=mysql_num_rows($sql_result);

			//見つけた場合    
			if ($sql_count>0) {
				while ($sql_row=mysql_fetch_array($sql_result)) {
					if (trim($sql_row['STR_VALUE']) != "") {
						$str_Link = $sql_row['STR_VALUE'];
						break;
					}
				} //end while
			}
		}

		mysql_close($conn);
		if ($str_Link == "") {
			$str_Link = get_Link_Soto($str_Subject);
		}
		return($str_Link);

}

/***------------------------------------------***
 *** 「add_link」データベースからリンクを取得 ***
 ***------------------------------------------***/
	function get_Link_Soto($str_Subject) {
		$SERVER		= "localhost";
		$USERNAME	= "oujuser";
		$PASSWORD	= "ouj20100401";
		$DBNAME		= "add_link";

		$str_Link	= "";
    
		//「Mysql」サーバに接続する
		$conn = mysql_connect($SERVER, $USERNAME, $PASSWORD);
		if (!$conn){ 
			$str_Link = "";
		}

		//「add_link」データベースを接続する
		if(!mysql_select_db($DBNAME, $conn)) {
			$str_Link = "";
		}

		$sql_select = "SELECT * FROM add_link_data WHERE STR_KEY like binary '".$str_Subject."'";
		$sql_result = mysql_query($sql_select, $conn);
		if (!$sql_result) {
			$str_Link = "";
		} else {
			//出た件数を数える
			$sql_count=mysql_num_rows($sql_result);

			//見つけた場合    
			if ($sql_count>0) {
				while($sql_row=mysql_fetch_array($sql_result)) {
					if (trim($sql_row['STR_VALUE']) != "") {
						$str_Link = $sql_row['STR_VALUE'];
						break;
					}
				} //end while
			}
		}

		mysql_close($conn);
		return($str_Link);

	}

/***------------***
 *** 記号の変換 ***
 ***------------***/
	function get_Change($str) {

		$str = str_replace('"', '”', $str);
		$str = str_replace("'", "’", $str);
		$str = str_replace("―", "ー", $str);
		$str = str_replace("-", "ー", $str);
		$str = str_replace("−", "ー", $str);
		$str = str_replace("\\", "￥", $str);
		//$str = mb_convert_kana($str, A, "eucjp-win");
		$str = mb_convert_kana($str, "A", "eucjp-win");  // modified k.hamada 2014/06/05
		return($str);

	}

/***----------------------***
 *** 数字フォーマット設定 ***
 ***----------------------***/
	function get_Number_2byte($int_Input) {

		if($int_Input < 10) {
			$int_Output = "0".$int_Input;
		} else {
			$int_Output = $int_Input;
		}
		return($int_Output);

	}

/***----------------***
 *** 曜日を返す関数 ***
 ***----------------***/
	function get_Youbi() {

		$now_month = get_month();			//月を取得
		$now_date =  get_date();			//日を取得
		$BS2_flg = check_BS2($now_month, $now_date);

		$str_month = get_2Byte($now_month);			//月を取得
		$str_date = get_2Byte($now_date);			//日を取得
		if ( $BS2_flg == 0 ) {		//3チャネル放送
			$str_filename = "data/".$str_month.$str_date."FM01.TXT";	//データファイル名を取得
		} else {
			$str_filename = "data/".$str_month.$str_date."BSR.TXT";		//データファイル名を取得
		}

		//ファイルを読み込み
		if ( ! ($fp = fopen ($str_filename, "r"))) {

		} else {
			//ファイルの読み込みと出力
			while (! feof ($fp)) {
				$str_Row = fgets ($fp, 4096);
				$str_Row = mb_convert_encoding($str_Row, "eucjp-win", "Shift_JIS");
				$int_Row = Get_Row_Type($str_Row);
				if ($int_Row == 2) {
					$int_pos = strpos($str_Row, ")");
					if($int_pos == false) { 
						$int_pos = strpos($str_Row, "）");
					}

					if($int_pos !== false) {
						$str_youbi = substr(trim(str_replace("　", " ", substr($str_Row, 0, $int_pos))), -2);
					}

					break;
				}
			}
		}

		//リターン値
		if ($str_youbi != "") {
			return($str_youbi);
		} else {
			return("");
		}

	}

/***------------***
 *** 元々幅指定 ***
 ***------------***/
	function get_Length() {

		$str_type = htmlspecialchars(@$_GET['type']);
		if ($str_type =="") {
			return(160);
		} else {
			return(80);
		}
	}

/***----------------------------***
 *** ダブルクォーテーション対策 ***
 ***----------------------------***/
	function get_Double_Co($str_input) {

		$str = str_replace("\"", "”", $str_input);
		$str = str_replace("\\", "￥", $str);
		return($str);

	}

?>
