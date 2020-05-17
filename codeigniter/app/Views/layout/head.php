<?php

use App\Models\Auth;

$auth = new Auth();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.4/rr-1.2.7/sc-2.0.2/datatables.min.css" />
    <title>Perpustakaan - <?= $title ?></title>
    <style>
        body,
        html {
            font-family: "Nunito", sans-serif;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <a class="navbar-brand" href="/">
            Perpustakaan
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link <?= isset($home_active) ? "active" : "" ?>" href="/">Home </a>
                </li>
                <?php

                // use App\Models\Auth;

                if (isset($user) && !empty($user)) : ?>

                    <?php

                    // $auth = new Auth();
                    if ($auth->getUserPriv($user["token"])->can_see_book) : ?>
                        <li class="nav-item <?= (isset($laravel_active)) ? "active" : "" ?>">
                            <a class="nav-link" href="/buku">Buku</a>
                        </li>
                    <?php endif ?>
                    <?php if ($auth->getUserPriv($user["token"])->can_see_user) : ?>
                        <li class="nav-item <?= (isset($user_active)) ? "active" : "" ?>">
                            <a class="nav-link" href="/user">User</a>
                        </li>
                    <?php endif ?>

                <?php endif ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($user) && empty($user)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/login">Login</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $user["nama"] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/auth/logout">Logout</a>
                        </div>
                        <!-- <a class="nav-link" href="#"></a> -->
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>