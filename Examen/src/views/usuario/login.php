<?php if(!isset($_SESSION['indentity'])): ?>
    <form action="<?=BASE_URL?>Usuario/login/" method="post">
        <p>
            <label for="nombreUsuario">Usuario: </label>
            <input id="nombreUsuario" type="text" name="data[nombreUsuario]" required>
        </p>
        <p>
            <label for="password">Contraseña: </label>
            <input id="password" type="password" name="data[password]" required>
        </p>
        <p>
            <input type="submit" value="Loguearse">
        </p>
    </form>
<?php else: ?>
    <h3><?=$_SESSION['identity']->nombre?><?= $_SESSION['identity']->apellidos ?></h3>
<?php endif;?>