<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pegawai</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Tambah Pegawai</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" placeholder="Nama">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>" placeholder="Password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Divisi</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="divisi" name="divisi" value="<?= set_value('divisi'); ?>" placeholder="Divisi">
                        <?= form_error('divisi', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jabatan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= set_value('jabatan'); ?>" placeholder="Jabatan">
                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>  
                    </div>
                    </div>

                    
                    <a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Kembali</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah</button>
  
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>
