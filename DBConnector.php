<?php

class DBConnector
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "baudos";
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function printAnyTable($result)
    {
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    // CRUD Read all
    public function getAllFines()
    {
        $query = "SELECT * FROM `sarasas`;";
        return $this->conn->query($query);
    }

    // CRUD Read 1
    public function getFineByPlates($numberPlates)
    {
        $query = "SELECT * FROM `sarasas` WHERE `numberPlates` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $numberPlates);
        $stmt->execute();
        return $stmt->get_result();
    }

    // CRUD Create
    public function addFine($numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSie, $isPaid)
    {
        $query = "INSERT INTO `sarasas` (`numberPlates`, `carMake`, `carModel`, `carYear`, `maxSpeed`, `currentSpeed`, `fineSize`, `isPaid`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssiiidi", $numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSie, $isPaid);
        $stmt->execute();
    }

    // CRUD Delete
    public function deleteFine($numberPlates)
    {
        $query = "DELETE FROM `sarasas` WHERE `numberPlates` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $numberPlates);
        $stmt->execute();
    }

    // CRUD update
    public function updateFine($numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSize, $isPaid)
    {
        $query = "UPDATE `sarasas` SET `carMake` = ?,`carModel` = ?,`carYear` = ?,`maxSpeed` = ?,`currentSpeed` = ?,`fineSize` = ?,`isPaid` = ? WHERE `numberPlates` = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiiidis", $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSize, $isPaid, $numberPlates);
        $stmt->execute();
    }

    public function getUzduotis1()
    {
        $query = "SELECT * FROM `students` ORDER BY `name` ASC;";
        return $this->conn->query($query);
    }
}