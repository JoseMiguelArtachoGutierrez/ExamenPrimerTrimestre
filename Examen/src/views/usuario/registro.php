<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TiendaAcA</title>
</head>
<body>
<?php ?>
<?php ?>
<h1>Registrate</h1>
<a href="<?=BASE_URL?>DashBoard/index">Cancelar</a><br>

<form action="<?=BASE_URL?>Usuario/registro/" method="post">
    <label>Usuario: </label>
    <input type="text" name="data[nombreUsuario]" value=""><br>
    <label>DNI: </label>
    <input type="text" name="data[DNI]" value=""><br>
    <label>Nombre: </label>
    <input type="text" name="data[nombreCompleto]" value=""><br>
    <label>Primer Apellidos: </label>
    <input type="text" name="data[apellidoUno]" value=""><br>
    <label>Segunod Apellido: </label>
    <input type="text" name="data[apellidoDos]" value=""><br>
    <label>Correo: </label>
    <input type="text" name="data[email]" value=""><br>
    <label>Password: </label>
    <input type="text" name="data[password]" value=""><br>
    <br><input type="submit" value="Registrarse">
</form>
</body>
</html>


