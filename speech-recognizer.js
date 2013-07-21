(function($) {

    $(document).ready(function() {
        $('#mom').toggle();
        $('#coffee').toggle();
        $('#lost').toggle();
        $('#girl').toggle();
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
            console.log("penis");
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
                    $('.inner').append(event.results[i][0].transcript);
                    console.log(event.results[i][0].transcript);

                    //CHECKS HERE
                    if (event.results[i][0].transcript === "could you call my mom") {
                        speak("Sure, I'm currently calling your mom for you");
                        console.log("hi");
                        $('#mom').toggle();
                        Twilio.Device.connect();
                    }

                    else if (event.results[i][0].transcript === "I want to buy some coffee") {
                        console.log("hi");
                        $('#coffee').toggle();
                    }

                    else if (event.results[i][0].transcript === "I'm lost") {
                        console.log("hi");
                        $('#lost').toggle();
                    }

                    else if (event.results[i][0].transcript === "i see a beautiful girl") {
                        console.log("hi");
                        $('#girl').toggle();
                    }

                    recognition.stop();
                } else {
                    isFinished = false;
                    //insertAtCaret(textAreaID, event.results[i][0].transcript + '\u200B');
                    interimResult += event.results[i][0].transcript + '\u200B';
                }
            }
        };

        recognition.onend = function() {
            $('.speech-content-mic').removeClass('speech-mic-works').addClass('speech-mic');
            $('.inner').replaceWith('<div class="inner"></div>');
        };
    });
})(jQuery);