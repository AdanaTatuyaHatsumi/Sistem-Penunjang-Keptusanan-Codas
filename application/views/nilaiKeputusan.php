<div class="main-panel">
<div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    
                                    <h4 class="card-title">Nilai Keputusan</h4>
                                    <?php 
                                     foreach($alternatif as $a) : 
                                        $mmk = $this->db->query("SELECT * FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && username = '$username' ORDER BY id ASC")->result();
                                     endforeach;
                                     if (empty($mmk)) {
                                        ?>
                                             <a class="btn btn-sm btn-info" href="<?php echo base_url('NilaiKeputusan/tambahNilai/'.$a->alternatif) ?>">Tambah Nilai Keputusan</a>
                                        <?php
                                     }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Alternatif</th>
                                                    <?php foreach($kriteria as $k) : ?>
                                                    <th><?php echo strtoupper($k->kode) ?></th>
                                                    <?php endforeach; ?>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($alternatif as $a) : ?>
                                                    <?php $mmk = $this->db->query("SELECT * FROM membentuk_matriks_keputusan WHERE alternatif = '$a->alternatif' && username = '$username' ORDER BY id ASC")->result(); ?>
                                                    
                                                <?php if (!empty($mmk)) {
                                                   ?>
                                                    <tr>
                                                        <td><?php echo strtoupper($a->alternatif) ?></td>
                                                        <?php foreach($mmk as $m) : ?> 

                                                            <td><?php echo $m->nilai ?></td>
                                                        <?php endforeach; ?>
                                                        <td>
                                                            <a class="btn btn-sm btn-warning" href="<?php echo base_url('NilaiKeputusan/editNilai/'.$a->alternatif) ?>">Edit</a>
                                                            <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('NilaiKeputusan/deleteNilai/'.$a->alternatif) ?>">Delete</a>
                                                        </td>
                                                    </tr>
                                                   <?php
                                                } ?>
                                                
                                               
                                               <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>