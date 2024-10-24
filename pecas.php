<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Peças</title>
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
        <h2>Cadastrar Peça</h2>

        <?php
        // Incluindo o arquivo de conexão
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebendo os dados do formulário
            $pecas_numero = $_POST['pecas_numero'];
            $pecas_peso = $_POST['pecas_peso'];
            $pecas_cor = $_POST['pecas_cor'];
            $tbl_fornecedor_for_numero = $_POST['tbl_fornecedor_for_numero'];

            // Verificar se o número da peça já existe
            $check_sql = "SELECT * FROM tbl_pecas WHERE pecas_numero = '$pecas_numero'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                // Se já existir, mostrar mensagem de erro
                echo "<div class='message'>Erro: O número da peça já existe.</div>";
            } else {
                // Se não existir, inserir os dados na tabela tbl_pecas
                $sql = "INSERT INTO tbl_pecas (pecas_numero, pecas_peso, pecas_cor, tbl_fornecedor_for_numero) 
                        VALUES ('$pecas_numero', '$pecas_peso', '$pecas_cor', '$tbl_fornecedor_for_numero')";

                // Executando a query e verificando se a inserção foi bem-sucedida
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='message' style='color: green;'>Peça cadastrada com sucesso!</div>";
                } else {
                    echo "<div class='message'>Erro ao cadastrar peça: " . $conn->error . "</div>";
                }
            }

            // Fechando a conexão com o banco de dados
            $conn->close();
        }
        ?>

        <form action="" method="POST">
            <label for="pecas_numero">Número da Peça:</label>
            <input type="number" id="pecas_numero" name="pecas_numero" required>

            <label for="pecas_peso">Peso da Peça:</label>
            <input type="number" id="pecas_peso" name="pecas_peso" required>

            <label for="pecas_cor">Cor da Peça:</label>
            <input type="text" id="pecas_cor" name="pecas_cor" required>

            <label for="tbl_fornecedor_for_numero">Número do Fornecedor:</label>
            <input type="number" id="tbl_fornecedor_for_numero" name="tbl_fornecedor_for_numero" required>

            <input type="submit" value="Cadastrar">
        </form>
    </div>

</body>
</html>
