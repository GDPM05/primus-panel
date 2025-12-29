<?php 
    
    function shapeSpace_server_uptime() {	
        $uptime = floor(preg_replace ('/\.[0-9]+/', '', file_get_contents('/proc/uptime')) / 86400);
        
        return $uptime;
    }

    print_r(shapeSpace_server_uptime());

    $server_uptime = [
        15,
        59,
        50
    ];

?>

<main class="content">
    <h2 class="page-title">Server Stats</h2>
    <div class="server-uptime">
        <p>Server Uptime: <span id="uptime_time"><?php echo $server_uptime[0] . 'h ' . $server_uptime[1] . 'm ' . $server_uptime[2] . 's'; ?></span></p>
    </div>
</main>
<script src="<?php echo BASE_URL . 'public/js/stats.js';?>"></script>