<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Projetos</title>
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
        
        input[type="text"], input[type="number"], input[type="text"] {
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
        <h2>Cadastrar Projeto</h2>

        <?php
        // Incluindo o arquivo de conexão
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebendo os dados do formulário
            $proj_numero = $_POST['proj_numero'];
            $proj_orcamento = $_POST['proj_orcamento'];
            $proj_funcionario_funci_numero = $_POST['proj_funcionario_funci_numero'];

            // Verificar se o número do projeto já existe
            $check_sql = "SELECT * FROM tbl_projeto WHERE proj_numero = '$proj_numero'";
            $result = $conn->query($check_sql);

            if ($result->num_rows > 0) {
                // Se já existir, mostrar mensagem de erro
                echo "<div class='message'>Erro: O número do projeto já existe.</div>";
            } else {
                // Se não existir, inserir os dados na tabela tbl_projeto
                $sql = "INSERT INTO tbl_projeto (proj_numero, proj_orcamento, proj_funcionario_funci_numero) 
                        VALUES ('$proj_numero', '$proj_orcamento', '$proj_funcionario_funci_numero')";

                // Executando a query e verificando se a inserção foi bem-sucedida
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='message' style='color: green;'>Projeto cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='message'>Erro ao cadastrar projeto: " . $conn->error . "</div>";
                }
            }

            // Fechando a conexão com o banco de dados
            $conn->close();
        }
        ?>

        <form action="" method="POST">
            <label for="proj_numero">Número do Projeto:</label>
            <input type="number" id="proj_numero" name="proj_numero" required>

            <label for="proj_orcamento">Orçamento do Projeto:</label>
            <input type="number" step="0.01" id="proj_orcamento" name="proj_orcamento" required>

            <label for="proj_funcionario_funci_numero">Número do Funcionário:</label>
            <input type="number" id="proj_funcionario_funci_numero" name="proj_funcionario_funci_numero" required>

            <input type="submit" value="Cadastrar">
        </form>
    </div>

</body>
</html>
