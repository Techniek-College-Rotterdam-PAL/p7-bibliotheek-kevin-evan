<?php
session_start();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
class Database
{   
    private $connection;
    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=evke_books;";
        $username = "root";
        $password = "";
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }
    public function query($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            exit();
        }
    }
}
class Signup extends Database
{
    // #1
    public function __construct()
    {
        parent::__construct(); // Call the parent class constructor
    }
    // #2 
    public function checkEmailExists($email)
    {
        $sql = "SELECT COUNT(*) AS AANTAL FROM account WHERE email = :email";
        $result = $this->query($sql, [':email' => $email]);
        return $result[0]['AANTAL'];
    }
    // #3
    public function registerUser($name, $surname, $email, $password)
    {
        // Check if the email ends with "@tcrmbo.nl" or "@student.zadkine.nl"
        if (!preg_match('/(@tcrmbo\.nl$)|(@student\.zadkine\.nl$)/', $email)) {
            header("location: retry_register.php");
            exit();
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
            
            // Set the default role ID
            $role_idrole = 2; // Default ID for student
        
            // Check if the email is from tcrmbo.nl domain and set role ID accordingly
            if (preg_match('/@tcrmbo\.nl$/', $email)) {
                // Set ID for tcrmbo.nl users
                $role_idrole = 1; 
            }
        
            $sql = "INSERT INTO account(name, surname, email, password, role_idrole) VALUES(:name, :surname, :email, :password, :role_idrole)";
            $params = [
                ':name' => $name,
                ':surname' => $surname,
                ':email' => $email,
                ':password' => $hashed_password,
                ':role_idrole' => $role_idrole // $_SESSION RoleId start
            ];
            $this->query($sql, $params);
        }
    }
    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@tcrmbo\.nl$/', $email);
    }
}

// Retrieve data from POST request
$name = strip_tags($_POST["name"]);
$surname = strip_tags($_POST["surname"]);
$email = strip_tags($_POST["email"]);
$password = strip_tags($_POST["password"]);

// Create instance of Signup class
$signup = new Signup();

// Check if email already exists
$aantal = $signup->checkEmailExists($email);
if ($aantal == 1) {
    header("location: retry_register.php");
    exit();
} else {
    // Register user
    $signup->registerUser($name, $surname, $email, $password);
    $_SESSION["name"] = $name;
    $_SESSION["surname"] = $surname;
    $_SESSION["email"] = $email;
    header("Location: logged_in_user.php");
    exit();
}
?>