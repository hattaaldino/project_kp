          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 id="judulproyek" class="h3"></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-outline-secondary update-pekerjaan">Update Pekerjaan</button>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-3">Daftar Pekerjaan</h4> 
                </div>
                <div class="table-responsive">
                <table class="table table-striped table-sm display" style="width: 100%;" id="table-pekerjaan">
                    <thead>
                    <tr>
                        <th>Nama Pekerjaan</th>
                        <th>Status</th>
                        <th>Volume</th>
                        <th>Bobot</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($proyek['pekerjaan'])): ?>
                            <?php foreach($proyek['pekerjaan'] as $pekerjaan): ?>
                                <tr data-id="<?php echo $pekerjaan['id']; ?>">
                                    <td class='nama-pekerjaan' data-id="<?php echo $pekerjaan['id']; ?>"><?php echo $pekerjaan['nama']; ?></td>
                                    <?php if($pekerjaan['status'] == -1): ?>
                                        <td><span class="badge badge-danger status-pekerjaan" data-id="<?php echo $pekerjaan['id']; ?>">Belum Dikerjakan</span></td>
                                    <?php elseif($pekerjaan['status'] == 0): ?>
                                        <td><span class="badge badge-secondary status-pekerjaan" data-id="<?php echo $pekerjaan['id']; ?>">Belum Diperiksa</span></td>
                                    <?php elseif($pekerjaan['status'] == 1): ?>
                                        <td><span class="badge badge-success status-pekerjaan" data-id="<?php echo $pekerjaan['id']; ?>">Sudah Dikerjakan</span></td>
                                    <?php endif; ?>
                                    <td class='volume-pekerjaan' data-id="<?php echo $pekerjaan['id']; ?>"><?php echo $pekerjaan['volume']; ?></td>
                                    <td class='bobot-pekerjaan' data-id="<?php echo $pekerjaan['id']; ?>"><?php echo $pekerjaan['bobot']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="mb-3">Grafik Proyek</h4>
                <canvas id="graph-proyek" width="100%" height="50"></canvas>
            </div>
            </div>
        </main>
    </div>
    </div>
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
        $('#table-pekerjaan').DataTable();
        $('#judulproyek').html(proyek['nama']);
        $('.update-pekerjaan').on('click', function(){
            var id = proyek.id;
            $.ajax({
                url : "",
                method : 'POST',
                data : {
                    id : id
                },
                success : function(responseProyek){
                    var proyek = responseProyek.data[0];
                    $.ajax({
                        url : "<?php echo base_url('contractor/kontraktor_submit_proyek'); ?>",
                        method : 'POST',
                        data : {proyek : proyek},
                        success : function(){
                            window.location.href = '<?php echo base_url('kontraktor/dashboard/update-proyek'); ?>';
                        }
                    });
                }
            });
        });
        var workdone = [];

        if(proyek['pekerjaan'][0]['id'])
        {
        workdone = (proyek['pekerjaan']).map(data => {
            if(data.status == 1){
                return data;
            }
        });
        }

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