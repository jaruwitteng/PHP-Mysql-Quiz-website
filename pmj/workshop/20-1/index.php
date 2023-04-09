<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 20-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	div {
		float: left;
		margin: 10px;
	}
</style>
<script src="jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	var partNames = ["เหนือ", "กลาง", "อีสาน", "ใต้"];
	var north = ["เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "..."];
	var central = ["กรุงเทพ", "ปทุมธานี", "ลพบุรี", "สระบุรี", "..."];
	var northEast = ["ขอนแก่น","นครราชสีมา", "บุรีรัมย์", "สุรินทร์", "..."];
	var south = ["กระบี่", "ตรัง", "ภูเก็ต", "สงขลา", "..."];
	
	var parts = [north, central, northEast, south];  //parts จะเป็นอาร์เรย์ของอาร์เรย์
	
	/*  ซึ่ง parts ก็คืออาร์เรย์ของอาร์เรย์ในลักษณะดังนี้
	var parrts = [
	 								["เชียงใหม่", "เชียงราย","..."],
									["กรุงเทพ", "ปทุมธานี", "..."],
									....
					 ]
	*/
										
	for(var i in partNames) {
		$('#part').append('<option value="' + partNames[i] + '">' + partNames[i] + '</option>');	
	}
	
	
	$('#part').change(function() {
		var provinces = Array();
		var selectedIndex = $(this).find('option:selected').index();
		provinces = parts[selectedIndex];  
		/*
		var selectedPart = $(this).find('option:selected').val();
		if(selectedPart == "เหนือ") {
			provinces = north;
		}
		else if(selectedPart == "กลาง") {
			provinces = central;
		}
		else if(selectedPart == "อีสาน") {
			provinces = northEast;
		}
		else if(selectedPart == "ใต้") {
			provinces = south;
		}
		*/
		$('#province').empty();
		for(var i in provinces) {
			$('#province').append('<option value="' + provinces[i] + '">' + provinces[i] + '</option>');	
		}	
	});
	
	$('#part').change();  
	
});
</script>
</head>

<body>
	<div>ภาค:<br>
    		<select id="part"></select>
    </div>
    <div>จังหวัด:<br>
    		<select id="province"></select>
    </div>
</body>
</html>