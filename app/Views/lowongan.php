<section class="section">
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">LOWONGAN PT. MATCHA QIONG</h4>
                </div>

                <?php
      if (session()->get('level') == 1 || session()->get('level') == 2){
        ?>
                <button class="btn btn-primary m-3" id="btnTambahLowongan" onclick="loadTambahLowonganForm()">
                    <i class="fe fe-plus"></i> ADD LOWONGAN
                </button>
                <?php 
      } else {

      }
?>

                <!-- Lowongan Cards Container -->
                <div class="row px-3">
                    <?php
                    $no = 1;
                    foreach ($oke as $okei) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm bg-light-gray">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($okei->nama_lowongan) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($okei->deskripsi) ?></p>
                                <div class="d-flex justify-content-between">
                                <div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown<?= $okei->id_lowongan ?>" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="actionDropdown<?= $okei->id_lowongan ?>">
        <?php
        if (session()->get('level') == 1 || session()->get('level') == 2) {
        ?>
            <li>
                <a class="dropdown-item" href="#" onclick="loadEditLowonganForm(<?= $okei->id_lowongan ?>)">
                    <i class="fe fe-edit"></i> Edit
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="<?= base_url('home/hapus_lowongan/' . $okei->id_lowongan) ?>">
                    <i class="fe fe-trash"></i> Delete
                </a>
            </li>
        <?php 
        } else {
            // Tampilkan pesan atau kosongkan
            echo '<li><a class="dropdown-item disabled">Akses Terbatas</a></li>';
        }
        ?>
    </ul>
</div>

                                    <button class="btn btn-info btn-sm btn-delete" data-id="<?= $okei->id_lowongan ?>" data-bs-toggle="modal" data-bs-target="#lamaranModal" 
        onclick="document.getElementById('id_lowongan').value='<?= $okei->id_lowongan ?>'">
    <i class="fe fe-paper-plane"></i> Apply
</button>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FORM LAMARAN BOY!!!!!! -->

<div class="modal fade" id="lamaranModal" tabindex="-1" aria-labelledby="lamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lamaranModalLabel">Form Lamaran Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formLamaran" action="<?= base_url('home/aksi_t_lamaran') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_lowongan" id="id_lowongan"> <!-- ID for lowongan -->
                    
                    <div class="mb-3">
                        <label for="nama_pelamar" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_pelamar" name="nama_pelamar" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="umur" class="form-label">Umur</label>
                        <input type="number" class="form-control" id="umur" name="umur" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    
                    <div class="mb-3">
                        <label for="cv" class="form-label">Upload CV (PDF)</label>
                        <input type="file" class="form-control" id="cv" name="cv"  required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="surat" class="form-label">Upload Surat Lamaran (PDF)</label>
                        <input type="file" class="form-control" id="surat" name="surat"  required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<div id="dynamicContent"></div>
<style>
    .bg-light-gray {
        background-color: #f0f0f0 !important; /* Warna abu-abu muda */
    }

   
    
</style>


<script>


    // Function to load "Tambah Jurusan" form dynamically
    function loadTambahLowonganForm() {
        // Fetch and load the form for adding a new jurusan
        fetch('<?= base_url('home/t_lowongan') ?>') // Endpoint for adding siswa form
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToLowonganList()">
                        <i class="fe fe-arrow-left"></i> Back to lowongan List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form tambah lowongan.');
            });
    }

    // Function to load "Edit Jurusan" form dynamically
    function loadEditLowonganForm(id_lowongan) {
        // Fetch and load the edit form for the lowongan
        fetch('<?= base_url('home/e_lowongan') ?>/' + id_lowongan) // Endpoint for editing jurusan
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToLowonganList()">
                        <i class="fe fe-arrow-left"></i> Back to Lowongan List
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
    function backToLowonganList() {
        // Show the section again
        document.querySelector('.section').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }

    
</script>
