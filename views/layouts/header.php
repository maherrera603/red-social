<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=URL."assets/css/style.css"?>">
    <title>Social Red</title>
</head>
<body>

    <?php if(isset($_SESSION["user"])): ?>
    <header>
        <div class="header">
            <a href="<?=URL."home/index"?>">
                <h1><i class="fa-solid fa-paper-plane"></i> Social Red</h1>
            </a>
            <nav>
                <ul>
                    <li><a href="<?=URL."user/logout"?>">Salir</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php endif; ?>
    <main>