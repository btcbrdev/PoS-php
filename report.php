<?php include 'partials/header.php'; ?>

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
                        <th>Valor em Bitcoin</th>
                        <th>Valor em BRL</th>
                        <th>Nota</th>
                        <th>Endereço BTC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2015-01-07 19:12:20</td>
                        <td>00.00001000 BTC</td>
                        <td>R$ 1.00</td>
                        <td>Testing</td>
                        <td>
                            <a href="">1XFoARCU5GzkoctiFxWgTuDZ7gNuZjmcK</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- /.report-table -->
        </div>
        <!-- /.report__body -->
    </div>
    <!-- /.report -->

<?php include 'partials/footer.php'; ?>
