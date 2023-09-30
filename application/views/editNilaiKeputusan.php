 <!-- partial -->
 <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    <h4 class="card-title">Edit Nilai Keputusan</h4>
                                    <form method="POST" action="<?php echo base_url('NilaiKeputusan/editNilaiAksi') ?>" enctype="multipart/form-data" class="form-sample">
                                        <p class="card-description">
                                            Personal info
                                        </p>
                                        <div class="row">
                                            <?php $n=1; $e=1; $a=1; $f=1; foreach($kriteria as $k) : ?>
                                            <?php $nilai_keputusan = $this->db->query("SELECT * FROM membentuk_matriks_keputusan WHERE alternatif = '$alternatif' && kode = '$k->kode' && username = '$username' ")->result() ?>
                                            
                                            <?php foreach($nilai_keputusan as $nk) : ?>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label"><?php echo strtoupper($nk->kode) ?></label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" name="<?php echo 'alternatif'.$a++ ?>" placeholder="Example : 4 or 3.5" class="form-control" value="<?php echo $alternatif ?>">
                                                        <input type="hidden" name="<?php echo 'kode'.$e++ ?>" placeholder="Example : 4 or 3.5" class="form-control" value="<?php echo $nk->kode ?>">
                                                        <input type="text" name="<?php echo 'nilai'.$n++ ?>" placeholder="Example : 4 or 3.5" class="form-control" value="<?php echo $nk->nilai ?>">
                                                        <?php echo form_error('nilai'.$f++,'<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <a href="<?php echo base_url('alternatif') ?>" class="btn btn-light">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->