  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="assets/js/waves.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
  <!-- Vector map JavaScript -->
  <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Chart js -->
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
  <!-- Index js -->
  
  <!-- Calendar js -->
  <script src='assets/plugins/fullcalendar/js/moment.min.js'></script>
  <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
  <script src="assets/plugins/fullcalendar/js/fullcalendar-custom-script.js"></script>
  <!-- Data table JS -->
  <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <!-- <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script> -->
  <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
  <!-- switcher button -->
  <script src="assets/plugins/switchery/js/switchery.min.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    
    <script src="assets/plugins/jquery-multi-select/jquery.multi-select.js"></script>
    <script src="assets/plugins/jquery-multi-select/jquery.quicksearch.js"></script>

 <!-- Dropzone JS  -->
  <script src="assets/plugins/dropzone/js/dropzone.js"></script>
  <script type="text/javascript">
    var loadFile = function(event){
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
  <script type="text/javascript">
    var uploadSlid1 = function(event){
        var image = document.getElementById('slidOne');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
    var loadSlid2 = function(event){
        var image = document.getElementById('slidTwo');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
    var uploadSlidder = function(event){
        var image = document.getElementById('slidThree');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>

    <script>
      var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
      $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
       });
    </script>

    <!--Bootstrap Switch Buttons-->
    <script src="assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>

    <!-- summernote -->
   <script src="assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
  <script>
   $('#summernoteEditor').summernote({
            height: 200,
            tabsize: 2
        });
   $('#description').summernote({
    height:200,
    tabsize:2
   });
   $('#content').summernote({
    height:200,
    tabsize:2
   })
  </script>
  
    <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
  <!-- <script src="assets/js/index.js"></script> -->
</body>

<!-- white-version/index.html  Wed, 31 Oct 2018 03:22:03 GMT -->
</html>