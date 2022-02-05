<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function menuBarang() {
        $('#modal-lg').modal('show');
    }

    function getMaxIdPenjualan() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('penjualan/getMaxIdPenjualan'); ?>',
            success: function(result) {
                console.log(result);
                $("#id_penjualan").val(result)
            }
        })
    }

    function pilihBarang(id) {
        $("#id_barang").val($("#" + id + " td")[2].innerHTML);
        $("#nama_barang").val($("#" + id + " td")[3].innerHTML);
        $("#satuan").val($("#" + id + " td")[6].innerHTML);
        $('#modal-lg').modal('hide');
    }

    function tambah() {
        if ($("#id_barang").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }
        getMaxIdPenjualan();

        id_barang = $("#id_barang").val();
        nama_barang = $("#nama_barang").val();
        qty = $("#qty").val();
        harga = $("#harga").val();
        $("#vbarang tbody").append(
            `<tr>
                <td>${id_barang}</td>
                <td>${nama_barang}</td>
                <td align="right">${numberWithCommas(qty)}</td>
                <td align="right">${numberWithCommas(harga)}</td>
                <td align="right">${numberWithCommas(qty*harga)}</td>
            </tr>`
        );
        $("#id_barang").val("");
        $("#nama_barang").val("");
        $("#qty").val("");
        $("#harga").val("");

    }

    function simpan() {

        if ($("#id_user").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Session habis, Harap logout dan login kembali',
            })
            return;
        }
        if ($("#vbarang tbody tr").length < 1 || $("#tgl_pembelian").val() == "" || $("#suplier").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var row = $("#vbarang tbody tr");
        var jml = 0;
        var datadetail = new Array();
        for (var i = 0; i < row.length; i++) {
            var col = $(row[i]).find("td");
            datadetail.push({
                "id_penjualan": $("#id_penjualan").val(),
                "id_barang": col[0].innerHTML,
                "qty_masuk": col[2].innerHTML.replace(',', ''),
                "qty_keluars": '',
                "harga_beli": col[3].innerHTML.replace(',', ''),
            });
        }

        let dataArray = {
            "penjualan": {
                "id_pembelian": $("#id_pembelian").val(),
                "id_user": $("#id_user").val(),
                "tgl_pembelian": $("#tgl_pembelian").val(),
                "id_suplier": $("#suplier").val(),
                "keterangan": $("#ket").val()
            },
            "penjualan_detail": datadetail

        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('penjualan/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>penjualan";
            }
        })

    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>barang">Penjualan</a></li>
                        <li class="breadcrumb-item active">Tambah Penjualan</li>
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
            <div class="card">
                <div class="card-header">
                    Tambah Penjualan
                </div>
                <div class="card-body">
                    <!-- <form class="form-horizontal"> -->
                    <div class="card-body">
                        <div class="form-group row">
                            <input type="hidden" class="form-control" id="id_user" value="<?php echo $this->session->userdata('id_user'); ?>" disabled placeholder="ID User">
                            <input type="hidden" class="form-control" id="id_pembelian" disabled placeholder="ID Pembelian">
                            <label for="barcode" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo date("Y-m-d") ?>" id="tgl_pembelian" name="tgl_pembelian">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" id="customer">
                                    <option value="">-- Pilih Customer --</option>
                                    <?php for ($a = 0; $a < count($customer); $a++) {  ?>
                                        <option value="<?php echo $customer[$a]['id_customer'] ?>">
                                            <?php echo $customer[$a]['nama_customer'] . ' | ' . $customer[$a]['alamat'];  ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan">
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ID Barang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_barang" name="ket" placeholder="Id Barang" disabled>
                            </div>
                            <div class="col-sm-1">
                                <button onclick="menuBarang()" class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label">Qty</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Qty">
                            </div>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label">Harga Jual</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button onclick="tambah()" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="vbarang" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stock</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pembayaran</label>
                        <div class="col-sm-10">
                            <select class="form-control" style="width: 100%;" id="pembayaran">
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                    </div>


                    <div class="card-footer">
                        <button onclick="simpan()" class="btn btn-primary">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                    <!-- </form> -->
                </div>
            </div>
            <!-- </div> -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-header">
                        <!-- <button type="button" class="btn btn-app" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                            <i class="fa fa-plus-square" aria-hidden="true"></i> Tambah
                        </button> -->
                        Pilih Barang Barang
                    </div>
                    <div class="card-body">
                        <div class="box-body table-responsive">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Action</th>
                                        <th>Id Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Stock</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($barang)) {
                                        for ($a = 0; $a < count($barang); $a++) { ?>
                                            <?php $idbarang = $barang[$a]['id_barang']; ?>
                                            <tr id="barang<?php echo $idbarang; ?>">
                                                <td><?php echo $a + 1 ?></td>
                                                <td>
                                                    <a class="btn btn-large btn-primary" href="javascript:pilihBarang('barang<?php echo $barang[$a]['id_barang']; ?>')">Pilih</a>
                                                </td>
                                                <td><?php echo $idbarang ?></td>
                                                <td><?php echo $barang[$a]['nama_barang'] ?></td>
                                                <td><?php echo $barang[$a]['kategori'] ?></td>
                                                <td><?php echo $barang[$a]['stock'] ?></td>
                                                <td><?php echo $barang[$a]['satuan'] ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('vfooter'); ?>