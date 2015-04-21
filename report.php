<?php include 'partials/header.php'; ?>

<?php
	include("partials/PDO/Db.class.php");

	$db = new Db();
    $invoices = $db->query("SELECT * FROM invoices");
?>

    <!-- .report -->
    <div class="report">
        <!-- .report__head -->
        <header class="report__head">
            <h1 class="report__title">Relatório de Pagamentos</h1>
        </header>
        <!-- /.report__head -->

        <!-- .report__body -->
        <div class="report__body">
            <!-- .report-table -->
            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Data Expiry</th>
                        <th>Valor em Bitcoin</th>
                        <th>Valor em BRL</th>
                        <th>Nota</th>
                        <th>Confirmações</th>
                        <th>Endereço BTC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $key) : ?>
                    <tr>
                        <td><?php echo $key["invoice_id"]; ?></td>
                        <td><?php echo $key["invoice_date"]; ?></td>
                        <td><?php echo $key["invoice_date_expiry"]; ?></td>
                        <td><?php echo $key["invoice_btc_value"]; ?> BTC</td>
                        <td><?php echo $key["invoice_fiat"]; ?> <?php echo $key["invoice_fiat_value"]; ?></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="invoice.php?id=<?php echo $key["invoice_id"]; ?>"><?php echo $key["invoice_address"]; ?></a>
                        </td>
                    </tr>
                    <?php endForeach; ?>
                </tbody>
            </table>
            <!-- /.report-table -->
        </div>
        <!-- /.report__body -->
    </div>
    <!-- /.report -->

<?php include 'partials/footer.php'; ?>
