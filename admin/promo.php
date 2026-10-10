<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION["admin_login"]) || $_SESSION["admin_login"] !== true) {
    header("Location: login.php");
    exit;
}

$pesan = "";
$error = "";
$folderFoto = "../images/";

if (!is_dir($folderFoto)) {
    mkdir($folderFoto, 0777, true);
}

/* TAMBAH PROMO */
if (isset($_POST["tambah"])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"] ?? "");
    $harga = (int)($_POST["harga"] ?? 0);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST["deskripsi"] ?? "");
    $ketentuan = mysqli_real_escape_string($koneksi, $_POST["ketentuan"] ?? "");
    $foto = "";

    if ($nama === "" || $harga <= 0) {
        $error = "Nama promo dan harga wajib diisi.";
    } else {
        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
            $namaFile = $_FILES["foto"]["name"];
            $tmpFile = $_FILES["foto"]["tmp_name"];
            $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
            $allowed = ["jpg", "jpeg", "png", "webp"];

            if (in_array($ext, $allowed)) {
                $namaFoto = time() . "_" . preg_replace(
                    "/[^a-zA-Z0-9._-]/",
                    "_",
                    $namaFile
                );

                if (move_uploaded_file($tmpFile, $folderFoto . $namaFoto)) {
                    $foto = "images/" . $namaFoto;
                } else {
                    $error = "Foto gagal diupload.";
                }
            } else {
                $error = "Format foto harus JPG, JPEG, PNG, atau WEBP.";
            }
        }

        if ($error === "") {
            $sql = "INSERT INTO promo (nama, harga, foto, deskripsi, ketentuan)
                    VALUES ('$nama', $harga, '$foto', '$deskripsi', '$ketentuan')";

            if (mysqli_query($koneksi, $sql)) {
                $pesan = "Promo berhasil ditambahkan.";
            } else {
                $error = "Promo gagal ditambahkan: " . mysqli_error($koneksi);
            }
        }
    }
}

/* EDIT PROMO */
if (isset($_POST["edit"])) {
    $id = (int)($_POST["id"] ?? 0);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"] ?? "");
    $harga = (int)($_POST["harga"] ?? 0);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST["deskripsi"] ?? "");
    $ketentuan = mysqli_real_escape_string($koneksi, $_POST["ketentuan"] ?? "");

    if ($id <= 0 || $nama === "" || $harga <= 0) {
        $error = "Data promo tidak lengkap.";
    } else {
        $queryLama = mysqli_query(
            $koneksi,
            "SELECT * FROM promo WHERE id=$id LIMIT 1"
        );

        $promoLama = mysqli_fetch_assoc($queryLama);
        $foto = $promoLama["foto"] ?? "";

        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
            $namaFile = $_FILES["foto"]["name"];
            $tmpFile = $_FILES["foto"]["tmp_name"];
            $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
            $allowed = ["jpg", "jpeg", "png", "webp"];

            if (in_array($ext, $allowed)) {
                $fotoBaru = time() . "_" . preg_replace(
                    "/[^a-zA-Z0-9._-]/",
                    "_",
                    $namaFile
                );

                if (move_uploaded_file($tmpFile, $folderFoto . $fotoBaru)) {
                    if ($foto !== "" && file_exists("../" . $foto)) {
                        unlink("../" . $foto);
                    }

                    $foto = "images/" . $fotoBaru;
                } else {
                    $error = "Foto baru gagal diupload.";
                }
            } else {
                $error = "Format foto harus JPG, JPEG, PNG, atau WEBP.";
            }
        }

        if ($error === "") {
            $sql = "UPDATE promo SET
                    nama='$nama',
                    harga=$harga,
                    foto='$foto',
                    deskripsi='$deskripsi',
                    ketentuan='$ketentuan'
                    WHERE id=$id";

            if (mysqli_query($koneksi, $sql)) {
                $pesan = "Promo berhasil diperbarui.";
            } else {
                $error = "Promo gagal diperbarui: " . mysqli_error($koneksi);
            }
        }
    }
}

/* HAPUS PROMO */
if (isset($_GET["hapus"])) {
    $id = (int)$_GET["hapus"];

    $query = mysqli_query(
        $koneksi,
        "SELECT foto FROM promo WHERE id=$id LIMIT 1"
    );

    $data = mysqli_fetch_assoc($query);

    if ($data && !empty($data["foto"])) {
        $fileFoto = "../" . $data["foto"];

        if (file_exists($fileFoto)) {
            unlink($fileFoto);
        }
    }

    if (mysqli_query($koneksi, "DELETE FROM promo WHERE id=$id")) {
        header("Location: promo.php?status=hapus");
        exit;
    }

    $error = "Promo gagal dihapus.";
}

if (isset($_GET["status"]) && $_GET["status"] === "hapus") {
    $pesan = "Promo berhasil dihapus.";
}

$result = mysqli_query(
    $koneksi,
    "SELECT * FROM promo ORDER BY id DESC"
);

