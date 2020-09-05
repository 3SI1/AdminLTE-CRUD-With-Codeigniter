<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-briefcase"></i> List Mahasiswa (Jurusan: <b><?php echo $jurusan->nama; ?></b>)</h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Asal kota</th>
            <th>Jenis Kelamin</th>
          </tr>
        </thead>
        <tbody id="data-mahasiswa">
          <?php
            foreach ($dataJurusan as $mahasiswa) {
              ?>
              <tr>
                <td style="min-width:230px;"><?php echo $mahasiswa->mahasiswa; ?></td>
                <td><?php echo $mahasiswa->telp; ?></td>
                <td><?php echo $mahasiswa->kota; ?></td>
                <td><?php echo $mahasiswa->kelamin; ?></td>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
  </div>

  <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div>
</div>