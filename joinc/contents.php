<?php
#===================== MODUL CONTENTS : BEGIN =====================
#modul contents home
if($_GET['mod']=='home') {
	include "joinc/contents/home.php";
}

#modul staff
elseif ($_GET['mod'] == 'staff') {
	include "joinc/contents/staff.php";
}

#modul search
elseif ($_GET['mod'] == 'search') {
	include "joinc/contents/search.php";
}

#modul contents about_us
elseif($_GET['mod']=='about') {
	include "joinc/contents/about.php" ;
}

#modul contents how_to_order
elseif($_GET['mod']=='how_to_order') {
	include "joinc/contents/how_to_order.php" ;
}

#modul contents allproduct
elseif($_GET['mod']=='allproduct') {
	include "joinc/contents/product.php" ;
}

#modul contents product category
elseif($_GET['mod']=='product_category') {
	include "joinc/contents/product_category.php" ;
}

#modul contents sub product category
elseif($_GET['mod']=='sub_product_category') {
	include "joinc/contents/sub_product_category.php" ;
}

#modul contents sub product category
elseif($_GET['mod']=='detail_product') {
	include "joinc/contents/detail_product.php" ;
}

#modul contents client
elseif($_GET['mod']=='allclient') {
	include "joinc/contents/client.php" ;
}

#modul contents client category
elseif($_GET['mod']=='client_category') {
	include "joinc/contents/client_category.php" ;
}

#modul contents media partner
elseif($_GET['mod']=='media_partners') {
	include "joinc/contents/media_partners.php" ;
}
#modul contents news
elseif($_GET['mod']=='berita') {
	include "joinc/contents/news.php" ;
}

elseif($_GET['mod']=='berita_detail') {
	include "joinc/contents/news_detail.php" ;
}

#modul contents program
elseif($_GET['mod']=='program') {
	include "joinc/contents/program.php" ;
}

elseif($_GET['mod']=='program_detail') {
	include "joinc/contents/program_detail.php" ;
}

#modul contents news category
elseif($_GET['mod']=='news_category') {
	include "joinc/contents/news_category.php" ;
}

elseif($_GET['mod']=='download') {
	include "joinc/contents/download.php" ;
}

elseif($_GET['mod']=='catalog_by_category') {
	include "joinc/contents/catalog_by_category.php" ;
}

#modul contents contact_us
elseif($_GET['mod']=='contact') {
	include "joinc/contents/contact.php" ;
}

elseif($_GET['mod']=='messages-act') {
	include "joinc/contents/action/messages_act.php" ;
}

elseif($_GET['mod']=='enquiry-act') {
	include "joinc/contents/action/enquiry_act.php" ;
}
elseif($_GET['mod']=='gallery') {
	include "joinc/contents/gallery.php" ;
}
elseif($_GET['mod']=='fasilitas') {
	include "joinc/contents/fasilitas.php" ;
}
elseif($_GET['mod']=='trainer') {
	include "joinc/contents/trainer.php" ;
}
elseif($_GET['mod']=='trainer_detail') {
	include "joinc/contents/trainer_detail.php" ;
}
elseif($_GET['mod']=='testimoni') {
	include "joinc/contents/testimoni.php" ;
}
elseif($_GET['mod']=='detail_testimoni') {
	include "joinc/contents/detail_testimoni.php" ;
}
elseif($_GET['mod']=='sosmed') {
	include "joinc/contents/sosmed.php" ;
}

elseif($_GET['mod']=='agenda') {
	include "joinc/contents/agenda.php" ;
}
elseif($_GET['mod']=='agenda_detail') {
	include "joinc/contents/agenda_detail.php" ;
}
elseif($_GET['mod']=='detail_penyelenggara') {
	include "joinc/contents/detail_penyelenggara.php" ;
}

elseif($_GET['mod']=='fasilitator') {
	include "joinc/contents/fasilitator.php" ;
}



#===================== MODUL CONTENTS : END ====================