<!-- logout dialog -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Mau Keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tekan tombol logout dibawah untuk keluar dan anda akan dibawa ke laman login kembali.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="logoutButton" class="btn btn-primary">Logout</button>
      </div>
    </div>
  </div>
</div>
<!-- Error Page Dialog -->
<div class="modal fade" id="errorPageDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terjadi kerusakan pada halaman</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Upss terjadi masalah pada halaman ini.. coba untuk logout kemudian login kembali :)</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="logoutButton" class="btn btn-primary">Logout</button>
      </div>
    </div>
  </div>
</div>
<!--create project dialog-->
<?php if($this->uri->uri_string === 'owner/dashboard' || $this->uri->uri_string === 'contractor/owner_board'): ?>
  <div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Projek Anda</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="tab-content">
          <div class="tab-pane fade in show active" id="inputproject1" role="tabpanel">
            <div class="modal-body">
              <h6 class="mb-4">Identitas Project</h6>
              <div class="md-form form-sm mb-3">
                <label for="buatNamaProject">Nama Project</label>
                <input type="text" name="nama-project" id="buatNamaProject" class="form-control" required >
                <div class="invalid-feedback">
                  Masukan Nama Project
                </div>
              </div>
              <div class="md-form form-sm mb-3">
                <label for="buatLokasiProject">Lokasi Project</label>
                <textarea name="lokasi-project" id="buatLokasiProject" class="form-control"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-toggle="tab" data-target="#inputproject2">Next</button>
            </div>
          </div>

          <div class="tab-pane fade" id="inputproject2" role="tabpanel">
            <div class="modal-body">
              <h6 class="mb-4">Penanggung Jawab Project</h6>
              <div class="md-form form-sm mb-3">
                <label for="inputPengawasProject">Pengawas Project</label>
                <select class="custom-select" id="inputPengawasProject" title="Pilih Pengawas..">
                  <?php 
                  if(isset($pengawas)){
                    foreach($pengawas as $listpengawas) {
                      echo"<option value='",$listpengawas['id'],"'>",$listpengawas['nama'],"</option";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="md-form form-sm mb-3">
                <label for="inputKontraktorProject">Kontraktor Project</label>
                <select class="custom-select" id="inputKontraktorProject" title="Pilih Kontraktor..">
                  <?php 
                  if(isset($kontraktor)){
                    foreach($kontraktor as $listkontraktor) {
                      echo"<option value='",$listkontraktor['id'],"'>",$listkontraktor['nama'],"</option";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-toggle="tab" data-target="#inputproject1">Back</button>
                  <button class="btn btn-primary" data-toggle="tab" data-target="#inputproject3">Next</button>
                </div>
          </div>

          <div class="tab-pane fade" id="inputproject3" role="tabpanel">
            <div class="modal-body">
              <div class="md-form form-sm mb-3">
                <label class="h6" for="inputVolumeProject">Volume Project</label>
                <div id="pilihFileProyek" class="text-center">
                  <div id="drop">Letakan file spreadsheet disini</div>
                  <div class="pt-3">
                    <h6>Atau klik ini untuk pilih file</h6>
                  	<input type="file" name="xlfile" id="xlf">
                  </div>
                </div> 
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-toggle="tab" data-target="#inputproject2">Back</button>
              <button class="btn btn-primary" data-toggle="tab" data-target="#inputproject4">Next</button>
            </div>
          </div>

          <div class="tab-pane fade" id="inputproject4" role="tabpanel">
            <div class="modal-body">
              <h6 class="mb-4">Durasi Project</h6>
              <div class="md-form form-sm mb-3">
                <label for="inputAwalProject">Tanggal Awal Project</label>
                <input placeholder="Awal Projek" type="date" id="inputAwalProject" class="form-control">
                <label for="inputAkhirProject">Tanggal Akhir Project</label>
                <input placeholder="Akhir Projek" type="date" id="inputAkhirProject" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-toggle="tab" data-target="#inputproject3">Back</button>
              <button id="createProject" class="btn btn-primary">Buat Project</button>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
<?php endif; ?>
<!--edit profile-->
<?php if($this->uri->segment('3') === 'edit-profil' || $this->uri->uri_string === 'owner/dashboard/edit-pengawas'): ?>
  <div class="modal fade" id="editFotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Foto Profil</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <div class="custom-file">
              <label class="custom-file-label" id="edit-foto-profil" for="edit-foto-profil">Choose file</label>
              <input type="file" class="custom-file-input" id="edit-foto-profil" accept=".jpg, .png, .jpeg" aria-describedby="inputGroupFileAddon04">
            </div>
          </div>
          <div class="invalid-feedback profile-alert">
            Your profile picture must be in image format (jpg,jpeg,png).
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="edit-foto">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editNamaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Nama</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control nama" type="text" placeholder="Edit Nama Anda">
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="edit-nama">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editUsernameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping">@</span>
            </div>
            <input type="email" class="form-control username" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="edit-username">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editPassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control password" type="password">
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="edit-pass">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editAlamatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Alamat</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <textarea class="form-control alamat" aria-label="With textarea" placeholder="Alamat"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="edit-alamat">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editTelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Nomor Telepon</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control telepon" type="text" placeholder="No Telp">
          <div class="invalid-feedback telp-alert">
             Please insert a valid phone number.
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="edit-telp">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<!--edit projek-->
<?php if($this->uri->uri_string === 'owner/dashboard/edit-proyek' || $this->uri->uri_string === 'contractor/owner_edit_proyek'): ?>
  <div class="modal fade" id="editNamaProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Nama Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control edit-nama-proyek" type="text" placeholder="Nama Proyek">
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editnamaproyekbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editAwalProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Tanggal Mulai Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control edit-awal-proyek" type="date" placeholder="Tanggal awal proyek">
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editawalproyekbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editAkhirProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Tanggal Selesai Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control edit-akhir-proyek" type="date" placeholder="Tanggal akhir proyek">
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editakhirproyekbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editLokasiProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Lokasi Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <textarea class="form-control edit-lokasi-proyek" aria-label="With textarea" placeholder="Lokasi Proyek"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editlokasiproyekbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editPekerjaanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Pekerjaan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="md-form form-sm mb-3">
            <label for="editnamapekerjaan">Nama Pekerjaan</label>
            <input type="text" name="nama-pekerjaan" id="editnamapekerjaan" class="form-control">
          </div>
          <div class="md-form form-sm mb-3">
            <label for="editvolumepekerjaan">Volume Pekerjaan</label>
            <input type="text" name="volume-pekerjaan" id="editvolumepekerjaan" class="form-control">
          </div>
          <div class="md-form form-sm mb-3">
            <label for="editbobotpekerjaan">Bobot Pekerjaan</label>
            <input type="number" name="bobot-pekerjaan" id="editbobotpekerjaan" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editpekerjaanbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editKontraktorProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Kontraktor Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="md-form form-sm">
            <label for="editKontraktorProyek">Kontraktor Proyek</label>
            <select class="custom-select" id="editKontraktorProyek" title="Pilih Kontraktor..">
              <?php 
              if(isset($kontraktor)){
                foreach($kontraktor as $listkontraktor) {
                  echo"<option value='",$listkontraktor['id'],"'>",$listkontraktor['nama'],"</option";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editkontraktorproyekbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editPengawasProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Kontraktor Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="md-form form-sm">
            <label for="editPengawasProyek">Pengawas Proyek</label>
            <select class="custom-select" id="editPengawasProyek" title="Pilih Pengawas..">
              <?php 
              if(isset($pengawas)){
                foreach($pengawas as $listpengawas) {
                  echo"<option value='",$listpengawas['id'],"'>",$listpengawas['nama'],"</option";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="editpengawasproyekbtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="konfirmasiPerubahanProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Semua Perubahan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="mb-0"><strong>Nama Proyek</strong></p>
          <?php if(isset($proyek['nama'])): ?>
          <p id="nama-proyek"><?php echo $proyek['nama']; ?></p>
          <?php else: ?>
          <p id="nama-proyek" class="text-muted">Anda Belum Mendaftarkan Nama Proyek Ini</p>
          <?php endif; ?>

          <p class="mb-0"><strong>Tanggal Mulai Proyek</strong></p>
          <?php if(isset($proyek['tanggal_awal'])): ?>
          <p id="tanggal-awal-proyek"><?php echo $proyek['tanggal_awal']; ?></p>
          <?php else: ?>
          <p id="tanggal-awal-proyek" class="text-muted">Anda Belum Mendaftarkan Tanggal Awal Proyek ini</p>
          <?php endif; ?>

          <p class="mb-0"><strong>Tanggal Selesai Proyek</strong></p>
          <?php if(isset($proyek['tanggal_akhir'])): ?>
          <p id="tanggal-selesai-proyek"><?php echo $proyek['tanggal_akhir']; ?></p>
          <?php else: ?>
          <p id="tanggal-selesai-proyek" class="text-muted">Anda Belum Mendaftarkan Tanggal Akhir Proyek ini</p>
          <?php endif; ?>

          <p class="mb-0"><strong>Lokasi Proyek</strong></p>
          <?php if(isset($proyek['lokasi'])): ?>
          <p id="lokasi-proyek" class="mb-1"><?php echo $proyek['lokasi']; ?></p>
          <?php else: ?>
          <p id="lokasi-proyek" class="text-muted mb-1">Anda Belum Mendaftarkan Lokasi Proyek ini</p>
          <?php endif; ?>

          <div class="table-responsive mt-3 border-bottom border-top">
            <p class="mb-2 pt-2"><strong>Data Pekerjaan Proyek Baru</strong></p>
            <table class="table table-bordered" style="width: 100%;" id="table-pekerjaan-yang-diedit">
              <thead>
                <tr>
                  <th>Nama Pekerjaan</th>
                  <th>Volume</th>
                  <th>Bobot</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody class="body-table-pekerjaan-berubah">
              </tbody>
            </table>
          </div>

          <p class="mb-0 mt-1"><strong>Kontraktor Proyek</strong></p>
          <?php if(isset($kontraktorProyek['nama'])): ?>
              <p class="text-muted" id="nama-kontraktor"><?php echo $kontraktorProyek['nama']; ?></p>
          <?php else: ?>
              <p class="text-muted" id="nama-kontraktor">No Name</p>
          <?php endif; ?>
          
          <p class="mb-0"><strong>Pengawas Proyek</strong></p>
          <?php if(isset($pengawasProyek['nama'])): ?>
              <p class="text-muted" id="nama-pengawas"><?php echo $pengawasProyek['nama']; ?></p>
          <?php else: ?>
              <p class="text-muted" id="nama-pengawas">No Name</p>
          <?php endif; ?>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-primary" id="konfirmasiPerubahanProyekBtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<!--submit projek-->
<?php if($this->uri->uri_string === 'kontraktor/dashboard/update-proyek' || $this->uri->uri_string === 'contractor/kontraktor_submit_proyek'): ?>
  <div class="modal fade" id="dokumentasiProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dokumentasi Proyek</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <div class="custom-file">
              <label class="custom-file-label" for="dokumentasi-proyek">Choose file</label>
              <input type="file" class="custom-file-input" id="dokumentasi-proyek" accept=".jpg, .png, .jpeg" multiple aria-describedby="inputGroupFileAddon04">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-sm btn-primary" id="dokumentasi-proyek-button">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>