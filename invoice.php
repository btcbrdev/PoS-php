<?php include 'partials/header.php'; ?>

    <!-- .invoice -->
    <div class="invoice">
        <!-- .invoice__head -->
        <header class="invoice__head">
            <h1 class="invoice__title">Fatura #1</h1>
        </header>
        <!-- /.invoice__head -->

        <!-- .invoice__body -->
        <div class="invoice__body">
            <div class="invoice__fiat-value">R$ 1,00</div>
            <div class="invoice__btc-value">Transfira exatamente: 00.01000000 BTC</div>
            <a href="" class="invoice__pay">Pagar com Bitcoin</a>
            <div class="invoice__address">1XFoARCU5GzkoctiFxWgTuDZ7gNuZjmcK</div>
            <img src="https://blockchain.info/qr?data=bitcoin:1XFoARCU5GzkoctiFxWgTuDZ7gNuZjmcK?label=label&message=nota&size=200" alt="" />
            <div class="invoice__note">Nota: Hot Chocolate</div>
            <div class="invoice__time">Expira em: 7:26</div>
            <div class="invoice-progress"></div>
        </div>
        <!-- /.invoice__body -->
    </div>
    <!-- /.invoice -->

<?php include 'partials/footer.php'; ?>
