<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1>Crear categorias</h1>
    <p>
        Añade nuevas categorias al blog para que los usuarios puedan
        usarlas al crear sus entradas.
    </p>
    <br>
    <form action="guardar-categoria.php" method="POST">
        <label form="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre"/>
        
        <input type="submit" value="guardar"/>
        
    </form>
</div>

<!--fin del contenedor-->

<!--pie de pagina-->
<?php require_once 'includes/pie.php'; ?>