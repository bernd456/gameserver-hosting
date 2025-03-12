<?php
include("includes/header.php");
?>
<div class="container">
    <h2>Gameserver Migration</h2>
    <p>Möchten Sie Ihren Gameserver von einem anderen Anbieter zu uns migrieren?</p>
    <form action="start_migration.php" method="post">
        <label>Alter Anbieter:</label>
        <input type="text" name="old_provider" required>
        <label>Server ID:</label>
        <input type="text" name="server_id" required>
        <button type="submit">Migration starten</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>
