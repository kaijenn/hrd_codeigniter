<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Barang</h4>
                </div>
                <form action="<?= base_url('home/t_barang') ?>" method="get" class="my-2">
                    <button type="submit" class="btn btn-info">Tambah Barang</button>
                </form>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($oke as $key): ?>
                                <div class="col-md-4">
                                    <div class="card" style="width: 100%; height: 350px; background-color: #d3d3d3; border: 1px solid #ccc;">
                                        <!-- Gambar auto-adjust dengan mempertahankan aspek rasio -->
                                        <img src="<?= base_url('uploads/' . $key->foto_barang) ?>" 
                                             class="card-img-top" 
                                             alt="<?= htmlspecialchars($key->nama_barang) ?>" 
                                             style="width: 100%; height: auto; max-height: 180px; object-fit: contain;">
                                        <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                                            <h5 class="card-title text-truncate"><?= htmlspecialchars($key->nama_barang) ?></h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="card-text mb-0">
                                                    <?php
                                                    $harga = str_replace(['Rp.', '.'], '', $key->harga_barang);
                                                    $harga_angka = (float)$harga;
                                                    ?>
                                                    <strong>Harga:</strong> <?= number_format($harga_angka, 0, ',', '.') ?> <br>
                                                    <strong>Stok:</strong> <?= htmlspecialchars($key->stok_barang) ?>
                                                </p>
                                                <div class="d-flex flex-column align-items-end">
                                                    <!-- Form untuk Edit dan Hapus dengan Auto-Adjust -->
                                                    <form action="<?= base_url('home/edit_barang/' . $key->id_barang) ?>" method="get" class="mb-0" style="width: 100%; text-align: center; margin-bottom: 5px;">
                                                        <button type="submit" class="btn btn-secondary btn-sm w-100">Edit</button>
                                                    </form>
                                                    <form action="<?= base_url('home/hapus_barang/' . $key->id_barang) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus barang ini?')" class="mb-0" style="width: 100%; text-align: center;">
                                                        <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
