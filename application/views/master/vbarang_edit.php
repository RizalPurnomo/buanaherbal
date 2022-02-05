<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function update() {
        if ($("#namaBarang").val() == "" || $("#kategori").val() == "" || $("#stock").val() == "" || $("#satuan").val() == "" || $("#harga").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "barang": {
                "nama_barang": $("#namaBarang").val(),
                "barcode": $("#barcode").val(),
                "kategori": $("#kategori").val(),
                "stock": $("#stock").val().replace(',', ''),
                "satuan": $("#satuan").val(),
                "harga_juals": $("#harga").val().replace(',', '')
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('barang/updateData/'); ?>' + $("#idBarang").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Diupdate',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>barang";
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
                    <h1 class="m-0">Update Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>barang">Barang</a></li>
                        <li class="breadcrumb-item active">Update Barang</li>
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
                    Update Barang
                </div>
                <div class="card-body">
                    <!-- <form class="form-horizontal"> -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="idBarang" class="col-sm-2 col-form-label">Id Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="idBarang" name="idBarang" placeholder="Nama Barang" value="<?php echo $barang[0]['id_barang']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Nama Barang" value="<?php echo $barang[0]['nama_barang']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" value="<?php echo $barang[0]['barcode']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori" value="<?php echo $barang[0]['kategori']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?php echo number_format($barang[0]['stock']); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="<?php echo $barang[0]['satuan']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga Jual</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Jual" value="<?php echo number_format($barang[0]['harga_juals']); ?>">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button onclick="update()" class="btn btn-info">Update</button>
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

<?php $this->load->view('vfooter'); ?>