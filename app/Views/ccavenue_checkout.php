<!DOCTYPE html><html><body>
<h3>Redirecting to CCAvenue...</h3>
<form method="post" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<input type="hidden" name="merchant_id" value="YourMerchantID">
<input type="hidden" name="order_id" value="<?= time() ?>">
<input type="hidden" name="currency" value="INR">
<input type="hidden" name="amount" value="<?= $data['amount'] ?>">
<input type="hidden" name="redirect_url" value="<?= base_url('payment/success') ?>">
<input type="hidden" name="cancel_url" value="<?= base_url('payment/failure') ?>">
<button type="submit">Proceed to CCAvenue</button>
</form>
</body></html>
