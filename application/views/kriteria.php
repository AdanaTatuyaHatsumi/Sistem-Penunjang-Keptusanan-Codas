<div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <?php echo $this->session->flashdata('pesan') ?>
                                    <h4 class="card-title">Daftar Kriteria</h4>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('kriteria/tambahKriteria') ?>">Tambah Kriteria</a>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Kriteria</th>
                                                    <th>Bobot</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach($kriteria as $k) : ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo strtoupper($k->kode) ?></td>
                                                    <td><?php echo ucwords(str_replace("-"," ",$k->kriteria)) ?></td>
                                                    <td><?php echo $k->bobot ?></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url('kriteria/editKriteria/'.$k->id) ?>">Edit</a>
                                                        <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('kriteria/deleteKriteria/'.$k->id) ?>">Delete</a>
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

                
                <!-- content-wrapper ends -->