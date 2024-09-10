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
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Berkas</th>
                                            <th>Nama Berkas Enkripsi</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($berkas as $us) : ?>
                                            <?php
                                            $status = $us['status'];
                                            if ($status === "1") {
                                                $class = 'btn btn-warning';
                                                $displayText = 'Dekripsi File';
                                                $link = base_url("Pegawai/dekripsi/") . $us["id_file"];
                                            } else if ($status === "2") {
                                                $class = 'btn btn-success';
                                                $displayText  = "Sudah Didekripsi";
                                                $downloadLink = base_url("Pegawai/download/") . $us["id_file"];
                                            } else {
                                                $class = 'unknown-class';
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $i; ?>.</td>
                                                <td><?= $us['file_name_source']; ?></td>
                                                <td><?= $us['file_name_finish']; ?></td>
                                                <td><?= $us['tgl_upload']; ?></td>
                                                <td>
                                                <?php if ($status === "2") : ?>
                                                    <a href="<?= $downloadLink ?>" class="<?= $class ?>"><?= $displayText ?></a>
                                                <?php else : ?>
                                                    <a href="<?= $link ?>" class="<?= $class ?>"><?= $displayText ?></a>
                                                <?php endif; ?>
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