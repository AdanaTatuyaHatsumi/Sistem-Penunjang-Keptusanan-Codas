 <!-- partial -->
 <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    <h4 class="card-title">Tambah Kriteria</h4>
                                    <form method="POST" action="<?php echo base_url('kriteria/tambahKriteriaAksi') ?>" enctype="multipart/form-data" class="form-sample">
                                        <p class="card-description">
                                            Personal info
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Code</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kode" placeholder="Example : C1" class="form-control">
                                                        <?php echo form_error('kode','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Kriteria</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kriteria" placeholder="Example : IPK" class="form-control">
                                                        <?php echo form_error('kriteria','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Bobot per %</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="bobot" placeholder="Example : 40%" class="form-control">
                                                        <?php echo form_error('bobot','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <a href="<?php echo base_url('kriteria') ?>" class="btn btn-light">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->