<?php
$host ="localhost";
$dbname="mydb";
$username= "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PRODException $e){
    die("Koneksi gagal:". $e->getMessage());
}

function getAllUsers($pdo) {
    $stmt =$pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->feltchALL(PDO::FETCH_ASSOC);
}
 if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user = getUserByld($pdo, $_GET['id']);
    $show_detail = true;
 } else {
    $users = getallheaders($pdo);
    $show_detail = false;
 }
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$show_detail ? 'Profil Pengguna' : 'Daftar Pengguna' ?> </title>
    <link rel="stylesheet" href="style.css">
 </head>
 <body>
    <div class="contrainer">
        <?php if ($show_detail): ?>
        <!-- Tampilkan detail pengguna --->
        <h1>Selamat Datang, <?= htmlspecialchars($user['name']); ?></h1>
        <p>Email: <?=htmlspecialchars($user['email']); ?></p>
        <a href="TnpaMVC.php" class="btn">Kembali ke Daftar</a>
    <?php else:?>
        <!--Tampilkan daftar Pengguna-->
        <h1>Daftar Pengguna</h1>
        <table class="user table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </body>

        <?php foreach ($user as $user):?>
            <tr>
                <td><?=htmlspecialchars($user['name']); ?></td>
                  <td><?=htmlspecialchars($user['email']); ?></td>
                  <td><a href="index.php?id=<?= $user['id']; ?>" class="btn-small">Detail</a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
        </table>
        <?php endif;?>
    
 </body>
 </html>
 




























