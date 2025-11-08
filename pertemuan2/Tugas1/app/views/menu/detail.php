<div class="container mt-5">
    <h3>Detail Menu</h3>
    <ul>
        <li>ID: <?= $data['menu']['id']; ?></li>
        <li>Nama: <?= $data['menu']['nama']; ?></li>
        <li>Harga: Rp<?= number_format($data['menu']['harga']); ?></li>
        <li>Kategori: <?= $data['menu']['kategori']; ?></li>
    </ul>
    <a href="<?= BASEURL; ?>/menu">Kembali</a>
</div>
