<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION["admin_login"]) || $_SESSION["admin_login"] !== true) {
    header("Location: login.php");
    exit;
}

$jumlahMenu = 0;
$jumlahPromo = 0;

$resultMenu = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM menu");

if ($resultMenu) {
    $dataMenu = mysqli_fetch_assoc($resultMenu);
    $jumlahMenu = $dataMenu["total"];
}

$resultPromo = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM promo");

if ($resultPromo) {
    $dataPromo = mysqli_fetch_assoc($resultPromo);
    $jumlahPromo = $dataPromo["total"];
}

$username = $_SESSION["admin_username"] ?? "Admin";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Rappokopi</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --orange: #f45116;
            --orange-dark: #c53b09;
            --cream: #fffaf3;
            --brown: #352016;
            --muted: #75675f;
            --border: #eadfd5;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--brown);
            font-family: "Plus Jakarta Sans", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 12px 0;
        }

        .navbar-brand {
            color: var(--orange);
            font-size: 1.55rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .navbar-brand:hover {
            color: var(--orange-dark);
        }

        .navbar-brand img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .admin-name {
            color: var(--muted);
            font-size: 14px;
            font-weight: 500;
            margin-right: 16px;
        }

        .admin-name strong {
            color: var(--brown);
            font-weight: 700;
        }

        .btn-logout {
            background: var(--orange);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 9px 17px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: var(--orange-dark);
            color: var(--white);
            transform: translateY(-1px);
        }

        .dashboard {
            padding: 48px 0 40px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            margin: 0 0 9px;
            font-size: 31px;
            font-weight: 800;
            letter-spacing: -0.8px;
            color: var(--brown);
        }

        .welcome p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px 26px;
            height: 100%;
            box-shadow: 0 7px 22px rgba(53, 32, 22, 0.045);
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(53, 32, 22, 0.07);
        }

        .stat-title {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stat-number {
            color: var(--orange);
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
        }

        .menu-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 25px 26px;
            height: 100%;
            box-shadow: 0 7px 22px rgba(53, 32, 22, 0.045);
            transition: 0.2s;
        }

        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(53, 32, 22, 0.07);
        }

        .menu-card h3 {
            font-size: 20px;
            font-weight: 800;
            margin: 0 0 9px;
            color: var(--brown);
            letter-spacing: -0.3px;
        }

        .menu-card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin: 0 0 21px;
        }

        .btn-orange {
            display: inline-block;
            background: var(--orange);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 10px 17px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-orange:hover {
            background: var(--orange-dark);
            color: var(--white);
            transform: translateY(-1px);
        }

        .footer {
            margin-top: 36px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 576px) {
            .dashboard {
                padding: 32px 15px;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .welcome p {
                font-size: 14px;
            }

            .admin-name {
                display: none;
            }

            .navbar-brand {
                font-size: 1.35rem;
            }

            .navbar-brand img {
                width: 45px;
                height: 45px;
            }

            .stat-card,
            .menu-card {
                padding: 21px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100">

                    <a href="dashboard.php" class="navbar-brand">
                <img src="../images/logo.png" alt="Logo Rappokopi">
                RAPPOKOPI
            </a>

            <div class="d-flex align-items-center">
                <span class="admin-name">
                    Halo, <strong><?= htmlspecialchars($username) ?></strong>
                </span>

                <a href="logout.php" class="btn-logout">
                    Logout
                </a>
            </div>

        </div>
    </div>
</nav>

<main class="dashboard">
    <div class="container">

        <div class="welcome">
            <h1>Selamat Datang di Panel Rappokopi</h1>

            <p>
                Kelola menu dan promo Rappokopi dengan mudah dari satu tempat.
            </p>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-md-6">
                <div class="stat-card">

                    <div class="stat-title">
                        Menu Tersedia
                    </div>

                    <div class="stat-number">
                        <?= $jumlahMenu ?>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="stat-card">

                    <div class="stat-title">
                        Promo Tersedia
                    </div>

                    <div class="stat-number">
                        <?= $jumlahPromo ?>
                    </div>

                </div>
            </div>

        </div>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="menu-card">

                    <h3>Kelola Menu</h3>

                    <p>
                        Tambah, edit, dan hapus menu/promo Rappokopi.
                    </p>

                    <a href="menu.php" class="btn-orange">
                        Kelola Menu
                    </a>

                </div>
            </div>

            <div class="col-md-6">
                <div class="menu-card">

                    <h3>Kelola Promo</h3>

                    <p>
                        Tambah, edit, dan hapus menu/promo Rappokopi.
                    </p>

                    <a href="promo.php" class="btn-orange">
                        Kelola Promo
                    </a>

                </div>
            </div>

        </div>

        <div class="footer">
            © <?= date("Y") ?> Rappokopi — Panel Pengelola
        </div>

    </div>
</main>

</body>
</html>