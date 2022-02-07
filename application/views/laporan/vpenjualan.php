<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">

</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembelian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pembelian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- <div class="row"> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan Penjualan
                            <div class="card-tools">
                                <a href="<?php echo base_url('report/printPenjualan') ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label">Tanggal</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>

                                        <input type="text" class="form-control pull-right" name="datepicker" id="datepicker" value="<?php echo date("m/d/Y", strtotime($tglAwal)); ?>"> <!-- date("m/d/Y") -->
                                    </div>
                                </div>
                                s/d
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control pull-right" name="datepicker2" id="datepicker2" value="<?php echo date("m/d/Y", strtotime($tglAkhir)); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" name="proses" value="proses" class="btn btn-info pull-right">Proses</button>
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" name="proses" value="print" class="btn btn-info pull-right">Print</button>
                                </div>
                            </div>
                            <hr />
                            <?php
                            // $totalsBeli = 0;
                            // $totalsPendapatan = 0;
                            ?>
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">No</th>
                                            <th>Id Penjualan</th>
                                            <th>Tgl Penjualan</th>
                                            <th>Customer</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($penjualan)) {
                                            for ($a = 0; $a < count($penjualan); $a++) { ?>
                                                <?php $idpenjualan = $penjualan[$a]['id_penjualan']; ?>
                                                <tr id="penjualan<?php echo $idpenjualan; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $idpenjualan ?></td>
                                                    <td><?php echo $penjualan[$a]['tgl_penjualan'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama_customer'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama_barang'] ?></td>
                                                    <td align="right"><?php echo $penjualan[$a]['qty_keluar'] ?></td>
                                                    <td align="right"><?php echo number_format($penjualan[$a]['harga_jual']) ?></td>
                                                    <td align="right">
                                                        <?php
                                                        $subtotaljual =  $penjualan[$a]['qty_keluar'] * $penjualan[$a]['harga_jual'];
                                                        echo number_format($subtotaljual);
                                                        ?>
                                                    </td>
                                                    <?php
                                                    // $totalsBeli = $totalsBeli + $totalbeli;
                                                    // $totalsPendapatan = $totalsPendapatan + $pendapatan;
                                                    ?>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td align="right" colspan="11">TOTAL</td>
                                            <!-- <td align="right" style="background-color:#B9FFFF"><?php echo number_format($totalsBeli); ?></td>
                                            <td align="right" style="background-color:#A8FC9B"><?php echo number_format($totalsPendapatan); ?></td> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('vfooter'); ?>