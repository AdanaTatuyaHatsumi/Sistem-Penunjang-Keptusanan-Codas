 <!-- partial -->
 <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    <h4 class="card-title">Edit Alternatif</h4>
                                    <form method="POST" action="<?php echo base_url('alternatif/editAlternatifAksi') ?>" enctype="multipart/form-data" class="form-sample">
                                        <p class="card-description">
                                            Personal info
                                        </p>
                                        <?php foreach($selectAlternatif as $sa) : ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Code Alternatif</label>
                                                    <div class="col-sm-9">
                                                    <input type="hidden" name="id" placeholder="Example : A01 or A1" class="form-control" value="<?php echo $sa->id ?>">
                                                        <input type="text" name="kode" placeholder="Example : A01 or A1" class="form-control" value="<?php echo strtoupper($sa->alternatif) ?>">
                                                        <?php echo form_error('kode','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Alternatif</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="alternatif" placeholder="Example : Your Name Alternatif" class="form-control" value="<?php echo ucwords(str_replace('-',' ',$sa->keterangan)) ?>">
                                                        <?php echo form_error('alternatif','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <a href="<?php echo base_url('alternatif') ?>" class="btn btn-light">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->