<?php 
session_start ();

if(!isset($_SESSION['login_username']))
// {header("Location: http://127.0.0.1/station/back-end/index.php");}
{header("Location: https://station.mogahenze.com/station/back-end/index.php");}


?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Report | Oil </title>
  <script src="../static/js/jquery.min.js"></script>
   <script src="../static/js/main.js"></script>
   <link rel="stylesheet" type="text/css" href="../static/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="../static/css/navabar.css">
   <link rel="stylesheet" type="text/css" href="../static/css/main.css">
   <link rel="stylesheet" type="text/css" href="../static/css/w3.css">

<script>

function SetupAutocompleteTypes () 
{
   autocomplete(document.getElementById("ridder-name-input-id"), ridders_names);    
   autocomplete(document.getElementById("ridder-stage-input-id"), ridders_stage);    
}

function SetUpMemberNames ()
{ 
   Load_Names(names_ridders_api);Load_Stage_Names(ridders_stage_api);
}

function Do_Logic ()
{
   display_Date ();
   ViewOilFuelReportData (view_report_oil_today_api);
   setTimeout(SetUpMemberNames,2000)
   setTimeout(SetupAutocompleteTypes,3000)
}
</script>
</head>

<body onload=" Do_Logic ()" class="app-body">
   <nav class="navbar navbar-default no-margin">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="side-header-navbar navbar-header fixed-brand">
      <div id="log-name-div" >
         <?php include '../name.php'; ?>
      </div>
      </div>
      <!-- navbar-header-->
      <div class="header-navbar collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li >
               <button class="menu-btn-link navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2">
                  <img src="../static/imgs/menu.png" class="menu-fas-img">
               </button>
            </li>
         </ul>

         <div id="header-navbar-inner-div">
            <?php include '../header.php'; ?>
         </div>
      </div>
      <!-- bs-example-navbar-collapse-1 -->
   </nav>
   <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
         <?php include '../navigation.php' ?>
      </div>
      <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
         <div class="container-fluid main-section-content">
         <label class="page-title-label" >Oil | Report</label>
         <div id="navi-links">
            <button type="button" onclick="location.reload()" class="btn btn-primary">Refresh</button>
            <button type="submit" onclick="document.getElementById('options-modal').style.display='block'" class="btn btn-primary ">Options</button>
            <button id="download" onclick="PrintDocument('quick-links-div-2','Pdf')" class="btn btn-success">Print</button>
         </div>
            <div id="quick-links-div-2">
               <div id="reports-today-div">
                  <div style="text-align:justify; overflow: auto; height: 500px;" class="user-view-area">
                     
                     <table id="html-table-id" class="w3-card-4" >
                        <thead></thead>
                           <tbody id="html-tbody-id"></tbody>
                     </table>
            </div>
               <!-- <div id="sales-products-outer-div">
                  <div id="sales-chart-div" >
                     <label>Sales Chart</label><br>
                  </div>
                  <div id="top-products-div" >
                     <label>Top Products (February 2022)</label><br>
                  </div>
               </div> -->

            </div>
         </div>
      </div>
      
      <!-- /#page-content-wrapper -->
   </div>
   <center>
   <div id="options-modal" class="w3-modal">
      <div class="w3-modal-content w3-animate-top w3-card-4">
            <div class="w3-container first-pop-up-window">
               <br>
                  <center>
                  <div class="options-main-div" >
                     <div class="options-grid-item ">
                        <button type="button" onclick="ShowTodaysData ()" class="btn btn-info range-view-btns">Today</button><br><br>
                        <button type="button" onclick="ShowAllData()" class="btn btn-info range-view-btns">All</button><br><br>

                        <form id="range-form">
                           <div class="view-by-name-div">
                              <label class="input-labels" >View By Range</label><br>
                                 <label>From old date</label>
                                 <input  required type="date" class="form-control range-view-inputs" name="from_date" placeholder="From"  autocomplete="off"><br>
                                 <label>To new date</label>
                                 <input  required type="date" class="form-control range-view-inputs" name="to_date" placeholder="From"  autocomplete="off">
                              <button type="submit" onclick="submitReportFormDataAndGet ('range-form',view_report_oil_range_api)" class="btn btn-info range-view-btns">View</button>
                           </div>
                        </form>
                     </div>

                     <div class="options-grid-item ">
                        <button type="button" onclick="ShowThisWeekData()" class="btn btn-info range-view-btns">This Week</button><br><br>
                        <button type="button" onclick="ShowThisMonthData()" class="btn btn-info range-view-btns">This Month</button><br><br>

                        <form id="my-form">
                           <div class="view-by-name-div">
                              <label class="input-labels" >View By Name</label>
                              <div class="autocomplete">
                                 <input id="ridder-name-input-id" required type="text" class="form-control range-view-inputs" name="name" placeholder="Rider's Name"  autocomplete="off">
                              </div>
                              <button type="submit" onclick="submitReportFormDataAndGet ('my-form',view_report_oil_name_api)" class="btn btn-info range-view-btns">View</button>
                           </div>
                        </form>

                        <form id="stage-form">
                           <div class="view-by-name-div">
                              <label class="input-labels" >View By Stage</label>
                              <div class="autocomplete">
                                 <input id="ridder-stage-input-id" required type="text" class="form-control range-view-inputs" name="stage" placeholder="Rider's Name"  autocomplete="off">
                              </div>
                              <button type="submit" onclick="submitReportFormDataAndGet ('stage-form',view_report_oil_stage_name_api)" class="btn btn-info range-view-btns">View</button>
                           </div>
                        </form>
                     </div>
                  </div>
                  <script>
                     function ShowTodaysData ()
                        {ViewOilFuelReportData (view_report_oil_today_api);document.getElementById('options-modal').style.display='none';}
                     function ShowAllData ()
                        {ViewOilFuelReportData (view_report_oil_all_api);document.getElementById('options-modal').style.display='none';}
                     function ShowThisWeekData ()
                        {ViewOilFuelReportData (view_report_oil_this_week_api);document.getElementById('options-modal').style.display='none';}
                     function ShowThisMonthData ()
                        {ViewOilFuelReportData (view_report_oil_this_month_api);document.getElementById('options-modal').style.display='none';}
                  </script>
                  </center>
               <br><br>
               <button onclick="document.getElementById('options-modal').style.display='none'" type="button" class="close-popup-label" >Close</button><br>
            </div>		
      </div>
   </div>
   </center>
   <footer class="main-footer">
        <div class="pull-right">
            Version <strong>4.0.19</strong>
        </div>

        <span class="copyright-span"> Copyright © 2022 Liquor Store. All rights reserved.</span>
    </footer>


  <script>
  $("#menu-toggle").click(function(e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled");
  });
  $("#menu-toggle-2").click(function(e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled-2");
     $('#menu ul').hide();
  });

  function initMenu() {
     $('#menu ul').hide();
     $('#menu ul').children('.current').parent().show();
     //$('#menu ul:first').show();
     $('#menu li a').click(
        function() {
           var checkElement = $(this).next();
           if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
              return false;
           }
           if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
              $('#menu ul:visible').slideUp('normal');
              checkElement.slideDown('normal');
              return false;
           }
        }
     );
  }
  $(document).ready(function() {
     initMenu();
  });
  </script>
</body>
</html>
