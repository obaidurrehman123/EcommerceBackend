<?php
class DbConnection
{ 
    private $connection;
    private $connected;
    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=Ecommerce', 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
        } catch (PDOException $e) {
            $this->connected = false;
        }
    }
    public function getConnectionStatus()
    {
        return $this->connected;
    }
    public function execute($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }
    public function getTableNames()
    {
        $query = "SHOW TABLES";
        $statement = $this->connection->query($query);
        $tableNames = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $tableNames;
    }

}
// $dbConnection = new DbConnection
// if ($dbConnection->getConnectionStatus()) {
//     echo 'Connection Established Successfully';
//     $tableNames = $dbConnection->getTableNames();
//     echo "Tables in the Ecommerce database: ";
//     foreach ($tableNames as $tableName) {
//         echo $tableName . "<br>";
//     }
// } else {
//     echo 'Connection not successful';
// }