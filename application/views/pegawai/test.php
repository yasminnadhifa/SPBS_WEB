<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Surat Perizinan</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Edit Surat Perizinan</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="" placeholder="Nama Pegawai">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tanggal Izin</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="" placeholder="Tanggal Izin">
                    </div>
                    <label class="col-sm-1 col-form-label" >Hingga</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="" placeholder="Tanggal Izin">
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Waktu Izin</label>
                      <div class="col-sm-4">
                        <input type="time" class="form-control" id="waktu_izin" name="waktu_izin" value="" placeholder="Waktu Izin">
                    </div>
                    <label class="col-sm-1 col-form-label" >Hingga</label>
                      <div class="col-sm-4">
                        <input type="time" class="form-control" id="waktu_izin" name="waktu_izin" value="" placeholder="Waktu Izin">
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Keterangan Sakit</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ket_sakit" name="ket_sakit" value="" placeholder="Keterangan Sakit">
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload Surat Sakit</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control custom-file-input" name="file" id="file" value="" placeholder="Upload Surat Sakit">
                        <div class="custom-file-label" for="customFile">
                    </div>
                    </div>
                    </div>
                
                    <a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>