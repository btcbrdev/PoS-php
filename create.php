<?php include 'partials/header'; ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['password']) && $_GET['password'] == '123' and ($_GET['user']) && $_GET['user'] == 'admin'){
    $_SESSION['valida'] = 1;
}

if ($_SESSION['valida'] != 1) {
    echo '<br><br><center><h1>ACESSO NEGADO!</h1></center>';
    unset($_SESSION['valida']);
    exit();
}

if (isset($_GET['logout']) && $_GET['logout'] == 'ok') {
    unset($_SESSION['valida']);
    session_destroy();
    exit();
}
$currecies = json_decode(file_get_contents("https://blockchain.info/ticker"), true);
?>

<?php if ($_POST) : ?>

<?php
	include("class/PDO/Db.class.php");

    $user_id = 1;
    $currency = $_POST['currency'];
    $currency_value = number_format($_POST['value'], 2);
    $invoice_btc_value = file_get_contents("https://blockchain.info/tobtc?currency=$currency&value=$currency_value");
    //$TIME = date("D M d Y H:i:s O");
    //$ENDTIME = date("D M d Y H:i:s O", strtotime($TIME) + 600);

    //$TIME = strtotime($TIME);
    //$ENDTIME = strtotime($ENDTIME);

	$db = new Db();

	$db->query("INSERT INTO invoices (invoice_user_id, invoice_fiat, invoice_fiat_value, invoice_btc_value, invoice_paid) VALUES('$user_id', '$currency', '$currency_value', '$invoice_btc_value', '0')");
?>


<?php else : ?>

   <header>
    <h1>Criar Fatura</h1>
   </header>

    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <div style="margin-bottom:12px;">
            <label>Valor:</label>
            <input name="value" type="text">
            <select id="" name="currency">
                <?php foreach ($currecies as $currency => $value) : ?>
                <option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom:12px;">
           <label>Notas:</label>
           <textarea name="note" rows="3"></textarea>
        </div>

        <button type="submit">Gerar Fatura</button>
   </form>

   <a href="report.php">Relatórios de Pagamento</a>

<?php endif; ?>

<?php include 'partials/footer'; ?>
