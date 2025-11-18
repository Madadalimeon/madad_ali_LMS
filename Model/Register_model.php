<?php
include __DIR__ . "/../Config/Config.php";
class Register_model
{
    private $conn;
    private $Name;
    private $Email;
    private $Password;
    private $Role;
    private $Delete_id;
    public function __construct($Name = null, $Email = null, $Password = null, $Role = null)
    {
        $database = new Database();
        $this->conn = $database->getDB();
        $this->Name = $Name;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Role = $Role;
    }
    public function Register()
    {
        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "ssss",
            $this->Name,
            $this->Email,
            $this->Password,
            $this->Role
        );
        return $stmt->execute();
    }
    public function Delete_Register($Delete_id)
    {
        $this->Delete_id = $Delete_id;
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->Delete_id);
        return $stmt->execute();
    }
    public function Update_Register($Update_name, $Update_email, $Update_password, $Update_role, $update_id)
    {
        $query = "UPDATE users SET name = ?, email = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi",$Update_name, $Update_email, $Update_password, $Update_role,$update_id);
        return $stmt->execute();
    }
}
