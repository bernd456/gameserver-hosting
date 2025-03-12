<?php
function startServer($serverId) {
    $command = "bash /opt/gameserver-slave/daemon/start.sh " . escapeshellarg($serverId);
    return shell_exec($command);
}

function stopServer($serverId) {
    $command = "bash /opt/gameserver-slave/daemon/stop.sh " . escapeshellarg($serverId);
    return shell_exec($command);
}

function restartServer($serverId) {
    stopServer($serverId);
    sleep(2);
    return startServer($serverId);
}

function setMaintenanceMode($serverId, $mode) {
    // $mode: "on", "off" oder "partial" (z.B. Store in Wartung)
    $command = "bash /opt/gameserver-slave/daemon/maintenance.sh " . escapeshellarg($serverId) . " " . escapeshellarg($mode);
    return shell_exec($command);
}

function migrateServer($oldProvider, $serverId) {
    // Platzhalter: Implementiere Migrationslogik
    return "Migration von $oldProvider für Server $serverId initiiert.";
}
?>

