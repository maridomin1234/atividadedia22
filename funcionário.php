<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }
        
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Aumentado para acomodar a tabela */
            text-align: center; /* Centralizado */
        }
        
        h2 {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .button-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .button-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Cadastrar Funcionário</h2>

        <?php
        // Incluindo o arquivo de conexão
        include 'conexao.php';

        // Processa a inserção de um novo funcionário
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
            $funci_numero = $_POST['funci_numero'];
            $funci_salario = $_POST['funci_salario'];
            $funci_telefone = $_POST['funci_telefone'];
            $funci_departamento = $_POST['funci_departamento'];

            // SQL para inserir os dados na tabela
            $sql = "INSERT INTO tbl_funcionario (funci_numero, funci_salario, funci_telefone, funci_departamento_dep_numero)
                    VALUES ('$funci_numero', '$funci_salario', '$funci_telefone', '$funci_departamento')";

            // Executando a query e verificando se a inserção foi bem-sucedida
            if ($conn->query($sql) === TRUE) {
                echo "<div class='message' style='color: green;'>Funcionário cadastrado com sucesso!</div>";
            } else {
                echo "<div class='message'>Erro ao cadastrar funcionário: " . $conn->error . "</div>";
            }
        }

        // Processa a exclusão de um funcionário
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
            $funci_numero = $_GET['funci_numero'];

            // Primeiro, exclua os registros da tabela tbl_controle que referenciam tbl_funcionario
            $deleteControleSql = "DELETE FROM tbl_controle WHERE tbl_projeto_tbl_funcionario_funci_numero='$funci_numero'";
            $conn->query($deleteControleSql); // Ignorar erro, se não houver dependência

            // Agora, exclua o funcionário
            $sql = "DELETE FROM tbl_funcionario WHERE funci_numero='$funci_numero'";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='message' style='color: green;'>Funcionário excluído com sucesso!</div>";
            } else {
                echo "<div class='message'>Erro ao excluir funcionário: " . $conn->error . "</div>";
            }
        }

        // Processa a atualização de um funcionário
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
            $funci_numero = $_POST['funci_numero'];
            $funci_salario = $_POST['funci_salario'];
            $funci_telefone = $_POST['funci_telefone'];
            $funci_departamento = $_POST['funci_departamento'];

            // SQL para atualizar os dados do funcionário
            $sql = "UPDATE tbl_funcionario SET 
                        funci_salario='$funci_salario', 
                        funci_telefone='$funci_telefone', 
                        funci_departamento_dep_numero='$funci_departamento' 
                    WHERE funci_numero='$funci_numero'";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='message' style='color: green;'>Funcionário atualizado com sucesso!</div>";
            } else {
                echo "<div class='message'>Erro ao atualizar funcionário: " . $conn->error . "</div>";
            }
        }

        // Reabrindo a conexão para buscar os funcionários
        $conn->close();
        include 'conexao.php';

        // Consultando os funcionários cadastrados
        $sql = "SELECT * FROM tbl_funcionario";
        $result = $conn->query($sql);
        ?>

        <form action="" method="POST">
            <label for="funci_numero">Número do Funcionário:</label>
            <input type="number" id="funci_numero" name="funci_numero" required>

            <label for="funci_salario">Salário:</label>
            <input type="number" id="funci_salario" name="funci_salario" required>

            <label for="funci_telefone">Telefone:</label>
            <input type="text" id="funci_telefone" name="funci_telefone" required>

            <label for="funci_departamento">Departamento (Número):</label>
            <input type="number" id="funci_departamento" name="funci_departamento" required>

            <input type="hidden" name="action" value="add">
            <input type="submit" value="Cadastrar">
        </form>

        <h2>Funcionários Cadastrados</h2>
        <table>
            <tr>
                <th>Número</th>
                <th>Salário</th>
                <th>Telefone</th>
                <th>Departamento</th>
                <th>Ações</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['funci_numero']; ?></td>
                        <td><?php echo $row['funci_salario']; ?></td>
                        <td><?php echo $row['funci_telefone']; ?></td>
                        <td><?php echo $row['funci_departamento_dep_numero']; ?></td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="funci_numero" value="<?php echo $row['funci_numero']; ?>">
                                <input type="hidden" name="funci_salario" value="<?php echo $row['funci_salario']; ?>">
                                <input type="hidden" name="funci_telefone" value="<?php echo $row['funci_telefone']; ?>">
                                <input type="hidden" name="funci_departamento" value="<?php echo $row['funci_departamento_dep_numero']; ?>">
                                <input type="hidden" name="action" value="update">
                                <input type="submit" value="Alterar">
                            </form>
                            <form action="" method="GET" style="display:inline;">
                                <input type="hidden" name="funci_numero" value="<?php echo $row['funci_numero']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="button-delete">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum funcionário cadastrado.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
