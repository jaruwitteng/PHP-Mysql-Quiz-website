<?php
$link_stat = @mysqli_connect("localhost", "root", "abc456", "pmj");

//ตรวจสอบข้อมูลของผู้ใช้
$bs__ = user_browser();
$os__ = user_os();

//สร้าง IP จำลอง หากนำไปใช้งานจริง ให้ใช้ฟังก์ชั่น user_ip() แทน fake_ip()
$ip__ = fake_ip();   //user_ip();    

$sql_stat = "INSERT INTO webstats VALUE(CURRENT_DATE(), '$ip__', '$bs__', '$os__')";		
@mysqli_query($link_stat, $sql_stat);

function fake_ip() {
	$a = array();
	//สุ่มให้ได้เลขระหว่าง 0-255 จำนวน 4 ชุด
	for($i = 1; $i <= 4; $i++) {
		$n = rand(0, 255);
		array_push($a, $n);
	}
	$ip = implode(".", $a);   //นำเลขแต่ละชุดมาเชื่อมต่อกันด้วยจุด
	return $ip;
}

function count_visitor() {  //ฟังก์ชั่นในการนับจำนวนผู้เข้าเยี่ยมชมทั้งหมด
	global $link_stat;
	$sql = "SELECT COUNT(*) FROM webstats";
	$rs = @mysqli_query($link_stat, $sql);
	$data = @mysqli_fetch_array($rs);
	return $data[0];
}

function user_agent() {
	return  $_SERVER['HTTP_USER_AGENT'];
}

function user_ip() {
	return $_SERVER['REMOTE_ADDR'];
}

function user_browser() {
	$a = array(
	 				"IE"=>'/(MSIE)|(Trident)/i', 
					"Opera"=>'/(Opera)|(OPR)/i', 
	 				"Firefox"=>'/Firefox/i', 
					"Chrome"=>'/Chrome/i', 
					"Safari"=>'/Safari/i'
			); 	//ห้ามสลับลำดับในอาร์เรย์
			
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