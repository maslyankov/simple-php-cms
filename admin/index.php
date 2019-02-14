<?php
session_start();


include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])){
    //Logged in
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="../assets/style.css">
        <title>
            Simple CMS - Admin
        </title>

    </head>

    <body>

    <div class="wrapper">
        <aside class="sidebar">
            <header></header>
            <div class="sidebar-content">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="add.php">Add</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="delete.php">Delete</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="content center">
            <br>
            <h1>Wellcome, <?php echo $_SESSION['username'] ?></h1>


        </main>
    </div>

    </body>

    </html>
    <?php
} else {
    // Ask for credentials
    if (isset($_POST['username'], $_POST['password']) ) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if (empty($username) or empty($password)){
            $error = 'All fields are required!';
        } else {
            $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");

            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query-> rowCount();

            if ($num == 1) {
                // ok
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header('Location : index.php');
            } else {

                echo $username;
                echo $password;
                // incorrect
                $error = 'Incorrect details!';
            }
        }
    }
?>

<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>
        Simple CMS - Admin
    </title>

</head>

<body>

<div class="">
    <main class="center clean">
        <form action="index.php" method="post">

            <?php if (isset($error)) { ?>
                <small class="error"><?php echo $error ?></small>
            <?php } ?>

            <input type="text" name="username" placeholder="Username" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <input type="submit" value="Login" />
        </form>


    </main>
</div>

</body>

</html>

<?php } ?>