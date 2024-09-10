<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pengaduan</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Ajukan Pengaduan!</h4>
                    <h4 style="color: red;font-size:13px;">*Pengaduan ini dienkripsi menggunakan RSA</h4>
                  </div>
                 
                  <div class="card-body">
                    <form method="POST" action="<?=base_url('pegawai/pengaduan')?>">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" placeholder="Nama">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pengaduan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="pengaduan" name="pengaduan" value="<?= set_value('pengaduan'); ?>" placeholder="Tuliskan pengaduanmu!"></textarea>
                        <?= form_error('pengaduan', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>

                
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Ajukan</button>
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>
