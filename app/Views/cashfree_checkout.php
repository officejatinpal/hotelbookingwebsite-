<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Cashfree...</title>
</head>
<body onload="document.cf.submit();">

<h3>Please wait... Redirecting to Cashfree</h3>

<form name="cf" method="post" action="https://www.cashfree.com/checkout/post/submit">
    <?php foreach ($fields as $key => $value): ?>
        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
    <?php endforeach; ?>

    <input type="hidden" name="signature" value="<?= $signature ?>">
</form>

</body>
</html>