if (!$result) {
    die("Gagal mengambil data promo: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Promo - Rappokopi</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
        }

        * {
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        body {
            background: var(--cream);
            color: var(--brown);
        }

        .navbar {
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .navbar {
    background: #ffffff;
    border-bottom: 1px solid var(--border);
    padding: 12px 0;
}

.navbar-brand {
    color: var(--orange);
    font-size: 1.6rem;
    font-weight: 900;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
.btn-dashboard {
    color: #68717a;
    background: #ffffff;
    border: 1px solid #adb5bd;
    border-radius: 7px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}

.btn-dashboard:hover {
    background: #f5f5f5;
    color: #343a40;
}

.btn-logout {
    color: var(--orange);
    background: #ffffff;
    border: 1px solid var(--orange);
    border-radius: 7px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}

.btn-logout:hover {
    background: var(--orange);
    color: #ffffff;
}

.admin-name {
    color: var(--muted);
    font-size: 14px;
    font-weight: 500;
}

.admin-name strong {
    color: var(--brown);
    font-weight: 800;
}

.navbar-brand:hover {
    color: var(--orange-dark);
}

.navbar-brand img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

        .page-title {
            font-weight: 800;
        }

        .btn-orange {
            background: var(--orange);
            color: white;
            border: none;
            font-weight: 700;
        }

        .btn-orange:hover {
            background: var(--orange-dark);
            color: white;
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(53, 32, 22, 0.06);
        }

        .table th {
            background: #fff3e8;
            color: var(--brown);
        }

        .table td {
            vertical-align: middle;
        }

        .foto-promo {
            width: 90px;
            height: 65px;
            object-fit: cover;
            border-radius: 10px;
        }

        .foto-kosong {
            width: 90px;
            height: 65px;
            border-radius: 10px;
            background: #f1e8df;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--muted);
        }

        .modal-content {
            border: none;
            border-radius: 18px;
        }

        .modal-header {
            background: var(--orange);
            color: white;
            border-radius: 18px 18px 0 0;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid var(--border);
            padding: 11px 13px;
        }

        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(244, 81, 22, 0.12);
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

            <div class="d-flex align-items-center gap-3">

                <span class="admin-name d-none d-md-block">
                    Halo, <strong><?= htmlspecialchars($_SESSION["admin_username"]) ?></strong>
                </span>

                <a href="dashboard.php" class="btn-dashboard">
                    Dashboard
                </a>

                <a href="logout.php" class="btn-logout">
                    Logout
                </a>

            </div>

        </div>
    </div>
</nav>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">Kelola Promo</h2>
            <p class="text-muted mb-0">
                Tambah, edit, dan hapus promo Rappokopi.
            </p>
        </div>

        <button
            class="btn btn-orange px-4"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah"
        >
            + Tambah Promo
        </button>
    </div>

    <?php if ($pesan !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif; ?>

    <?php if ($error !== ""): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Promo</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Ketentuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>

                        <?php while ($promo = mysqli_fetch_assoc($result)): ?>
                            <tr>

                                <td><?= $no++ ?></td>

                                <td>
                                    <?php if (!empty($promo["foto"])): ?>
                                        <img
                                            src="../<?= htmlspecialchars($promo["foto"]) ?>"
                                            class="foto-promo"
                                            alt="<?= htmlspecialchars($promo["nama"]) ?>"
                                        >
                                    <?php else: ?>
                                        <div class="foto-kosong">
                                            Tidak ada
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= htmlspecialchars($promo["nama"]) ?>
                                    </strong>
                                </td>

                                <td>
                                    Rp<?= number_format($promo["harga"], 0, ",", ".") ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($promo["deskripsi"] ?: "-") ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($promo["ketentuan"] ?: "-") ?>
                                </td>

                                <td>
                                    <button
                                        class="btn btn-sm btn-warning mb-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit<?= $promo["id"] ?>"
                                    >
                                        Edit
                                    </button>

                                    <a
                                        href="promo.php?hapus=<?= $promo["id"] ?>"
                                        class="btn btn-sm btn-danger mb-1"
                                        onclick="return confirm('Yakin ingin menghapus promo ini?')"
                                    >
                                        Hapus
                                    </a>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Promo</h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>
            </div>

            <form method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Promo</label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Contoh: Promo Paket Hemat"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Promo</label>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            placeholder="25000"
                            min="1"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Promo</label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="3"
                            placeholder="Deskripsi promo..."
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ketentuan</label>

                        <textarea
                            name="ketentuan"
                            class="form-control"
                            rows="3"
                            placeholder="Contoh: Berlaku setiap hari..."
                        ></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        name="tambah"
                        class="btn btn-orange"
                    >
                        Simpan Promo
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<?php
$resultEdit = mysqli_query(
    $koneksi,
    "SELECT * FROM promo ORDER BY id DESC"
);
?>

<?php while ($promo = mysqli_fetch_assoc($resultEdit)): ?>

<!-- MODAL EDIT -->
<div
    class="modal fade"
    id="modalEdit<?= $promo["id"] ?>"
    tabindex="-1"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Promo</h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>
            </div>

            <form method="POST" enctype="multipart/form-data">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $promo["id"] ?>"
                >

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Promo</label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="<?= htmlspecialchars($promo["nama"]) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Promo</label>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            value="<?= $promo["harga"] ?>"
                            min="1"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >
                    </div>

                    <?php if (!empty($promo["foto"])): ?>
                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            <br>

                            <img
                                src="../<?= htmlspecialchars($promo["foto"]) ?>"
                                class="foto-promo"
                                alt="Foto promo"
                            >
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="3"
                        ><?= htmlspecialchars($promo["deskripsi"]) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ketentuan</label>

                        <textarea
                            name="ketentuan"
                            class="form-control"
                            rows="3"
                        ><?= htmlspecialchars($promo["ketentuan"]) ?></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        name="edit"
                        class="btn btn-orange"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<?php endwhile; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>