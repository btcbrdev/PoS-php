<?php include 'partials/header.php'; ?>

<style type="text/css">
    .bar {
        border:1px solid #222;
        padding: 1px;
        margin-bottom: 12px;
        overflow: hidden;
        width: 250px;
    }

    .bar__percent {
        background: #222;
        float: right;
        height: 12px;
        width:100%;
    }
</style>

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

        <div class="bar">
            <div id="bar" class="bar__percent"></div>
        </div>
        <div id="countdown"></div>
        <div id="result">Esperando pagamento...</div>

        <script type="text/javascript">
            $(document).ready(function() {
                var url = "https://blockchain.info/";
                var bal;

                function checkBalance() {
                    $.ajax({
                        type: "GET",
                        url: url + "q/getreceivedbyaddress/<?php echo $key["invoice_address"]; ?>?confirmations=0",
                        data: {format : 'plain'},
                        success: function(response) {
                            if (!response) return;

                            var value = parseInt(response);

                            if (value > 0) {
                                $('#result').text("Recebido!");
                                $('#countdown').text('');
                                $('#bar').css("width", 0 + "%");
                                clearInterval(timer);
                                clearInterval(bal);

                                $.ajax({
                                    type: "POST",
                                    url: "save-tx.php",
                                    data: {addr : "<?php echo $key["invoice_address"]; ?>"},
                                    success: function(response) {
                                        console.log(response);
                                    }
                                });
                            } else {
                                bal = setTimeout(checkBalance, 5000);
                            }
                        }
                    });
                }
                ///Check for incoming payment
                bal = setTimeout(checkBalance, 5000);


                var timer;
                var end = new Date('<?php echo $key["invoice_date_expiry"]; ?>');
                var barWidth = 100;
                var secondsToEnd = parseInt((end - new Date()) / 1000);
                var percent = (100 / secondsToEnd);

                function countDown() {
                    var second = 1000;
                    var minute = second * 60;
                    var hour = minute * 60;
                    var day = hour * 24;
                    var now = new Date();
                    var distance = end - now;

                    if (distance < 0) {
                        clearInterval(timer);
                        clearInterval(bal);
                        $('#bar').css("width", 0 + "%");
                        $('#countdown').text('Expirou!');
                        $('#result').text('');

                        return;
                    }

                    var days = Math.floor(distance / day);
                    var hours = Math.floor((distance % day) / hour);
                    var minutes = Math.floor((distance % hour) / minute);
                    var seconds = Math.floor((distance % minute) / second);

                    var expire = "Expira em: " + minutes + ':';
                        expire += (seconds < 10 ? '0' : '') + seconds;

                    barWidth = barWidth - percent;
                    $('#bar').css("width", barWidth + "%");
                    $('#countdown').text(expire);
                }

                // inicia funcao countDown
                countDown();
                timer = setInterval(countDown, 1000);
            });
        </script>
    <?php endForeach; ?>

<?php include 'partials/footer.php'; ?>
