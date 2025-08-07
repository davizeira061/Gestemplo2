<?php
require_once(dirname(__FILE__).'/../src/utils.php');
$menu_pages = get_menu_pages();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIB Curitiba Clone</title>
    <style>
        /* Basic Responsive Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }
        /* Header and Navigation */
        .main-header {
            background: #fff;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        .main-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .main-nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .main-nav li {
            display: inline-block;
            margin-left: 20px;
        }
        .main-nav a {
            text-decoration: none;
            color: #555;
            font-weight: bold;
        }
        /* Basic mobile nav toggle - can be improved with JS */
        .nav-toggle { display: none; }
        @media (max-width: 768px) {
            .main-nav { display: none; }
            .nav-toggle { display: block; /* Should be a button */ }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="container">
        <a href="/pib-clone/" class="logo">Igreja Batista</a>
        <nav class="main-nav">
            <ul>
                <li><a href="/pib-clone/home">Home</a></li>
                <li><a href="/pib-clone/news">Notícias</a></li>
                <li><a href="/pib-clone/events">Eventos</a></li>
                <li><a href="/pib-clone/sermons">Sermões</a></li>
                <?php foreach($menu_pages as $page): ?>
                    <li><a href="/pib-clone/page/<?php echo htmlspecialchars($page['slug']); ?>"><?php echo htmlspecialchars($page['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <button class="nav-toggle">Menu</button>
    </div>
</header>

<main class="container">
