<form method="POST">
    <label for="num1">Numero 1: </label>
    <input type="number" id="num1" name="num1">

    <select id="operacao" name="operacao">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
        <option value="!">!</option>
        <option value="^">^</option>
    </select>

    <label for="num2">Numero 2: </label>
    <input type="number" id="num2" name="num2">

    <input type="submit" value="Calcular">

    <input type="submit" name="salvar_memoria" value="Salvar na Memória">
    <input type="submit" name="recuperar_memoria" value="Recuperar Memória">
</form>

<form method="post">
    <input type="hidden" name="apagar_historico" value="">
    <input type="submit" value="Limpar historico">
</form>

<?php
session_start();

if (isset($_POST['apagar_historico'])) {
    unset($_SESSION['historico']);
}

echo "<br>";


if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operacao'])) {
    $num1 = doubleval($_POST['num1']);
    $num2 = doubleval($_POST['num2']);
    $operacao = $_POST['operacao'];


    switch ($operacao) {
        case '+':
            $resultado = $num1 + $num2;

            break;
        case '-':
            $resultado = $num1 - $num2;

            break;
        case '*':
            $resultado = $num1 * $num2;

            break;
        case '/':
            if ($num2 != 0) {
                $resultado = $num1 / $num2;

            } else {
                $resultado = "Divisão por zero não é permitida";

            }

            break;
        case '^':
            $resultado = pow($num1, $num2);

            break;
        case '!':
            $resultado = 1;

            while ($num1 > 1) {
                $resultado *= $num1;
                $num1--;
            }

            break;
    }
    
    
    if (isset($_POST['salvar_memoria'])) {
        // Salvar os valores na memória
        $_SESSION['memoria'] = array($num1, $operacao, $num2);
        echo "<br>Valores salvos na memória.";
    }
    
    echo "<br> $num1 $operacao $num2 = $resultado";
    
    if (isset($_POST['recuperar_memoria'])) {
        if (isset($_SESSION['memoria'])) {
            list($num1, $operacao, $num2) = $_SESSION['memoria'];
            echo "<br> $num1 $operacao $num2 = $resultado";
            unset($_SESSION['memoria']);

        } else {
            echo "<br>Nenhum valor na memória.";
        }
    }

    $historico = "$num1 $operacao $num2 = $resultado";
    $_SESSION['historico'][] = $historico;

    if (isset($_SESSION['historico'])) {
        echo "<h1>Histórico</h1>";
        foreach ($_SESSION['historico'] as $op) {
            echo $op . "<br>";
        }
    } else {
        echo "Nenhuma operação no histórico.";
        echo "<br>";
    }
} else {
    echo "Insira valores";
}


echo "<br>";

?>