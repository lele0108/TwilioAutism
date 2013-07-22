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
    <script type="text/javascript" src="http://static.firebase.com/v0/firebase.js"></script>
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
    <link href="animate.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="textarea-helper.js"></script>
    <script type="text/javascript" src="speech-recognizer.js"></script>
    <script src="speakClient.js"></script>
  </head>
  <body>
    <div id="audio"></div>
    <div id="audio_play"></div>
    <div class="steve">
      <div class="row">
        <div class="container">
          <div class="span6 offset3">
            <div class="row">

              <div class="span6">
                <div class="speech-content-mic speech-mic"/></div>
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
            <div class="inner">Say Something</div>
              <div id="mom">
                <div class="result">


                  
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


              
              <div class="answer">
                <h1>Here, try this:</h1>
                <div class="box">
                  <h2>1. Go to your local coffee shop and walk up to cashier</h2>
                  <h2>2. Tell her what you want</h2>
                  <h2>3. Pay her what she tells you to</h2>
                  <h2>4. Get your delicious coffee!</h2>
                </div>
                <h1>Do you want me to say it for you?</h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="spill">
            <div class="result">


              
              <div class="answer">
                <h1>Here, try this:</h1>
                <div class="box">
                  <h2>Try to get some towels and clean it up</h2>
                  <center><img src="img/towel.png" width="100"></center>
                  <h2>Or try to find some adults around you</h2>
                </div>
                <h1>Do you want to ask your mom for your help?</h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="hurt">
            <div class="result">


              
              <div class="answer">
                <h1>Here, try this:</h1>
                <div class="box">
                  <h2>Go to the restroom and wash your hurt area</h2>
                  <h2>Put a bandaid on your hurt area</h2>
                  <center><img src="img/bandaid.png" width="50"></center>
                </div>
                <h1>Do you want to ask your mom for your help?</h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="lonely">
            <div class="result">


              
              <div class="answer">
                <h1>Here, let us talk about how your day went:</h1>
                <div class="box">
                  <h2>What did you do today?</h2>
                </div>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="bored">
            <div class="result">


              
              <div class="answer">
                <h1>Here, lets draw a picture and send it to your mom:</h1>
                <div class="box">
                  <canvas id="drawing-canvas" width="500" height="250"></canvas>
                  <button onClick="clearDraw()" class="btn pull-left">Clear</button>
                  <form METHOD="LINK" ACTION="test.php">
                    <button class="btn pull-right">Save</button>
                  </form>
                </div>
                
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="lost">
            <div class="result">


              
              <div class="answer">
                <h1>Here, directions home from your location</h1>
                <div class="box">
                  <iframe width="500" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=d&amp;source=s_d&amp;saddr=10121+Firwood+Dr,+Cupertino,+CA+95014&amp;daddr=245+Harrison+St,+San+Francisco,+CA&amp;hl=en&amp;geocode=FYd3OQIdsUm5-Cn_yIHmcrSPgDG2bgvdEc7gHg%3BFfiYQAIdZXe0-CnbvfN8eoCFgDE_2hM-jMo_Wg&amp;aq=0&amp;oq=245+Har&amp;sll=37.572577,-122.23593&amp;sspn=1.367068,2.469177&amp;mra=ls&amp;ie=UTF8&amp;t=m&amp;ll=37.554376,-122.24762&amp;spn=0.326613,0.411987&amp;z=10&amp;output=embed"></iframe><br /><small><a href="https://www.google.com/maps?f=d&amp;source=embed&amp;saddr=10121+Firwood+Dr,+Cupertino,+CA+95014&amp;daddr=245+Harrison+St,+San+Francisco,+CA&amp;hl=en&amp;geocode=FYd3OQIdsUm5-Cn_yIHmcrSPgDG2bgvdEc7gHg%3BFfiYQAIdZXe0-CnbvfN8eoCFgDE_2hM-jMo_Wg&amp;aq=0&amp;oq=245+Har&amp;sll=37.572577,-122.23593&amp;sspn=1.367068,2.469177&amp;mra=ls&amp;ie=UTF8&amp;t=m&amp;ll=37.554376,-122.24762&amp;spn=0.326613,0.411987&amp;z=10" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                </div>
                <h1>Do you want to ask your mom for help?</h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="weather">
            <div class="result">


              
              <div class="answer">
                <h1>The weather looks a bit cold today. Try wearing these outfits.</h1>
                <div class="box">
                  <h2>Tshirt</h2>
                  <h2>Long Jeans</h2>
                  <h2>Light Jacket</h2><br>
                    <img src="img/tshirt.png" width="70">
                    <img src="img/jeans.png" width="70">
                    <img src="img/jacket.png" width="70">
                </div>
                <h1></h1>
              </div>

            </div>
          </div>

          <div class="span6 offset3" id="girl">
            <div class="result">

              
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

          <div class="span6 offset3" id="hi">
            <div class="result">

              
              <div class="answer">
                <h1>Hello, how are you? I feel meowtastic!</h1>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
    <script>
  $(document).ready(function () {
    //Set up some globals
    var pixSize = 2, lastPoint = null, currentColor = "000", mouseDown = 0;

    //Create a reference to the pixel data for our drawing.
    var pixelDataRef = new Firebase('https://drawingapp.firebaseio.com/');

    // Set up our canvas
    var myCanvas = document.getElementById('drawing-canvas');
    var myContext = myCanvas.getContext ? myCanvas.getContext('2d') : null;
    if (myContext == null) {
      alert("You must use a browser that supports HTML5 Canvas to run this demo.");
      return;
    }

    //Setup each color palette & add it to the screen
    var colors = ["fff","000","f00","0f0","00f","88f","f8d","f88","f05","f80","0f8","cf0","08f","408","ff8","8ff"];
    for (c in colors) {
      var item = $('<div/>').css("background-color", '#' + colors[c]).addClass("colorbox");
      item.click((function () {
        var col = colors[c];
        return function () {
          currentColor = col;
        };
      })());
      item.appendTo('#colorholder');
    }

    //Keep track of if the mouse is up or down
    myCanvas.onmousedown = function () {mouseDown = 1;};
    myCanvas.onmouseout = myCanvas.onmouseup = function () {
      mouseDown = 0, lastPoint = null;
    };

    //Draw a line from the mouse's last position to its current position
    var drawLineOnMouseMove = function(e) {
      if (!mouseDown) return;

      // Bresenham's line algorithm. We use this to ensure smooth lines are drawn
      var offset = $('canvas').offset();
      var x1 = Math.floor((e.pageX - offset.left) / pixSize - 1),
        y1 = Math.floor((e.pageY - offset.top) / pixSize - 1);
      var x0 = (lastPoint == null) ? x1 : lastPoint[0];
      var y0 = (lastPoint == null) ? y1 : lastPoint[1];
      var dx = Math.abs(x1 - x0), dy = Math.abs(y1 - y0);
      var sx = (x0 < x1) ? 1 : -1, sy = (y0 < y1) ? 1 : -1, err = dx - dy;
      while (true) {
        //write the pixel into Firebase, or if we are drawing white, remove the pixel
        pixelDataRef.child(x0 + ":" + y0).set(currentColor === "fff" ? null : currentColor);

        if (x0 == x1 && y0 == y1) break;
        var e2 = 2 * err;
        if (e2 > -dy) {
          err = err - dy;
          x0 = x0 + sx;
        }
        if (e2 < dx) {
          err = err + dx;
          y0 = y0 + sy;
        }
      }
      lastPoint = [x1, y1];
    }
    $(myCanvas).mousemove(drawLineOnMouseMove);
    $(myCanvas).mousedown(drawLineOnMouseMove);

    // Add callbacks that are fired any time the pixel data changes and adjusts the canvas appropriately.
    // Note that child_added events will be fired for initial pixel data as well.
    var drawPixel = function(snapshot) {
      var coords = snapshot.name().split(":");
      myContext.fillStyle = "#" + snapshot.val();
      myContext.fillRect(parseInt(coords[0]) * pixSize, parseInt(coords[1]) * pixSize, pixSize, pixSize);
    }
    var clearPixel = function(snapshot) {
      var coords = snapshot.name().split(":");
      myContext.clearRect(parseInt(coords[0]) * pixSize, parseInt(coords[1]) * pixSize, pixSize, pixSize);
    }
    pixelDataRef.on('child_added', drawPixel);
    pixelDataRef.on('child_changed', drawPixel);
    pixelDataRef.on('child_removed', clearPixel);
  });
</script>
<script>
    function clearDraw()
    {
    new Firebase('https://drawingapp.firebaseio.com/').set(null);
    }

    </script>
  </body>
</html>