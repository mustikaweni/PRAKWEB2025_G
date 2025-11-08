<div class="container mt-4">
    <h3>Konfirmasi Hapus Menu</h3>

    <?php if (!isset($data['menu'])): ?>
        <p>Data menu tidak ditemukan.</p>
        <a href="<?= BASEURL; ?>/menu">Kembali</a>
        <?php return; ?>
    <?php endif; ?>

    <ul>
        <li><strong>ID:</strong> <?= htmlspecialchars($data['menu']['id']); ?></li>
        <li><strong>Nama:</strong> <?= htmlspecialchars($data['menu']['nama']); ?></li>
        <li><strong>Harga:</strong> Rp<?= number_format($data['menu']['harga']); ?></li>
        <li><strong>Kategori:</strong> <?= htmlspecialchars($data['menu']['kategori']); ?></li>
    </ul>

    <form action="<?= BASEURL; ?>/menu/hapus/<?= htmlspecialchars($data['menu']['id']); ?>" method="post">
        <p>Yakin ingin menghapus menu ini?</p>
        <button type="submit">Ya, hapus</button>
        <a href="<?= BASEURL; ?>/menu">Batal</a>
    </form>
</div>