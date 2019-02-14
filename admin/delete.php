<?php
session_start();


include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article;




if (isset($_SESSION['logged_in'])) {
    //Logged in
    if (isset($_GET['id'])){
        $id=$_GET['id'];

        $query = $pdo->prepare("DELETE FROM articles WHERE id=?");
        $query->bindValue(1, $id);
        $query->execute();
        echo "Deleted";
        header("Location: delete.php");
    }

    $articles = $article -> fetch_all()

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
                        <a class="nav-link" href="#">Delete</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="content center">
            <form action="delete.php" method="GET">
                <h1>Delete article</h1>



                <select onchange="this.form.submit()" name="id" id="">
                    <option value="">Choose article to delete</option>
                    <?php foreach($articles as $article){ ?>
                    <option value="<?php echo $article['id']; ?>"><?php echo $article['title']; ?></option>
                    <?php } ?>
                </select>
            </form>


        </main>
    </div>

    </body>

    </html>
    <?php
} else {
    header('Location: index.php');
}

?>