<?php include 'partials/header.php'; ?>

    <!-- .create -->
    <form class="create" action="invoice.php">
        <!-- .create__head -->
        <header class="create__head">
            <h1 class="create__title">Criar Fatura</h1>
        </header>
        <!-- /.create__head -->

        <!-- .create__body -->
        <div class="create__body">
            <!-- .create-form -->
            <ul class="create-form">
                <li>
                    <label for="" class="create-form__label">Cotação:</label>
                    R$ 600,00
                </li>
                <li>
                    <label for="" class="create-form__label">Valor em R$:</label>
                    <input id="" name="" type="text" class="create-form__input input" />
                    BTC: 0.00426348
                </li>
                <li>
                    <label for="" class="create-form__label">Notas:</label>
                    <textarea id="" name="" rows="6" class="create-form__textarea"></textarea>
                </li>
                <li>
                    <button type="submit">Gerar Fatura</button>
                </li>
            </ul>
            <!-- /.create-form -->

            <a href="report.php">Relatórios de Pagamento</a>
        </div>
        <!-- /.create__body -->
    </div>
    <!-- /.create -->

<?php include 'partials/footer.php'; ?>
