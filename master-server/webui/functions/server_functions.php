<?php
// Funktionen für die Serververwaltung
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
?>
