<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>



<!-- CAJA PRINCIPAL -->

<div id="principal">

    <h1>Ultimas entradas</h1>

    <?php
    $entradas = conseguirUltimasEntradas($db);
    if (!empty($entradas)):
        while ($entradas = mysqli_fetch_assoc($entradas)):
            ?>
            <article class="entrada">
                <h2><?= $entrada['titulo'] ?></h2>
                <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
                <p>
                    <?= $entrada['descripcion'] ?>
                </p>
            </article>

            <?php
        endwhile;
    endif;
    ?>

    <div id="ver-todas">
        <a href="">Ver todas las entradas</a>

    </div>

</div><!-- fin principal -->

<?php require_once 'includes/pie.php'; ?>







