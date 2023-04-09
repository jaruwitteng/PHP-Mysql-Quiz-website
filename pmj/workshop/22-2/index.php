<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 22-2</title>
<style>
	* {
		font: 12px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	body > span {
		color: #ddd;
	}
	#img-chat {
		width: 60px;
		cursor: pointer;
	}
	#chitchat {
		display:none;
	}
	#chat-container {
		position: fixed;
		left: 0px;
		bottom: 0px;
		width: 100%;
		text-align: center;
	}
	#chatbox {
		width: 100%;
		height: 220px;
		overflow:auto;
		border: solid 1px #bbb;
		background: #def;
		margin-bottom: 3px;
	}
	div#enter-name {
		text-align: center;
		margin-top: 50px;
	}
	[name=name] {
		background: #ffc;
		margin: 5px;
		padding: 3px;
		border: solid 1px gray;
	}
	#chat-input {
		width:368px;
		background: #ffc;
		border: solid 1px steelblue;
		color: navy;
		padding-left: 3px;
		padding-right: 5px;
		height: 24px;
	}
	div.chat-msg {
		margin: 10px 0px;
	}
	img.chat-profile {
		float: left;
		width: 32px;
		height: 32px;
		margin: 0px 5px 0px 5px;
		vertical-align: top;
	}
	div.chat-aside-img {
		float: left;
		width: 85%;
	}
	div.chat-name-time {
		width: 100%;
	}
	span.chat-name {
		font: bold 12px tahoma;
		color: #c00;
	}
	span.chat-time {
		float:right;
		font-size: 10px;
		font-style: italic;
		color: gray;
	}
	span.chat-text {
		font: 12px tahoma;
		color: navy;
	}
	br.clear-both {
		clear: both;
	}
	br.clear-left {
		clear: left;
	}
	br.clear-right {
		clear: right;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.blockUI.js"></script>
<script>
var INTERVAL;
$(function(){
	for(var i = 1; i <= 1000; i++) {
		$('body').append('<span>ajax chitchat </span>');
	}
	
	//ให้ภาพเข้าสู่การแชทอยู่ตรงขอบด้านล่างกลาง
	$('#img-chat').position({my: "center bottom", at: "center bottom", of: window});
	
	//เมื่อคลิกที่ภาพ
	$('#img-chat').click(function() {
		$(this).hide();   //ซ่อนภาพ
		$('#chitchat').dialog({
			width: 400,
			height: 300,
			position: { my: "center bottom", at: "center bottom", of: window},
			beforeClose:function(event, ui) {
				$('#img-chat').show();  //ถ้าคลิกปิดไดอะล็อก ใหกลับมาแสดงภาพเหมือนเดิม
			}
		});
		checkName(null);  //ไปตรวจสอบชื่อว่ามีในเซสชั่่นหรือไม่ จึงไม่ระบุชื่อ
	});
	
 	//เมื่อคลิกปุ่มกำหนดชื่อ(ร่วมวง) ซึ่งใช้ on() เพราะปุ่มถูกเพิ่มหลังการโหลดเพจ
	$(document).on('click', '#bt-name', function(event) {
		var name = $.trim($('[name=name]').val());
		if(name.length >= 2) {
			checkName(name);
		}
		else {
			alert('กรุณากำหนดชื่อใหม่');
		}
	});

	$(document).on('keypress', '#chat-input', function(event) {
		if(event.which == 13) {
			sendMessage();
		}
	});
	
    $(window).resize(function() {
        $('#chitchat').dialog('option', 'position', $("#chitchat").dialog('option', 'position'));
    });
	
	$(window).scroll(function() {
		 $(window).resize();
	});
});

function checkName(name) {
	$.ajax({
		url:'check-name.php',
		type:'post',
		dataType:'script',
		data:{'name':name},
		beforeSend: function() {
			$('#chitchat').block({ignoreIfBlocked:true});
			clearInterval(INTERVAL);
		},
		complete:function() {
			$('#chitchat').unblock();
		}
	});
}

function enterName() {
	var tag = '<div id="enter-name">';
	tag += '<input type="text" name="name" maxlength="50" placeholder="กำหนดชื่อ">';
	tag += '<button id="bt-name">ร่วมวง</button></div>';
	$('#chitchat').html(tag);
}

function displayChat() {
	var tag = '<div id="chatbox"></div>';
	tag += '<input type="text" id="chat-input" maxlength="250" placeholder="ข้อความ">';
	$('#chitchat').html(tag);
	INTERVAL = setInterval(loadMessage, 5000);
}

function loadMessage() {
	$.ajax({
		url:'load-msg.php',
		type:'post',
		dataType:'html',
		success:function(result) {
			$('#chatbox').html(result);
			$('#chatbox').scrollTop($('#chatbox').height());
		}
	});
}

function sendMessage() {
	var msg = $.trim($('#chat-input').val());
	if(msg.length == 0) {
		return;
	}
	
	$.ajax({
		url:'send-msg.php', 
		type:'post',
		dataType:'script',
		data:{'msg':msg}
	});
	
	$('#chat-input').val('');
}
</script>
</head>

<body>
<div id="chat-container">
	<img src="message.png" id="img-chat">
    <div id="chitchat"> </div>
</div> 
</body>
</html>