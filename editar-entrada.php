<?php require_once 'includes/redireccion.php'; ?>
<!--conexion--> 
<?php require_once 'includes/conexion.php'; ?>
<!--helpers--> 
<?php require_once 'includes/helpers.php'; ?>
<!--llamar a la funcion conseguir categoria-->
<?php
$entrada_actual = conseguirEntrada($db, $_GET['id']);



?>
<!--cabecera--> 
<?php require_once 'includes/cabecera.php'; ?>
<!--barra lateral-->
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1>Editar entradas</h1>
    <p>
        Si tienes alguna nueva idea en la cual quieres añadir en el juego de <?=$entrada_actual['titulo'] ?>
    </p>
    <br>
    <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
        <label form="titulo">titulo de la entrada</label>
        <input type="text" name="titulo" value="<?= $entrada_actual['titulo']?>"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

        <label form="descripcion">Descripcion</label>
        <textarea name="descripcion"><?= $entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <label form="categoria">Categoria</label>
        <select name="categoria"> 
            <?php
            $categorias = conseguirCategorias($db);
            if (!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
            <option value="<?= $categoria['id'] ?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected ="selected"': ''?>>
                        <?= $categoria['nombres'] ?>
                    </option>
                    <?php
                endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

        <input type = "submit" value = "guardar"/>

    </form>
    <?php borrarErrores(); ?>
</div>


<?php require_once 'includes/pie.php'; ?>