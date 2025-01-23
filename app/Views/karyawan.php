<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">KARYAWAN PT. MATCHA QIONG</h4>
                </div>

                <!-- Content area -->
                <div id="content">
                    <!-- Initial content (table of jurusan) -->
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Karyawan</th>
                                        <th>Bagian</th>
                                        <th>Gaji</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                        $no = 1;
                                        foreach ($oke as $okei) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= ($okei->nama_pelamar) ?></td>
                                            <td><?= ($okei->nama_lowongan) ?></td>
                                            <td><?= ($okei->gaji) ?></td>

                                            <td>
                                                <!-- Edit button -->
                                                <button class="btn btn-info btn-sm" data-id="<?= $okei->id_karyawan ?>" data-bs-toggle="modal" data-bs-target="#lamaranModal" 
    onclick="document.getElementById('id_karyawan').value='<?= $okei->id_karyawan ?>'">
    <i class="fe fe-paper-plane"></i> Edit
</button>
<a href="<?= base_url('home/hapus_user/'.$okei->id_karyawan) ?>">
    <button class="btn btn-secondary btn-sm">Delete</button>
</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="lamaranModal" tabindex="-1" aria-labelledby="lamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lamaranModalLabel">GAJI KARYAWAN PT. MATCHA QIONG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formLamaran" action="<?= base_url('home/aksi_e_karyawan') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_karyawan" id="id_karyawan"> <!-- ID for lowongan -->
                    
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <input type="text" class="form-control" id="gaji" name="gaji" required>
                    </div>
                    
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Kirim Gaji</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="dynamicContent"></div>

<script>
    // Function to load "Tambah Jurusan" form dynamically
    function loadTambahKaryawanForm() {
        // Fetch and load the form for adding a new jurusan
        fetch('<?= base_url('home/t_karyawan') ?>') // Endpoint for adding siswa form
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToKaryawanList()">
                        <i class="fe fe-arrow-left"></i> Back to Karyawan List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form tambah user.');
            });
    }

    // Function to load "Edit Jurusan" form dynamically
    function loadEditKaryawanForm(id_karyawan) {
        // Fetch and load the edit form for the karyawan
        fetch('<?= base_url('home/e_karyawan') ?>/' + id_karyawan) // Endpoint for editing jurusan
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToKaryawanList()">
                        <i class="fe fe-arrow-left"></i> Back to Karyawan List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form edit jurusan.');
            });
    }

    // Function to return to the jurusan list
    function backToKaryawanList() {
        // Show the section again
        document.querySelector('.section').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }
</script>
