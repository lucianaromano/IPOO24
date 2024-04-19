<?php
include 'login.php';
$valida = false;
$login = new Login("Pufu", "Paco", "gato");

while (!$valida) {
    echo "Ingrese su contrasenia: ";
    $contrasenia = trim(fgets(STDIN));
    if ($login->validarContrasenia($contrasenia)) {
        $valida = true;
    } else {
        echo "Contrasenia incorrecta\n";
    }
}
echo "Bienvenido " . $login->getNombreUsuario() . "\n";

echo "Desea cambiar su contrasenia? (s/n) ";
$opcion = trim(fgets(STDIN));

if ($opcion == 's') {
    cambioDeContrasenia($login);
}

$login->cambiarContrasenia("Gauss");
$login->cambiarContrasenia("Euler");

cambioDeContrasenia($login);

/**
 * MODULO cambioDeContrasenia
 */
function cambioDeContrasenia($login)
{
    do {
        echo "Ingrese la nueva contrasenia: ";
        $nuevaContrasenia = trim(fgets(STDIN));
    } while (!$login->cambiarContrasenia($nuevaContrasenia));

    echo "Ingrese la nueva frase para ayudar a recordar la contrasenia: ";
    $nuevaFrase = trim(fgets(STDIN));
    $login->setFrase($nuevaFrase);
}
