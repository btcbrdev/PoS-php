<?php include 'partials/header.php'; ?>

<?php if ($_POST) : ?>

<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_POST['password']) && $_POST['password'] == '123' and ($_POST['user']) && $_POST['user'] == 'admin'){
        $_SESSION['valida'] = 1;

        header('Location: create.php');
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
?>

<?php else : ?>

    <title>PoS</title>

    <h1>Fa&ccedil;a Login</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
    Usu&aacute;rio: <br><input type="text" name="user"><br><br>
    Senha: <br><input type="password" name="password"><br><br>
    <button type="submit">Acessar</button><br><br>
    </form>

<?php endif; ?>

<?php include 'partials/footer.php'; ?>
