<?php 
    
    function getUptime() {
        $raw_uptime = floor(explode(' ', file_get_contents('/proc/uptime'))[0]);

        $hours = floor($raw_uptime / 3600);
        $minutes = floor(($raw_uptime % 3600) / 60);
        $seconds = $raw_uptime % 60;

        return $hours . 'h ' . $minutes . 'm ' . $seconds . 's';
    }

    function getUptimeForWindows() {
        $raw_uptime = 478365.23;

        $hours = floor($raw_uptime / 3600);
        $minutes = floor(($raw_uptime % 3600) / 60);
        $seconds = $raw_uptime % 60;

        return $hours . 'h ' . $minutes . 'm ' . $seconds . 's';
    }

    function getMemoryInfo() {
        $output = shell_exec('free -h');
        $lines = explode("\n", trim($output));
        $memLine = preg_split('/\s+/', trim($lines[1]));

        return [
            $memLine[1],  // total
            $memLine[2],  // usado
            $memLine[3],  // livre
            $memLine[4],  // partilhado
            $memLine[5],  // buff/cache
            $memLine[6]   // disponível
        ];
    }

    function getMemoryInfoForWindows() {
        return [
            "7,5Gi",
            "625Mi",
            "6,4Gi",
            "0Kb",
            "0Kb",
            "6,9Gi"
        ];
    }

    $memory = getMemoryInfoForWindows();

    function getDiskData() {
        $free = disk_free_space('/');
        $total = disk_total_space('/');

        $free_gb = $free / 1073741824;
        $total_gb = $total / 1073741824;

        return [
            $free_gb,
            $total_gb
        ];
    }   

    function getDiskDataForWindows() {

        $free = disk_free_space('C:');
        $total = disk_total_space('C:');

        $free_gb = $free / 1073741824;
        $total_gb = $total / 1073741824;

        return [
            $free_gb,
            $total_gb
        ];
    }

    $diskData = getDiskDataForWindows();
    $usedSpace = $diskData[1] - $diskData[0];
    $usedPercentage = $diskData[1] > 0 ? ($usedSpace / $diskData[1]) * 100 : 0;
?>

<!-- ESTILO EXTRA (NÃO ALTERA O TEU CSS BASE) -->
<style>
    .content {
        padding: 30px 20px 80px 20px; /* espaço extra por causa do footer fixed */
    }

    .page-title {
        font-size: 2rem;
        margin-bottom: 25px;
        color: rgb(66, 66, 66);
    }

    .stats-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .stats-column {
        flex: 1 1 300px;
        min-width: 280px;
    }

    .card {
        background-color: #f3f3f3;
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: rgb(66, 66, 66);
    }

    .card-subtitle {
        font-size: 0.9rem;
        margin-bottom: 15px;
        color: #777;
    }

    .uptime-value {
        font-size: 1.4rem;
        color: rgb(66, 66, 66);
    }

    /* MEMORY */
    .memory-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .memory-item {
        background-color: #ffffff;
        border-radius: 6px;
        border: 1px solid #dedede;
        padding: 8px 10px;
    }

    .memory-label {
        font-size: 0.8rem;
        color: #777;
        margin-bottom: 3px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .memory-value {
        font-size: 1rem;
        color: rgb(66, 66, 66);
    }

    /* DISK */
    .disk-bar {
        width: 100%;
        height: 20px;
        background-color: #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        margin: 10px 0 8px 0;
    }

    .disk-bar-fill {
        height: 100%;
        background-color: rgb(66, 66, 66);
        color: #fff;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .disk-info {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        color: #555;
    }

    @media (max-width: 768px) {
        .stats-wrapper {
            flex-direction: column;
        }
    }
</style>

<main class="content">
    <h2 class="page-title">Server Stats</h2>

    <div class="stats-wrapper">
        <!-- Coluna 1: Uptime + Disco -->
        <div class="stats-column">
            <div class="card">
                <div class="card-title">Uptime</div>
                <div class="card-subtitle">Tempo desde o último arranque</div>
                <div class="uptime-value" id="uptime_time">
                    <?php echo getUptimeForWindows(); ?>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Disco</div>
                <div class="card-subtitle">Espaço usado vs disponível</div>
                <div class="disk-bar">
                    <div class="disk-bar-fill" style="width: <?php echo $usedPercentage; ?>%;">
                        <?php echo number_format($usedPercentage, 1); ?>% usado
                    </div>
                </div>
                <div class="disk-info">
                    <span>Total: <?php echo number_format($diskData[1], 2); ?> GB</span>
                    <span>Livre: <?php echo number_format($diskData[0], 2); ?> GB</span>
                </div>
            </div>
        </div>

        <!-- Coluna 2: Memória -->
        <div class="stats-column">
            <div class="card">
                <div class="card-title">Memória</div>
                <div class="card-subtitle">Detalhe de utilização de RAM</div>
                <div class="memory-grid">
                    <div class="memory-item">
                        <div class="memory-label">Total</div>
                        <div class="memory-value"><?php echo $memory[0]; ?></div>
                    </div>
                    <div class="memory-item">
                        <div class="memory-label">Usada</div>
                        <div class="memory-value"><?php echo $memory[1]; ?></div>
                    </div>
                    <div class="memory-item">
                        <div class="memory-label">Livre</div>
                        <div class="memory-value"><?php echo $memory[2]; ?></div>
                    </div>
                    <div class="memory-item">
                        <div class="memory-label">Disponível</div>
                        <div class="memory-value"><?php echo $memory[5]; ?></div>
                    </div>
                    <div class="memory-item">
                        <div class="memory-label">Cache</div>
                        <div class="memory-value"><?php echo $memory[4]; ?></div>
                    </div>
                    <div class="memory-item">
                        <div class="memory-label">Partilhada</div>
                        <div class="memory-value"><?php echo $memory[3]; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL . 'public/js/stats.js';?>"></script>