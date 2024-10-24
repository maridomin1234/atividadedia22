<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Depósitos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        input[type="submit"]:hover {
            background-color: #218838;
        }
        
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Cadastrar Depósito</h2>

        <?php
        // Incluindo o arquivo de conexão
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebendo os dados do formulário
            $deposit_numero = $_POST['deposit_numero'];
            $deposit_endereco = $_POST['deposit_endereco'];
            $tbl_pecas_pecas_numero = $_POST['tbl_pecas_pecas_numero'];

            // Verificar se o número do depósito já existe
            $check_sql = "SELECT * FROM tbl_depositos WHERE deposit_numero = '$deposit_numero'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                // Se já existir, mostrar mensagem de erro
                echo "<div class='message'>Erro: O número do depósito já existe.</div>";
            } else {
                // Se não existir, inserir os dados na tabela tbl_depositos
                $sql = "INSERT INTO tbl_depositos (deposit_numero, deposit_endereco, tbl_pecas_pecas_numero) 
                        VALUES ('$deposit_numero', '$deposit_endereco', '$tbl_pecas_pecas_numero')";

                // Executando a query e verificando se a inserção foi bem-sucedida
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='message' style='color: green;'>Depósito cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='message'>Erro ao cadastrar depósito: " . $conn->error . "</div>";
                }
            }

            // Fechando a conexão com o banco de dados
            $conn->close();
        }
        ?>

        <form action="" method="POST">
            <label for="deposit_numero">Número do Depósito:</label>
            <input type="number" id="deposit_numero" name="deposit_numero" required>

            <label for="deposit_endereco">Endereço do Depósito:</label>
            <input type="text" id="deposit_endereco" name="deposit_endereco" required>

            <label for="tbl_pecas_pecas_numero">Número da Peça:</label>
            <input type="number" id="tbl_pecas_pecas_numero" name="tbl_pecas_pecas_numero" required>

            <input type="submit" value="Cadastrar">
        </form>
    </div>

</body>
</html>
