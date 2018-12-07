<?php
include_once "DBConnector.php";
$obj = new DBConnector();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>Uzduotis</h1>
<?php
$result = $obj->getAllFines();
$obj->printAnyTable($result);
?>
<hr width="100%">
</body>
</html>