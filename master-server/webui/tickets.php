<?php
include("includes/header.php");
?>
<div class="container">
    <h2>Support-Tickets</h2>
    <form action="submit_ticket.php" method="post" enctype="multipart/form-data">
        <label>Betreff:</label>
        <input type="text" name="subject" required>
        <label>Nachricht:</label>
        <textarea name="message" required></textarea>
        <button type="submit">Ticket absenden</button>
    </form>
    <!-- Hier werden bestehende Tickets angezeigt -->
</div>
<?php include("includes/footer.php"); ?>
