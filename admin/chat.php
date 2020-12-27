<?php include 'header.php';?>

<?php 
	if (isset($_POST['id'])) {
		ob_end_clean();
		include '../includes/connection.php';
		$receiver = $_POST['id'];
		$sender = $_SESSION['id'];
		$date = date('Y-m-d');

		$updateAgent = $connect2db->prepare("UPDATE chat SET receiver = ?, status = ? WHERE sender = ? AND m_date = ? AND receiver = ?");
		$updateAgent->execute([$sender, 1, $receiver, $date, 0]);
		echo($receiver);
		exit();


	}

	if (isset($_POST['message']) && !empty($_POST['message']) && $_POST['message'] !== " ") {
		ob_clean();
		$message = trim($_POST['message']);
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$sender = $_SESSION['id'];
		$receiver = $_POST['receiver'];

		$sendMsg = $connect2db->prepare("INSERT INTO chat (sender,message,m_date,m_time,receiver) VALUES (?,?,?,?,?)");
		$sendMsg->execute([$sender, $message, $date, $time,$receiver]);
		if ($sendMsg) {
			echo "Sent";
			exit();
		} else{
			echo "error";
			exit();
		}

		// // echo 'passed';
		// exit();
	}

	if (isset($_POST['lifetech']) && isset($_GET['id'])) {
		ob_end_clean();
		$id = $_SESSION['id'];
		$date = date('Y-m-d');
			// echo($gid);
			$getData = $connect2db->prepare("SELECT * FROM chat WHERE sender = ? OR receiver = ? AND m_date = ?ORDER BY id DESC ");
			$getData->execute([$id, $id, $date]);
			while ($msg=$getData->fetch(PDO::FETCH_OBJ)) {
				$sender = $msg->sender;
				($sender == $id) ? $class = 'sender' : $class = 'admin';
						
				echo "<div class=$align>
					$msg->message
				</div><br>";
				
			
		}
exit();
	
	}

?>

<style type="text/css">
	
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
.minmaxCon{
      height: 35px;
      bottom: 1px;
      right: 10px;
      position: fixed;
      /*right: 100%;*/
      z-index: 9999;
    }

    .sender{
    background-color:#fff;
    color:#3A3A3A;
    font-family: Poppins;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 19px;
    align-items: center;
    padding: 7px 20px 7px 20px; 
    margin:2px 20px 0px 20px;
    border-radius:10px 0px 10px 10px;
  }
  .admin{
    font-family: Poppins;
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    line-height: 19px;
    border: 1px solid #FFFFFF;
    box-sizing: border-box;
    border-radius: 0px 10px 10px 10px;
    padding: 7px 20px 10px 20px;
    margin:2px 46px 0px 10px;
    color:#fff;
      }
</style>
	
	<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
      <!-- Content Start From Here -->
      <br><br><br><br>

    <div class="row">
        <div class="col-xl-12">




        	<div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="background:#3A3A3A;color:#fff">
                    <tr>
                        <th>Name</th>
                        <th>Waiting Time</th>
                        <th>Location</th>
                        <th>Agent Chatting</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                   
                    $date = date('Y-m-d');
                    $getUser = $connect2db->prepare("SELECT DISTINCT chat.sender,chat.receiver,chat.status, chat.m_time,chat.m_date, users.role, users.fname,users.lname,users.country, users.id FROM chat JOIN users ON chat.sender = users.id WHERE chat.m_date = ? AND users.role != ? AND chat.status != 2 GROUP BY chat.sender ORDER by chat.id DESC  ");
                    $getUser->execute([$date, 'Admin']);
                    // $i = 1;
                    while ($row = $getUser->fetch()) {
                      ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;border-bottom:2px solid #3A3A3A;background:transparent;">
                          <td>
                            <?php 
                              $cname = $row->fname." ".$row->lname;
                              echo $cname 
                            ?>
                          </td>
                          <td><?php 
                          		if ($row->status == 0) {
                          			$current = date('Y-m-d H:i:s');

	                          		$start = new DateTime($row->m_date." ".$row->m_time);
	                          		$diff = $start->diff(new DateTime($current));
	                          		$h = $diff->h;
	                          		$m = $diff->i;
	                          		$s = $diff->s;

	                          		echo $h.":".$m.":".$s;
                          		} else{
                          			echo "Chatting";
                          		}
                          	?></td>
                          
                          <td><?php echo $row->country; ?></td>
                          <td><?php 
                          	$rc = $row->receiver; 
                            $aname = '';
                          	if ($rc == '0') {
                          		echo "None";
                          	} else{
                          		$getAgent = $connect2db->prepare("SELECT fname, lname FROM users WHERE id = ?");
                          		$getAgent->execute([$rc]);
                          		$name = $getAgent->fetch();
                              $aname = $name->fname." ".$name->lname;
                          		echo $cname;
                          	}
                          ?></td>
                        

                            <td> 
                            	<?php 
                            		if ($row->status == 0) {?>
                          			<a data-toggle="modal" data-target="#defaultsizemodal" class="chat" id="<?php echo $row->id?>" data-name="<?php echo $cname?>" style="color:#AD976E;cursor:pointer;" > 
                            		Start Chat 
                            	</a>
                          		<?php } 
                              else if($row->status == 1){?>
                                <a data-toggle="modal" data-target="#defaultsizemodal" class="chat" id="<?php echo $row->id?>" data-name="<?php echo $cname?>" style="color:#AD976E;cursor:pointer;" > 
                                Resume Chat 
                              </a>
                            <?php } else if($row->status==2){
                          			echo "Chat Ended";
                          		}else{
                                echo "Chatting";
                              }
                            	?>
                            	
                            </td>
                        </tr>
                    <?php
                    // $i=$i+1;
                    }
                  ?>
                  </tbody>
              </table>

              </div>
            </div>
        </div>
    </div>
  </div>




