<?php include 'partials/header.php'; ?>

<?php
    $currencies = json_decode(file_get_contents("https://blockchain.info/ticker"), true);
?>

<?php if (isset($_POST["invoice"])) : ?>

<?php
	include("partials/PDO/Db.class.php");

    $receivingAddress = "19UvhEdjQbhnJrUtDcMLvpRN5nk3axBAJu";

    $user_id = 1;
    $newAddr = json_decode(file_get_contents("https://blockchain.info/api/receive?method=create&address=$receivingAddress"), true)[input_address];
    $currency = $_POST['currency'];
    $currency_value = number_format($_POST['value'], 2);
    $invoice_btc_value = file_get_contents("https://blockchain.info/tobtc?currency=$currency&value=$currency_value");
    $date = date("D M d Y H:i:s O");
    $date_expiry = date("D M d Y H:i:s O", strtotime($date) + 900);

	$db = new Db();

    $db->query("INSERT INTO
                invoices(invoice_user_id, invoice_address, invoice_fiat, invoice_fiat_value, invoice_btc_value, invoice_paid, invoice_date, invoice_date_expiry)
                VALUES('$user_id', '$newAddr', '$currency', '$currency_value', '$invoice_btc_value', '0', '$date', '$date_expiry')"
    );

    header('Location: invoice.php?id=' . $db->lastInsertId());
?>

<?php else : ?>

<?php
    $currency_default = "BRL";

    if (isset($_GET["currency"])) {
        $currency_default = $_GET["currency"];
    }
    $quote = $currencies[$currency_default]["sell"];
    $symbol = $currencies[$currency_default]["symbol"];
?>

   <header>
    <h1>Criar Fatura</h1>
   </header>

    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <div style="margin-bottom:12px;">
            <label>Cotação:</label>
            <div>
                <?php echo $symbol . ' ' . $quote; ?>
            </div>
        </div>

        <div style="margin-bottom:12px;">
            <label>Moeda:</label>
            <select id="select-currency" name="currency">
                <?php foreach ($currencies as $currency => $value) : ?>
                    <option value="<?php echo $currency; ?>" <?php if ($currency == $currency_default) : ?>selected<?php endIf; ?>><?php echo $currency; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Valor:</label>
            <input id="value" name="value" data-quote="<?php echo $quote; ?>" type="text">
        </div>

        <div style="margin-bottom:12px;">
            <label>Total em BTC:</label>
            <div id="total">
            </div>
        </div>

        <div style="margin-bottom:12px;">
           <label>Notas:</label>
           <textarea name="note" rows="3"></textarea>
        </div>

        <button type="submit" name="invoice">Gerar Fatura</button>
   </form>

   <a href="report.php">Relatórios de Pagamento</a>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#value").on("change paste keyup", function() {
                var val = $(this).val(),
                    quote = $(this).data("quote"),
                    oneFiatinSatoshis = 100000000 / quote,
                    valInSatoshis = val * oneFiatinSatoshis,
                    valInBTC = valInSatoshis / 100000000;

                $("#total").text(valInBTC.toFixed(8));
            });

            $("#select-currency").on("change", function() {
                window.location = "create.php?currency=" + $(this).val();
            });
        });
    </script>

<?php endif; ?>

<?php include 'partials/footer.php'; ?>
