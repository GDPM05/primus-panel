$(()=> {

    let uptime_initial_value = $("#uptime_time").text();
    let uptime_time_arr = uptime_initial_value.split(' ').map((v) => v.replace(/\D/g, ''));
    
    setInterval(function() {
        uptime_time_arr[2] = Number.parseInt(uptime_time_arr[2]) + 1;

        if (uptime_time_arr[2] == 60) {
            uptime_time_arr[2] = 0;
            uptime_time_arr[1] = Number.parseInt(uptime_time_arr[1]) + 1;
            if (uptime_time_arr[1] == 60) {
                uptime_time_arr[0] = Number.parseInt(uptime_time_arr[0]) + 1;
                uptime_time_arr[1] = 0;
            }
        }

        $("#uptime_time").text(((uptime_time_arr[0] < 10) ? "0" : "") + uptime_time_arr[0]+"h "+ ((uptime_time_arr[1] < 10) ? "0" : "") + uptime_time_arr[1] + "m " + ((uptime_time_arr[2] < 10) ? "0" : "") + uptime_time_arr[2]+"s");
    }, 1000);

});