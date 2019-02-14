<?php
session_start();


include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])){
    //Logged in
    if(isset($_POST['title'], $_POST['content'])){
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

        if (empty($title) or empty($content)){
            $error = "All fields required!";
        } else {
            $query = $pdo->prepare("INSERT INTO articles (title, content, timestamp) VALUES (?, ?, ?)");
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());

            $query->execute();

            header("Location: index.php");
        }
    }


    ?>
    <html>
    <head>
        <link rel="stylesheet" href="../assets/style.css">
        <title>
            Simple CMS - Admin - Add article
        </title>

    </head>

    <body>

    <div class="wrapper">
        <aside class="sidebar">
            <header></header>
            <div class="sidebar-content">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Add</a>
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
            <form action="add.php" method="post">
                <h1>Add article</h1>

                <?php if (isset($error)) { ?>
                    <small class="error"><?php echo $error ?></small>
                <?php } ?>

                <input type="text" name="title" placeholder="Title" required/>
                <textarea name="content" placeholder="Enter text here..." required></textarea>
                <input type="submit" value="Sumbit" />
            </form>


        </main>
    </div>

    </body>

    </html>
    <?php
} else {
    header('Location: index.php');
}