<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>user/edit/" + idData;
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
                    url: "<?php echo base_url(); ?>user/delete/" + idData,
                    success: function(html) {
                        console.log(html);
                        var url = "<?php echo base_url(); ?>user/";
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
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                    <a href="<?php echo base_url(); ?>user/add" class="btn btn-app">
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
                                    <th>Id User</th>
                                    <th>Username</th>
                                    <th>Realname</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($user)) {
                                    for ($a = 0; $a < count($user); $a++) { ?>
                                        <?php $iduser = $user[$a]['id_user']; ?>
                                        <tr id="user<?php echo $iduser; ?>">
                                            <td><?php echo $a + 1 ?></td>
                                            <td><?php echo $iduser ?></td>
                                            <td><?php echo $user[$a]['username'] ?></td>
                                            <td><?php echo $user[$a]['real_name'] ?></td>
                                            <td><?php echo $user[$a]['last_login'] ?></td>

                                            <td>
                                                <div class="text-center">
                                                    <a class="btn btn-large btn-primary" href="javascript:selectData('user<?php echo $user[$a]['id_user']; ?>')"><i class="fas fa-edit"></i></a>
                                                    | <a class="btn btn-large btn-danger" href="javascript:deleteData('user<?php echo $user[$a]['id_user']; ?>')"><i class="fas fa-trash-alt"></i></a>

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