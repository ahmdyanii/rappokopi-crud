<?php
session_start();
include "../koneksi.php";

$error = "";

if (isset($_SESSION["admin_login"]) && $_SESSION["admin_login"] === true) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Username dan password wajib diisi.";
    } else {
        $sql = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($koneksi, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $admin = mysqli_fetch_assoc($result);

            if (md5($password) === $admin["password"]) {
                $_SESSION["admin_login"] = true;
                $_SESSION["admin_id"] = $admin["id"];
                $_SESSION["admin_username"] = $admin["username"];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Username atau password salah.";
            }
        } else {
            $error = "Username atau password salah.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Rappokopi</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: var(--cream);
            color: var(--brown);
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        }

        .login-box {
            width: 100%;
            max-width: 430px;
            background: var(--white);
            padding: 40px;
            border-radius: 22px;
            border: 1px solid var(--border);
            box-shadow: 0 15px 40px rgba(53, 32, 22, 0.12);
            position: relative;
            overflow: hidden;
        }

        .login-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--orange);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 95px;
            height: 95px;
            object-fit: contain;
            display: block;
            margin: 0 auto 12px;
        }

        .logo h2 {
            margin: 0;
            color: var(--orange);
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .logo p {
            margin-top: 7px;
            margin-bottom: 0;
            color: var(--muted);
            font-size: 14px;
            font-weight: 500;
        }

        .form-label {
            color: var(--brown);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            min-height: 48px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--brown);
            background: var(--white);
            font-size: 14px;
            transition: 0.25s;
        }

        .form-control:focus {
            border-color: var(--orange);
            background: var(--white);
            color: var(--brown);
            box-shadow: 0 0 0 0.2rem rgba(244, 81, 22, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #a99b92;
            font-size: 13px;
        }

        .btn-login {
            width: 100%;
            min-height: 50px;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            background: var(--orange);
            color: var(--white);
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.25s, transform 0.25s, box-shadow 0.25s;
        }

        .btn-login:hover {
            background: var(--orange-dark);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(244, 81, 22, 0.25);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .back-link {
            color: var(--orange);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .back-link:hover {
            color: var(--orange-dark);
            text-decoration: underline;
        }

        .alert-danger {
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #f1b5a2;
            background: #fff1ec;
            color: #a52f0b;
            font-size: 14px;
            font-weight: 500;
        }

        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .login-box {
                padding: 30px 25px;
                border-radius: 18px;
            }

            .logo img {
                width: 80px;
                height: 80px;
            }

            .logo h2 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="logo">
            <img src="../images/logo.png" alt="Logo Rappokopi">
            <h2>Rappokopi</h2>
            <p>Login Administrator</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" autocomplete="username" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" autocomplete="current-password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="text-center mt-4">
            <a href="../index.php" class="back-link">← Kembali ke Website</a>
        </div>
    </div>
</body>
</html>