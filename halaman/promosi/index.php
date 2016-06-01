<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    include '../../koneksi/koneksi.php';
    include '../../asset/login/check_login_pelanggan.php';
    include '../navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Promosi</title>

	<!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/bootstrap/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	   
    <!-- include Navigation -->
    <?php     
        Navbar(); 
    ?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <!-- GET NAMA FILE PROMOSI -->
            <?php
            $sql = "SELECT url FROM promosi WHERE status='Y' LIMIT 3";                           
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $stmt->bind_result($url);
            $no = 1;
            while ($stmt->fetch()) {
                if ($no == 1) {
                   ?>
                    <div class="item active">
                        <div class="fill" style="background-image:url('../../asset/gambar/promosi/<?php echo $url; ?>');"></div>
                        <div class="carousel-caption">
                            <h2></h2>
                        </div>
                    </div>
                   <?php
                }else if ($no > 1) {
                    ?>
                    <div class="item">
                        <div class="fill" style="background-image:url('../../asset/gambar/promosi/<?php echo $url; ?>');"></div>
                        <div class="carousel-caption">
                            <h2></h2>
                        </div>
                    </div>
                    <?php
                }else{ ?>
                    <div class="item active">
                        <div class="fill" style="background-image:url('../../asset/gambar/promosi/default.jpg');"></div>
                        <div class="carousel-caption">
                            <h2></h2>
                        </div>
                    </div>
                   <?php
                }
                $no++;
            } ?>    
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Informasi Promosi -->
        <div class="row">
            <div class="col-lg-12">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="service-one">
                        <h4>Informasi Promosi</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae repudiandae fugiat illo cupiditate excepturi esse officiis consectetur, laudantium qui voluptatem. Ad necessitatibus velit, accusantium expedita debitis impedit rerum totam id. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus quibusdam recusandae illum, nesciunt, architecto, saepe facere, voluptas eum incidunt dolores magni itaque autem neque velit in. At quia quaerat asperiores.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae repudiandae fugiat illo cupiditate excepturi esse officiis consectetur, laudantium qui voluptatem. Ad necessitatibus velit, accusantium expedita debitis impedit rerum totam id. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus quibusdam recusandae illum, nesciunt, architecto, saepe facere, voluptas eum incidunt dolores magni itaque autem neque velit in. At quia quaerat asperiores.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; LumpurMas 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../bootstrap/bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
</body>
</html>
