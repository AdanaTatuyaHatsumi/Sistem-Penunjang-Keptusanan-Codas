<div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    <h4 class="card-title">Daftar Alternatif</h4>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('alternatif/tambahAlternatif') ?>">Tambah Alternatif</a>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Alternatif</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach($alternatif as $a) : ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo strtoupper($a->alternatif) ?></td>
                                                    <td><?php echo ucwords(str_replace("-"," ",$a->keterangan)) ?></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="<?php echo base_url('NilaiKeputusan/tampilNilai/'.$a->alternatif) ?>">Open</a>
                                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url('alternatif/editAlternatif/'.$a->id) ?>">Edit</a>
                                                        <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('alternatif/deleteAlternatif/'.$a->alternatif) ?>">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Membentuk Matriks Keputusan</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Alternatif</th>
                                                    <?php foreach($kriteria as $k) : ?>
                                                    <th><?php echo strtoupper($k->kode) ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($alternatif as $a) : ?>
                                                    <?php $mmk = $this->db->query("SELECT * FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && username = '$username' ORDER BY id ASC")->result(); ?>
                                                    
                                                <tr>
                                                    <td><?php echo strtoupper($a->alternatif) ?></td>
                                                <?php foreach($mmk as $m) : ?> 

                                                    <td><?php echo $m->nilai ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                                
                                               
                                               <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                
                <?php if (count($alternatif) >= 2) { ?>
                    <?php foreach($alternatif as $a) : ?>
                        <?php $alter = $this->db->query("SELECT * FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && username = '$username'")->result(); ?>
                    <?php endforeach; ?>
                    <?php if (!empty($alter)) { ?>
                        <div class="content-wrapper">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Bobot Max</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Bobot</th>
                                                    <?php foreach($kriteria as $k) : ?>
                                                    <th><?php echo $k->bobot ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>
                                                    <td>Max Val</td>
                                                <?php foreach($kriteria as $k) : ?>
                                                    <?php $mmk = $this->db->query("SELECT MAX(nilai) AS nilai FROM membentuk_matriks_keputusan WHERE kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php foreach($mmk as $m) : ?>
                                                            <td><?php echo $m->nilai ?></td>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                </tr>
                                                
                                               
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                    <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Normalisasi Matriks Keputusan</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    <th>Alternatif</th>
                                                    <?php foreach($kriteria as $k) : ?>
                                                    <th><?php echo strtoupper($k->kode) ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($alternatif as $a) : ?>

                                                <tr>
                                                <td><?php echo strtoupper($a->alternatif) ?></td>

                                                <?php foreach($kriteria as $k) : ?>

                                                    <?php $mmk2 = $this->db->query("SELECT membentuk_matriks_keputusan.nilai AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && alternatif = '$a->alternatif' && username = '$username'")->result(); ?>
                                                    <?php $mmk3 = $this->db->query("SELECT MAX(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>

                                                    <?php foreach($mmk2 as $mk2) : ?>
                                                        <?php foreach($mmk3 as $mk3) : ?>
                                                            <td><?php echo round($mk2->nilai/$mk3->nilai,5) ?></td>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                                    
                                            </tr>
                                                
                                               
                                               <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                                                        </div>
                    <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Normalisasi Matriks Terbobot (R)</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    <th>Alternatif</th>
                                                    <?php foreach($kriteria as $k) : ?>
                                                    <th><?php echo strtoupper($k->kode) ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($alternatif as $a) : ?>
                                                <tr>
                                                <td><?php echo strtoupper($a->alternatif) ?></td>

                                                <?php foreach($kriteria as $k) : ?>

                                                    <?php $mmk2 = $this->db->query("SELECT membentuk_matriks_keputusan.nilai AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && alternatif = '$a->alternatif' && username = '$username'")->result(); ?>
                                                    <?php $mmk3 = $this->db->query("SELECT MAX(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>

                                                    <?php foreach($mmk2 as $mk2) : ?>
                                                        <?php foreach($mmk3 as $mk3) : ?>
                                                            <td><?php echo round(($mk2->nilai/$mk3->nilai)*(float)$k->bobot/100,5) ?></td>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                                    
                                            </tr>
                                                
                                               
                                               <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>

                    <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Menentukan Nilai Ideal Negatif (NS)</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    <?php foreach($kriteria as $k) : ?>
                                                    <th><?php echo strtoupper($k->kode) ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           
                                                <tr>
                                                <?php foreach($kriteria as $k) : ?>

                                                    <?php $mmk2 = $this->db->query("SELECT MIN(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                    <?php $mmk3 = $this->db->query("SELECT MAX(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>

                                                    <?php foreach($mmk2 as $mk2) : ?>
                                                        <?php foreach($mmk3 as $mk3) : ?>
                                                            <td><?php echo round(($mk2->nilai/$mk3->nilai)*(float)$k->bobot/100,4) ?></td>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                                    
                                            </tr>
                                                
                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>

                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Menghitung Jarak Euclidean & Taxicab</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    <th>Alternatif</th>
                                                    
                                                    <th>Ei</th>
                                                    <th>Ti</th>
                                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($alternatif as $a) : ?>
                                                <tr>
                                                <td><?php echo strtoupper($a->alternatif) ?></td>

                                                <?php $nl3=0; $nl4=0; foreach($kriteria as $k) : ?>

                                                    <?php $mmk1 = $this->db->query("SELECT membentuk_matriks_keputusan.nilai AS nilai FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && kode = '$k->kode' && username = '$username'")->result(); ?>
                                                    <?php $mmk2 = $this->db->query("SELECT MIN(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                    <?php $mmk3 = $this->db->query("SELECT MAX(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                    <?php  foreach($mmk1 as $mk1) : ?>
                                                        <?php foreach($mmk2 as $mk2) : ?>
                                                            <?php  foreach($mmk3 as $mk3) : ?>
                                                                <?php $nl   = ($mk1->nilai/$mk3->nilai)*(float)$k->bobot/100 ?>
                                                                <?php $nl2  = ($mk2->nilai/$mk3->nilai)*(float)$k->bobot/100 ?>
                                                                <?php $nl3 += (($nl-$nl2)*($nl-$nl2)) ?>
                                                                <?php $nl4 += (($nl-$nl2)) ?>
                                                                
                                                            <?php endforeach; ?>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                                <td><?php echo round(sqrt($nl3),5) ?></td>
                                                <td><?php echo round(abs($nl4),5) ?></td>
                                                    
                                            </tr>
                                                
                                               
                                               <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>

                    <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title">Membentuk Matriks Relative Assessment Score (RA)</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    <th>Alternatif</th>
                                                    
                                                    
                                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                
                                                <?php $nl3=array(); $nl4=array(); $nl7=array(); foreach($alternatif as $aa => $a) : ?>

                                                    <?php $nl3[$aa]=0;  $nl4[$aa]=0; $nl7[$aa]=0; foreach($kriteria as $k) : ?>

                                                        <?php $mmk1 = $this->db->query("SELECT membentuk_matriks_keputusan.nilai AS nilai FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php $mmk2 = $this->db->query("SELECT MIN(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php $mmk3 = $this->db->query("SELECT MAX(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php   foreach($mmk1 as $mk1) : ?>
                                                            <?php foreach($mmk2 as $mk2) : ?>
                                                                <?php   foreach($mmk3 as $mk3) : ?>
                                                                    <?php $nl   = ($mk1->nilai/$mk3->nilai)*(float)$k->bobot/100 ?>
                                                                    <?php $nl2  = ($mk2->nilai/$mk3->nilai)*(float)$k->bobot/100 ?>
                                                                    <?php $nl3[$aa]  += (($nl-$nl2)*($nl-$nl2)) ?>
                                                                    <?php $nl4[$aa]  += (($nl-$nl2)) ?>
                                                                        
                                                                    <?php //$nl5 = sqrt($nl3[$aa]) ?>
                                                                    <?php //$nl6 = abs($nl4) ?>

                                                                    <?php $nl7[$aa]  = $a->alternatif;  ?>

                                                                    <?php //$nl11 = abs($nl3) ?>
                                                                    <?php //$nl12 = $nl11 - $nl5 ?>
                                                                    <?php //$nl7 = ($nl5-$nl5)+(0.02*($nl5-$nl5)*($nl6-$nl6)) ?>
                                                                    <?php //$nl8 = $nl-$nl2 ?>
                                                                    <?php //$nl9 = ($nl-$nl2)*($nl-$nl2) ?>
                                                                    <?php //$nl10 = $nl9 + (0.02*($nl9)*($nl8)) ?>
                                                                    
                                                                                                                                       
                                                                <?php endforeach; ?>

                                                            <?php endforeach; ?>

                                                        <?php endforeach; ?>
                                                        
                                                    <?php endforeach; ?>

                                                <?php endforeach; ?>
                                             
                                                <?php for ($i=0; $i < count($alternatif); $i++) { ?>
                                                    <tr>
                                                    <td><?php echo strtoupper($nl7[$i]) ?></td>
                                                    <?php for ($k=0; $k < count($kriteria); $k++) { ?>
                                                        <?php $nl8 = (sqrt($nl3[$i]) - sqrt($nl3[$k])) + (0.02*(sqrt($nl3[$i]) - sqrt($nl3[$k])) * (abs($nl4[$i]) - abs($nl4[$k]))) ?>
                                                            <td><?php echo round($nl8,5) ?></td>
                                                        <?php  } ?>
                                                    </tr>
                                                    <?php  } ?>

                                            
                                                
                                               
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>

                    <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <h4 class="card-title"> Menghitung Nilai Assessment Score (H) dan Perankingan (R)</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    
                                                    <th>Alternatif</th>
                                                    <th>H</th>
                                                    <th>R</th>
                                                    
                                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                
                                                <?php $nl10=array();  $nl3=array(); $nl4=array(); $nl7=array();  foreach($alternatif as $aa => $a) : ?>

                                                    <?php $nl10[$aa]=0; $nl3[$aa]=0;  $nl4[$aa]=0; $nl7[$aa]=0;  foreach($kriteria as $kk => $k) : ?>

                                                        <?php $mmk1 = $this->db->query("SELECT membentuk_matriks_keputusan.nilai AS nilai FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php $mmk2 = $this->db->query("SELECT MIN(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php $mmk3 = $this->db->query("SELECT MAX(membentuk_matriks_keputusan.nilai) AS nilai FROM membentuk_matriks_keputusan WHERE  kode = '$k->kode' && username = '$username'")->result(); ?>
                                                        <?php   foreach($mmk1 as $mk1) : ?>
                                                            <?php foreach($mmk2 as $mk2) : ?>
                                                                <?php   foreach($mmk3 as $mk3) : ?>
                                                                    <?php $nl   = ($mk1->nilai/$mk3->nilai)*(float)$k->bobot/100 ?>
                                                                    <?php $nl2  = ($mk2->nilai/$mk3->nilai)*(float)$k->bobot/100 ?>
                                                                    <?php $nl3[$aa]  += (($nl-$nl2)*($nl-$nl2)) ?>
                                                                    <?php $nl4[$aa]  += (($nl-$nl2)) ?>
                                                                        
                                                                    <?php //$nl5 = sqrt($nl3[$aa]) ?>
                                                                    <?php //$nl6 = abs($nl4) ?>

                                                                    <?php $nl7[$aa]  = $a->keterangan;  ?>
                                                                    <?php //$nl8[$aa]  = $a->keterangan;  ?>

                                                                    <?php //$nl11 = abs($nl3) ?>
                                                                    <?php //$nl12 = $nl11 - $nl5 ?>
                                                                    <?php //$nl7 = ($nl5-$nl5)+(0.02*($nl5-$nl5)*($nl6-$nl6)) ?>
                                                                    <?php //$nl8 = $nl-$nl2 ?>
                                                                    <?php //$nl9 = ($nl-$nl2)*($nl-$nl2) ?>
                                                                    <?php //$nl10 = $nl9 + (0.02*($nl9)*($nl8)) ?>
                                                                    
                                                                                                                                       
                                                                <?php endforeach; ?>

                                                            <?php endforeach; ?>

                                                        <?php endforeach; ?>
                                                        
                                                    <?php endforeach; ?>

                                                <?php endforeach; ?>

                                                <?php $ni=1; $nl9=array(); $nl0=array(); $nl13=array(); foreach($alternatif as $l => $ll) : $nl9[$l] = 0; $nl10[$l] = 0;?>
                                                    
                                                        
                                                        <?php foreach($kriteria as $m => $mm) : ?>
                                                            <?php $nl9[$l] += (sqrt($nl3[$l]) - sqrt($nl3[$m])) + (0.02*(sqrt($nl3[$l]) - sqrt($nl3[$m])) * (abs($nl4[$l]) - abs($nl4[$m]))); $nl10[$l] = $nl9[$l]; ?>
                                                        <?php endforeach; ?>
                                                        
                                                    <?php 
                                                    //$nl13[$nl7[$l]]=$nl10[$l];
                                                    
                                                    //$nl13[$ni++]=$nl10[$l];
                                                    //ksort($nl13); 
                                                    ?>

                                                <?php endforeach; ?>
                                                <?php $nl14=array(); $nl15=array(); $nl17=array(); $noo=1; foreach($alternatif as $r => $rr) : ?>
                                                    
                                                    <?php 
                                                        //rsort($nl10); $nl14[$noo++] = $nl10[$r];
                                                        //$nl14["$nl10[$r]"] = $r;
                                                        //$nl17[$r]=$r;
                                                        //sort($nl17);
                                                        $nl15["$nl10[$r]"] = $nl7[$r];
                                                        $nl17[$r] = $nl10[$r];
                                                        arsort($nl17);
                                                        //$nl17[$r] = $nl15["$nl10[$r]"] = $nl7[$r];
                                                        //$nl16[$r]=array("$nl10[$r]" => $nl7[$r]); 
                                                    ?>


                                                <?php endforeach; ?>

                                                <?php $no=1; foreach($nl17 as $nn => $nnn) : ?>
                                                    <tr>
                                                    
                                                    <td><?php  print_r(ucwords(str_replace("-"," ",$nl7[$nn]))) ?></td>
                                                    <td><?php   echo round($nl9[$nn],5) ?></td>
                                                    <td><?php echo  $no++
                                                    
                                                    //$nl14[$nii++] = $nl10[$u];
                                                    
                                                    //krsort($nl10); //echo "Rank-".$nomor++." Dengan Nilai ".round($nl10[$u],5)
                                                    //$nl13=array( $u => $nl10[$u] ); //krsort($nl13); print_r($nl13);  
                                                    //krsort($nl14);  //print_r($nl14);
                                                    //krsort($nl15);
                                                    //arsort($nl17); 
                                                    //print_r($nl17); 
                                                    //krsort($nl16); print_r($nl16[$u]) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>
                    <?php } else { ?>
                        <div class="content-wrapper">
                            <h4>*Silahkan Selesaikan Penginputan Nilai</h4>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="content-wrapper">
                        <h4>*Input Minimal 2 Data Alternatif</h4>
                    </div>
                <?php } ?>
                