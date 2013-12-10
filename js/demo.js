
function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {str = '0' + str;}
    return str;
}

function formatTime(time) {
    var hour = parseInt(time / 360000), 
        min = parseInt(time / 6000) - (hour * 60),
        sec = parseInt(time / 100) - (min * 60);
        //hundredths = pad(time - (sec * 100) - (min * 6000), 2);
    return  (hour > 0 ? pad(hour, 2) : "00") + ":" + (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2);
}
    var MrTime = function(element,duration) {
        var stopwatch, // Stopwatch element on the page
        incrementTime = 70, // Timer speed in milliseconds
        currentTime = 0, // Current time in hundredths of a second
        updateTimer = function() {
            stopwatch.html(formatTime(currentTime));
            currentTime += incrementTime / 10;
        },
        init = function() {
            currentTime = duration;
            stopwatch = $("#"+element);
            stopwatch.html(formatTime(currentTime));
            //MrTime.Timer = $.timer(updateTimer, incrementTime, true);
        };
        this.resetStopwatch = function() {
            currentTime = 0;
            this.timer.stop().once();
        };
        this.getDuration = function( ){
            return currentTime;
        };
        this.Timer = $.timer(updateTimer, incrementTime, true);
        $(init);
    }

    clocklst = [];
