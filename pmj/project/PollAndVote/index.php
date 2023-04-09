<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Poll & Vote</title>
<style>
	@import "global.css";
	#content {
		background: url(images/vote.jpg) center center no-repeat !important;
	}
	fieldset * {
		font-size: 12px !important;
	}
	fieldset {
		width: 160px;
		text-align: left;
		margin: 5px auto 10px;
		border-radius: 3px;
		border: solid 1px green;
	}
	legend {
		color: green;
		font: bold 14px tahoma !important;
	}
	button {
		margin-right: 5px;
		margin-top: 10px;
		background: tomato;
		color: cyan;
		border-radius: 3px;
		border: solid 1px aqua;
		padding: 2px 7px;
	}
	button:hover {
		background: yellow;
		color: red;	
	}
	span#poll-topic {
		font: 12px tahoma !important;
		color: #f30;	
	}
	div#poll-choice {
		margin-top: 5px;
		font-size: 11px !important;
		color: navy !important;
	}
	div.graph {
		height: 10px;
		display: inline-block;
		margin: 2px 0px 3px 0px;
	}
	[type=radio] {
		vertical-align: bottom;
	}
	a {
		color: blue;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
 	//เมื่อคลิกปุ่มโหวต
	$('#bt-vote').click(function() {
		if($('#poll :radio:checked').length == 0) {
			alert('ท่านยังไม่ได้เลือกรายการที่จะโหวต');
			return false;
		}
		var topic_id = $(this).attr('data-id');
		var choice_id = $('#poll :radio:checked').val();

		$.ajax({
			url:'vote.php',
			data:{'topic_id':topic_id, 'choice_id':choice_id},
			type:'post',
			dataType:'html',
			beforeSend: function() {
				$.blockUI();
			},
			success: function(result) {
				if(result.length != 0) {
					alert(result);
				}
			},
			complete: function() {
				$.unblockUI();
			}
		});
	});
	//เมื่อคลิกปุ่มดูผล
	$('#bt-result').click(function() {
		var topic_id = $(this).attr('data-id');
		$.ajax({
			url:'result.php',
			data:{'topic_id':topic_id},
			type:'post',
			dataType:'html',
			beforeSend: function() {
				$.blockUI();
			},
			success: function(result) {
				if(result.length != 0) {
					$('div#poll-choice').html(result);
				}
			},
			complete: function() {
				$.unblockUI();
			}
		});
	});
	
});
</script>
</head>

<body>
<table id="container">
<tr><td colspan="3" id="header"><h1>DeveloperThai.com</h1></td></tr>
<tr>
	<td id="left-side">&nbsp;</td>
    <td id="content">&nbsp;</td>
    <td id="right-side">
  	<?php
	include "dblink.php";
	$sql = "SELECT * FROM poll_topic WHERE status = 'active' LIMIT 1";
	$rs = mysqli_query($link, $sql);
	if(mysqli_num_rows($rs) != 0) {
		echo '<fieldset id="poll"><legend>โพล</legend>';
		$data = mysqli_fetch_array($rs);
		echo '<span id="poll-topic">'.$data['topic_text'] . "</span><br>";
		echo '<div id="poll-choice">';
		$topic_id = $data['topic_id'];
		$sql = "SELECT * FROM poll_choice WHERE topic_id = '$topic_id'";
		$rs = mysqli_query($link, $sql);
		while($data = mysqli_fetch_array($rs)) {
			$cid = $data['choice_id'];
			$ch = $data['choice_text'];
			echo "<input type=\"radio\" name=\"choice\" value=\"$cid\">$ch<br>";
		}
		echo "<button data-id=\"$topic_id\" id=\"bt-vote\">โหวต</button>";
		echo "<button data-id=\"$topic_id\" id=\"bt-result\">ดูผล</button>";
		echo "</div>";
		echo "</fieldset>";
	}
	mysqli_close($link);
	?> <br><br>
    </td>
</tr>
</table>
<?php
if(isset($_SESSION['admin'])) {
?>
	<a href="new-topic.php">เพิ่มหัวข้อโพล</a> - 
	<a href="manage-poll.php">จัดการโพล</a> - 
	<a href="logout.php">ออกจากระบบ</a>
<?php
}
else {
?>
	<a href="login.php">เข้าสู่ระบบ</a>
<?php
}
?>
</body>
</html>