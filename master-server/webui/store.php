<?php
include("includes/header.php");
?>
<div class="container">
    <h2>Hosting-Pakete</h2>
    <div class="package">
        <h3>Basic Paket</h3>
        <p>4GB RAM, 10 Slots, 2 vCores – 5,99€ / Monat</p>
        <button onclick="purchasePackage('basic')">Paket bestellen</button>
    </div>
    <div class="package">
        <h3>Advanced Paket</h3>
        <p>8GB RAM, 20 Slots, 4 vCores – 9,99€ / Monat</p>
        <button onclick="purchasePackage('advanced')">Paket bestellen</button>
    </div>
    <!-- Weitere Pakete hinzufügen -->
</div>
<?php include("includes/footer.php"); ?>
