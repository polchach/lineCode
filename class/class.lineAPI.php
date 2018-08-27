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
		$users = array(
							"userId"		=> "",
							"displayName"	=> "",
							"pictureUrl"	=> "",
							"statusMessage"	=> "",
							"phone" 	=> "",
							"email" 	=> "",
							"role" 		=> "",
							"status" 	=> ""
						);	

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
function Greeting_MENU($replyToken){
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
		$template  = array(
				"type" 					=> "buttons",
				"thumbnailImageUrl"		=> "https://upload.wikimedia.org/wikipedia/commons/7/78/Image.jpg",
				"imageAspectRatio" 		=> "rectangle",
				"templateimageSize" 	=> "cover",
				"imageBackgroundColor" 	=> "#BFDFFF",
				"title" 				=> "บริษัท LinkPBX จำกัด ",
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
		$reply = array("replyToken" => $replyToken,"messages" => $messages);
		return $reply;
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