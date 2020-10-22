<?php
 
 include('connect.php');

include('header.php'); 

if($_GET['dataVal']!=''){
    $id=base64_decode($_GET['dataVal']);
        $result = $conn->query("SELECT customer_id, customer_name, email, customer_code FROM customers WHERE customer_id=$id");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $customer_name= $row["customer_name"];
                $customer_email=$row["email"];
                $customer_code=$row["customer_code"];
            }
        }
        $conn->close();
 }
?>
<!--===============================================================================================-->
<script src="multiselect/jquery.min.js"></script>
<link rel="stylesheet" href="multiselect/bootstrap.min.css">
<link rel="stylesheet" href="multiselect/bootstrap-select.css">
<script src="multiselect/bootstrap-select.js"></script>
<script src="multiselect/bootstrap.min.js"></script>
<!--===============================================================================================-->
<div class="top_content">
    <div class="titlebar-1_container cwidth_container" style="background-image: url('./images/titlebar_services.jpg');">
        <div class="titlebar-1_wrapper cwidth_wrapper">
            <div class="titlebar-1 cwidth">
                <div class="col-1-1">
                    <div class="col">
                        <h2 class="titlebar_title"><span style="color: #8b8b8b;">Subscribe Service Request</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_content_container cwidth_container" style="margin-top:-22px !important;padding-top:20px;">
        <div class="main_content_wrapper cwidth_wrapper">
            <div class="main_content cwidth">
                <div class="page-1_wrapper">
                    <div class="page-1 content_cols_eq">
                        <div class="post_content">
                            <div class="grid ">
                                <div class="wpcf7" id="wpcf7-f211-p120-o1">
                                    <form name="sendFeedBack" id="sendFeedBack" method="post" action="subscribeVal.php" onsubmit="validateNow();return false;">
                                        <table>
                                            
                                            <tr>
                                                <th>
                                                    <p class="half half_last">Your Name (required)<br>
                                                        <span class="wpcf7-form-control-wrap your-name"><input type="text" class="isRequired" name="name" placeholder="Name" title="Please Enter your name" value="<?php echo $customer_name;?>"></span>
                                                    </p>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <p class="half half_last">Your Email (required)<br>
                                                        <span class="wpcf7-form-control-wrap your-email"><input type="text" name="email" id="email" placeholder="Email" size="40" class="isRequired isEmail" title="Please Enter your Email" value="<?php echo $customer_email;?>"></span>
                                                    </p>

                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <p class="half half_last">Customer Code<br>
                                                        <span class="wpcf7-form-control-wrap your-email"><input type="text" readonly name="customerCode" id="customerCode" value="<?php echo $customer_code;?>"></span>
                                                    </p>

                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <p class="half half_last">Services (required)<br>
                                                        <span class="wpcf7-form-control-wrap your-email">
                                                        
                                                      
                                                        <select name="servicesID[]" id="servicesID" class="selectpicker" multiple data-live-search="true">
                                                            <?php 
                                                            $result = $conn->query("SELECT * FROM `services` WHERE `services_status` = 'active' AND `subscribe_status` = 'active'");
                                                             if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $row["service_id"]; ?>"><?php echo $row["service_name"]; ?></option>
                                                            <?php    }
                                                            } else {
                                                                echo "0 results";
                                                            }
                                                            $conn->close();
                                                            ?>

                                                        </select>
                                                    
                                                    </span>
                                                    </p>

                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <p>
                                                    <input type="hidden" id="hidevalue">
                                                    <input type="hidden" id="servicesName" name="servicesName">
                                                        <input type="submit"  onclick="showSelectsd();" value="Subscribe" name="save" class="wpcf7-form-control wpcf7-submit"><img class="ajax-loader" src="assets/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
                                                    </p>
                                                </th>
                                            </tr>
                                        </table>

                                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/deforayValidation.js"></script>
<script type="text/javascript">

function showSelectsd(){
    var items = $("#servicesID option:selected").map(function() {
    return $(this).text();
}).get();
    $ServiceList=items.join();
    $('#servicesName').val($ServiceList);
}


    function validateNow() {
        flag = deforayValidator.init({
            formId: 'sendFeedBack'
        });
        if (flag) {
            document.getElementById('sendFeedBack').submit();

        }

    }  

    $(document).ready(function(){

$("#email").change(function(){
    var emailid = $(this).val();
    $.ajax({
        url: 'servicesList.php',
        type: 'post',
        data: {emailID:emailid},
        dataType: 'json',
        success:function(response){
            var len = response.length;
            if(len>0){
                $("#servicesList").empty();
                var arrayval=[];
                for( var i = 0; i<len; i++){
                    var serviceId = response[i]['serviceId'];
                    var serviceName = response[i]['serviceName'];                
                    $("#servicesID").find('option[value*='+serviceId+']').prop('disabled',true);
                    $('li:contains("'+serviceName+'")').hide();
                    arrayval.push(serviceId+'##'+serviceName);
                }
                    $('#hidevalue').val(arrayval);
            }else{
                var hidevalue =  $('#hidevalue').val();
                var hidevalueSplit = hidevalue.split(",");
                for (var i = 0; i < hidevalueSplit.length; i++) {
                    var hidevalueSplitval = hidevalueSplit[i].split("##");
                    $("#servicesID").find('option[value*='+hidevalueSplitval[0]+']').prop('disabled',false);
                    $('li:contains("'+hidevalueSplitval[1]+'")').show();
              
                }
            }
        }
    });
});

});
</script>
<?php include('footer.php'); ?>