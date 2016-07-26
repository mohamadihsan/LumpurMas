<?php
function Navbar() {
	?>
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../../">Lumpur Mas</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- MENU PRODUK -->
                            <li>
                                <a href="../produk/">Produk</a>
                            </li>
                            <!-- MENU PROMO -->
                            <li>
                                <a href="../promosi/">Promo</a>
                            </li>
                            <!-- MENU PEMESANAN -->
                            <li>
                                <a href="../pemesanan/">Pemesanan</a>
                            </li>
                            <!-- MENU KELUHAN SARAN -->
                            <li>
                                <a href="../keluhan_saran/">Keluhan Saran</a>
                            </li>
                            <!-- LOGIN -->
                            <?php
                                if (!empty($_SESSION['username']) AND !empty($_SESSION['id_user'])) {
		                          ?>
                                    <!-- MENU KOTAK INFORMASI -->
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Kotak Informasi
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="../info_pemesanan/">Info Pemesanan</a>
                                            </li>
                                            <li>
                                                <a href="../info_keluhan/">Info Keluhan</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <?php echo "Selamat datang," . $_SESSION['nama']; ?>
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="../../asset/profil_pelanggan/">Pengaturan Akun</a>
                                            </li>
                                            <li>
                                                <a href="../../asset/logout/">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                    } else {
                                    		?>
                                    <li>
                                        <a href="../../asset/login/">Login</a>
                                    </li>
                                    <?php
                                }
	                        ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
        <?php
}
?>
