<!-- /app/Views/receipt.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
</head>
<body>
<h2>Payment Receipt</h2>

<p>Order ID: <?= esc($order_id) ?></p>
<p>Gateway: <?= esc($gateway) ?></p>
<p>Payment Done Successfully! ✅</p>

</body>
</html>
