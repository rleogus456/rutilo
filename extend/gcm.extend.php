<?php
	function send_GCM($reg_id,$title,$content){
		$apiKey = "AAAASd-GxiE:APA91bFV3sfR8TL7iP82Fq7e_xW4Omr7bvfDo4nr2Q3iPtOlY-o97uAVY5Ar6Nl8hSJ-Je88D2wsGM3tKZV7v_VM08_bVxCKqRzrmdAT--6mZkM_hH1hlq-H4doFD5AzA7onRzGCdAxS";
		$regId_array=array($reg_id);
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
			'registration_ids' => $regId_array,
			'data' => array( "title"=>$title,"message" => $content ),
		 );
		$headers = array(
			'Authorization: key='.$apiKey,
			'Content-Type: application/json'
		);
		$ch = curl_init();
		// Set the URL, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		// Execute post
		$result = curl_exec($ch);
		// Close connection
		curl_close($ch);
		$decode = json_decode($result, true);
	}
	function send_reserve_GCM($title,$content){
		$apiKey = "AAAASd-GxiE:APA91bFV3sfR8TL7iP82Fq7e_xW4Omr7bvfDo4nr2Q3iPtOlY-o97uAVY5Ar6Nl8hSJ-Je88D2wsGM3tKZV7v_VM08_bVxCKqRzrmdAT--6mZkM_hH1hlq-H4doFD5AzA7onRzGCdAxS";
		$sql = "select regid from `g5_member` WHERE (mb_id='admin') and (regid<>'' and off_gcm='0');";
		$rs = sql_query($sql);
		$num = mysql_num_rows($rs);
		for($i=0;$row=sql_fetch_array($rs);$i++){
			$regid[$i] = $row["regid"];
		}
		$url = 'https://android.googleapis.com/gcm/send';
		$headers = array(
			'Authorization: key='.$apiKey,
			'Content-Type: application/json'
		);
		$result = "";
		$arr = array();
		$regiSize = round(sizeof($regid)/1000);
		if($regiSize==0){
			$regiSize=1;
		}
		for($i=0;$i<$regiSize;$i++){
			$arr[$i] = array();
			$arr[$i]['data'] = array();
			$arr[$i]['data']['title'] = $title;
			$arr[$i]['data']['message'] = $content;
			$arr[$i]['registration_ids'] = array();
			$size = sizeof($regid);
			if($size > 1000){
				for($j=0;$j<1000;$j++){
					$arr[$i]['registration_ids'][$j] = $regid[$j];
				}
				$regid = array_splice($regid, 1000);
			}else{
				for($j=0;$j<$size;$j++){
					$arr[$i]['registration_ids'][$j] = $regid[$j];
				}
			}
		}
		for($i=0;$i<sizeof($arr);$i++){
			$ch = curl_init();

			// Set the URL, number of POST vars, POST data
			curl_setopt( $ch, CURLOPT_URL, $url);
			curl_setopt( $ch, CURLOPT_POST, true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr[$i]));

			// Execute post
			$result = curl_exec($ch);
			
			// Close connection
			curl_close($ch);

			$decode = json_decode($result, true);

			$Success = $Success + $decode["success"];
			$Failure = $Failure + $decode["failure"];

			$result .= $result;
		}
	}
	function send_all_GCM($title,$content){
		$apiKey = "AAAASd-GxiE:APA91bFV3sfR8TL7iP82Fq7e_xW4Omr7bvfDo4nr2Q3iPtOlY-o97uAVY5Ar6Nl8hSJ-Je88D2wsGM3tKZV7v_VM08_bVxCKqRzrmdAT--6mZkM_hH1hlq-H4doFD5AzA7onRzGCdAxS";
		$sql = "select regid from `g5_member` WHERE regid<>'' and off_gcm='0';";
		$rs = sql_query($sql);
		$num = mysql_num_rows($rs);
		for($i=0;$row=sql_fetch_array($rs);$i++){
			$regid[$i] = $row["regid"];
		}
		$url = 'https://android.googleapis.com/gcm/send';
		$headers = array(
			'Authorization: key='.$apiKey,
			'Content-Type: application/json'
		);
		$result = "";
		$arr = array();
		$regiSize = round(sizeof($regid)/1000);
		if($regiSize==0){
			$regiSize=1;
		}
		for($i=0;$i<$regiSize;$i++){
			$arr[$i] = array();
			$arr[$i]['data'] = array();
			$arr[$i]['data']['title'] = $title;
			$arr[$i]['data']['message'] = $content;
			$arr[$i]['registration_ids'] = array();
			$size = sizeof($regid);
			if($size > 1000){
				for($j=0;$j<1000;$j++){
					$arr[$i]['registration_ids'][$j] = $regid[$j];
				}
				$regid = array_splice($regid, 1000);
			}else{
				for($j=0;$j<$size;$j++){
					$arr[$i]['registration_ids'][$j] = $regid[$j];
				}
			}
		}
		for($i=0;$i<sizeof($arr);$i++){
			$ch = curl_init();

			// Set the URL, number of POST vars, POST data
			curl_setopt( $ch, CURLOPT_URL, $url);
			curl_setopt( $ch, CURLOPT_POST, true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr[$i]));

			// Execute post
			$result = curl_exec($ch);
			
			// Close connection
			curl_close($ch);

			$decode = json_decode($result, true);

			$Success = $Success + $decode["success"];
			$Failure = $Failure + $decode["failure"];

			$result .= $result;
		}
	}
?>