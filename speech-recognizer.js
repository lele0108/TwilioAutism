(function($) {

    $(document).ready(function() {
        $('.result').toggle();
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
            //textArea.focus();
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
                    if (event.results[i][0].transcript === "hello") {
                        console.log("hi");
                        $('.result').toggle();
                    }
                } else {
                    isFinished = false;
                    //insertAtCaret(textAreaID, event.results[i][0].transcript + '\u200B');
                    interimResult += event.results[i][0].transcript + '\u200B';
                }
            }
        };

        recognition.onend = function() {
            $('.speech-content-mic').removeClass('speech-mic-works').addClass('speech-mic');
        };
    });
})(jQuery);