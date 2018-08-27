<?php
date_default_timezone_set("Asia/Bangkok");
$date_time = date("d/m/Y H:i:s");

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
		if($results['userId'] == ""){
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "สวัสดีค่ะคุณยังไม่ได้เพิ่มทางเราเป็นเพื่อนค่ะ\nกรุณาเพิ่มเป็นเพื่อนก่อนนะคะ";
		}
		else{
			
/*{
  "type": "template",
  "altText": "This is a buttons template",
  "template": {
      "type": "buttons",
      "thumbnailImageUrl": "http://thailandsmartai.com/GW/asset/mini.jpg",
      "imageAspectRatio": "rectangle",
      "imageSize": "cover",
      "imageBackgroundColor": "#FFFFFF",
      "title": "Menu",
      "text": "Please select",
      "defaultAction": {
          "type": "uri",
          "label": "View detail",
          "uri": "https://www.tot.co.th"
      },
      "actions": [
          {
            "type": "postback",
            "label": "Buy",
            "data": "action=buy&itemid=123"
          },
          {
            "type": "postback",
            "label": "Add to cart",
            "data": "action=add&itemid=123"
          },
          {
            "type": "uri",
            "label": "View detail",
            "uri": "https://www.tot.co.th"
          }
      ]
  }
}*/
$defaultAction  = array(
		"type" 					=> "uri",
		"label"					=> "ข้อมูลทาง บริษัทเรา",
		"uri" 					=> "https://www.tot.co.th"
	);
$Actions[]  = array(
		"type" 					=> "postback",
		"label"					=> "คุยกับ คุณ ชบา",
		"data" 					=> "action=chabar&userid=".$userId
	);
$Actions[]  = array(
		"type" 					=> "postback",
		"label"					=> "คุยกับ พนักงาน",
		"data" 					=> "action=agent&userid=".$userId
	);
$template  = array(
		"type" 					=> "buttons",
		"thumbnailImageUrl"		=> "http://thailandsmartai.com/GW/asset/mini.jpg",
		"imageAspectRatio" 		=> "rectangle",
		"templateimageSize" 	=> "cover",
		"imageBackgroundColor" 	=> "#FFFFFF",
		"title" 				=> "รายการ",
		"text" 					=> "เลือกรายการเลยค่ะ",
		"defaultAction" 		=> $defaultAction,
		"actions" 				=> $Actions
	);
$messages[] = array(
					"type"					=> "text",
					"text"					=> "สวัสดีค่ะคุณ ".$name." ยินดีให้บริการค่ะ\nกรุณาเลือกทำรายการได้เลยคะ"
					
		);
$messages[] = array(
					"type"					=> "template",
					"altText"				=> "สวัสดีค่ะคุณ ".$name." ยินดีให้บริการค่ะ\nกรุณาเลือกทำรายการได้เลยคะ",
					"template"				=> $template
					
		);
/*			$arrPostData['messages'][0]['type'] = "template";
			$arrPostData['messages'][0]['altText'] = "สวัสดีค่ะคุณ ".$name." ยินดีให้บริการค่ะ\nกรุณาเลือกทำรายการได้เลยคะ";
			$arrPostData['messages'][0]['template']['type'] = "buttons";
			$arrPostData['messages'][0]['template']['thumbnailImageUrl'] = "http://thailandsmartai.com/GW/asset/mini.jpg";
			$arrPostData['messages'][0]['template']['imageAspectRatio'] = "rectangle";
			$arrPostData['messages'][0]['template']['templateimageSize'] = "cover";
			$arrPostData['messages'][0]['template']['imageBackgroundColor'] = "#FFFFFF";
			$arrPostData['messages'][0]['template']['title'] = "เมนู";
			$arrPostData['messages'][0]['template']['text'] = "กรุณาเลือกทำรายการ";
			$arrPostData['messages'][0]['template']['defaultAction']['type'] = "uri";
			$arrPostData['messages'][0]['template']['defaultAction']['label'] = "ข้อมูลทางเรา";
			$arrPostData['messages'][0]['template']['defaultAction']['uri'] = "https://www.tot.co.th";
			$arrPostData['messages'][0]['template']['actions'][0]['type'] = "postback";
			$arrPostData['messages'][0]['template']['actions'][0]['label'] = "คุยกับชบา";
			$arrPostData['messages'][0]['template']['actions'][0]['data'] = "action=chabar&userid=".$userId;
			$arrPostData['messages'][0]['template']['actions'][1]['type'] = "postback";
			$arrPostData['messages'][0]['template']['actions'][1]['label'] = "ติดต่อพนักงาน";
			$arrPostData['messages'][0]['template']['actions'][1]['data'] = "action=agent&userid=".$userId;*/
$line->Reply_Message($messages);
//$arrPushData = array("to"=>$userId,"messages"=>$messages);
//						$line->Push_Message($arrPushData);
		//ตรวจสอบว่า เป็น agent หรือ ผู้ติดต่อ

		$acd = array("cmd" => "ACD","userid"=>$userId);
		$r = $line->ACD($acd);
		$agentId = $r['agentid'];
		if($agentId != "A"){
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
			
				
				
				
				switch($arrJson['events'][0]['message']['type']){
				  case 'text':
					$event = array(
										"type"		=> $type,
										"senddate"	=> $date_time
									);
					$messages[] = array(
										"type"	=> "text",
										"text"	=> $arrJson['events'][0]['message']['text']
									);
					//ค้นหาข้อมูลใน ฐานข้อมูล google แล้วนำมาตอบกลับไป ถ้าเป็น AI
					
					
				  break;
				  
				  case 'image':
					$event = array(
										"type"		=> $type,
										"senddate"	=> $date_time
									);
					/*{
  "type": "image",
  "originalContentUrl": "PROVIDE_URL_FROM_YOUR_SERVER",
  "previewImageUrl": "PROVIDE_URL_FROM_YOUR_SERVER",
  "animated": false
}*/
					$messages[] = array(
										"type"					=> "image",
										"originalContentUrl"	=> $arrJson['events'][0]['message']['originalContentUrl'],
										"previewImageUrl"		=> $arrJson['events'][0]['message']['previewImageUrl']
									);
				  break;
				  
				  case 'video':
					$event = array(
										"type"		=> $type,
										"senddate"	=> $date_time
									);
					$messages[] = array(
										"type"					=> "video",
										"originalContentUrl"	=> $arrJson['events'][0]['message']['originalContentUrl'],
										"previewImageUrl"		=> $arrJson['events'][0]['message']['previewImageUrl']
									);
				  break;
				  
				  case 'audio':
					$event = array(
										"type"		=> $type,
										"senddate"	=> $date_time
									);
					$messages[] = array(
										"type"					=> "audio",
										"originalContentUrl"	=> $arrJson['events'][0]['message']['originalContentUrl'],
										"duration"				=> $arrJson['events'][0]['message']['duration']
									);
				  break;
				  
				  case 'file':
					$event = array(
										"type"		=> $type,
										"senddate"	=> $date_time
									);
					$messages[] = array(
										"type"		=> "file",
										"fileName"	=> $arrJson['events'][0]['message']['fileName'],
										"fileSize"	=> $arrJson['events'][0]['message']['fileSize']
									);
				  break;
				  
				  case 'location':
					$event = array(
										"type"		=> $type,
										"senddate"	=> $date_time
									);
					$messages[] = array(
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
										"senddate"	=> $date_time
									);
					$packageId = $arrJson['events'][0]['message']['packageId'];
					$stickerId = $arrJson['events'][0]['message']['stickerId'];
					
					$messages[] = array(
										"type"	=> "text",
										"text"	=> "Package : ".$packageId ."\nSticker : ".$stickerId
									);
					$messages[] = array(
										"type"	=> "sticker",
										"packageId"	=> $packageId,
										"stickerId"	=> $packageId
									);
					
				  break;
				}
				
				$data = array("uniqueid" => $uniqueid,"userid"=>$userId);
				$response = $line->SrcDstId($data);
				$userid = $response['userid'];
				$agentid = $response['agentid'];
				
				if(strlen($roomId) < 10){
					
					if($type=='A'){						
						$arrPushData = array("to"=>$userid,"messages"=>$messages);
						$line->Push_Message($arrPushData);
					}else {
						$arrPushData = array("to"=>$agentid,"messages"=>$messages);
						$line->Push_Message($arrPushData);
					}
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
						"src" 			=> $userid,
						"dst" 			=> $agentid,
						"mtext"			=> $mtext
					);

				$line -> mdr($cdr);
				unset($messages);
		}else{
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "คุณ " .$name. " คะ\nขณะนี้พนักงานไม่สามารถให้บริการท่านได้\nกรุณารอสักครู่ ท่านจะได้รับบริการโดยเร็วที่สุดค่ะ";
			$arrPostData['messages'][0]['type'] = "sticker";
			$arrPostData['messages'][0]['packageId'] = 1;
			$arrPostData['messages'][0]['stickerId'] = 5;
		
			$line->Reply_Message($arrPostData);
		}
		
	}

}

?>