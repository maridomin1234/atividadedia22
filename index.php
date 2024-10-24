<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Botões</title>
    <style>
        /* Estilos básicos para resetar margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo do menu */
        .menu {
            background-color: #333;
            text-align: center;
            padding: 10px 0;
        }

        /* Estilo dos links do menu */
        .menu ul {
            list-style: none;
        }

        .menu ul li {
            display: inline-block;
            margin-right: 20px;
        }

        .menu ul li:last-child {
            margin-right: 0;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            background-color: #444;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        /* Efeito ao passar o mouse */
        .menu a:hover {
            background-color: #555;
            color: #f1f1f1;
        }
    </style>
</head>
<body>

    <nav class="menu">
        <ul>
            <li><a href="funcionário.php">Funcionário</a></li> <!-- Redireciona para funcionario.php -->
            <li><a href="departamento.php">Departamento</a></li>
            <li><a href="projeto.php">Projetos</a></li>
            <li><a href="pecas.php">Peças</a></li>
            <li><a href="fornecedor.php">Fornecedor</a></li>
            <li><a href="deposito.php">Deposito</a><li>
        </ul>
    </nav>

</body>
</html>
