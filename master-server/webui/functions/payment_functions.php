<?php
// Zahlungsabwicklung und Rechnungsstellung
function processPayment($userId, $package, $amount) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO payments (user_id, package, amount, payment_date) VALUES (?, ?, ?, NOW())");
    if ($stmt->execute([$userId, $package, $amount])) {
        return true;
    }
    return false;
}

function generateInvoice($paymentId) {
    $invoiceContent = "Rechnung für Zahlung ID: " . $paymentId . "\nVielen Dank für Ihre Buchung!";
    $invoiceFile = "invoices/invoice" . $paymentId . ".pdf";
    file_put_contents($invoiceFile, $invoiceContent);
    return $invoiceFile;
}
?>
