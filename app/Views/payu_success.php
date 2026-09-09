<?php
// -------- NORMALIZE PAYU RESPONSE ----------
$status = ($response['status'] ?? '') === 'success' ? 'success' : 'failure';

$payment_id = $response['txnid'] ?? 'N/A';
$order_id   = $response['mihpayid'] ?? 'N/A';
$amount     = $response['amount'] ?? 0;
$name       = $response['firstname'] ?? 'N/A';
$email      = $response['email'] ?? 'N/A';
$phone      = $response['phone'] ?? 'N/A';
$type       = $response['productinfo'] ?? 'N/A';

$error_code = $response['error_code'] ?? '';
$error_desc = $response['error'] ?? $response['error_Message'] ?? 'Transaction Failed';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Payment Receipt</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    background-color: #f4f6f8;
    margin: 0;
    padding: 10px;
    color: #333;
}

.invoice-box {
    max-width: 900px;
    margin: 20px auto;
    background: #fff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    position: relative;
    overflow: hidden;
}

.invoice-box::before {
    content: "";
    background-image: url('<?= base_url("asset/watermark.png") ?>');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 400px;
    opacity: 0.05;
    position: absolute;
    top: 10%;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.invoice-content { position: relative; z-index: 5; }

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 15px;
    margin-bottom: 30px;
}
.header img { width: 140px; }
.header-right {
    text-align: right;
    font-size: 14px;
    line-height: 1.5;
    color: #555;
}

.top-details {
    display: flex;
    justify-content: space-between;
    background: #f0f4ff;
    padding: 18px 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    border: 1px solid #d7dbec;
}

.top-details div { width: 33%; font-size: 16px; font-weight: 500; }

.status-box {
    padding: 15px 0;
    text-align: center;
    border-radius: 10px;
    font-size: 18px;
    margin-bottom: 25px;
    font-weight: 700;
    color: #fff;
}

.success { background: #28a745; }
.failed { background: #dc3545; }

.table-box { 
    border: 1px solid #e0e0e0; 
    border-radius: 12px; 
    overflow: hidden; 
    margin-bottom: 30px;
}

.row {
    display: flex;
    padding: 14px 20px;
    border-bottom: 1px solid #e6e6e6;
    font-size: 16px;
}
.row:last-child { border-bottom: none; }
.col-left { width: 40%; font-weight: 600; color: #444; }
.col-right { width: 60%; color: #333; }

.footer {
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
    font-size: 14px;
    color: #555;
}

.thankyou { font-size: 18px; margin-bottom: 10px; font-weight: 700; }

.btn-area {
    text-align: center;
    margin-top: 20px;
}
button, a {
    padding: 12px 24px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    margin-right: 10px;
    cursor: pointer;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.print-btn { background: #17a2b8; }
.print-btn:hover { background: #138496; }

.pdf-btn { background: #28a745; }
.pdf-btn:hover { background: #218838; }

.home-btn { background: #007bff; }
.home-btn:hover { background: #0069d9; }
.highlight { 
    color:#00BFFF;
}

@media print {
    button, a { display: none; }
}
</style>
</head>

<body>

<!-- BUTTON AREA -->
<div class="btn-area">
    <button class="print-btn" onclick="window.print()">🖨️ Print</button>

    <?php if($status === 'success'): ?>
        <button class="pdf-btn" onclick="downloadPDF()">📄 Download PDF</button>
    <?php endif; ?>

    <a href="<?= base_url('/') ?>" class="home-btn">Back to Home</a>
</div>

<div class="invoice-box" id="payment-card">
<div class="invoice-content">

<!-- STATUS -->
<?php if ($status === 'success'): ?>
    <div class="status-box success">✔ Payment Successful</div>
<?php else: ?>
    <div class="status-box failed">✖ Payment Failed</div>
<?php endif; ?>

<!-- HEADER -->
<div class="header">
    <img src="<?= base_url('asset/logo.png') ?>">
    <div class="header-right">
        info@delviaholidaysinternational.com<br>
        +91 1135236123<br>
        New Delhi – 110020
    </div>
</div>

<!-- TOP DETAILS -->
<div class="top-details">
    <div>
        <strong>Txn. ID:</strong>
        <span class="highlight"><?= esc($payment_id) ?></span>
    </div>
    <div>
        <strong>Date:</strong>
        <span class="highlight"><?= date('d-m-Y') ?></span>
    </div>
    <div>
        <strong>Total:</strong>
        <span class="highlight">₹<?= number_format($amount,2) ?></span>
    </div>
</div>

<!-- DETAILS TABLE -->
<div class="table-box">

<?php if($status === 'success'): ?>
<div class="row">
    <div class="col-left">Order ID:</div>
    <div class="col-right highlight"><?= esc($order_id) ?></div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-left">Name:</div>
    <div class="col-right"><?= esc($name) ?></div>
</div>

<div class="row">
    <div class="col-left">Email:</div>
    <div class="col-right"><?= esc($email) ?></div>
</div>

<div class="row">
    <div class="col-left">Phone:</div>
    <div class="col-right"><?= esc($phone) ?></div>
</div>

<div class="row">
    <div class="col-left">Payment Type:</div>
    <div class="col-right"><?= esc($type) ?></div>
</div>

<div class="row">
    <div class="col-left">Payment Gateway:</div>
    <div class="col-right">PayU</div>
</div>

<div class="row">
    <div class="col-left">TXN Status:</div>
    <div class="col-right">
        <?= $status === 'success' ? 'Transaction Success' : 'Transaction Failed' ?>
    </div>
</div>

<?php if ($status === 'failure'): ?>
<div class="row">
    <div class="col-left">Error Code:</div>
    <div class="col-right"><?= esc($error_code) ?></div>
</div>

<div class="row">
    <div class="col-left">Error Message:</div>
    <div class="col-right"><?= esc($error_desc) ?></div>
</div>
<?php endif; ?>

</div>

<!-- FOOTER -->
<div class="footer">
    <strong>Terms & Conditions</strong>
    <p>Invoice is computer-generated and valid without signature and seal.</p>
</div>

</div>
</div>

<script>
async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const card = document.getElementById("payment-card");
    const canvas = await html2canvas(card, { scale: 2 });
    const img = canvas.toDataURL("image/png");

    const pdf = new jsPDF('p','mm','a4');
    const w = pdf.internal.pageSize.getWidth();
    const h = (canvas.height * w) / canvas.width;

    pdf.addImage(img, "PNG", 0, 5, w, h);
    pdf.save("PayU_Payment_Receipt.pdf");
}
</script>

</body>
</html>
