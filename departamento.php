<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Departamento</title>
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
            height: auto;
            padding-bottom: 20px;
        }
        
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
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
        
        input[type="submit"], .button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        input[type="submit"]:hover, .button:hover {
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
        }

        .button-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Cadastrar Departamento</h2>

        <?php
        // Incluindo o arquivo de conexão
        include 'conexao.php';

        // Processa a inserção de um novo departamento
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
            $dep_numero = $_POST['dep_numero'];
            $dep_setor = $_POST['dep_setor'];

            // Verifica se já existe um departamento com o mesmo número
            $checkSql = "SELECT * FROM tbl_departamento WHERE dep_numero = '$dep_numero'";
            $checkResult = $conn->query($checkSql);
            if ($checkResult->num_rows > 0) {
                echo "<div class='message'>Erro: Já existe um departamento com esse número.</div>";
            } else {
                // SQL para inserir os dados na tabela tbl_departamento
                $sql = "INSERT INTO tbl_departamento (dep_numero, dep_setor) 
                        VALUES ('$dep_numero', '$dep_setor')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='message' style='color: green;'>Departamento cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='message'>Erro ao cadastrar departamento: " . $conn->error . "</div>";
                }
            }
        }

        // Processa a exclusão de um departamento
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
            $dep_numero = $_GET['dep_numero'];

            // Verifica se existem funcionários associados ao departamento
            $checkSql = "SELECT * FROM tbl_funcionario WHERE funci_departamento_dep_numero = '$dep_numero'";
            $checkResult = $conn->query($checkSql);
            if ($checkResult->num_rows > 0) {
                echo "<div class='message'>Erro: Não é possível excluir o departamento, pois há funcionários associados a ele.</div>";
            } else {
                // SQL para deletar o departamento
                $sql = "DELETE FROM tbl_departamento WHERE dep_numero = '$dep_numero'";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='message' style='color: green;'>Departamento excluído com sucesso!</div>";
                } else {
                    echo "<div class='message'>Erro ao excluir departamento: " . $conn->error . "</div>";
                }
            }
        }

        // Processa a atualização de um departamento
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
            $dep_numero = $_POST['dep_numero'];
            $dep_setor = $_POST['dep_setor'];

            // SQL para atualizar os dados do departamento
            $sql = "UPDATE tbl_departamento SET dep_setor = '$dep_setor' WHERE dep_numero = '$dep_numero'";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='message' style='color: green;'>Departamento atualizado com sucesso!</div>";
            } else {
                echo "<div class='message'>Erro ao atualizar departamento: " . $conn->error . "</div>";
            }
        }

        // Fechando a conexão com o banco de dados
        $conn->close();

        // Reabrindo a conexão para buscar os departamentos
        include 'conexao.php';

        // Consultando os departamentos cadastrados
        $sql = "SELECT * FROM tbl_departamento";
        $result = $conn->query($sql);
        ?>

        <form action="" method="POST">
            <label for="dep_numero">Número do Departamento:</label>
            <input type="number" id="dep_numero" name="dep_numero" required>

            <label for="dep_setor">Setor do Departamento:</label>
            <input type="text" id="dep_setor" name="dep_setor" required>

            <input type="hidden" name="action" value="add">
            <input type="submit" value="Cadastrar">
        </form>

        <h2>Departamentos Cadastrados</h2>
        <table>
            <tr>
                <th>Número</th>
                <th>Setor</th>
                <th>Ações</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['dep_numero']; ?></td>
                        <td><?php echo $row['dep_setor']; ?></td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="dep_numero" value="<?php echo $row['dep_numero']; ?>">
                                <input type="hidden" name="dep_setor" value="<?php echo $row['dep_setor']; ?>">
                                <input type="hidden" name="action" value="update">
                                <input type="submit" class="button" value="Alterar">
                            </form>
                            <form action="" method="GET" style="display:inline;">
                                <input type="hidden" name="dep_numero" value="<?php echo $row['dep_numero']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="submit" class="button button-delete" value="Excluir">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhum departamento cadastrado.</td>
                </tr>
            <?php endif; ?>
        </table>

    </div>

</body>
</html>
