<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Berkas Sidang</h1>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Data Berkas</h4>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom:20px;">
                                <a href="<?= base_url() ?>Console/add_berkas" class="btn btn-outline-dark"><i class="fas fa-plus"></i>Enkripsi File</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pengguna</th>
                                            <th>Nama Berkas</th>
                                            <th>Nama Berkas Enkripsi</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($berkas as $us) : ?>
                                            <?php
                      $status = $us['status'];
                      if ($status === "1") {
                        $class = 'badge badge-warning';
                        $displayText ='Terenkripsi';
                      } else if ($status === "2") {
                        $class = 'badge badge-success';
                        $displayText  ="Sudah Didekripsi";
                      } else {
                        $class = 'unknown-class';
                      }
                      ?>
                                            <tr>
                                                <td><?= $i; ?>.</td>
                                                <td><?= $us['username']; ?></td>
                                                <td><?= $us['file_name_source']; ?></td>
                                                <td><?= $us['file_name_finish']; ?></td>
                                                <td><?= $us['tgl_upload']; ?></td>
                                                <td><div class="<?= $class ?>" id="myDiv"><?= $displayText; ?></span></div></td>
                                                <td>
                                                    <a href="<?= base_url('Console/delete_berkas/') . $us['id_file']; ?>" class="btn btn-danger" onclick="return confirm_delete('Apakah anda yakin?')"></i>Hapus</a>
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