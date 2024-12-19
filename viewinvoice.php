<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/vendor/autoload.php';

// Ambil Order ID dari query parameter
if (!isset($_GET['order_id'])) {
    die("Order ID tidak ditemukan.");
}

$order_id = $_GET['order_id'];

// Query data invoice dari database
$stmt = $pdo->prepare("
    SELECT 
        a.name, a.email, a.phone, 
        e.title, eta.price AS subtotal, eta.purchase_date AS transaction_date, 
        eta.transaction_status, eta.order_ID 
    FROM 
        event_ticket_assignment eta
    JOIN 
        attendee a ON eta.attendee_ID = a.attendee_ID
    JOIN 
        events e ON eta.event_ID = e.event_ID
    WHERE 
        eta.order_ID = :order_id
");
$stmt->execute(['order_id' => $order_id]);
$invoice = $stmt->fetch(PDO::FETCH_ASSOC);

// Periksa apakah data ditemukan
if (!$invoice) {
    die("Data invoice tidak ditemukan.");
}

// Tentukan apakah invoice dalam status pending
$isPending = $invoice['transaction_status'] === 'Pending';

// URL pembayaran (jika status pending)
$payment_url = $isPending ? "midtrans_payment.php?order_id={$order_id}" : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #007bff;
        }
        .header p {
            margin: 0;
            color: #6c757d;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            margin-bottom: 10px;
            color: #343a40;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table th, .details-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .details-table th {
            background-color: #f8f9fa;
        }
        .btn-group {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice</h1>
            <p>BPROTIC Event Management</p>
        </div>

        <div class="section">
            <h3>Invoice Details</h3>
            <table class="details-table">
                <tr>
                    <th>Order ID</th>
                    <td><?= htmlspecialchars($invoice['order_ID']) ?></td>
                </tr>
                <tr>
                    <th>Transaction Date</th>
                    <td><?= htmlspecialchars($invoice['transaction_date']) ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= htmlspecialchars($invoice['name']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($invoice['email']) ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?= htmlspecialchars($invoice['phone']) ?></td>
                </tr>
                <tr>
                    <th>Event Name</th>
                    <td><?= htmlspecialchars($invoice['title']) ?></td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td>Rp <?= number_format($invoice['subtotal'], 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= htmlspecialchars($invoice['transaction_status']) ?></td>
                </tr>
            </table>
        </div>

        <div class="btn-group">
            <?php if ($isPending && $payment_url): ?>
                <a href="<?= htmlspecialchars($payment_url) ?>" class="btn btn-primary">Bayar Sekarang</a>
            <?php endif; ?>
            <button class="btn btn-success" onclick="printInvoice()">Cetak</button>
            <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
