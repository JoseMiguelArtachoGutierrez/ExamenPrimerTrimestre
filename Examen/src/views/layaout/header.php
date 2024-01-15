<h1>Header</h1>

<ul>
    <li><a href="<?=BASE_URL?>">Inicio</a></li>
    <?php if (isset($_SESSION['identity'])): ?>
        <p><?php print_r($_SESSION['identity']); ?></p>
        <li><a href="<?= BASE_URL ?>Usuario/logout/">Cerrar sesion</a></li>
        <?php if ($_SESSION['identity']->rol=="direccion"):?>
            <li><a href="<?= BASE_URL ?>Usuario/registro/">Crear cuenta</a></li>
            <li><a href="<?= BASE_URL ?>Usuario/mostrarTodos/">Mostrar usuarios</a></li>
        <?php endif;?>
    <?php else: ?>
        <li><a href="<?= BASE_URL ?>Usuario/indetifica/">Identificate</a></li>

    <?php endif; ?>
</ul>