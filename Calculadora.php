<form action="" method="POST">
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
    <button type="submit" name="salvar">Salvar </button>
    <button type="submit" name="pegar">Pegar </button>
</form>

<form action="" method="post">
    <input type="hidden" name="apagar_historico" value="1">
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
        case '^':
            $resultado = pow($num1, $num2);
            echo $num1 . $operacao . $num2 . " = " . $resultado;

            break;
        case '!':
            $resultado = 1;
            while ($num1 > 1) {
                $resultado *= $num1;
                $num1--;
            }
            break;
    }

    $historico = "$num1 $operacao $num2 = $resultado";
    $_SESSION['historico'][] = $historico;

    if (isset($_SESSION['historico'])) {
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