$(document).ready(function(){

			Twilio.Device.setup("<?php echo $capability->generateToken();?>");

			$("#call").click(function() {
				Twilio.Device.connect();
			});
			$("#hangup").click(function() {
				Twilio.Device.disconnectAll();
			});

			Twilio.Device.ready(function (device) {
				$('#status').text('Ready to start call');
			});

			Twilio.Device.offline(function (device) {
				$('#status').text('Offline');
			});

			Twilio.Device.error(function (error) {
				$('#status').text(error);
			});

			Twilio.Device.connect(function (conn) {
				$('#status').text("Successfully established call");
				toggleCallStatus();
			});

			Twilio.Device.disconnect(function (conn) {
				$('#status').text("Call ended");
				toggleCallStatus();
			});

			function toggleCallStatus(){
				$('#call').toggle();
				$('#hangup').toggle();
			}

		});