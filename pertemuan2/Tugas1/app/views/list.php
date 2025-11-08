<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
     <link rel ="stylesheet" href="style.css">
</head>
<body>
    <div class="contrainer">
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
                  <td><a href="index.php?id=<?= $user['id']; ?> class="btn-small">Detail</a></td>
            </tr>
            <?php endforeach;?>
       </tbody>
        </table>
    </div>
    
</body>
</html>