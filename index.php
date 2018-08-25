<?php
date_default_timezone_set("Asia/Bangkok");


require_once('class/class.lineAPI.php');
$line = new lineAPI();

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 

$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];

$userId 	= $arrJson['events'][0]['source']['userId'];
$messageId 	= $arrJson['events'][0]['message']['id'];
$roomId 	= $arrJson['events'][0]['source']['roomId'];
$groupId 	= $arrJson['events'][0]['source']['groupId'];
$array_message = explode('/',strtolower($arrJson['events'][0]['message']['text']));
if(sizeof($array_message)==2){
	$role = '';
	$name = $line -> createAgentProfile($userId,$role);
	switch($array_message[1]){
		case 'new':
		if($name==''){
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "สวัสดีค่ะคุณยังไม่ได้เพิ่มเป็นเพื่อนค่ะ\nกรุณาเพิ่มเป็นเพื่อนก่อนนะคะ";
		}else{
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบพร้อมใช้งานแล้วค่ะ" 
			."\n1. วิธี login พิมพิ์  code/login"
			."\n2. วิธี logout พิมพิ์  code/logout"
			."\n3. วิธี พักหลังจากจบ line (ACW) พิมพิ์  code/acw"
			."\n4. วิธี พัก line ด้วยเหตุผล (reason) พิมพิ์  code/dnd";
		}
		break;
		
		case 'login':
			$data = array('cocode'=>$array_message[0],'userid'=>$userId);
			$response = $line -> login($data);
			if($response['result']=='success'){
				$arrPostData['messages'][0]['type'] = "text";
				$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบพร้อมใช้งานแล้วค่ะ"; 
			}else{
				$arrPostData['messages'][0]['type'] = "text";
				$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบไม่สามารถ Login ได้ค่ะ\nกรุณาตรวจสอบข้อมูลอีกครั้งค่ะ";
			}
			

		break;
		
		case 'logout':
			$data = array('cocode'=>$array_message[0],'userid'=>$userId);
			$response = $line -> logout($data);
			if($response['result']=='success'){
				$arrPostData['messages'][0]['type'] = "text";
				$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบยกเลิกการใช้งานแล้วค่ะ";
			}else{
				$arrPostData['messages'][0]['type'] = "text";
				$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบไม่สามารถ Logout ได้ค่ะ\nกรุณาตรวจสอบข้อมูลอีกครั้งค่ะ";
			}
			
		break;
		
		case 'acw':
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบพักการใช้งานชั่วขณะแล้วค่ะ";
		break;
		
		case 'dnd':
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nระบบพักการใช้งานแล้วค่ะ";
		break;
	}

	$line->Reply_Message($arrPostData);

}
else {

		$results = $line -> getUserProfile($userId);
	  
		if(sizeof($results)< 2){
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "สวัสดีค่ะคุณยังไม่ได้เพิ่มทางเราเป็นเพื่อนค่ะ\nกรุณาเพิ่มเป็นเพื่อนก่อนนะคะ";
		}
		else{
		//ตรวจสอบว่า เป็น agent หรือ ผู้ติดต่อ

		$acd = array("cmd" => "ACD");
		$r = $line->ACD($acd);
		$agentId = $r['agentid'];
		$uID = array("userid" => $userId);
		$res = $line -> AgentCheck($uID);
		
		if($res['result']== '1'){
			$type = 'A';
			
		}else{
			$type = 'C';
			
		}
		
		$data = array("userid" => $userId,"agentid" => $agentId,"type"=>$type);
		$rs = $line -> CoreState($data);
		$uniqueid = $rs['uniqueid'];
		
			$date_time = date("d/m/Y H:i:s");
			$name = $results['displayName'];
			$pic = $results['pictureUrl'];
			
			
			switch($arrJson['events'][0]['message']['type']){
			  case 'text':
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง Text"
								);
				$messages = array(
									"type"	=> "text",
									"text"	=> $arrJson['events'][0]['message']['text']
								);
				//ค้นหาข้อมูลใน ฐานข้อมูล google แล้วนำมาตอบกลับไป ถ้าเป็น AI
				
				
			  break;
			  
			  case 'image':
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง Image"
								);
				$messages = array(
									"type"					=> "image",
									"originalContentUrl"	=> $arrJson['events'][0]['message']['originalContentUrl'],
									"previewImageUrl"		=> $arrJson['events'][0]['message']['previewImageUrl']
								);
			  break;
			  
			  case 'video':
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง Video"
								);
				$messages = array(
									"type"					=> "video",
									"originalContentUrl"	=> $arrJson['events'][0]['message']['originalContentUrl'],
									"previewImageUrl"		=> $arrJson['events'][0]['message']['previewImageUrl']
								);
			  break;
			  
			  case 'audio':
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง Audio"
								);
				$messages = array(
									"type"					=> "audio",
									"originalContentUrl"	=> $arrJson['events'][0]['message']['originalContentUrl'],
									"duration"				=> $arrJson['events'][0]['message']['duration']
								);
			  break;
			  
			  case 'file':
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง File"
								);
				$messages = array(
									"type"		=> "file",
									"fileName"	=> $arrJson['events'][0]['message']['fileName'],
									"fileSize"	=> $arrJson['events'][0]['message']['fileSize']
								);
			  break;
			  
			  case 'location':
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง  Location"
								);
				$messages = array(
									"type"	=> "location",
									"title"	=> "ส่งพิกัด โดยคุณ ".$name,
									"address"	=> $arrJson['events'][0]['message']['address'],
									"latitude"	=> $arrJson['events'][0]['message']['latitude'],
									"longitude"	=> $arrJson['events'][0]['message']['longitude']
								);
			  break;
			 
			  
			  case 'sticker':
		
				$event = array(
									"type"		=> $type,
									"sendby"	=> $name,
									"senddate"	=> $date_time,
									"comment"	=> "คุณ ".$name." ส่ง Sticker"
								);
				$messages = array(
									"type"		=> "sticker",
									"packageId"	=> $arrJson['events'][0]['message']['packageId'],
									"stickerId" => $arrJson['events'][0]['message']['stickerId']
								);
				
			  break;
			}
			$mtext = array(
					"event" 	=> $event,
					"message"	=> $messages
				);
			
			$cdr = array(
					"linedate"		=> $date_time,
					"uniqueid"		=> $uniqueid,
					"messageid"		=> $messageId,
					"roomid"		=> $roomId,
					"groupid"		=> $groupId,
					"mtype"			=> $type,
					"src" 			=> $userId,
					"dst" 			=> $agentId,
					"mtext"			=> $mtext
				);
			$line -> mdr($cdr);
		
		
	}

}

?>