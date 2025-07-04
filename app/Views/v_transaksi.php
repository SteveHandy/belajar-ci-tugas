<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="accordion" id="accordionTransaksi">
    <?php if (empty($daftar_transaksi)) : ?>
        <div class="alert alert-info">Belum ada data transaksi.</div>
    <?php else : ?>
        <?php foreach ($daftar_transaksi as $index => $transaksi) : ?>
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="heading-<?= $transaksi['id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $transaksi['id'] ?>" aria-expanded="false" aria-controls="collapse-<?= $transaksi['id'] ?>">
                        <div class="d-flex justify-content-between w-100 pe-3">
                            <span><strong>ID Transaksi:</strong> <?= $transaksi['id'] ?></span>
                            <span><strong>Waktu Pembelian:</strong> <?= $transaksi['created_at'] ?></span>
                            <span><strong>Total:</strong> Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></span>
                        </div>
                    </button>
                </h2>
                <div id="collapse-<?= $transaksi['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $transaksi['id'] ?>" data-bs-parent="#accordionTransaksi">
                    <div class="accordion-body">
                        <h5>Detail Item:</h5>
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 10%;">Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Diskon</th>
                                    <th>Ongkir</th>
                                    <th>Subtotal</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi['detail_items'] as $item) : ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($item['gambar_produk'])) : ?>
                                                <img src="<?= base_url('img/' . $item['gambar_produk']) ?>" alt="<?= $item['nama_produk'] ?>" class="img-fluid">
                                            <?php else : ?>
                                                <small>No Image</small>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= $item['nama_produk'] ?></td>
                                        <td><?= $item['jumlah'] ?></td>
                                        <td>Rp <?= number_format($item['harga_produk'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($item['diskon'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($transaksi['ongkir'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($item['subtotal_harga'], 0, ',', '.') ?></td>
                                        <td><?= $transaksi['alamat'] ?></td>
                                        <td><?= ($transaksi['status'] == "1") ? "Sudah Selesai" : "Belum Selesai" ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>