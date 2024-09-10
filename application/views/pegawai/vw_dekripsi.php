<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Berkas</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Dekripsi Berkas Sidang</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="<?=base_url('pegawai/decryptFile')?>"  enctype="multipart/form-data">
                    <input type="hidden" name="id_file" value="<?= $berkas['id_file']; ?>">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama File Sumber</label>
                      <div class="col-sm-9">
                        <label for=""><?= $berkas['file_name_source']; ?></label>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama File Enkripsi</label>
                      <div class="col-sm-9">
                        <label for=""><?= $berkas['file_name_finish']; ?></label>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ukuran File</label>
                      <div class="col-sm-9">
                        <label for=""><?= $berkas['file_size']; ?></label>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tanggal Enkripsi</label>
                      <div class="col-sm-9">
                        <label for=""><?= $berkas['tgl_upload']; ?></label>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Keterangan</label>
                      <div class="col-sm-9">
                        <label for=""><?= $berkas['keterangan']; ?></label>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Password Enkripsi</label>
                      <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>" placeholder="Password">
                    </div>
                    </div>
                    
                    <a href="<?= base_url('Pegawai/berkas') ?>" class="btn btn-light">Kembali</a>
                        <button type="submit" name="decrypt_now" class="btn btn-primary float-right">Dekripsi</button>
  
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>
