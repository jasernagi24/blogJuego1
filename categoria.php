<!--conexion--> 
<?php require_once 'includes/conexion.php'; ?>
<!--helpers--> 
<?php require_once 'includes/helpers.php'; ?>
<!--llamar a la funcion conseguir categoria-->
<?php
$categoria_actual = conseguirCategoria($db, $_GET['id']);

if (!isset($categoria_actual['id'])) {
    header('Location: index.php');
}
?>
<!--cabecera--> 
<?php require_once 'includes/cabecera.php'; ?>
<!--barra lateral-->
<?php require_once 'includes/lateral.php'; ?>

<!--contenido principal-->
<div id="principal">
    <h1>Entradas de la categoria de <?= $categoria_actual['nombres'] ?></h1>
    <?php
    $entradas = conseguirEntradas($db, null, $categoria_actual['id']);
   
    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1):
        while ($entrada = mysqli_fetch_assoc($entradas)):
            ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id']; ?>">
                    <h2><?= $entrada['titulo'] ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>

                    <p>
                        <?= substr($entrada['descripcion'], 0, 200) . "..." ?>
                    </p>
                </a>
            </article>
            <?php
        endwhile;
    else:
        ?> 
        <div class="alerta-error">No hay entradas en esta categoria</div>
    <?php endif; ?>
</div>

<!--fin del contenedor-->

<!--pie de pagina-->
<?php require_once 'includes/pie.php'; ?>