<!-- ################# MODAL START HERE -->

<!-- <button class="btn btn-primary m-1 mdlFire" data-toggle="modal" data-target="#defaultsizemodal">Default Size Modal</button> -->
              <!-- Modal -->
<div class="container">
    <div class="modal fade mymodal" id="defaultsizemodal">
      <div class="modal-dialog">
        <div class="modal-content" style="width:331px;height:454px;background-color:#3A3A3A;">
          <div class="modal-header" style="background-color:#AD976E;color:#fff;">
            
                	<button class="modalMinimize" style="width: 27px;height: 27px;background: rgba(0, 0, 0, 0.5);border:0;border-radius:50%;text-align:center;">
                		<img src="images/minus.png">
                	</button> 
            <h5 class="modal-title" style="color:#fff;text-align:center;padding-left:10px">
                <!-- Modal title -->
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-center"><?php echo date('F d')?></p>
            <p id="receiver" style="display:none;"></p>
            <p id="chat" style="display:flex;overflow-y:scroll;height:250px;flex-direction:column-reverse;"></p>
		      <!-- <?php 
			     // $sender = $_SESSION['id'];
			      //$date = //date("Y-m-d");

		      	//$getMsg = $connect2db->//prepare("SELECT * FROM chat WHERE receiver = ? AND m_date = ?");
		      	//$getMsg->execute([$sender, $date]);
		      //	while ($msg = $getMsg->fetch()) {
		      		?>
		      		
		      			<span class="text-right sender" style="float: right;">
				      	<?php 
				      //		echo $msg->message; 
				      	?>
				     </span>
		      	<?php
		      	//	}
		      	?>
		      

		      <div class="admin" style="float: left;">
		      	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque.
		      </div> -->
          </div>
          <div class="modal-footer">
           
           <hr>
		      <div class="row">
		      	<div class="col-sm-9">
		      		<form id="message">
			      		<input type="text" id="msg" style="width:100%;height:40px;border:0px;color:#a7a7a7;background-color:#3A3A3A;outline-style:none;" name="message" placeholder="Type a Message Here">
			      		<!-- <input type="submit" name=""> -->
			      </div>

		      	<div class="col-sm-3" style="padding-top:12px;padding-left:1px;">
		      		<img src="../images/icon/camera.png">
		      	</div>

		      	</form>
		      </div>

          </div>
        </div>
      </div>
    </div>
</div>  

 


<div class="minmaxCon"></div>  


<!-- @##############3# MODAL ENDS HERE -->




      <!-- Content Ends Here -->
    </div>
  </div>

<?php include 'footer.php'?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#default-datatable').DataTable();
  });
</script>


<script type="text/javascript">

	$('.chat').on('click',function(){
		let id = $(this).attr('id');
		let sender = $(this).attr('data-user');
    let cname = $(this).data('name')
		$.ajax({
			type:'POST',
			data:{id:id},
			dataType:'text',
			cache:false,
			success: function(data){
				$('#receiver').html(data);
        $('.modal-title').html(cname);
			}
		})
	});

	// Updating before modal pop up ends here

	$(document).on('keypress', function(event){
		if (event.key === "Enter") {
			event.preventDefault();
			let data = $('#msg').val();
			let receiver = $('#receiver').html();
			if ($('#msg').val() !="" && $('#msg').val() !=" ") {
				$.ajax({
			    type:'POST',
	            data: {message:data, receiver:receiver},
	            success:function(data){
	                alert(data);
	                $('#message')[0].reset();
	            }
	        });
			}
		}
	});

	// Sending of message asynchronously ends HERE

	function getChat(){
    let receiver = $('#receiver').html();
            $.ajax({
                method:'POST',
                data:{receiver:receiver},
                url:'getchat.php',
                success:function(data){
                    $('#chat').html(data);
                    // alert(data)
                }
            });
        }

         setInterval(getChat,3000);

     // Get message function ends Here

	 var $content, $modal, $apnData, $modalCon; 

      $content = $(".min"); 
       $(".mdlFire").click(function(e){

          e.preventDefault();

          var $id = $(this).attr("data-target"); 

          $($id).modal({backdrop: false, keyboard: true	}); 

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

                $(this).next('.modalMinimize').find("i").removeClass('fa-clone').addClass( 'fa-minus');

              }); 

 
</script>