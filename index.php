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
    require_once("./models/Juego.php");
    require_once("./models/Tablero.php");
    require_once("./models/Casilla.php");
    require_once("./models/Jugador.php");
    require_once("./models/Pieza.php");
    require_once("./models/ModelosPiezas/Alfil.php");
    require_once("./models/ModelosPiezas/Caballo.php");
    require_once("./models/ModelosPiezas/Peon.php");
    require_once("./models/ModelosPiezas/Reina.php");
    require_once("./models/ModelosPiezas/Rey.php");
    require_once("./models/ModelosPiezas/Torre.php");

    ?>
    <header>
        <h1>Mi Ajedrez</h1>
    </header>
    <main>
        <?php
        session_start();
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
                $juego->moverFicha($_GET["moverFicha"][0].$_GET["moverFicha"][1] , $_GET["moverFicha"][3].$_GET["moverFicha"][4]);
                $juego->seleccionarFicha();
            } elseif(isset($_GET["matarFicha"])) {
                $juego->matarFicha($_GET["matarFicha"][0].$_GET["matarFicha"][1] , $_GET["matarFicha"][3].$_GET["matarFicha"][4]);
            } else {
                $juego->seleccionarFicha();
            }
            $_SESSION['juego'] = serialize($juego);
        }else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            unset($_SESSION["juego"]);
            header("Location: .");
        } else {
            unset($_SESSION["juego"]);
        }
        ?>
        <form action="#" method="get">
            <?= $juego->mostrarTablero();?>
        </form>
        <div class="info">
            <h2>Juegan <?=$juego->getTurno() == 1 ? "<span class='blanca'>Blancas</span>" : "<span class='negra'>Negras</span>" ?></h2>
            <div class="piezasMuertas">
                <h2>Piezas fuera de juego</h2>
                <div class="blanca">
                    <h2><span class="blanca">Blancas</span></h2>
                </div><!--
                --><div class="negra">
                    <h2><span class="negra">Negras</span></h2>
                    <?= $juego->jugadores['negra']->mostrarMuertas();?>
                </div>
            </div>
            <form action="#" method="post">
                <button type="submit" name="borrarSesion">Reiniciar partida</button>
            </form>
        </div>
    </main>
    <footer>
        <address class="author">By David Peral</address>
    </footer>
</body>
</html>