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
                    <h4>Enkripsi Berkas Sidang</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="<?=base_url('Console/encryptFile')?>"  enctype="multipart/form-data">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">File</label>
                      <div class="col-sm-9">
                      <div class="custom-file" >
                          <input type="file" class="form-control custom-file-input" name="file" id="file">
                          <label class="custom-file-label" for="customFile">Pilih Berkas</label>
                    </div>
                        <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kunci</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>" placeholder="Kunci">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Keterangan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= set_value('keterangan'); ?>" placeholder="Keterangan">
                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>

                    
                    <a href="<?= base_url('Console/berkas') ?>" class="btn btn-light">Kembali</a>
                        <button type="submit" name="encrypt_now" class="btn btn-primary float-right">Tambah</button>
  
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>
