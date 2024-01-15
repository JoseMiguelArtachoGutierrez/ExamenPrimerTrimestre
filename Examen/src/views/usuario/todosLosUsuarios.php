<?php if(isset($_SESSION['identity']) && $_SESSION['identity']->rol=="direccion"): ?>
    <table>
        <tr>
            <td>Usuario</td>
            <td>Nombre Completo</td>
            <td>Primer Apellido</td>
            <td>Segundo Apellido</td>
            <td>DNI</td>
            <td>Correo</td>
        </tr>
        <?php
        if (isset($usuarios)):foreach ($usuarios as $usuario):?>
            <td><?=$usuario['nombreUsuario']?></td>
            <td><?=$usuario['apellidoUNO']?></td>
            <td><?=$usuario['apellidoDOS']?></td>
            <td><?=$usuario['nombreUsuario']?></td>
            <td><?=$usuario['dni']?></td>
            <td><?=$usuario['email']?></td>
            <td><a href="<?= BASE_URL ?>Usuario/update/<?= $usuario['id'] ?>">Modificar</a></td>
        <?php endforeach; endif;?>

    </table>
<?php endif;?>
