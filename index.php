<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='author' content='David Peral'>
    <meta name='description' content='Proyecto de Ajedrez en PHP'>
    <meta name='keywords' content=''>
    <title>Mi Ajedrez</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
    <script src="./assets/icons/FontAwesome.js"></script>
</head>
<body>
    <?php
    require_once("./models/ModeloJuego.php");
    ?>
    <header>
        <h1>Mi Ajedrez</h1>
    </header>
    <main>
        <?php
        session_start();
        //unset($_SESSION["juego"]);
        $juego = new Juego();
        if (!isset($_SESSION['juego'])) {
            $_SESSION['juego'] = serialize($juego); // Guardar en la sesión
        } else {
            $juego = unserialize($_SESSION['juego']); // Restaurar desde la sesión
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $juego = unserialize($_SESSION['juego']);
            if (isset($_GET["seleccionarFicha"])) {
                $juego->mostrarMovimientos($_GET["seleccionarFicha"]);
            } elseif (isset($_GET["moverFicha"]) && !isset($_GET["seleccionarFicha"])) {
                $juego->moverFicha([$_GET["moverFicha"][0],$_GET["moverFicha"][1]], [$_GET["moverFicha"][3], $_GET["moverFicha"][4]]);
                $juego->seleccionarFicha();
            } else {
                $juego->seleccionarFicha();
            }
            $_SESSION['juego'] = serialize($juego);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            unset($_SESSION["juego"]);
            header("Location: .");
        }
        ?>
        <form action="#" method="get">
            <?= $juego->mostrarTablero();?>
        </form>
        <div class="info">
            <h2><?=$juego->getTurno() == 1 ? "Juegan Blancas" : "Juegan Negras" ?></h2>
            <form action="#" method="post">
                <button type="submit" name="borrarSesion">Borrar Cookie</button>
                <h1><?= $juego->getTurno();?></h1>
            </form>
        </div>
    </main>
    <footer>
        <address class="author">By David Peral</address>
    </footer>
</body>
</html>