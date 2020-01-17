<!-- main banner -->
    <div class="main-top" id="home">
        <!-- header -->
        <header>
            <div class="container-fluid">
                <div class="header d-lg-flex justify-content-between align-items-center py-3 px-sm-3">
                    <!-- logo -->
                    <div id="logo">
                        <a href="home"><img src="images/logo.png"></a>
                    </div>
                    <!-- //logo -->
                    <!-- nav -->
                    <div class="nav_w3ls">
                        <nav>
                            <label for="drop" class="toggle">Menu</label>

                            <input type="checkbox" id="drop" />
                            <ul class="menu">
                                <li><a href="home" <?php echo $aktif = ($_GET['mod'] == 'home') ? 'class="active"' : '' ; ?>>Home</a></li>
                                <li>
                                    <!-- First Tier Drop Down -->
                                    <label for="drop-2" class="toggle toogle-2">Profil <span class="fa fa-angle-down" aria-hidden="true"></span>
                                    </label>
                                    <a href="#" <?php echo $aktif = (($_GET['mod'] == 'about') || ($_GET['mod'] == 'trainer') || ($_GET['mod'] == 'fasilitas')) ? 'class="active"' : '' ; ?>>Profil <span class="fa fa-angle-down" aria-hidden="true"></span></a>
                                    <input type="checkbox" id="drop-2" />
                                    <ul>
                                        <li><a href="kemah-pancasila" <?php echo $aktif = ($_GET['mod'] == 'about') ? 'class="drop-text active"' : 'drop-text' ; ?>>Kemah Pancasila</a></li>
                                        <li><a href="trainer" <?php echo $aktif = ($_GET['mod'] == 'trainer') ? 'class="drop-text active"' : 'drop-text' ; ?>>Trainer</a></li>
                                        <li><a href="fasilitator" <?php echo $aktif = ($_GET['mod'] == 'fasilitator') ? 'class="drop-text active"' : 'drop-text' ; ?>>Fasilitator</a></li>
                                    </ul>
                                </li>
                                <li><a href="program" <?php echo $aktif = ($_GET['mod'] == 'program') ? 'class="active"' : '' ; ?>>Program</a></li>                                
                                <li><a href="berita" <?php echo $aktif = ($_GET['mod'] == 'news') ? 'class="active"' : '' ; ?>>Berita</a></li>                                
                                <li><a href="galeri" <?php echo $aktif = ($_GET['mod'] == 'gallery') ? 'class="active"' : '' ; ?>>Galeri</a></li>
                                <li><a href="agenda" <?php echo $aktif = ($_GET['mod'] == 'agenda') ? 'class="active"' : '' ; ?>>Agenda</a></li>                                
                                <li><a href="home#penyelenggara" <?php echo $aktif = ($_GET['mod'] == 'penyelenggara') ? 'class="active"' : '' ; ?>>Penyelenggara</a></li>                                
                                <li><a href="testimoni">Testimoni</a></li>
                                <li><a href="sosmed">Sosial Media</a></li>


                                <!-- <li><a href="about" <?php echo $aktif = ($_GET['mod'] == 'about') ? 'class="active"' : '' ; ?>>About Us</a></li> -->
                                <!-- <li><a href="contact" <?php echo $aktif = ($_GET['mod'] == 'contact') ? 'class="active"' : '' ; ?>>Contact Us</a></li> -->
                            </ul>
                        </nav>
                    </div>
                    <!-- //nav -->
                    <div class="d-flex mt-lg-1 mt-sm-2 mt-3 justify-content-center">
                        
                    </div>
                </div>
            </div>
        </header>
        <!-- //header -->
    </div>
<!-- //main banner -->
