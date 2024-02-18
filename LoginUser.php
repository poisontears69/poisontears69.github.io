<?php
class Database {
    private $db;

    public function __construct() {
        $this->connect(); // Calls the connect method when a Database object is created
    }

    private function connect() {
        $this->db = new mysqli("localhost", "root", "", "lecturex"); // Establishes a new MySQLi connection with localhost, root username, empty password, and "user" database

        if($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error); // If connection fails, it terminates the script and displays an error message
        }
    }

    public function query($sql, $params = array()) {
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }
        
        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        return $stmt->get_result();
    }

    public function close() {
        if ($this->db) {
            $this->db->close(); // Closes the database connection
        }
    }
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Create a new instance of Database
    $db = new Database();
    
    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE username = ?";
    
    // Prepare statement
    $stmt = $db->query($sql, array($username));
    
    // Bind parameters
    $stmt->bind_param("s", $username);
    
    // Execute statement
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Check if user exists
    if ($result->num_rows > 0) {
        // User exists, fetch the row
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Successful login
            echo "<h2>Welcome, $username!</h2>";
        } else {
            // Invalid password
            echo "<h2>Invalid username or password!</h2>";
        }
    } else {
        // User does not exist
        echo "<h2>Invalid username or password!</h2>";
    }
    
    // Close statement
    $stmt->close();
    
    // Close database connection
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="GlobalCss.css">
    <link rel="stylesheet" href="LoginCss.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>