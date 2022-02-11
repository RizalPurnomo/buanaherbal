<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function menuBarang() {
        $('#modal-lg').modal('show');
    }

    function menuCustomer() {
        $('#modal-customer').modal('show');
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
        $("#id_pembelian_detail").val($("#" + id + " td")[1].innerHTML);
        $("#nama_barang").val($("#" + id + " td")[2].innerHTML);
        $("#satuan").val($("#" + id + " td")[5].innerHTML);
        $("#id_barang").val($("#" + id + " td")[6].innerHTML);
        $('#modal-lg').modal('hide');
    }

    function tambah() {
        if ($("#id_barang").val() == "" || $("#qty").val() == "" || $("#harga").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }
        getMaxIdPenjualan();

        id_barang = $("#id_barang").val();
        id_pembelian_detail = $("#id_pembelian_detail").val();
        nama_barang = $("#nama_barang").val();
        qty = $("#qty").val();
        harga = $("#harga").val();
        $("#vbarang tbody").append(
            `<tr>
                <td>${id_barang}</td>
                <td>${id_pembelian_detail}</td>
                <td>${nama_barang}</td>
                <td align="right">${numberWithCommas(qty)}</td>
                <td align="right">${numberWithCommas(harga)}</td>
                <td align="right">${numberWithCommas(qty*harga)}</td>
            </tr>`
        );
        $("#id_barang").val("");
        $("#id_pembelian_detail").val("");
        $("#nama_barang").val("");
        $("#qty").val("");
        $("#harga").val("");

    }

    function simpanCustomer() {
        if ($("#nama2").val() == "" || $("#alamat2").val() == "" || $("#tlp2").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "customer": {
                "nama_customer": $("#nama2").val(),
                "alamat": $("#alamat2").val(),
                "tlp": $("#tlp2").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('customer/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })
                window.location = "<?php echo base_url(); ?>penjualan/add";
            }
        })
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
        var datadetailpembelian = new Array();
        for (var i = 0; i < row.length; i++) {
            var col = $(row[i]).find("td");
            datadetail.push({
                "id_penjualan": $("#id_penjualan").val(),
                "id_pembelian_detail": col[1].innerHTML,
                "id_barang": col[0].innerHTML,
                "qty_keluar": col[3].innerHTML.replace(',', ''),
                "harga_jual": col[4].innerHTML.replace(',', ''),
            });
            datadetailpembelian.push({
                "id_pembelian_detail": col[1].innerHTML,
                "qty_keluars": col[3].innerHTML.replace(',', '')
            });
        }

        let dataArray = {
            "penjualan": {
                "id_penjualan": $("#id_penjualan").val(),
                "id_user": $("#id_user").val(),
                "tgl_penjualan": $("#tgl_penjualan").val(),
                "id_customer": $("#customer").val(),
                "keterangan": $("#ket").val()
            },
            "penjualan_detail": datadetail,
            "pembelian_detail": datadetailpembelian

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
                            <input type="hidden" class="form-control" id="id_penjualan" disabled placeholder="ID Penjualan">
                            <label for="barcode" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo date("Y-m-d") ?>" id="tgl_penjualan" name="tgl_penjualan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="customer">
                                    <option value="">-- Pilih Customer --</option>
                                    <?php for ($a = 0; $a < count($customer); $a++) {  ?>
                                        <option value="<?php echo $customer[$a]['id_customer'] ?>">
                                            <?php echo $customer[$a]['nama_customer'] . ' | ' . $customer[$a]['alamat'];  ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <button onclick="menuCustomer()" class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i></button>
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
                            <div class="col-sm-10">
                                <div class="input-group input-group">
                                    <input type="text" class="form-control" id="id_barang" name="ket" placeholder="Id Barang" disabled>
                                    <span class="input-group-append">
                                        <button onclick="menuBarang()" class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i></button>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id_pembelian_detail" name="id_pembelian_detail" placeholder="Id Pembelian Detail" disabled>
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
                                        <th>Id Pembelian</th>
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
                                        <!-- <th>No </th> -->
                                        <th>Action</th>
                                        <th>Id Pembelian</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Stock</th>
                                        <th>Satuan</th>
                                        <th>Id Barang</th>
                                        <th>Tgl Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($barang)) {
                                        for ($a = 0; $a < count($barang); $a++) { ?>
                                            <?php $idbarang = $barang[$a]['id_pembelian_detail']; ?>
                                            <tr id="barang<?php echo $idbarang; ?>">
                                                <!-- <td><?php echo $a + 1 ?></td> -->
                                                <td>
                                                    <a class="btn btn-large btn-primary" href="javascript:pilihBarang('barang<?php echo $barang[$a]['id_pembelian_detail']; ?>')"><i class="fas fa-plus-circle"></i></a>
                                                </td>
                                                <td><?php echo $idbarang ?></td>
                                                <td><?php echo $barang[$a]['nama_barang'] ?></td>
                                                <td><?php echo $barang[$a]['kategori'] ?></td>
                                                <td><?php echo $barang[$a]['stocks'] ?></td>
                                                <td><?php echo $barang[$a]['satuan'] ?></td>
                                                <td><?php echo $barang[$a]['id_barang'] ?></td>
                                                <td><?php echo $barang[$a]['tgl_pembelian'] ?></td>
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

<div class="modal fade" id="modal-customer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Customer</h4>
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
                        Customer
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama2" name="nama2" placeholder="Nama Customer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat2" name="alamat2" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tlp" class="col-sm-2 col-form-label">Telpon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tlp2" name="tlp2" placeholder="Telpon">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary float-right" onclick="simpanCustomer()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('vfooter'); ?>