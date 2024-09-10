<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pegawai</h1>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">

                            <h4>Data Pegawai</h4>


                        </div>
                        <div class="card-body">
                            <div style="margin-bottom:20px;">
                                <a href="<?= base_url() ?>Console/add_pegawai" class="btn btn-outline-dark"><i class="fas fa-plus"></i>Tambah</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Divisi</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pegawai as $us) : ?>
                                            <tr>
                                                <td><?= $i; ?>.</td>
                                                <td><?= $us['nama']; ?></td>
                                                <td><?= $us['username']; ?></td>
                                                <td style="
  display:inline-block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 13ch;"><?= $us['password']; ?></td>
                                                <td><?= $us['divisi']; ?></td>
                                                <td><?= $us['jabatan']; ?></td>
                                                <td><a href="<?= base_url('Console/edit_pegawai/') . $us['id']; ?>" class="btn btn-secondary">Edit</a>
                                                    <a href="<?= base_url('Console/delete_pegawai/') . $us['id']; ?>" class="btn btn-danger" onclick="return confirm_delete('Apakah anda yakin?')"></i>Hapus</a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

</div>
</div>
<script>
    function confirm_delete(question) {

        if (confirm(question)) {

            alert("Action to delete");

        } else {
            return false;
        }

    }
</script>