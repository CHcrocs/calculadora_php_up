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

    <input type="submit" value="Salvar" name="salvar">
    <input type="submit" value="Pegar" name="pegar">

</form>

<?php
session_start();
if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operacao'])) {
    $num1 = $_POST['num1'] ?? 0;
    $num2 = $_POST['num2'] ?? 0;
    $operacao = $_POST['operacao'];

    switch ($operacao) {
        case '+':
            $resultado = $num1 + $num2;
            echo $num1 . $operacao . $num2 . " = " . $resultado;
            break;
        case '-':
            $resultado = $num1 - $num2;
            echo $num1 . $operacao . $num2 . " = " . $resultado;
            break;
        case '*':
            $resultado = $num1 * $num2;
            echo $num1 . $operacao . $num2 . " = " . $resultado;
            break;
        case '/':
            $resultado = $num1 / $num2;
            echo $num1 . $operacao . $num2 . " = " . $resultado;

            break;
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
            echo $num1 . $operacao . " = " . $resultado;

            break;
    }
} else {
    echo "Insira valores validos";
}

?>