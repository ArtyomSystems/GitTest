<?php
/***--- 2018-08-27 add k.h ---------------------------------***
 *** BS放送開始以降であるか判断する                         ***
 *** 2018/10/01以降、BS放送                                 ***
 *** Return ( 0 :３チャネル－放送   1 :BS２チャンネル放送 ) ***
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

?>
