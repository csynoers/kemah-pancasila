    <script type='text/javascript'>
        function refreshCaptcha(){
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
        }
    </script>
<?php 
    $address = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak=10");
    $email   = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak=7");
    $phone   = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak=8");
    $cs      = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak=13");
    $wa      = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak=14");
    $open    = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak=15");
?>
<!-- banner -->
    <div class="banner_w3lspvt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Contact Us</li>
        </ol>
    </div>
<!-- //banner -->
<!-- contact -->
    <div class="contact py-5" id="contact">
        <div class="container pb-xl-5 pb-lg-3">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="title-w3 text-bl mb-3 font-weight-bold">Kemah Pancasila</h3>
                    <?php 
                        $kontak = $database->select($fields="*", $table="kontak", $where_clause="ORDER BY id_kontak ASC", $fetch="all");
                        foreach ($kontak as $key => $vk) {
                            echo '
                                <p><address><b>'.$vk['nama'].'</b></address></p>
                                <p><address>'.$vk['judul'].'</address></p>
                            ';
                        }
                     ?>
                </div>
                <div class="col-lg-6 mt-lg-0 mt-5">
                    <h3 class="title-w3 text-bl mb-3 font-weight-bold">Leave Message to Us!</h3>
                    <!-- contact form grid -->
                    <div class="contact-top1">
                        <form action="send-messages" method="post" class="contact-wthree-do contact-form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            Full Name
                                        </label>
                                        <input class="form-control" type="text" placeholder="Full Name*" name="name" required="">
                                    </div>
                                    <div class="col-md-6 mt-md-0 mt-4">
                                        <label>
                                            Subject
                                        </label>
                                        <input class="form-control" type="text" placeholder="Subject*" required="" name="subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            Telephone
                                        </label>
                                        <input class="form-control" type="text" placeholder="Phone*" required="" name="phone">
                                    </div>
                                    <div class="col-md-6 mt-md-0 mt-4">
                                        <label>
                                            Email
                                        </label>
                                        <input class="form-control" type="email" placeholder="Email*" required="" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>
                                            Your message
                                        </label>
                                        <textarea placeholder="Add your Description here" name="message" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Captcha Code <span>*</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="jolib/captcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
                                                Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.<br/> 
                                            </div>
                                            <div class="col-md-6 mt-md-0 mt-4">
                                                <input id="captcha_code" name="captcha_code" class="form-control" type="text"  required="require" maxlength="6" placeholder="Captcha Code*" value="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-cont-w3 btn-block mt-4">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- //contact form grid ends here -->
                </div>
            </div>
        </div>
    </div>
    <!-- //contact-->
    <!-- map -->
    <?php 
        $map = $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul = 6", $fetch='');
    ?>
    <div class="w3l-map p-4">
        <iframe src="<?php echo $map['static_content']; ?>"></iframe>
    </div>
    <!-- //map -->