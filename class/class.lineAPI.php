<?php

class lineAPI {
	var $accToken; 
	var $apiUrl_push;
	var $apiUrl_multicast;
	var $apiUrl_reply;
	var $apiUrl_profile;
 
    function __construct() {
		$this->accToken 		= "O9yyPdY0+txPZb0aEFKNeJ0rwnoinigsIeVE0DuJFDArnh+RaLLXH7bTzXW1kj5VYP+4mqtwT7qnG/fa1SgNEZNlTSDa7Ur6aBWMxC5WnSS2pt5CrdSAM9fyEMDI4XMUmnBuK/xq2FruStgIWPWBRAdB04t89/1O/w1cDnyilFU=";
		$this->apiUrl_push 		= "https://api.line.me/v2/bot/message/push";
		$this->apiUrl_multicast = "https://api.line.me/v2/bot/message/multicast";
		$this->apiUrl_reply 	= "https://api.line.me/v2/bot/message/reply";
		$this->apiUrl_profile 	= "https://api.line.me/v2/bot/profile";
	}
	function Reply_Menu($arrPostData){
		$strUrl = $this->apiUrl_reply;
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	function Reply_Message($arrPostData){
		$strUrl = $this->apiUrl_reply;
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	function Push_Message($arrPostData){
		$strUrl = $this->apiUrl_push;
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	function Multicast_Message($arrPostData){
		$strUrl = $this->apiUrl_multicast;
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	function Get_Content($messageId){
		$strUrl = "https://api.line.me/v2/bot/message/{$messageId}/content";
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	function pushToDB($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/push.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
		curl_close ($ch);

	}
	function mdr($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/mdr.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
		curl_close ($ch);

	}
	function login($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/login.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	
	function logout($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/logout.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	function SrcDstId($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/srcdst.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	function InitState($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/initstate.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	function CoreState($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/corestate.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	function ACD($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/acd.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	function GetUNQ($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/getunq.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	function AgentCheck($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/agent.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);
	}
	
	function ToTalk($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/talk.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}

	function getAgentState($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/agentstate.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
		return json_decode($result,true);

	}
	
	function updateAgentState($arrPostData){
		$strUrl = "http://www.thailandsmartai.com/GW/push.json/?data=".base64_encode(json_encode($arrPostData));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
		curl_close ($ch);

	}
	
	function getUserProfile($userId){
		$strUrl = $this->apiUrl_profile ."/{$userId}";
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
	
		$data = json_decode($result,true);
		curl_close ($ch);
		
		if(sizeof($data) == 4){
			$users = array(
							"userId"		=> $data['userId'],
							"displayName"	=> $data['displayName'],
							"pictureUrl"	=> $data['pictureUrl'],
							"statusMessage"	=> $data['statusMessage'],
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> "EndUser",
							"status" 	=> "1"
						);	
		}else if(sizeof($data) == 3){
			$users = array(
							"userId"		=> $data['userId'],
							"displayName"	=> $data['displayName'],
							"pictureUrl"	=> $data['pictureUrl'],
							"statusMessage"	=> "",
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> "EndUser",
							"status" 	=> "1"
						);	

		}else{
			$users = array(
							"userId"		=> $data['userId'],
							"displayName"	=> $data['displayName'],
							"pictureUrl"	=> $data['pictureUrl'],
							"statusMessage"	=> "",
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> "EndUser",
							"status" 	=> "1"
						);	
		}
		
		$arrPostData = array(
				"users" => $users
			);
		$this->pushToDB($arrPostData);
		
		return $users;
	}
	
	function createAgentProfile($userId,$role){
		$strUrl = $this->apiUrl_profile ."/{$userId}";
 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$this->accToken}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
	
		$data = json_decode($result,true);
		curl_close ($ch);
		if(sizeof($data) == 4){
			$users = array(
							"userId"		=> $data['userId'],
							"displayName"	=> $data['displayName'],
							"pictureUrl"	=> $data['pictureUrl'],
							"statusMessage"	=> $data['statusMessage'],
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> $role,
							"status" 	=> "1"
						);	
		}else if(sizeof($data) == 3){
			$users = array(
							"userId"		=> $data['userId'],
							"displayName"	=> $data['displayName'],
							"pictureUrl"	=> $data['pictureUrl'],
							"statusMessage"	=> "",
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> $role,
							"status" 	=> "1"
						);	

		}else{
			$users = array(
							"userId"		=> $data['userId'],
							"displayName"	=> $data['displayName'],
							"pictureUrl"	=> $data['pictureUrl'],
							"statusMessage"	=> "",
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> $role,
							"status" 	=> "1"
						);	
		}
		$arrPostData = array(
				"agents" => $users
			);
		$this->pushToDB($arrPostData);
		
		return $arrPostData['agents']['displayName'];
}
	
	// Rich Menu
function Greeting_MENU($replyToken,$userId,$name){
		
		$Actions1[]  = array(
				"type" 					=> "message",
				"label"					=>  "คุยกับ คุณชบา คลิกเลยค่ะ",
				"text" 					=>  "คุยกับ คุณชบา คลิกเลยค่ะ"
			);
		$Actions1[]  = array(
				"type" 					=> "message",
				"label"					=> "คุยกับ พนักงาน คลิกค่ะ",
				"text" 					=> "คุยกับ พนักงาน คลิกค่ะ"
			);
		$Actions1[]  = array(
				"type" 					=> "message",
				"label"					=> "AIS Call",
				"text" 					=> "0905239695"
			);
		$columns[]  = array(
				"thumbnailImageUrl"		=> "https://upload.wikimedia.org/wikipedia/commons/7/78/Image.jpg",
				"title" 				=> "บริษัท linePBX จำกัด ",
				"text" 					=> "ดูรายละเอียดสินค้า คลิกเลยค่ะ",
				"actions" 				=> $Actions1
			);
		$Actions2[]  = array(
				"type" 					=> "message",
				"label"					=> "DTAC Call",
				"text" 					=> "0905239695"
			);
		$Actions2[]  = array(
				"type" 					=> "message",
				"label"					=> "TRUE Call",
				"text" 					=> "0905239695"
			);
		$Actions2[]  = array(
				"type" 					=> "message",
				"label"					=> "TOT Call",
				"text" 					=> "0905239695"
			);
		$columns[]  = array(
				"thumbnailImageUrl"		=> "https://upload.wikimedia.org/wikipedia/commons/7/78/Image.jpg",
				"title" 				=> "บริษัท LinePBX จำกัด ",
				"text" 					=> "ดูรายละเอียดสินค้า คลิกเลยค่ะ",
				"actions" 				=> $Actions2
			);
		$template  = array(
				"type" 					=> "carousel",
				"actions"				=> "[]",
				"columns"				=> $columns
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
		$data = array("replyToken" => $replyToken,"messages" => $messages);
		$this->Reply_Message($data);
}	
function MAIN_MENU_X($replyToken,$userId,$name){
		$defaultAction  = array(
				"type" 					=> "uri",
				"label"					=> "ข้อมูลทาง บริษัทเรา",
				"uri" 					=> "https://www.tot.co.th"
			);
		$Actions[]  = array(
				"type" 					=> "postback",
				"label"					=> "คุยกับ คุณชบา คลิกเลยค่ะ",
				"data" 					=> "action=chabar&userid=".$userId
			);
		$Actions[]  = array(
				"type" 					=> "postback",
				"label"					=> "คุยกับ พนักงาน คลิกค่ะ",
				"data" 					=> "action=agent&userid=".$userId
			);
		
		$Actions[]  = array(
				"type" 					=> "message",
				"label"					=> "AIS Call 0905239695",
				"text" 					=> "0905239695"
			);
		$template  = array(
				"type" 					=> "buttons",
				"thumbnailImageUrl"		=> "https://upload.wikimedia.org/wikipedia/commons/7/78/Image.jpg",
				"imageAspectRatio" 		=> "rectangle",
				"templateimageSize" 	=> "cover",
				"imageBackgroundColor" 	=> "#BFDFFF",
				"title" 				=> "บริษัท linePBX จำกัด ",
				"text" 					=> "ดูรายละเอียดสินค้า คลิกเลยค่ะ",
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
		$data = array("replyToken" => $replyToken,"messages" => $messages);
		$this->Reply_Message($data);
}
function MAIN_MENU($replyToken,$userId,$name){	
	$datajson = '{
	  "type": "bubble",
	  "styles": {
		"footer": {
		  "backgroundColor": "#42b3f4"
		}
	  },
	  "header": {
		"type": "box",
		"layout": "horizontal",
		"contents": [
		  {
			"type": "box",
			"layout": "baseline",
			"contents": [
			  {
				"type": "icon",
				"size": "xxl",
				"url": "https://scontent.fbkk7-2.fna.fbcdn.net/v/t1.0-1/p200x200/22814542_1962234637127047_1607260544847069468_n.png?_nc_cat=0&oh=2a303227c24dfab9e71a405b6d594d50&oe=5BC3965D"
			  }
			]
		  },
		  {
			"type": "box",
			"layout": "vertical",
			"flex": 5,
			"contents": [
			  {
				"type": "text",
				"text": "โรงพยาบาลอ่างทอง",
				"weight": "bold",
				"color": "#aaaaaa",
				"size": "md",
				"gravity": "top"
			  },
			  {
				"type": "text",
				"text": "ขอขอบพระคุณ",
				"weight": "bold",
				"color": "#aaaaaa",
				"size": "lg",
				"gravity": "top"
			  }
			]
		  }
		]
	  },
	  "hero": {
		"type": "image",
		"url": "https://scontent.fbkk7-2.fna.fbcdn.net/v/t1.0-9/35076722_2227987830551725_330757188106584064_n.jpg?_nc_cat=0&oh=0f5fa137c5bd65f109a40439afcd59eb&oe=5BB566B6",
		"size": "full",
		"aspectRatio": "16:9",
		"aspectMode": "cover",
		"action": {
		  "type": "uri",
		  "uri": "https://www.tot.co.th"
		}
	  },
	  "body": {
		"type": "box",
		"layout": "vertical",
		"contents": [
		  {
			"type": "text",
			"margin": "sm",
			"text": "คุณกานต์สินี ไหลสงวนงาม",
			"weight": "bold",
			"size": "md",
			"wrap": true
		  },
		  {
			"type": "box",
			"layout": "vertical",
			"margin": "xs",
			"contents": [
			  {
				"type": "box",
				"layout": "baseline",
				"spacing": "sm",
				"contents": [
				  {
					"type": "text",
					"text": "บริจาคเงินจำนวน ๑๘๐,๐๐๐ บาท เพื่อซื้อครุภัณฑ์ทางการแพทย์ ใช้ในโรงพยาบาลอ่างทอง โดยมีนายแพทย์พงษ์นรินทร์ ชาติรังสรรค์ผู้อำนวยการโรงพยาบาลอ่างทอง เป็นผู้รับมอบ",
					"wrap": true,
					"color": "#666666",
					"size": "sm",
					"flex": 6
				  }
				]
			  }
			]
		  },
		  {
			"type": "text",
			"margin": "md",
			"text": "วันที่ 12 มิ.ย. 2561",
			"size": "sm",
			"color": "#adadad"
		  }
		]
	  },
	  "footer": {
		"type": "box",
		"layout": "vertical",
		"spacing": "sm",
		"contents": [
		  {
			"type": "button",
			"style": "link",
			"color": "#FFFFFF",
			"height": "sm",
			"action": {
			  "type": "uri",
			  "label": "อ่านต่อ...",
			  "uri": "https://www.tot.co.th"
			}
		  }
		]
	  }
	}';
	$template = json_decode($datajson,true);
	$messages[] = array(
							"type"					=> "flex",
							"altText"				=> "สวัสดีค่ะคุณ ".$name." ยินดีให้บริการค่ะ\nกรุณาเลือกทำรายการได้เลยคะ",
							"contents"				=> $template
							
				);
	$data = array("replyToken" => $replyToken,"messages" => $messages);
	$this->Reply_Message($data);
}
function createNewRichmenu($channelAccessToken) {
  $sh = <<< EOF
  curl -X POST \
  -H 'Authorization: Bearer $channelAccessToken' \
  -H 'Content-Type:application/json' \
  -d '{"size": {"width": 2500,"height": 1686},"selected": false,"name": "Controller","chatBarText": "Controller","areas": [{"bounds": {"x": 551,"y": 325,"width": 321,"height": 321},"action": {"type": "message","text": "up"}},{"bounds": {"x": 876,"y": 651,"width": 321,"height": 321},"action": {"type": "message","text": "right"}},{"bounds": {"x": 551,"y": 972,"width": 321,"height": 321},"action": {"type": "message","text": "down"}},{"bounds": {"x": 225,"y": 651,"width": 321,"height": 321},"action": {"type": "message","text": "left"}},{"bounds": {"x": 1433,"y": 657,"width": 367,"height": 367},"action": {"type": "message","text": "btn b"}},{"bounds": {"x": 1907,"y": 657,"width": 367,"height": 367},"action": {"type": "message","text": "btn a"}}]}' https://api.line.me/v2/bot/richmenu;
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  if(isset($result['richMenuId'])) {
    return $result['richMenuId'];
  }
  else {
    return $result['message'];
  }
}

function getListOfRichmenu($channelAccessToken) {
  $sh = <<< EOF
  curl \
  -H 'Authorization: Bearer $channelAccessToken' \
  https://api.line.me/v2/bot/richmenu/list;
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  return $result;
}

function checkRichmenuOfUser($channelAccessToken, $userId) {
  $sh = <<< EOF
  curl \
  -H 'Authorization: Bearer $channelAccessToken' \
  https://api.line.me/v2/bot/user/$userId/richmenu
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  if(isset($result['richMenuId'])) {
    return $result['richMenuId'];
  }
  else {
    return $result['message'];
  }
}

function unlinkFromUser($channelAccessToken, $userId) {
  $sh = <<< EOF
  curl -X DELETE \
  -H 'Authorization: Bearer $channelAccessToken' \
  https://api.line.me/v2/bot/user/$userId/richmenu
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  if(isset($result['message'])) {
    return $result['message'];
  }
  else {
    return 'success';
  }
}

function deleteRichmenu($channelAccessToken, $richmenuId) {
  if(!isRichmenuIdValid($richmenuId)) {
    return 'invalid richmenu id';
  }
  $sh = <<< EOF
  curl -X DELETE \
  -H 'Authorization: Bearer $channelAccessToken' \
  https://api.line.me/v2/bot/richmenu/$richmenuId
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  if(isset($result['message'])) {
    return $result['message'];
  }
  else {
    return 'success';
  }
}

function linkToUser($channelAccessToken, $userId, $richmenuId) {
  if(!isRichmenuIdValid($richmenuId)) {
    return 'invalid richmenu id';
  }
  $sh = <<< EOF
  curl -X POST \
  -H 'Authorization: Bearer $channelAccessToken' \
  -H 'Content-Length: 0' \
  https://api.line.me/v2/bot/user/$userId/richmenu/$richmenuId
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  if(isset($result['message'])) {
    return $result['message'];
  }
  else {
    return 'success';
  }
}

function uploadRandomImageToRichmenu($channelAccessToken, $richmenuId) {
  if(!isRichmenuIdValid($richmenuId)) {
    return 'invalid richmenu id';
  }
  $randomImageIndex = rand(1, 5);
  $imagePath = realpath('') . '/' . 'controller_0' . $randomImageIndex . '.png';
  $sh = <<< EOF
  curl -X POST \
  -H 'Authorization: Bearer $channelAccessToken' \
  -H 'Content-Type: image/png' \
  -H 'Expect:' \
  -T $imagePath \
  https://api.line.me/v2/bot/richmenu/$richmenuId/content
EOF;
  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  if(isset($result['message'])) {
    return $result['message'];
  }
  else {
    return 'success. Image #0' . $randomImageIndex . ' has uploaded onto ' . $richmenuId;
  }
}

function isRichmenuIdValid($string) {
  if(preg_match('/^[a-zA-Z0-9-]+$/', $string)) {
    return true;
  } else {
    return false;
  }
}
}
?>