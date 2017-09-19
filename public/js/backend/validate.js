$(function() {
	$("#create").click(function(event) {
		if ($("#step").val() == '') {
			// alert('Please insert Step');
			sweetAlert("Oops...", "Please insert Step", "warning");
			$("#step").focus();
			return false;
		}
		if ($("#person").val() == "") {
			sweetAlert("Oops...", "Please insert type", "warning");
			// alert('Please select type');
			$("#person").focus();
			return false;
		}
		if ($("#type").val() == "") {
			// alert('Please select action');
			sweetAlert("Oops...", "Please select action", "warning");
			$("type").focus();
			return false;
		}
		if ($("#price").val() == '') {
			// alert('Please insert Credit limit');
			sweetAlert("Oops...", "Please insert Credit limit", "warning");
			$("#price").focus();
			return false;
		}
	});
	$("#back").click(function() {
		var type = $("#person_hid").val();
		if(type == 'VIP') {
			window.location.href ="/admin/step/vip";
		} else {
			window.location.href ="/admin/step/normal";
		}
	});
});