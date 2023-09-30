<div class="main-panel">
                
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
                                
                                <td><?php  print_r(ucwords(preg_replace("/[^a-zA-Z]/"," ",$nl7[$nn]))) ?></td>
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