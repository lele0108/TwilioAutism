<?php
 
require_once('Services/Twilio/Capability.php');
 
// Your API credentials from Account Dashboard here
$accountSid = 'AC34af33c1693ae7bc92535b1daf24838e';
$authToken = '9ce5818fea88d392eb83abdecc10d457';
$appSid = 'APzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz';
 
$capability = new Services_Twilio_Capability($accountSid, $authToken);
// give this app permissions
$capability->allowClientOutgoing($appSid);
// generate token that lasts for 5 minutes
$token = $capability->generateToken(300);
 
?>

<!DOCTYPE html>
<html>
<head>
<title>Twilio Client Test</title>
<script type="text/javascript"
src="http://static.twilio.com/libs/twiliojs/1.0/twilio.min.js"></script>
<script type="text/javascript"
src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
</script>
</head>

<script type="text/javascript">
Twilio.Device.setup("<?php echo $token; ?>");
Twilio.Device.ready(function (device) {
// handle device ready
});
Twilio.Device.error(function (error) {
// handle device error
});
Twilio.Device.connect(function (conn) {
// handle device connect
});
Twilio.Device.disconnect(function (conn) {
// handle device disconnect
});
function call() {
// make call
Twilio.Device.connect();
}
function hangup() {
Twilio.Device.disconnectAll();
}
</script>

<body>
<h1>Twilio Client Test</h1>
<a href="#" onclick="call();return false;">Call</a>
|
<a href="#" onclick="hangup();return false;">Hangup</a>
</body>
</html>