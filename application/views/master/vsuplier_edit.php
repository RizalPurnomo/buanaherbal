<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function update() {
        if ($("#nama").val() == "" || $("#alamat").val() == "" || $("#tlp").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "suplier": {
                "nama_suplier": $("#nama").val(),
                "alamat": $("#alamat").val(),
                "tlp": $("#tlp").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('suplier/updateData/'); ?>' + $("#id_suplier").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Diupdate',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>suplier";
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
                    <h1 class="m-0">Tambah Suplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>suplier">Suplier</a></li>
                        <li class="breadcrumb-item active">Tambah Suplier</li>
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
                    Tambah Suplier
                </div>
                <div class="card-body">
                    <!-- <form class="form-horizontal"> -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id_suplier" class="col-sm-2 col-form-label">Id Suplier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_suplier" name="id_suplier" placeholder="Id Suplier" value="<?php echo $suplier[0]['id_suplier']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Suplier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Suplier" value="<?php echo $suplier[0]['nama_suplier']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?php echo $suplier[0]['alamat']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tlp" class="col-sm-2 col-form-label">Telpon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Telpon" value="<?php echo $suplier[0]['tlp']; ?>">
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