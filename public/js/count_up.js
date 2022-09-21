var countUpDate = new Date("May 19, 2022 08:00:00").getTime();

// Update the count Up every 1 second
var x = setInterval(function () {
    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count Up date
    var distance = now - countUpDate;

    // Time calculations for days, hours, minutes and seconds
    var months = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
    var weeks = Math.floor(distance / (1000 * 60 * 60 * 24 * 7));
    var days = Math.floor(
        (distance % (1000 * 60 * 60 * 24 * 7)) / (1000 * 60 * 60 * 24)
    );
    var hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    //document.getElementById("mo").innerHTML = months;
    document.getElementById("w").innerHTML = weeks;
    document.getElementById("j").innerHTML = days;
    document.getElementById("h").innerHTML = hours;
    document.getElementById("m").innerHTML = minutes;
    document.getElementById("s").innerHTML = seconds;

    // If the count down is over, write some text
    /*  if (distance < 0) {
           clearInterval(x);
           document.getElementById("demo").innerHTML = "EXPIRED";
         } */
}, 1000);
