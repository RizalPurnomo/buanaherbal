<?php $this->load->view('vheader'); ?>
<?php $this->load->view('vsidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    async function resetPassword() {
        const {
            value: password
        } = await Swal.fire({
            title: 'Reset Password',
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Reset Password',
            inputAttributes: {
                maxlength: 100,
                autocapitalize: 'off',
                autocorrect: 'off'
            }
        })

        if (password) {
            var dataArray = {
                "user": {
                    "password": CryptoJS.MD5(password).toString()
                }
            }

            console.log(dataArray);
            // return;
            $.ajax({
                type: "POST",
                data: dataArray,
                url: '<?php echo base_url('user/resetPassword/'); ?>' + $("#iduser").val(),
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password berhasil di RESET',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(result);
                }
            })
        }
    }

    function update() {
        if ($("#username").val() == "" || $("#realname").val() == "" || $("#password").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "user": {
                "username": $("#username").val(),
                "real_name": $("#realname").val(),
                "password": $("#password").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('user/updateData/'); ?>' + $("#iduser").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>user";
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
                    <h1 class="m-0">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>barang">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                    Edit User
                </div>
                <div class="card-body">
                    <!-- <form class="form-horizontal"> -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="iduser" class="col-sm-2 col-form-label">Id User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="iduser" name="iduser" placeholder="Id User" value="<?php echo $user[0]['id_user']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $user[0]['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <button type="button" class="col-sm-6 btn btn-block btn-primary" onclick="resetPassword()">Ganti Password</button>
                                <!-- <input type="password" class="form-control" id="password" value="<?php echo $user[0]['password']; ?>" placeholder="Password"> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="realname" class="col-sm-2 col-form-label">Realname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="realname" name="realname" placeholder="Realname" value="<?php echo $user[0]['real_name']; ?>">
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