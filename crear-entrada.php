<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Añade nuevas entradas al blog para que los usuarios puedan
        usarlas al crear sus entradas.
    </p>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label form="titulo">titulo de la entrada</label>
        <input type="text" name="titulo"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

        <label form="descripcion">Descripcion</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <label form="categoria">Categoria</label>
        <select name="categoria"> 
            <?php
            $categorias = conseguirCategorias($db);
            if (!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                    <option value="<?= $categoria['id'] ?>">
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

<!--fin del contenedor-->

<!--pie de pagina-->
<?php require_once 'includes/pie.php'; ?>