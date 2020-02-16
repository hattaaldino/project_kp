    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="content">
        <h1 id="judulproyek" class="h3 pb-2 mb-3 border-bottom"></h1>
        <div class="row">
          <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="mb-3">Pekerjaan Selesai</h4> 
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-sm display" style="width: 100%;" id="table-pekerjaan-selesai">
                <thead>
                  <tr>
                    <th>Nama Pekerjaan</th>
                    <th>Tanggal Selesai</th>
                  </tr>
                </thead>
                <tbody class="body-table-pekerjaan">
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="mb-3">Grafik Proyek</h4>
            <canvas id="graph-proyek" width="100%" height="50"></canvas>
          </div>
        </div>
      </div>  
    </main>
  </div>
</div>
<!------>
<script>
  var proyek;
  <?php if(isset($proyek)): ?>
    proyek = JSON.parse('<?php echo json_encode($proyek); ?>');
  <?php else: ?>
    proyek = {
        id : '',
        nama : '',
        lokasi : '',
        tanggal_awal : '',
        tanggal_akhir : '',
        pekerjaan : [{
            id : '',
            nama : '',
            volume : '',
            bobot : '', 
            tanggal_selesai : '',
            status : null,
            dokumentasi : ['']
        }],
        id_owner: '',
        id_pengawas : '',
        id_kontraktor : ''
    };
  <?php endif; ?>
  
  $(document).ready(function(){
    //Setting Judul Proyek
    $('#judulproyek').html(proyek.nama);
    
    //Mengambil data pekerjaan yang sudah selesai
    var workdone = [];
    if(proyek['pekerjaan'][0]['id'])
    {
      workdone = (proyek['pekerjaan']).map(data => {
          if(data.status == 1){
              return data;
          }
      });
    }
    
    //membuat list nama data pekerjaan yang sudah selesai
    workdone.forEach(elem => {
        let tanggal = new Date(elem['tanggal_selesai']);
        let list = "<tr id='"+elem.id+"'>\n";
        list += "<td class='nama-pekerjaan' id='"+elem.id+"'>"+elem.nama+"</td>\n";
        list += "<td class='tanggal-selesai' id='"+elem.id+"'>"+tanggal.toDateString()+"</td>\n";
        list += "</tr>\n"; 

        let listdata = $(list);
        listdata.prependTo(".body-table-pekerjaan");
    });
    
    //membuat tabel
    $('#table-pekerjaan-selesai').DataTable();

    //Menyiapkan base grafik
    var base = $('#graph-proyek')[0].getContext('2d');
    var config = {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: '#B56A4B',
            }]
        },
        options: {
            responsive: true,
            title:{
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: true
            },
            hover: {
                mode: 'index',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Bobot Selesai'
                    }
                }]
            }
        }
    };

    //menyiapkan data buat grafik
    var dataproyek = [];
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Des'];

    //data 0
    if(proyek['tanggal_awal']){
      var awal_segalanya = new Date(proyek['tanggal_awal']);
      var label_awal = months[awal_segalanya.getMonth()] + " " + awal_segalanya.getFullYear();
      config.data.labels.push(label_awal);
      config.data.datasets[0].data.push(0);
    }
    
    //data seterusnya
    var jumlahlabel = (dataproyek.length - 1);
    var sortedWork = workdone.sort((a, b) => (new Date(a['tanggal_selesai']) >= new Date(b['tanggal_selesai'])) ? -1 : 1 );
    sortedWork.forEach(elem => {
        var date = new Date(elem['tanggal_selesai']);
        var labelname = months[date.getMonth()] + " " + date.getFullYear();
        if (dataproyek.length == 0){
            let newlabel = {
                label: labelname,
                bobot: elem['bobot']
            }
            dataproyek.push(newlabel);
        }
        else {
            //cek apakah label sudah ada pada data
            let indexdataproyek = -1;
            let labelexist = false;
            dataproyek.forEach((check, index)  => {
                if (check.label == labelname)
                    labelexist = true;
                    indexdataproyek = index;
            });
            //kalau label sudah ada tambahkan bobot pekerjaan ke label
            if (labelexist && indexdataproyek >= 0)
                dataproyek[indexdataproyek].bobot += elem['bobot'];
            //kalau label belum ada, buat label baru dan tambahkan bobot label sebelumnya dan bobot pekerjaan yang sedang dicek kedalam bobot label baru
            else {
                let newbobot = (dataproyek[jumlahlabel].bobot) + elem['bobot'];
                let newlabel = {
                    label: labelname,
                    bobot: newbobot
                }
                dataproyek.push(newlabel);
                jumlahlabel++;
            }
        }
    });

    //mensinkronkan data dan base grafik
    dataproyek.forEach(elem => {
      config.data.labels.push(elem.label);
      config.data.datasets[0].data.push(elem.bobot);
    });

    var graphProyek = new Chart(base, config);
  });

</script>
</body>
</html>