
<?php


try {
    $pdo = new PDO('mysql:host=localhost;dbname=refiasa', 'root', '');
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
}


// Datos del nuevo usuario
$usuario = 'admin';
$password = password_hash('1234', PASSWORD_BCRYPT); // Encriptar la contraseña
$estado = 1; // Estado activo, por ejemplo
$name = 'Anderson';
$lastname = 'Romero';
$phone = '123456789';
$mail = 'andersonromeroloarte@gmail.com';
$document = '12345678';
$typedoc = '1';

try {
    // Preparar la sentencia SQL
    $stmt = $pdo->prepare('INSERT INTO user (username, password, status, name,lastname,phone,mail,document,type_doc) VALUES (:usuario, :password, :estado,:name,:lastname,:phone,:mail,:document,:typedoc)');
   
    // Vincular los parámetros
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':document', $document);
    $stmt->bindParam(':typedoc', $typedoc);
  
    // Ejecutar la sentencia
    $stmt->execute();
    
    echo "Nuevo usuario insertado correctamente";
} catch (PDOException $e) {
    echo 'Error al insertar el usuario: ' . $e->getMessage();
}

?>


