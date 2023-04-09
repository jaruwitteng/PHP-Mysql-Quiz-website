<?php
function user_agent() {
	return  $_SERVER['HTTP_USER_AGENT'];
}

function user_ip() {
	return $_SERVER['REMOTE_ADDR'];
}

function user_browser() {
	//ข้อมูลต่อไปนี้อาจมีการเปลี่ยนแปลงตามเวอร์ชั่นของเบราเซอร์
	$a = array(
					//ห้ามสลับลำดับในอาร์เรย์
	 				"IE"=>'/(MSIE)|(Trident)/i', 
					"Opera"=>'/(Opera)|(OPR)/i', 
	 				"Firefox"=>'/Firefox/i', 
					"Chrome"=>'/Chrome/i', 
					"Safari"=>'/Safari/i'
			); 	
			
	$user_agent = user_agent();				
	$browser = "Unknown";
	foreach($a as $b => $p) {
    	if (preg_match($p, $user_agent)) { 
	 		$browser = $b;
			break;
		}
	}
	return $browser;
}

function user_os() {
  //ข้อมูลเหล่านี้มีการเปลี่ยนแปลงไปตามเวอร์ชั่นของ OS
  //ดังนั้น ขอให้ตรวจสอบข้อมูลเพิ่มเติมเมื่อมี OS เวอร์ชั่นใหม่ 
  $a = array(
  					'Windows 8.1' => '/windows nt 6.3/i',
   					'Windows 8' => '/windows nt 6.2/i',
            		'Windows 7' => '/windows nt 6.1/i',    
           			'Windows Vista' => '/windows nt 6.0/i',
                 	'Windows Server 2003/XP x64' => '/windows nt 5.2/i',
                	'Windows XP'  => '/(windows xp)|(windows nt 5.1)/i',
                   	'Windows 2000' => '/windows nt 5.0/i',
                    'Windows ME' => '/windows me/i',
 					'Windows 98' => '/win98/i',
    				'Windows 95' => '/win95/i',
					'Windows 3.11' => '/win16/i',
             		'Mac OS X' => '/macintosh|mac os x/i',
                    'Mac OS 9' => '/mac_powerpc/i',
     				'Linux' => '/linux/i',
        			'Ubuntu' => '/ubuntu/i',
                    'iPhone' => '/iphone/i',
          			'iPod' => '/ipod/i',
         			'iPad' => '/ipad/i',
                    'Android' => '/android/i',
                    'BlackBerry' => '/blackberry/i',
                    'Mobile' => '/webos/i'
				);	
					
	 $user_agent = user_agent();
	 $os = "Unknown";
	 foreach($a as $o => $p) {
    	if (preg_match($p, $user_agent)) { 
	 		$os = $o;
			break;
		}
	}
	return $os;	 
}
?>