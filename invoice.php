<?php include 'partials/header'; ?>

<?php
require 'config.php';
$newAddr = json_decode(file_get_contents("https://blockchain.info/api/receive?method=create&address=$receivingAddress"), true)[input_address];
$value = $_GET['value'];
$note = $_GET['note'];
$value = $_GET['value'];
$topay = number_format(file_get_contents("https://blockchain.info/tobtc?currency=BRL&value=$value"), 8);
date_default_timezone_set("America/Maceio");
$date = date("G:i:s - d/m/Y");
?>
    <title><?php echo $note; ?> | PoS</title>
   <header>
    <font face="Century Gothic" color="3e3e3e"><h1 align="center">Fatura #1</h1></font>
   </header>
   <center>
    Valor: R$<?php echo $value; ?><br>
    Transfira exatamente: <?php echo $topay; ?> BTC<br>
    <a href=""><?php echo $newAddr; ?></a><br>
    <img src="https://blockchain.info/qr?data=bitcoin:<?php echo $newAddr; ?>?amount=<?php echo $topay; ?>&label=label&message=nota&size=200" alt=""><br>
    Nota: <?php echo $note; ?><br>
    Expira em: 7:26<br>
    Data: <?php echo $date; ?><br>
    <div class="invoice-progress"></div><br>
    </center>

<?php include 'partials/footer'; ?>

<!--
if ($db = sqlite_open("invoices", 0666, $error)) {
sqlite_query($db, "INSERT INTO invoices (invoice_note, invoice_fiat, invoice_fiat_value, invoice_satoshis, invoice_paid, invoice_date, invoice_date_expiry) VALUES ($note, BRL, $value, $topay, TRUE or FALSE, $date, data expirada)");
}
else {
die($error);
}
-->
