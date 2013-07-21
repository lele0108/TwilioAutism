<?php
  // @start snippet
  include 'Services/Twilio/Capability.php';

  $accountSid = 'AC387108592c0562176801dfecc07b3551';
  $authToken  = 'c1f80aab9cc6f128c379fedff230b700';

  $capability = new Services_Twilio_Capability($accountSid, $authToken);
  $capability->allowClientOutgoing('AP7a72e3a80514ac5aea5309ea32b4889f');
  // @end snippet
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hackathon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
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
    </script>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="textarea-helper.js"></script>
    <script type="text/javascript" src="speech-recognizer.js"></script>
    <script src="speakClient.js"></script>
  </head>
  <body>
    <div id="audio"></div>
    <div class="steve">
      <div class="row">
        <div class="container">
          <div class="span6 offset3">
            <div class="row">

              <div class="span2">
                <div class="speech-content-mic speech-mic"/></div>
              </div>

              <div class="span4">
                <h1>What's up Steve?</h1>
              </div>

            

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="speach">
      <div class="row">
        <div class="container">
          <div class="span6 offset3">
            <div class="inner"></div>
              <div id="mom">
                <div class="result">


                  <div class="question"><p style="">Could you call my mom for me?</p></div>
                  <div class="answer">
                    <h1>Sure, I'm currently calling your mom for you</h1>
                    <div align="center">
                      <input type="button" id="hangup" value="Disconnect Call" style="display:none;"/>
                      <div id="status">
                      Offline
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          <div class="span6 offset3" id="coffee">
            <div class="result">


              <div class="question"><p style="">Meow, I'm trying to buy a coffee but I don't know what to say</p></div>
              <div class="answer">
                <h1>Here, try this:</h1>
                <div class="box">
                  <h2>1. Go up to cashier</h2>
                  <h2>2. Tell her what you want</h2>
                  <h2>3. Pay her what she tells you to</h2>
                  <h2>4. Get your delicious coffee!</h2>
                </div>
                <h1>Do you want me to say it for you?</h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="lost">
            <div class="result">


              <div class="question"><p style="">I'm lost!!! *sob*</p></div>
              <div class="answer">
                <h1>Here, directions home from your location</h1>
                <div class="box">
                  <iframe width="500" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=d&amp;source=s_d&amp;saddr=10121+Firwood+Dr,+Cupertino,+CA+95014&amp;daddr=245+Harrison+St,+San+Francisco,+CA&amp;hl=en&amp;geocode=FYd3OQIdsUm5-Cn_yIHmcrSPgDG2bgvdEc7gHg%3BFfiYQAIdZXe0-CnbvfN8eoCFgDE_2hM-jMo_Wg&amp;aq=0&amp;oq=245+Har&amp;sll=37.572577,-122.23593&amp;sspn=1.367068,2.469177&amp;mra=ls&amp;ie=UTF8&amp;t=m&amp;ll=37.554376,-122.24762&amp;spn=0.326613,0.411987&amp;z=10&amp;output=embed"></iframe><br /><small><a href="https://www.google.com/maps?f=d&amp;source=embed&amp;saddr=10121+Firwood+Dr,+Cupertino,+CA+95014&amp;daddr=245+Harrison+St,+San+Francisco,+CA&amp;hl=en&amp;geocode=FYd3OQIdsUm5-Cn_yIHmcrSPgDG2bgvdEc7gHg%3BFfiYQAIdZXe0-CnbvfN8eoCFgDE_2hM-jMo_Wg&amp;aq=0&amp;oq=245+Har&amp;sll=37.572577,-122.23593&amp;sspn=1.367068,2.469177&amp;mra=ls&amp;ie=UTF8&amp;t=m&amp;ll=37.554376,-122.24762&amp;spn=0.326613,0.411987&amp;z=10" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                </div>
                <h1>Do you want to ask your mom for help?</h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="girl">
            <div class="result">

              <div class="question"><p style="">Meow, I just saw a beautiful girl on the street, but I don't know what to say :(</p></div>
              <div class="answer">
                <h1>Nice! Try talking about the following:</h1>
                <div class="box">
                  <h2>* Talk about your breakfast</h2>
                  <h2>* Tell her how she looks</h2>
                  <h2>* #yolo</h2>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>

  </body>
</html>