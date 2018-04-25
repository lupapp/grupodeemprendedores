<?php
if(isset($_SESSION['user']) and $_SESSION['user']['tipo']==1){
    echo 'AREA RESTRINGIDA';
}else{
    header('Location: ../../');
}
?>
<meta charset="UTF-8">
<meta name="keywords" content="Administer" />
<meta name="description" content="Administer Pro - IProgramer.net">
<meta name="author" content="David Garcia">
<link rel="shortcut icon" href="favicon.ico">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="../../assets/vendor/font-awesome/css/font-awesome.css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="../../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="../../assets/vendor/select2/select2.css" />
<link rel="stylesheet" href="../../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
<link rel="stylesheet" href="../../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

<!-- Theme CSS -->
<link rel="stylesheet" href="../../assets/stylesheets/theme.css" />

<!-- Skin CSS -->
<link rel="stylesheet" href="../../assets/stylesheets/skins/default.css" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="../../assets/stylesheets/theme-custom.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<!-- Head Libs -->
<script src="../../assets/vendor/modernizr/modernizr.js"></script>
