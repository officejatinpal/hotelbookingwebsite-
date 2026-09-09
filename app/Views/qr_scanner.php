<?php include "header.php" ?>

<div style="text-align:center; margin-top:40px;">

    <h2>Scan & Explore Our Website</h2>

    <div style="position:relative; display:inline-block;">
        
        <!-- QR Code -->
        <img id="qrCode"
             src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=https://delviaholidaysinternational.com/"
             style="padding:15px 15px; background:#fff;">

        <!-- Logo (FIXED) -->
        <div style="
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            background:#fff;
            padding:8px;
            border-radius:10px;
        ">
            <img src="<?= base_url('asset/logo.png') ?>"
                 style="width:40px; height:40px;">
        </div>

    </div>

    <br><br>

    <button onclick="downloadQR()"
            style="padding:10px 20px; background:#007bff; color:#fff; border:none; border-radius:5px;">
        Download QR Code
    </button>
<br><br>
</div>

<script>
function downloadQR() {

    let size = 300;
    let canvas = document.createElement('canvas');
    canvas.width = size;
    canvas.height = size;
    let ctx = canvas.getContext('2d');

    let qr = new Image();
    qr.crossOrigin = "anonymous";

    // ✅ High error correction (important)
    qr.src = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&ecc=H&margin=20&data=https://delviaholidaysinternational.com/";

    qr.onload = function () {

        ctx.drawImage(qr, 0, 0, size, size);

        let logo = new Image();
        logo.src = "<?= base_url('asset/logo.png') ?>";

        logo.onload = function () {

            // ✅ Smaller logo (max 20% of QR)
            let logoSize = size * 0.18;

            let centerX = (size - logoSize) / 2;
            let centerY = (size - logoSize) / 2;

            // ✅ Bigger white safe area
            let padding = 10;

            ctx.fillStyle = "#ffffff";
            ctx.fillRect(
                centerX - padding,
                centerY - padding,
                logoSize + (padding * 2),
                logoSize + (padding * 2)
            );

            // ✅ Draw logo
            ctx.drawImage(logo, centerX, centerY, logoSize, logoSize);

            let link = document.createElement('a');
            link.download = "Delvia-QR.png";
            link.href = canvas.toDataURL("image/png");
            link.click();
        };
    };
}
</script>

<?php include "footer.php" ?>
