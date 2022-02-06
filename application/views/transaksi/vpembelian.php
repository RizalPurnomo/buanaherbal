<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>pembelian/edit/" + idData;
                window.location.href = url;
            }
        });
    }

    function deleteData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        Swal.fire({
            title: 'Apakah yakin data akan di hapus?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>pembelian/delete/" + idData,
                    success: function(html) {
                        console.log(html);
                        var url = "<?php echo base_url(); ?>pembelian/";
                        window.location.href = url;
                    }
                })
            } else {
                return;
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
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title">DataTable with default features</h3> -->
                    <a href="<?php echo base_url(); ?>pembelian/add" class="btn btn-app">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Id pembelian</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Create By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pembelian)) {
                                    for ($a = 0; $a < count($pembelian); $a++) { ?>
                                        <?php $idpembelian = $pembelian[$a]['id_pembelian']; ?>
                                        <tr id="pembelian<?php echo $idpembelian; ?>">
                                            <td><?php echo $a + 1 ?></td>
                                            <td><?php echo $idpembelian ?></td>
                                            <td><?php echo $pembelian[$a]['tgl_pembelian'] ?></td>
                                            <td><?php echo $pembelian[$a]['nama_suplier'] ?></td>
                                            <td><?php echo $pembelian[$a]['real_name'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <a class="btn btn-large btn-primary" href="javascript:selectData('pembelian<?php echo $pembelian[$a]['id_pembelian']; ?>')"><i class="fas fa-edit"></i></a>
                                                    | <a class="btn btn-large btn-danger" href="javascript:deleteData('pembelian<?php echo $pembelian[$a]['id_pembelian']; ?>')"><i class="fas fa-trash-alt"></i></a>

                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- </div> -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('vfooter'); ?>