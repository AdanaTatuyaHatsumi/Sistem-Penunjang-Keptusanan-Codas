 <!-- partial -->
 <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    <h4 class="card-title">Edit Kriteria</h4>
                                    <form method="POST" action="<?php echo base_url('kriteria/editKriteriaAksi') ?>" enctype="multipart/form-data" class="form-sample">
                                        <p class="card-description">
                                            Personal info
                                        </p>
                                        <?php foreach($selectKriteria as $sk) : ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Code</label>
                                                    <div class="col-sm-9">
                                                    <input type="hidden" name="id" placeholder="Example : C1" class="form-control" value="<?php echo $sk->id ?>">
                                                        <input type="text" name="kode" placeholder="Example : C1" class="form-control" value="<?php echo strtoupper($sk->kode) ?>">
                                                        <?php echo form_error('kode','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Kriteria</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kriteria" placeholder="Example : IPK" class="form-control" value="<?php echo ucwords(str_replace('-',' ',$sk->kriteria)) ?>">
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
                                                        <input type="text" name="bobot" placeholder="Example : 40%" class="form-control" value="<?php echo $sk->bobot ?>">
                                                        <?php echo form_error('bobot','<div class="text-small text-danger"></div>') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <a href="<?php echo base_url('kriteria') ?>" class="btn btn-light">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->