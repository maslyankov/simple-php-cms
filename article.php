<?php
include_once('includes/connection.php');
include_once('includes/article.php');

$article=new Article;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $article->fetch_data($id);



    ?>


    <html>
    <head>
        <link rel="stylesheet" href="assets/style.css">
        <title>
            Simple CMS - <?php echo $data['title'] ?>
        </title>

    </head>

    <body>

    <div class="wrapper">
        <aside class="sidebar">
            <header></header>
            <div class="sidebar-content">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>

                </ul>
            </div>
        </aside>
        <main>
            <header></header>
            <div class="breadcrumbs">
                <a href="index.php">Home</a>
                <a href="index.php">Articles</a>
                <a href="article.php?id=<?php echo $id ?>"><?php echo $data['title'] ?></a>

            </div>

            <article>
                <h1><?php echo $data['title'] ?></h1>
                <span><?php echo date('l jS', $data['timestamp']) ?></span>
                <p>
                    <?php echo $data['content'] ?>
                </p>
            </article>
            </div>
        </main>
    </div>

    </body>

    </html>


    <?php
} else {
    header('Location: index.php');
    exit();
}

?>