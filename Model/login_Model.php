<?php
include __DIR__ . "/../Config/Config.php";
class Login_model
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getDB();
    }
    public function login($email)
    {
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>