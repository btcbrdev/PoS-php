<?php include 'partials/header.php'; ?>

<?php
	include("partials/PDO/Db.class.php");

    $id = $_GET['id'];

	$db = new Db();
	$db->bind("id", $id);

	$invoice = $db->query("SELECT * FROM invoices WHERE invoice_id = :id");

    echo "<pre>";
    print_r($invoice);
    echo "</pre>";
?>
    <?php foreach ($invoice as $key) : ?>
       <header>
       <h1>Fatura # <?php echo $id; ?></h1>
       </header>
        Valor em <?php echo $key["invoice_fiat"]; ?>: <?php echo $key["invoice_fiat_value"]; ?><br>
        Transfira exatamente: <?php echo $key["invoice_btc_value"]; ?> BTC<br>
        <a href=""><?php echo $key["invoice_address"]; ?></a><br>
        <img src="https://blockchain.info/qr?data=bitcoin:<?php echo $key["invoice_address"]; ?>?amount=<?php echo $key["invoice_btc_value"]; ?>&size=200" alt=""><br>
        Expira em: <br>
        Data: <br>
        <div class="invoice-progress"></div><br>
    <?php endForeach; ?>

<?php include 'partials/footer.php'; ?>
