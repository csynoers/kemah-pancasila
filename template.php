<!DOCTYPE html>
<html lang="zxx">
	<?php 
        // Statistik user
        $ip      = $_SERVER['REMOTE_ADDR'].""; // Mendapatkan IP komputer user
        $tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu   = time(); //
        // Mengecek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini
        $statistik     = $database->count_rows($table="statistik", $count_where_clause="WHERE ip = '$ip' AND tanggal='$tanggal'");

        // Kalau belum ada, simpan data user tersebut ke database
        if($statistik == 0){
            $form_data = array(
                "ip"        => "$ip",
                "tanggal"   => "$tanggal",
                "hits"      => "1",
                "online"    => "$waktu"
            );
            $database->insert($table="statistik", $array=$form_data);
        }
        // Jika sudah ada, update
        else{
            $cek_stat = $database->select($fields="ip, hits, tanggal", $table="statistik", $where_clause="WHERE ip = '$ip' AND tanggal = '$tanggal'", $fetch='');
            if($tanggal == $cek_stat['tanggal'] && $ip = $cek_stat['ip']) {
                $hits   = $cek_stat['hits'] + 1;

                $form_data = array(
                    "hits"      => "$hits",
                    "online"    => "$waktu"
                );
                $database->update($table="statistik", $array=$form_data, $fields_key="ip", $id="$ip");
            }
        }
        $pengunjung       = $database->count_rows($table="statistik", $where_clause="WHERE tanggal='$tanggal'");
        $totalpengunjung  = $database->select($fields="COUNT(hits)", $table="statistik", $where_clause="", $fetch="");
        $hits             = $database->select($fields="SUM(hits)", $table="statistik", $where_clause="WHERE tanggal='$tanggal'", $fetch="");
        $totalhits        = $database->select($fields="SUM(hits)", $table="statistik", $where_clause="", $fetch="");

        $deskripsi  = $database->select($fields="static_content",$table="modul", $where_clause="WHERE id_modul = '3'", $fetch="");
        $keywords   = $database->select($fields="static_content",$table="modul", $where_clause="WHERE id_modul = '2'", $fetch="");
        $title      = $database->select($fields="static_content",$table="modul", $where_clause="WHERE id_modul = '1'", $fetch="");
        switch ($_GET['mod']) {
            case 'home':
                $judul = "Home | ".$title['static_content'];
                break;
            case 'about':
                $judul = "About Us | ".$title['static_content'];
                break;
            case 'contact-us':
                $judul = "Contact Us | ".$title['static_content'];
                break;
            case 'allclient':
                $judul = "Client | ".$title['static_content'];
                break;
            case 'client_category' :
                $judul = ucwords(str_replace('-', ' ', $_GET['seo']))." | ".$title['static_content'];
                break;
            case 'news':
                $judul = "News | ".$title['static_content'];
                break;
            case 'news_category':
                $judul = ucwords(str_replace('-', ' ', $_GET['seo']))." | ".$title['static_content'];
                break;
            case 'news_detail':
                $judul = ucwords(str_replace('-', ' ', $_GET['seo']))." | ".$title['static_content'];
                break;
            case 'preschool':
                $judul = "Preschool in English | ".$title['static_content'];
                break;
            case 'full-day':
                $judul = "Full Day School | ".$title['static_content'];
                break;
            case 'kindergarten':
                $judul = "Kindergarten in English | ".$title['static_content'];
                break;
            case 'bilingual-primary':
                $judul = "Bilingual Primary School | ".$title['static_content'];
                break;
            case 'english-course':
                $judul = "English Course | ".$title['static_content'];
                break;
            case 'staff':
                $judul = "Staff | ".$title['static_content'];
                break;
            case 'search':
                $judul = "Search | ".$title['static_content'];
                break; 
            default:
                $judul = $title['static_content'];
                break;
        }
     ?>

<head>
	<title><?php echo $judul; ?></title>
	<script>
		
	</script>
	<!-- //Meta tag Keywords -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?php echo $deskripsi['static_content']; ?>">
    <meta name="keywords" content="<?php echo $keywords['static_content']; ?>">
    <meta name="author" content="mastopp" />

	<!-- Custom-Files -->
    <link rel="shortcut icon" type="image/png" href="images/icon.png">
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <!-- <link href="css/owl.theme.default.min.css" rel="stylesheet" > -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css" type="text/css">


	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext"
	 rel="stylesheet">
    <!-- //Web-Fonts -->
    <script src="js/jquery.min.js"></script>
</head>

<body>
	<?php include 'joinc/header.php'; ?>
	<?php include 'joinc/contents.php'; ?>
	

<?php include 'joinc/footer.php'; ?>


<script src="js/owl.carousel.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<?= ($_GET['mod']=='sosmed') ? NULL : '<script src="js/jquery.isotope.min.js"></script>' ; ?>
<script src="js/main.js"></script>

<?php $kontak_wa = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak='14'");?>
<script type="text/javascript">
    // !function(a){var b=/iPhone/i,c=/iPod/i,d=/iPad/i,e=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,f=/Android/i,g=/(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,h=/(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,i=/IEMobile/i,j=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,k=/BlackBerry/i,l=/BB10/i,m=/Opera Mini/i,n=/(CriOS|Chrome)(?=.*\bMobile\b)/i,o=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,p=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),q=function(a,b){return a.test(b)},r=function(a){var r=a||navigator.userAgent,s=r.split("[FBAN");return"undefined"!=typeof s[1]&&(r=s[0]),s=r.split("Twitter"),"undefined"!=typeof s[1]&&(r=s[0]),this.apple={phone:q(b,r),ipod:q(c,r),tablet:!q(b,r)&&q(d,r),device:q(b,r)||q(c,r)||q(d,r)},this.amazon={phone:q(g,r),tablet:!q(g,r)&&q(h,r),device:q(g,r)||q(h,r)},this.android={phone:q(g,r)||q(e,r),tablet:!q(g,r)&&!q(e,r)&&(q(h,r)||q(f,r)),device:q(g,r)||q(h,r)||q(e,r)||q(f,r)},this.windows={phone:q(i,r),tablet:q(j,r),device:q(i,r)||q(j,r)},this.other={blackberry:q(k,r),blackberry10:q(l,r),opera:q(m,r),firefox:q(o,r),chrome:q(n,r),device:q(k,r)||q(l,r)||q(m,r)||q(o,r)||q(n,r)},this.seven_inch=q(p,r),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},s=function(){var a=new r;return a.Class=r,a};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=r:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=s():"function"==typeof define&&define.amd?define("isMobile",[],a.isMobile=s()):a.isMobile=s()}(this);
    // no_mobile=<?php echo json_encode(hp($kontak_wa['judul'])); ?>;
    // message_wa='Halo%20Tirta%20Jaya%20,%20mohon%20info%20pemesanan';
    // if(isMobile.any) {
    //     $('#wa_message, #wa-live').attr('href','https://wa.me/'+no_mobile+'?text='+message_wa);

    // }else{
    //     $('#wa_message, #wa-live').attr('href','https://web.whatsapp.com/send?phone='+no_mobile+'&text='+message_wa);

    // }
</script>

<script type="text/javascript">
    (function(j){
        j('body').append("</bo"+"dy>");
    })(jQuery)
</script>

</html>