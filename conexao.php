<?php
// Informações da conexão
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_industria';

// Conectar ao banco de dados
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificar a conexão
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

echo "Conexão bem-sucedida!";
?>
