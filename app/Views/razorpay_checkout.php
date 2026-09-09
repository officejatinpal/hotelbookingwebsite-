<!DOCTYPE html>
<html>
<head>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body onload="payNow()">

<script>
function payNow() {
    var options = {
        key: "<?= $key ?>",
        amount: <?= $amount * 100 ?>,
        currency: "INR",
        name: "Delvia Holidays International",
        description: "Payment",
        order_id: "<?= $order_id ?>",

        // ✅ ADD THIS
        prefill: {
            name: "<?= $name ?>",
            email: "<?= $email ?>",
            contact: "<?= $phone ?>"
        },

        handler: function(response) {
            window.location.href = "<?= base_url('payment/success') ?>" +
                "?razorpay_payment_id=" + response.razorpay_payment_id +
                "&razorpay_order_id=" + response.razorpay_order_id +
                "&razorpay_signature=" + response.razorpay_signature;
        },
        theme: {
            color: "#3399cc"
        }
    };

    var rzp = new Razorpay(options);

    rzp.on('payment.failed', function(response) {
        window.location.href = "<?= base_url('payment/failure') ?>" +
            "?error_code=" + response.error.code +
            "&error_description=" + encodeURIComponent(response.error.description) +
            "&error_source=" + response.error.source +
            "&error_step=" + response.error.step +
            "&error_reason=" + response.error.reason;
    });

    rzp.open();
}
</script>

</body>
</html>
