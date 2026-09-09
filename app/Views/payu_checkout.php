<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayU...</title>
</head>
<body>

<form action="<?= esc($payuBaseUrl) ?>" method="post" name="payuForm">
    <input type="hidden" name="key" value="<?= esc($key) ?>">
    <input type="hidden" name="txnid" value="<?= esc($txnid) ?>">
    <input type="hidden" name="amount" value="<?= esc($amount) ?>">
    <input type="hidden" name="productinfo" value="<?= esc($productinfo) ?>">
    <input type="hidden" name="firstname" value="<?= esc($firstname) ?>">
    <input type="hidden" name="email" value="<?= esc($email) ?>">
    <input type="hidden" name="phone" value="<?= esc($phone) ?>">
    <input type="hidden" name="surl" value="<?= esc($surl) ?>">
    <input type="hidden" name="furl" value="<?= esc($furl) ?>">
    <input type="hidden" name="hash" value="<?= esc($hash) ?>">
    <input type="hidden" name="service_provider" value="payu_paisa">
</form>

<script>
    document.payuForm.submit();
</script>

</body>
</html>
