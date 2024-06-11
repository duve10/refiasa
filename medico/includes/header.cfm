
<!--- <cfparam name="activeDash" default="">
<cfparam name="activeIncident" default="">
<cfparam name="activeEventHistory" default="">
<cfparam name="activePlanner" default="">
<cfparam name="activeCategory" default="">
<cfparam name="activeRol" default="">
<cfparam name="activeUser" default="">
<cfparam name="activeReports" default="">--->



<cfset userFullName = SESSION.fullname>
<cfset userPhoto = 'https://intranet.markham.edu.pe/istaff2/photos_staff/' & SESSION.login & '.jpg'>
<cfset arrayName = listToArray(userFullName,",",false,true)>

<cfset name = arrayName[2]>
<cfset lastName = arrayName[1]>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  
  <title>Markham Monitoring System</title>


<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/js/datepicker-full.min.js"></script>
<!-- or -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker-bs5.min.css">
<!-- or -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker-foundation.min.css">


 <!-- BODYMAP -->
 <script src='libraries/konva@8/konva.min.js'></script>


<!-- LINKS PARA INPUT FILE -->

<!-- bootstrap 5.x or 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" crossorigin="anonymous">



<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">

<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous" -->

<!-- the fileinput plugin styling CSS file
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" /> -->
<link href="libraries/kartik-v/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>

<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->

<!-- the jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

<!-- buffer.min.js and filetype.min.js are necessary in the order listed for advanced mime type parsing and more correct
     preview. This is a feature available since v5.5.0 and is needed if you want to ensure file mime type is parsed 
     correctly even if the local file's extension is named incorrectly. This will ensure more correct preview of the
     selected file (note: this will involve a small processing overhead in scanning of file contents locally). If you 
     do not load these scripts then the mime type parsing will largely be derived using the extension in the filename
     and some basic file content parsing signatures. -->
<!--<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/buffer.min.js" type="text/javascript"></script>-->
<script src='libraries/kartik-v/js/plugins/buffer.min.js'></script>

<!--<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/filetype.min.js" type="text/javascript"></script>-->
<script src='libraries/kartik-v/js/plugins/filetype.min.js'></script>

<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<!--<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/piexif.min.js" type="text/javascript"></script>-->
<script src='libraries/kartik-v/js/plugins/piexif.min.js'></script>

<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/sortable.min.js" type="text/javascript"></script>-->
<script src='libraries/kartik-v/js/plugins/sortable.min.js'></script>

<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->


<!-- the main fileinput plugin script JS file -->
<!--<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/fileinput.min.js"></script>-->
<script src='libraries/kartik-v/js/fileinput.min.js'></script>

<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/themes/fas/theme.min.js"></script -->

<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<!--<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/locales/LANG.js"></script>-->
<script src='libraries/kartik-v/js/locales/LANG.js'></script>

<!-- FIN LINKS PARA INPUT FILE -->



<link href="css/app.css" rel="stylesheet" />

<!-- FUENTE -->
<link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

 

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>


<!----
<!-- Popperjs -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  crossorigin="anonymous"></script>
<!-- Tempus Dominus JavaScript -->
<script src="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/js/tempus-dominus.js"
  crossorigin="anonymous"></script>

<!-- Tempus Dominus Styles -->
<link href="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/css/tempus-dominus.css"
  rel="stylesheet" crossorigin="anonymous">
---->





  <!-- sweetalert -->
  <script src="libraries/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
  <link href="libraries/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">



 <!-- picker
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->

  <script src="libraries/flatpickr-v4.6.13/flatpickr.min.js"></script>
  <link href="libraries/flatpickr-v4.6.13/flatpickr.min.css" rel="stylesheet">

 <!-- full calendar -->
  <script src='libraries/fullcalendar-6.0.3/dist/index.global.js'></script>



  <!--- MOMENT JS --->
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <!--- DATA TABLES --->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>


  <!--- TOOGLE --->
  <link href="libraries/bootstrap5-toggle-5.0.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
  <script src="libraries/bootstrap5-toggle-5.0.4/js/bootstrap5-toggle.ecmas.min.js"></script>

  <!--- popover --->
  <script src="https://unpkg.com/@popperjs/core@2"></script>

  <link href="css/customStyle.css" rel="stylesheet" />


    <!--- PAGINATION JS --->
    <link rel="stylesheet" type="text/css" href="https://pagination.js.org/dist/2.6.0/pagination.css">
  
    <script type="text/javascript" src="https://pagination.js.org/dist/2.6.0/pagination.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.4/mammoth.browser.min.js"></script>
</head>
    
</head>