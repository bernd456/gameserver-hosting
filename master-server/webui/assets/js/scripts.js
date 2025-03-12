// Basis-JavaScript für Interaktivität
document.addEventListener("DOMContentLoaded", function() {
    console.log("WebUI geladen");
});

function purchasePackage(packageType) {
    fetch("payment_process.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "package=" + packageType + "&paymentStatus=success"
    })
    .then(response => response.json())
    .then(data => {
        alert("Payment Successful. Server is being set up.");
        window.location.href = "account.php";
    })
    .catch(error => console.error(error));
}

function manageServer(action, serverId) {
    fetch(`/api/server?action=${action}&id=${serverId}`)
        .then(response => response.json())
        .then(data => {
            alert(`Server ${serverId} ${action}d: ${data.message}`);
        })
        .catch(err => console.error(err));
}
