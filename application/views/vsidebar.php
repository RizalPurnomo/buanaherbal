<?php
$master = ($this->uri->segment(1) == 'user'  || $this->uri->segment(1) == 'customer' || $this->uri->segment(1) == 'barang' || $this->uri->segment(1) == 'suplier' ? 'menu-open' : '');
$user = ($this->uri->segment(1) == 'user' ? 'active' : '');
$dashboard = ($this->uri->segment(1) == 'dashboard' ? 'active' : '');
$customer = ($this->uri->segment(1) == 'customer' ? 'active' : '');
$suplier = ($this->uri->segment(1) == 'suplier' ? 'active' : '');
$barang = ($this->uri->segment(1) == 'barang' ? 'active' : '');
$pembelian = ($this->uri->segment(1) == 'pembelian' ? 'active' : '');
$penjualan = ($this->uri->segment(1) == 'penjualan' ? 'active' : '');
?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BuanaHerbal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('real_name'); ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>dashboard" class="nav-link <?php echo $dashboard; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item <?php echo $master; ?>">
                    <a href="#" class="nav-link">
                        <i class="fa fa-server" aria-hidden="true"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>barang" class="nav-link <?php echo $barang; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>suplier" class="nav-link <?php echo $suplier; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>customer" class="nav-link <?php echo $customer; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>user" class="nav-link <?php echo $user; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>pembelian" class="nav-link <?php echo $pembelian; ?>">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        <p>
                            Pembelian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>penjualan" class="nav-link <?php echo $penjualan; ?>">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>