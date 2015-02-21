<?php include 'partials/header'; ?>
<?php include 'partials/style.css'; ?>

<title>Criar Fatura | PoS</title>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['password']) && $_GET['password'] == '123456' and ($_GET['user']) && $_GET['user'] == 'admin'){
    $_SESSION['valida'] = 1;
}
if ($_SESSION['valida'] != 1) {
    echo '<br><br><center><h1>ACESSO NEGADO!</h1></center>';
    unset($_SESSION['valida']);
    EXIT();
}
if (isset($_GET['logout']) && $_GET['logout'] == 'ok') {
    unset($_SESSION['valida']);
    session_destroy();
    EXIT();
}
$lastBTC = json_decode(file_get_contents("https://blockchain.info/ticker"), true)[BRL][last];
?>

   <header>
    <font face="Nexa Light" color="#3e3e3e"><h1 align="center">Criar Fatura</h1></font>
   </header>
   <center>
   <div class="box">
   <font face="Nexa Light" color="#e3e3e3" size="4px">
   <form action="invoice" type="POST">
      <br>
       <label>Cota&ccedil;&atilde;o: R$ <font face="Axis"><?php echo $lastBTC; ?></font></label>
      <br><br>
       <label>Valor em R$:</label>
       <input name="value" type="text">
      <br><br>
       <label>Notas:</label><br>
       <textarea name="note" rows="1" cols="15"></textarea>
      <br><br>
       <button type="submit">Gerar Fatura</button>
      <br><br>
   </form>
   </font>
   </div>
   <br>
   <a href="report">Relatórios de Pagamento</a>
   </center>

<?php include 'partials/footer'; ?>
