    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="content">
        <h1 id="judulproyek" class="h3 pb-2 mb-3 border-bottom">Data Proyek</h1>
          <div class="table-responsive">
            <table class="table table-striped table-sm display" style="width:100%" id="table-proyek-pengawas">
              <thead>
                <tr>
                  <th>Nama Proyek</th>
                  <th>Nama Kontraktor</th>
                  <th>Lihat Detail</th>
                </tr>
              </thead>
              <tbody id="table-proyek-pengawas-body">
                <?php if(isset($proyek)): ?>
                  <?php foreach ($proyek as $listproyek): ?>
                    <tr data-id='<?php echo $listproyek['id']; ?>'>
                    <td class='nama-proyek-pengawas' data-id='<?php echo $listproyek['id']; ?>'><?php echo $listproyek['nama']; ?></td>
                    <td class='nama-kontraktor-pengawas' data-id='<?php echo $listproyek['id']; ?>'><?php echo $listproyek['kontraktor']; ?></td>; 
                    <td>
                    <button class='btn btn-sm text-muted detail-proyek-pengawas-btn' data-id='<?php echo $listproyek['id']; ?>'>Lihat Detail</button>
                    </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
      </div>
    </main>
  </div>
</div>
<script>
  $('#table-proyek-pengawas').DataTable();
</script>
</body>
</html>