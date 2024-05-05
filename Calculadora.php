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
    $nu1 = $_POST['num1'] ?? 0;
    $nu2 = $_POST['num2'] ?? 0;
    $operacao = $_POST['operacao'] ?? null;

    $num1 = doubleval($nu1);
    $num2 = doubleval($nu1);


    
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
            $resultado = $num1 / $num2;
            break;
        case '^':
            $resultado = pow($num1, $num2);
            break;
        case '!':
            $resultado = 1;
            while ($num1 > 1){
                $resultado *= $num1;
                $num1--;
            } 
            break;
    }

    function Salvar($n1, $n2, $op){
        $_POST['num1'] = $n1;
        $_POST['num2'] = $n2;
        $_POST['operacao'] = $op;
    }

    function Pegar(){
        global $num1, $num2, $operacao, $resultado;

        if($num1 !== null && $operacao){
            echo $num1 . $operacao . $num2 . " = " . $resultado;
            return;
        }
    }

    if(isset($_POST['salvar'])){
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operacao = $_POST['operacao'];

        Salvar($num1, $num2, $operacao);

    } else if(isset($_POST['pegar'])){
        Pegar();
    }
    

    echo "resultado: " . $resultado;
} 
else{
    echo "Insira valores validos";
}

?>