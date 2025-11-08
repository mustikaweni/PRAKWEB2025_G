<div class="container mt-5">
    <h3>Daftar Menu Makanan</h3>
    <a href="<?= BASEURL; ?>/menu/tambahform" class="btn btn-success mb-3">Tambah Menu</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data['menu'] as $menu) : ?>
        <tr>
            <td><?= $menu['id']; ?></td>
            <td><?= $menu['nama']; ?></td>
            <td>Rp<?= number_format($menu['harga']); ?></td>
            <td><?= $menu['kategori']; ?></td>
            <td>
                <a href="<?= BASEURL; ?>/menu/detail/<?= $menu['id']; ?>">Detail</a> |
                <a href="<?= BASEURL; ?>/menu/edit/<?= $menu['id']; ?>">Edit</a> |
                <a href="<?= BASEURL; ?>/menu/hapus/<?= $menu['id']; ?>" onclick="return confirm('Hapus data?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h4 class="mt-4">Tambah Menu Baru</h4>
    <form action="<?= BASEURL; ?>/menu/tambah" method="post">
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="number" name="harga" placeholder="Harga" required><br>
        <input type="text" name="kategori" placeholder="Kategori" required><br>
        <button type="submit">Tambah</button>
    </form>
</div>
