<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      PUM
      <small>Data Transaksi PUM</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Transaksi PUM</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal" style="background-color: #159957;">
                <i class="fa fa-plus"></i> &nbsp Tambah PUM
              </button>
            </div>
            <hr>
            <?php
            if (isset($_GET['alert'])) {
              if ($_GET['alert'] == 'gagal') {
            ?>
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
                  Ekstensi Tidak Diperbolehkan
                </div>
              <?php
              } elseif ($_GET['alert'] == "berhasil") {
              ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success</h4>
                  Berhasil Disimpan
                </div>
              <?php
              } elseif ($_GET['alert'] == "berhasilupdate") {
              ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success</h4>
                  Berhasil Update
                </div>
            <?php
              }
            }
            ?>
          </div>
          <div class="box-body">

            <!-- Tambah -->
            <form action="transaksi_act_pum.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi PUM</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Project</label>
                        <select name="kategori" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php
                          $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                          while ($k = mysqli_fetch_array($kategori)) {
                          ?>
                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Tanggal Kebutuhan</label>
                        <input type="text" name="tanggal_kebutuhan" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" name="trnfoto" required="required" class="form-control">
                        <small>File yang di perbolehkan *PDF | *JPG | *jpeg </small>

                        <div class="form-group">
                        <!-- <label>Upload File</label> -->
                        <input type="hidden" name="foto_pjum" required="required" class="form-control">
                        <!-- <small>File yang di perbolehkan *PDF | *JPG | *jpeg </small> -->
                      </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"style="background-color: #159957;">Simpan</button>
                  </div>
                </div>
              </div>
          </div>
          </form>


          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-datatable">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">KODE</th>
                  <th class="text-center">TANGGAL TRANSAKSI</th>
                  <th class="text-center">PROJECT</th>
                  <th class="text-center">KEBUTUHAN DANA</th>
                  <th class="text-center">TANGGAL KEBUTUHAN</th>
                  <th class="text-center">NOMINAL</th>
                  <th rowspan="2" class="text-center">AKSI</th>
                </tr>
              </thead>

              <tbody>
                <?php
                include '../koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM transaksi_pjum,kategori 
                where kategori_id=transaksi_kategori order by transaksi_id desc");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td>PUM-0<?php echo $d['transaksi_id']; ?>/<?php echo $d['kode']; ?>/<?php echo date('m', strtotime($d['transaksi_tanggal'])); ?>/<?php echo date('Y', strtotime($d['transaksi_tanggal'])); ?></td>
                    <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                    <td><?php echo $d['kategori']; ?></td>
                    <td><?php echo $d['transaksi_keterangan']; ?></td>
                    <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal_kebutuhan'])); ?></td>
                    <td class="text-center">
                      <?php echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";?></td>
                    </td>

                    <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_transaksi_<?php echo $d['transaksi_id'] ?>">
                        <i class="fa fa-cog"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['transaksi_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>

                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lihat_transaksi_<?php echo $d['transaksi_id'] ?>">
                        <i class="fa fa-eye"></i>
                      </button>


                      <!-- Edit -->
                      <form action="transaksi_update_pum.php" method="post"  enctype="multipart/form-data">
                        <div class="modal fade" id="edit_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Edit Transaksi PUM</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">



                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Tanggal Transaksi</label>
                                  <input type="hidden" name="id" value="<?php echo $d['transaksi_id'] ?>">

                                  <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['transaksi_tanggal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Project</label>
                                  <select name="kategori" style="width:100%" class="form-control" required="required">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                                    while ($k = mysqli_fetch_array($kategori)) {
                                    ?>
                                      <option <?php if ($d['transaksi_kategori'] == $k['kategori_id']) {
                                                echo "selected='selected'";
                                              } ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Nominal</label>
                                  <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['transaksi_nominal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Keterangan</label>
                                  <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['transaksi_keterangan'] ?></textarea>
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Tanggal Kebutuhan</label>
                                  <input type="text" style="width:100%" name="tanggal_kebutuhan" required="required" class="form-control datepicker2" value="<?php echo $d['transaksi_tanggal_kebutuhan'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Upload File</label>
                                  <input type="file" name="foto" class="form-control"><br>
                                  <!-- <small><?php echo $d['transaksi_foto'] ?></small> -->
                                  <p class="help-block">Bila File <?php echo "<a class='fancybox btn btn-xs btn-primary' target=_blank href='../gambar/bukti/$d[transaksi_foto]'>$d[transaksi_foto]</a>"; ?> tidak dirubah kosongkan saja</p>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary"style="background-color: #159957;">Simpan</button>
                            </div>
                          </div>
                        </div>
          </div>
          </form>

          <div class="modal fade" id="lihat_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Lihat Bukti Upload</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <embed src="../gambar/bukti/<?php echo $d['transaksi_foto']; ?>" type="application/pdf" width="100%" height="400px" />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>

          <!-- hapus -->
          <div class="modal fade" id="hapus_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <p>Yakin ingin menghapus data ini ?</p>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <a href="transaksi_hapus_pum.php?id=<?php echo $d['transaksi_id'] ?>" class="btn btn-primary">Hapus</a>
                </div>
              </div>
            </div>
          </div>

          </td>
          </tr>
        <?php
                }
        ?>
        </tbody>
        </table>
        </div>
    </div>

</div>
</section>
</div>
</section>

</div>
<?php include 'footer.php'; ?>