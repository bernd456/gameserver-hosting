<?php
include("includes/header.php");
?>
<div class="container">
    <h2>Wartungsmodus</h2>
    <p>Aktueller Wartungsstatus: <?php // Dynamische Anzeige (z.B. "Aktiv" oder "Deaktiviert") ?></p>
    <form action="set_maintenance.php" method="post">
        <label>Wartungsmodus einstellen:</label>
        <select name="mode">
            <option value="on">Aktivieren (nur Admin-Login)</option>
            <option value="partial">Teilweise (z.B. Store in Wartung)</option>
            <option value="off">Deaktivieren</option>
        </select>
        <button type="submit">Einstellung speichern</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>
