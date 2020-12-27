<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


  <!-- font Awesome 4.5.0 -->
  <link href="css/modal-minimize-and-maximize/font-awesome.css" rel="stylesheet" type="text/css" />    


  <style type="text/css">  

    .modal-header .btnGrp{
      position: absolute;
      top: 8px;
      right: 10px;
    } 
 

    .min{
        width: 250px; 
        height: 35px;
        overflow: hidden !important;
        padding: 0px !important;
        margin: 0px;    

        float: left;  
        position: static !important; 
      }

    .min .modal-dialog, .min .modal-content{
        height: 100%;
        width: 100%;
        margin: 0px !important;
        padding: 0px !important; 
      }

    .min .modal-header{
        height: 100%;
        width: 100%;
        margin: 0px !important;
        padding: 3px 5px !important; 
      }

    .display-none{display: none;}

    button .fa{
        font-size: 16px;
        margin-left: 10px;
      }

    .min .fa{
        font-size: 14px; 
      }

    .min .menuTab{display: none;}

    button:focus { outline: none; }

    .minmaxCon{
      height: 35px;
      bottom: 1px;
      left: 1px;
      position: fixed;
      right: 1px;
      z-index: 9999;
    }

.modal-header {
    background-color: #C49F0F;
    padding:9px 15px;
    color:#FFF;
    font-family:Verdana, sans-serif;
    border-bottom:1px solid #eee;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
 }
 .modal-body {
    background-color: #F8E69E;
    padding:9px 15px;
    color:#000;
    font-family:Verdana, sans-serif;
    border-bottom:4px solid #C49F0F;

 }
.modal-footer {
    background-color: #FAEDBC;
    color:#FFF;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
 } 

  </style> 

</head>

<body>

<div class="container">
 
  <h2>A demo of modal</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-warning btn-lg mdlFire"  data-target="#modal-1" >Demo with max/min and customized CSS</button>

  <!-- Modal -->
  <div class="modal fade mymodal" id="modal-1" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal"> <i class='fa fa-times'></i> </button>   

          <button class="close modalMinimize"> <i class='fa fa-minus'></i> </button> 

          <h4 class="modal-title">A demo of modal with min/max options</h4>
        </div>

        <div class="modal-body"  style="padding:40px 50px;">
          <p>The content of the modal appears here</p>
        </div>

        <div class="modal-footer"  style="padding:40px 50px;">
          <p>Place the footer options like Ok, Cancel buttons here</p>
        </div>
 
      </div>      
    </div>
  </div>  
</div>  
 
<?php 
                              $current = date('Y-m-d H:i:s');
                              $m_date = date('Y-m-d H:i:s');
                              // $m_time = date('H:i:s');
                              $start = $m_date;
                              $diff = $start->diff(new DateTime($current));
                              $h = $diff->h;
                              $m = $diff->m;
                              $s = $diff->s;

                              echo $h.":".$m.":".$s;
                            ?>

<div class="minmaxCon"></div>  


<script>

  $(document).ready(function(){ 
      

      var $content, $modal, $apnData, $modalCon; 

      $content = $(".min");   


      //To fire modal
      $(".mdlFire").click(function(e){

          e.preventDefault();

          var $id = $(this).attr("data-target"); 

          $($id).modal({backdrop: false, keyboard: false}); 

        }); 
 

      $(".modalMinimize").on("click", function(){

                  $modalCon = $(this).closest(".mymodal").attr("id");  

                  $apnData = $(this).closest(".mymodal");

                  $modal = "#" + $modalCon;

                  $(".modal-backdrop").addClass("display-none");   

                  $($modal).toggleClass("min");  

                    if ( $($modal).hasClass("min") ){ 

                        $(".minmaxCon").append($apnData);  

                        $(this).find("i").toggleClass( 'fa-minus').toggleClass( 'fa-clone');

                      } 
                      else { 

                              $(".container").append($apnData); 

                              $(this).find("i").toggleClass( 'fa-clone').toggleClass( 'fa-minus');

                            };

                  });

        $("button[data-dismiss='modal']").click(function(){   

                $(this).closest(".mymodal").removeClass("min");

                $(".container").removeClass($apnData);   

                $(this).next('.modalMinimize').find("i").removeClass('fa fa-clone').addClass( 'fa fa-minus');

              }); 

  });

</script>
</body>
</html>

  