<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script type="text/javascript">
    function getDetail(id) {
        let no = $("#" + id + " td")[1].innerHTML;
        let id_pembelian = $("#" + id + " td")[2].innerHTML;

        $.ajax({
            type: "POST",
            data: {
                "id_penjualan": id_pembelian
            },
            url: "<?php echo base_url(); ?>penjualan/getPenjualanDetail/",
            success: function(data) {
                myObj = JSON.parse(data);
                objPenjualan = myObj['penjualan'];
                console.log(data);
                console.log(myObj);
                var txt = "";
                for (x in objPenjualan) {

                    txt += `	
                            <tr id="penjualan${no}${parseInt(x) + parseInt(1)}" data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                <td>${parseInt(x) + parseInt(1)}</td>    
                                <td>${objPenjualan[x].id_barang}</td>
                                <td>${objPenjualan[x].nama_barang}</td>
                                <td>${objPenjualan[x].kategori}</td>
                                <td>${objPenjualan[x].qty_keluar}</td>
                            </tr>						
                             `;
                }
                document.getElementById("detail" + no).innerHTML = txt;

            }
        })
    }

    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>penjualan/edit/" + idData;
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
                    url: "<?php echo base_url(); ?>penjualan/delete/" + idData,
                    success: function(html) {
                        console.log(html);
                        var url = "<?php echo base_url(); ?>penjualan/";
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
                    <h1 class="m-0">Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Penjualan</li>
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
                    <a href="<?php echo base_url(); ?>penjualan/add" class="btn btn-app">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No </th>
                                    <th>Id Penjualan</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Create By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($penjualan)) {
                                    for ($a = 0; $a < count($penjualan); $a++) { ?>
                                        <?php $idpenjualan = $penjualan[$a]['id_penjualan']; ?>
                                        <tr id="penjualan<?php echo $a + 1; ?>" data-toggle="collapse" data-target="#demo<?php echo $a + 1; ?>" class="accordion-toggle info">
                                            <td><button class="btn btn-default btn-xs" onclick="getDetail('penjualan<?php echo $a + 1; ?>')"><span class="fas fa-eye"></span></button></td>
                                            <td><?php echo $a + 1 ?></td>
                                            <td><?php echo $idpenjualan ?></td>
                                            <td><?php echo $penjualan[$a]['tgl_penjualan'] ?></td>
                                            <td><?php echo $penjualan[$a]['nama_customer'] ?></td>
                                            <td><?php echo $penjualan[$a]['real_name'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <a class="btn btn-large btn-primary" href="javascript:selectData('penjualan<?php echo $penjualan[$a]['id_penjualan']; ?>')">Edit</a>
                                                    | <a class="btn btn-large btn-danger" href="javascript:deleteData('penjualan<?php echo $penjualan[$a]['id_penjualan']; ?>')">Delete</a>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="hiddenRow">
                                                <div class="accordian-body collapse" id="demo<?php echo $a + 1; ?>">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr class="info">
                                                                <th>No</th>
                                                                <th>Id Barang</th>
                                                                <th>Nama</th>
                                                                <th>Kategori</th>
                                                                <th>Qty Jual</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="detail<?php echo $a + 1; ?>">


                                                        </tbody>
                                                    </table>

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