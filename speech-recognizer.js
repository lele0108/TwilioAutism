(function($) {

    $(document).ready(function() {
        $('#coffee').toggle();
        $('#lost').toggle();
        $('#girl').toggle();
        $('#spill').toggle();
        $('#hurt').toggle();
        $('#lonely').toggle();
        $('#bored').toggle();
        $('#mom').toggle();
        $('#hi').toggle();
        try {
            var recognition = new webkitSpeechRecognition();
        } catch(e) {
            var recognition = Object;
        }
        recognition.continuous = true;
        recognition.interimResults = true;

        var interimResult = '';
        //var textArea = $('#speech-page-content');
        //var textAreaID = 'speech-page-content';

        $('.speech-mic').click(function(){
            startRecognition();
        });

        $('.speech-mic-works').click(function(){
            recognition.stop();
        });

        var startRecognition = function() {
            $('.speech-content-mic').removeClass('speech-mic').addClass('speech-mic-works');
            recognition.start();
        };

        recognition.onresult = function (event) {
            //var pos = textArea.getCursorPosition() - interimResult.length;
            //textArea.val(textArea.val().replace(interimResult, ''));
            interimResult = '';
            //textArea.setCursorPosition(pos);
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    //insertAtCaret(textAreaID, event.results[i][0].transcript);

                    $('.inner').replaceWith('<div class="inner">"' + event.results[i][0].transcript + '"</div>');
                    console.log(event.results[i][0].transcript);

                    //CHECKS HERE
                    if (event.results[i][0].transcript === "could you call my mom" || event.results[i][0].transcript  === "can you call my mom") {
                        speak("Sure, I'm currently calling your mom for you");
                        $('#mom').addClass('animated fadeInDown');
                        $('#mom').toggle().fadeIn("slow");
                        Twilio.Device.connect();
                    }

                    else if (event.results[i][0].transcript === "hello") {
                        speak("Hello, how are you? I feel meowtastic.", { speed: 125 });
                        $('#hi').addClass('animated fadeInDown');
                        $('#hi').toggle();
                    }

                    else if (event.results[i][0].transcript === "I want to buy some coffee") {
                        speak("Here, try this: 1. Go up to cashier 2. Tell her what you want 3. Pay her what she tells you to 4. Get your delicious coffee! Do you want me to say it for you?", { speed: 125 });
                        $('#coffee').addClass('animated fadeInDown');
                        $('#coffee').toggle();
                    }

                    else if (event.results[i][0].transcript === "I'm lost") {
                        speak("Here are directions home from your location. Do you want me to ask your mom for help?");
                        $('#lost').addClass('animated fadeInDown');
                        $('#lost').toggle();
                    }

                    else if (event.results[i][0].transcript === "i see a beautiful girl") {
                        console.log("hi");
                        $('#girl').addClass('animated fadeInDown');
                        $('#girl').toggle();
                    }

                    else if (event.results[i][0].transcript === "I spilled something") {
                        speak("Here, try cleaning it up with the towels. Ask some adults near you for help. Do you want to ask your mom for help?");
                        $('#spill').addClass('animated fadeInDown');
                        $('#spill').toggle();
                    }

                    else if (event.results[i][0].transcript === "I'm bleeding") {
                        speak("Here, don't worry. Try washing up with water in the restroom. After that you can put on a bandaid. Do you want to ask your mom for help?");
                        $('#hurt').addClass('animated fadeInDown');
                        $('#hurt').toggle();
                    }

                    else if (event.results[i][0].transcript === "I'm bored") {
                        speak("Here, lets draw a picture and send it to your mom");
                        $('#bored').addClass('animated fadeInDown');
                        $('#bored').toggle();
                    }

                    else if (event.results[i][0].transcript === "yes") {
                        speak("Sure, I'm currently calling your mom for you");
                        $('#mom').addClass('animated fadeInDown');
                        $('#mom').toggle().fadeIn("slow");
                        Twilio.Device.connect();
                    }

                    else {
                        speak("I did not quite get that, could you say it again?");
                    }

                    recognition.stop();
                } 
            }
        };

        recognition.onend = function() {
            $('.speech-content-mic').removeClass('speech-mic-works').addClass('speech-mic');
        };
    });
})(jQuery);