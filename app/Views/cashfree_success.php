<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cashfree Payment Receipt</title>

<!-- html2canvas + jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
/* SAME CSS — unchanged */
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
    opacity: 0.06;
    position: absolute;
    top: 10%;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}
.invoice-content { position: relative; z-index: 5; }
.header {
    display: flex; justify-content: space-between; align-items: center;
    border-bottom: 2px solid #e0e0e0; padding-bottom: 15px; margin-bottom: 30px;
}
.header img { width: 140px; }
.header-right { text-align: right; font-size: 14px; color: #555; }

.top-details {
    display: flex; justify-content: space-between;
    background: #f0f4ff; padding: 18px 25px; border-radius: 12px;
    border: 1px solid #d7dbec; margin-bottom: 30px;
}
.top-details div { width: 33%; font-size: 16px; font-weight: 500; }

.status-box {
    padding: 15px 0; text-align: center; border-radius: 10px;
    font-size: 18px; margin-bottom: 25px; font-weight: 700; color: #fff;
}
.success { background: #28a745; }
.failed { background: #dc3545; }

.table-box {
    border: 1px solid #e0e0e0; border-radius: 12px; overflow: hidden; margin-bottom: 30px;
}
.row { display: flex; padding: 14px 20px; border-bottom: 1px solid #e6e6e6; font-size: 16px; }
.row:last-child { border-bottom: none; }
.col-left { width: 40%; font-weight: 600; }
.col-right { width: 60%; }

.footer { padding-top: 20px; border-top: 2px solid #e0e0e0; font-size: 14px; color: #555; }

.highlight { color:#00BFFF; font-weight: 600; }

.btn-area { text-align: center; margin-top: 20px; }
button, a {
    padding: 12px 24px; font-size: 16px; border: none;
    border-radius: 6px; margin-right: 10px; cursor: pointer;
    color: #fff; text-decoration: none;
}
.print-btn { background: #17a2b8; }
.pdf-btn { background: #28a745; }
.home-btn { background: #007bff; }

@media print { button, a { display: none; } }
</style>

</head>
<body>

<!-- BUTTONS -->
<div class="btn-area">
    <button class="print-btn" onclick="window.print()">🖨️ Print</button>

    <?php if(isset($status) && $status=='success'): ?>
        <button class="pdf-btn" onclick="downloadPDF()">📄 Download PDF</button>
    <?php endif; ?>

    <a href="<?= base_url('/') ?>" class="home-btn">Back to Home</a>
</div>

<div class="invoice-box" id="payment-card">
<div class="invoice-content">

    <!-- STATUS BOX -->
    <?php if ($status == 'success'): ?>
        <div class="status-box success">✔ Payment Successful</div>
    <?php else: ?>
        <div class="status-box failed">✖ Payment Failed</div>
    <?php endif; ?>

    <!-- HEADER -->
    <div class="header">
        <img src="<?= base_url('asset/logo.png') ?>" alt="Logo">
        <div class="header-right">
            info@delviaholidaysinternational.com<br>
            +91 1135236123<br>
            F-26/3 Pocket D, Okhla Phase-II, New Delhi – 110020
        </div>
    </div>

    <!-- TOP DETAILS -->
    <div class="top-details">
        <div><strong>Txn. ID:</strong> <span class="highlight"><?= esc($payment_id) ?></span></div>
        <div><strong>Date:</strong> <span class="highlight"><?= date('d-m-Y') ?></span></div>
        <div><strong>Total:</strong> <span class="highlight">₹<?= number_format($amount,2) ?></span></div>
    </div>

    <!-- USER DETAILS TABLE -->
    <div class="table-box">

        <div class="row">
            <div class="col-left">Order ID:</div>
            <div class="col-right highlight"><?= esc($order_id) ?></div>
        </div>

        <div class="row">
            <div class="col-left">Name:</div>
            <div class="col-right"><?= esc($name) ?></div>
        </div>

        <div class="row">
            <div class="col-left">Email Id:</div>
            <div class="col-right"><?= esc($email) ?></div>
        </div>

        <div class="row">
            <div class="col-left">Phone No.:</div>
            <div class="col-right"><?= esc($phone) ?></div>
        </div>

        <div class="row">
            <div class="col-left">Payment Type:</div>
            <div class="col-right"><?= esc($type) ?></div>
        </div>

        <div class="row">
            <div class="col-left">Payment Gateway:</div>
            <div class="col-right">Cashfree</div>
        </div>

        <div class="row">
            <div class="col-left">TXN Status:</div>
            <div class="col-right"><?= $status=='success' ? 'Transaction Success' : 'Transaction Failed' ?></div>
        </div>

        <!-- FAILED BLOCK -->
        <?php if ($status=='failed'): ?>
        <div class="row">
            <div class="col-left">Error Code:</div>
            <div class="col-right"><?= esc($status) ?></div>
        </div>

        <div class="row">
            <div class="col-left">Error Message:</div>
            <div class="col-right"><?= esc($message) ?></div>
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

    const pdf = new jsPDF('p', 'mm', 'a4');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const height = (canvas.height * pdfWidth) / canvas.width;

    pdf.addImage(img, "PNG", 0, 5, pdfWidth, height);
    pdf.save("Cashfree_Payment_Receipt.pdf");
}
</script>

</body>
</html>
