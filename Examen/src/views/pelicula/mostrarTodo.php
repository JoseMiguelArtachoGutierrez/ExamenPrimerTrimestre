<?php if(isset($_SESSION['identity']) && $_SESSION['identity']->rol=="profesor"): ?>
    <table>
        <tr>
            <td>Titulo</td>
            <td>Director</td>
            <td>Genero</td>
            <td>Año</td>
        </tr>
        <?php
        if (isset($usuarios)):foreach ($usuarios as $usuario):?>
            <td><?=$usuario['titulo']?></td>
            <td><?=$usuario['director']?></td>
            <td><?=$usuario['genero']?></td>
            <td><?=$usuario['fecha']?></td>
        <?php endforeach; endif;?>

    </table>
<?php endif;?>
