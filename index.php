<?php
include_once "DBConnector.php";
$obj = new DBConnector();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Baudu sarasas</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<div class="container">
    <h1>Baudu sarasas</h1>
    <table class="list">
        <tr>
            <th class="field">ID</th>
            <th class="field">Numeriai</th>
            <th class="field">Marke</th>
            <th class="field">Modelis</th>
            <th class="field">Pagaminimo metai</th>
            <th class="field">Leistinas greitis</th>
            <th class="field">Fiksuotas greitis</th>
            <th class="field">Bauda, EUR</th>
            <th class="field">Sumoketa</th>
            <th class="field" colspan="2">Veiksmas</th>
        </tr>
        <?php
        $result = $obj->getAllFines();
        $obj->printAnyTable($result);
        ?>
    </table>
    <form action="#" method="get">
        <table class="addCol">
            <tr>
                <th class="field">Numeriai</th>
                <th class="field">Marke</th>
                <th class="field">Modelis</th>
                <th class="field">Pagaminimo metai</th>
                <th class="field">Leistinas greitis</th>
                <th class="field">Fiksuotas greitis</th>
                <th class="field">Sumoketa</th>
            </tr>
            <tr>
                <td><input type="text" class="field" name="numberPlates"></td>
                <td><input type="text" class="field" name="carMake"></td>
                <td><input type="text" class="field" name="carModel"></td>
                <td><input type="text" class="field" name="carYear"></td>
                <td><input type="text" class="field" name="maxSpeed"></td>
                <td><input type="text" class="field" name="currentSpeed"></td>
                <td><input type="text" class="field" name="isPaid"></td>
                <td><input type="submit" name="add" value="Prideti"></td>
            </tr>
        </table>
    </form>

    <?php

    if (isset($_REQUEST["add"])) {
        if (isset($_REQUEST["numberPlates"])
            && isset($_REQUEST["carMake"])
            && isset($_REQUEST["carModel"])
            && isset($_REQUEST["carYear"])
            && isset($_REQUEST["maxSpeed"])
            && isset($_REQUEST["currentSpeed"])
            && isset($_REQUEST["isPaid"]))
        {
            $numberPlates = $_REQUEST["numberPlates"];
            $carMake = $_REQUEST["carMake"];
            $carModel = $_REQUEST["carModel"];
            $carYear = $_REQUEST["carYear"];
            $maxSpeed = $_REQUEST["maxSpeed"];
            $currentSpeed = $_REQUEST["currentSpeed"];
            $isPaid = $_REQUEST["isPaid"];

            $obj->addFine($numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $isPaid);
        }
    }

    if (isset($_REQUEST["delete"])) {
        $obj->deleteFine();
    }

    if (isset($_REQUEST["update"])) {
        $obj->updateFine();
    }

    ?>
</div>
</body>
</html>
