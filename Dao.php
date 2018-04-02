<?php
require_once 'KLogger.php';

class Dao {

  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_592a1c9406c6de3";
  private $user = "ba997243868c8b";
  private $pass = "6c9a1b9b";
  protected $logger;

  public function __construct () {
    $this->logger = new KLogger('/Users/bl4z3/Sites/newGarbo/log', KLogger::DEBUG);
  }

  private function getConnection () {
    try {
      $conn =
        new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
            $this->pass);
      $this->logger->logDebug("Established a database connection.");
      return $conn;
    } catch (Exception $e) {
      echo "connection failed: " . $e->getMessage();
      $this->logger->logFatal("The database connection failed.");
    }
  }

  public function getRiders () {
     $conn = $this->getConnection();
     $query = $conn->prepare("select * from riders;");
     $query->setFetchMode(PDO::FETCH_ASSOC);
     $query->execute();
     $results = $query->fetchAll();
     $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
     return $results;
  }

  public function saveRider ($name, $image) {
     $conn = $this->getConnection();
     $query = $conn->prepare("select count(id) from riders;");
     $query->setFetchMode(PDO::FETCH_ASSOC);
     $query->execute();
     $results = $query->fetchAll();
     $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
     $this->logger->logDebug(__FUNCTION__ . " " . print_r($results[0],1));
     $number = (int)($results[0]['count(id)']) + 1;
     $query = $conn->prepare("INSERT INTO riders (id, name, image) VALUES ($number, :name, :image);");
     $query->bindParam(':name', $name);
     $query->bindParam(':image', $image);
     $this->logger->logDebug(__FUNCTION__ . " name=[{$name}] id=[{$number}]");
     $query->execute();
  }

  public function deleterider ($id) {
     $conn = $this->getConnection();
     $query = $conn->prepare("DELETE FROM riders WHERE id = :id");
     $query->bindParam(':id', $id);
     $query->execute();
  }

}
