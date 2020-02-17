<!--conexion--> 
<?php require_once 'includes/conexion.php'; ?>
<!--helpers--> 
<?php require_once 'includes/helpers.php'; ?>
<!--llamar a la funcion conseguir categoria-->
<?php
$entrada_actual = conseguirEntrada($db, $_GET['id']);
if (!isset($entrada_actual['id'])) {
    header('Location: index.php');

}

?>
<!--cabecera--> 
<?php require_once 'includes/cabecera.php'; ?>
<!--barra lateral-->
<?php require_once 'includes/lateral.php'; ?>

<!--contenido de la entrada-->
<div id="principal">
    <h1><?= $entrada_actual['titulo']; ?></h1>
    <a href="categoria.php?id=<?= $entrada_actual['categoria_id']; ?>">
        <h2><?= $entrada_actual['categoria'] ?></h2>
    </a>
    <h3><?= $entrada_actual['creador']?> | <?= $entrada_actual['fecha'] ?></h3>
    <p><?= $entrada_actual['descripcion'] ?></p>

    <?php if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["id"] == $entrada_actual["usuario_id"]): ?>
        <a href="editar-entrada.php?id=<?= $entrada_actual['id']; ?>" class="boton boton-verde">Editar entrada</a>
        <br>
        <a href="borrar-entrada.php?id=<?= $entrada_actual['id']; ?>" class="boton boton-naranja">Eliminar entrada</a>
    <?php endif; ?>
</div>

<!--fin del contenedor-->

<!--pie de pagina-->
<?php require_once 'includes/pie.php'; ?>