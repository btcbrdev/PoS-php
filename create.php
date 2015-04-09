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

   <header>
    <h1>Criar Fatura</h1>
   </header>

    <form action="invoice.php" type="GET">
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

   <a href="report">Relatórios de Pagamento</a>

<?php include 'partials/footer'; ?>
