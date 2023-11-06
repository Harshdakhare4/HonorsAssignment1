<?php
 $pdo = new PDO(
    'mysql:host=127.0.0.1;dbname=forms',
     'root',
        '' );// PHP Database Object
       

        $name=$_POST['name'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $city=$_POST['city'];


        if (empty($name) || empty($email) || empty($gender) || empty($city)) {
            echo "Please fill out all fields.";
        } else {
            $statement = $pdo->prepare("INSERT INTO form (name, email, gender, city) VALUES (?, ?, ?, ?)");
            $statement->execute([$name, $email, $gender, $city]);
            echo "User information saved successfully!";
            $statement = $pdo->query("SELECT * FROM form");
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        }
?>

<html>
<head>
    <title>User List</title>
</head>
<body>
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>City</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['gender']; ?></td>
                <td><?php echo $user['city']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>