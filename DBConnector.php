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
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td><input type='text' class='field' value='$value'></td>";
                }
                echo "<td><input type='submit' class='field' name='delete' value='Trinti'></td>";
                echo "<td><input type='submit' class='field' name='update' value='Saugoti'></td>";
                echo "</tr>";
            }
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
    public function getFineByPlates()
    {
        $query = "SELECT * FROM `sarasas` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // CRUD Create
    public function addFine($numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $isPaid)
    {
        $fineSize = ($currentSpeed - $maxSpeed)*2.3;

        $query = "INSERT INTO `sarasas` (`id`, `numberPlates`, `carMake`, `carModel`, `carYear`, `maxSpeed`, `currentSpeed`, `fineSize`, `isPaid`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issiiidi", $numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSize, $isPaid);
        $stmt->execute();
    }

    // CRUD Delete
    public function deleteFine($id)
    {
        $query = "DELETE FROM `sarasas` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    // CRUD update
    public function updateFine($id, $numberPlates, $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSize, $isPaid)
    {
        $query = "UPDATE `sarasas` SET `carMake` = ?,`carModel` = ?,`carYear` = ?,`maxSpeed` = ?,`currentSpeed` = ?,`fineSize` = ?,`isPaid` = ? WHERE `id` = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiiidii", $carMake, $carModel, $carYear, $maxSpeed, $currentSpeed, $fineSize, $isPaid, $id);
        $stmt->execute();
    }
}