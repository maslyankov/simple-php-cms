<?php
    include_once('includes/connection.php');
    include_once('includes/article.php');

    $article = new Article;
    $articles = $article->fetch_all();

?>

<html>
    <head>
        <link rel="stylesheet" href="assets/style.css">
        <title>
            Simple CMS
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

                    <li class="nav-item">
                        <a class="nav-link" href="admin">Admin</a>
                    </li>
                </ul>
            </div>
        </aside>
        <main>
            <header></header>
            <div class="breadcrumbs">
                <a href="index.php">Home</a>
                <a href="index.php">Articles</a>
            </div>

            <div class="articles">
                <?php foreach ($articles as $article) { ?>
                <article>
                    <a href="article.php?id=<?php echo $article['id'] ?>"><h1><?php echo $article['title'] ?></h1></a>
                    <span><?php echo date('l jS', $article['timestamp']) ?></span>
                    <p>
                        <?php echo $article['content'] ?>
                    </p>
                </article>
                <?php } ?>
            </div>
        </main>
    </div>

    </body>

</html>