<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maseno University Cartering Department</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <!-- navbar-->
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active"> Make a special order </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Make Special Order</h1>
          </header>


         <div id="contact_info">
           
            <div class="row">
             <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Contact Person's Details</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">First name</label>
                      <input id="contact_fname" type="text" placeholder="First name" class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Last name</label>
                      <input id="contact_lname" type="text" placeholder="Last name" class="mr-3 form-control form-control">
                    </div>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Email</label>
                      <input id="contact_email" type="text" placeholder="Email" class="mr-3 form-control form-control">
                    </div>

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Phone</label>
                      <input id="contact_phone" type="text" placeholder="Phone" class="mr-3 form-control form-control">
                    </div>
                   
                  </form>
                </div>
              </div>
            </div>
          </div>




          <div class="row">
             <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Event details</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Event name</label>
                      <input id="group_name" type="text" placeholder="Event name" class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Event date</label>
                      <input id="date" type="date" placeholder="Evant date" class="mr-3 form-control form-control">
                    </div>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Number of people</label>
                      <input id="number_of_peope" type="number" placeholder="Number of people" class="mr-3 form-control form-control">
                    </div>

                   
                   
                  </form>
                </div>
              </div>
            </div>
          </div>


          <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Meals you will take</label>
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input id="meal1" type="checkbox" value="BREAKFAST"> Breakfast
                        </label>
                        <label class="checkbox-inline">
                          <input id="meal2" type="checkbox" value="LUNCH"> Lunch
                        </label>
                        <label class="checkbox-inline">
                          <input id="meal3" type="checkbox" value="SUPPER"> Supper
                        </label>
                        <button class="btn btn-primary" id="next1">Next Step</button>
                      </div>
                    </div>
                    <div class="line"></div>
         </div>




<div id="select_menu_div" style="display: none;">
  <center><h1>Select Menu</h1></center>



<div id="bf_menu_div" style="display: none;">

    <div class="row">
    <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Breakfast Menu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Food name</th>
                          <th>Quanitity per person</th>
                          <th>Unit Price</th>
                        </tr>
                      </thead>
                      <tbody id="bf_menu_table">
                     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
  </div>

    <div class="row">
              <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add Food</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <select id="bf_item" type="text"  class="mr-3 form-control">
                        

                      </select>
                    </div>
                   

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Quantity </label>
                      <input id="bfq" type="number" placeholder="Quantity per person" class="mr-3 form-control form-control" >
                    </div>

                    <div class="form-group">
                       
                       <button type="submit" class="btn btn-secondary" id="bf_reset">Reset</button>&nbsp;&nbsp;
                       <button type="submit" class="btn btn-primary" id="bf_add">Add</button>&nbsp;&nbsp;
                    </div>
                  </form>
                </div>
              </div>
            </div>
         </div>

</div>


 <div id="ln_menu_div" style="display: none;">
    <div class="row">
    <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Lunch Menu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Food name</th>
                          <th>Quanitity per person</th>
                          <th>Unit Price</th>
                        </tr>
                      </thead>
                      <tbody id="ln_menu_table">
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
  </div>

    <div class="row">
              <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add Food</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <select id="ln_item" type="text"  class="mr-3 form-control">
                       
                      </select>
                    </div>
                   

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Quantity </label>
                      <input id="lnq" type="number" placeholder="Quantity per person" class="mr-3 form-control form-control" >
                    </div>

                    <div class="form-group">
                       <button type="submit" class="btn btn-secondary" id="ln_reset">Reset</button>&nbsp;&nbsp;
                       <button type="submit" class="btn btn-primary" id="ln_add">Add</button>&nbsp;&nbsp;
                    </div>
                  </form>
                </div>
              </div>
            </div>
         </div>
</div>

<div id="sp_menu_div" style="display: none;">
    <div class="row">
    <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Supper Menu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Food name</th>
                          <th>Quanitity per person</th>
                          <th>Unit Price</th>
                          <!-- <th>Total</th> -->
                        </tr>
                      </thead>
                      <tbody id="sp_menu_table">
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
  </div>

    <div class="row">
              <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add Food</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <select id="sp_item" type="text"  class="mr-3 form-control">
                       </select>
                    </div>
                   

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Quantity </label>
                      <input id="spq" type="number" placeholder="Quantity per person" class="mr-3 form-control form-control" >
                    </div>

                    <div class="form-group">
                       
                       <button type="submit" class="btn btn-secondary" id="sp_reset">Reset</button>&nbsp;&nbsp;
                       <button type="submit" class="btn btn-primary" id="sp_add">Add</button>&nbsp;&nbsp;
                    </div>
                  </form>
                </div>
              </div>
            </div>

</div>

</div>
<!--supper menu-->

<!--
    <div id="finalbtn" style="display: none;">
    <center><button class="btn btn-danger btn-sm" id="cancel" style="margin-right: 50px;">Cancel</button><button class="btn btn-primary btn-sm" id="done">Done</button></center>
  </div>
-->
<div id="finalbtn">
    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Done Selecting menu?</label>
                      <div class="col-sm-10">
                       <button class="btn btn-danger" id="cancel">Cancel Order</button>
                        <button class="btn btn-primary" id="done">Submit order</button>
                      </div>
                    </div>
                    <div class="line"></div>
</div>







</div><!--End select menu-->



      </section>

      <div id="pay_order_div" style="display: none; padding: 30px">
         <center><h1>Make Payment</h1></center>
         <div class="row">

          <div class="col-lg-6">
            <h1>Lipa na M-Pesa: Paybill 666222</h1>
            <label>Total Amount : <span id="total_amt" style="color: green;">N/A</span></label>
            
          </div>
          <div>
            <label>Enter Transaction ID</label>
            <input type="text" name="TID" id="tid">
            <button class="btn btn-primary btn-sm" id="pay_order">Confirm</button>
          </div>
           
         </div>
      </div>
  </div>
  

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
 <script type="text/javascript">
function remove(arr,val){
  var a = [];
  for(var i=0; i<arr.length; i++){
    if (arr[i] != val) {a.push(arr[i]);}
  }
  return a;
}
function getSalesItems(){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getSalesItems : 1},
          success : function (res){
            var data =  JSON.parse(res);
            console.log(data);
          //  alert(data);
            $('#bf_item').empty();$('#ln_item').empty();$('#sp_item').empty();
            for (var i = 0; i < data.length; i++) {
              $('#bf_item').append('<option value="'+data[i].ITEM_NAME+','+data[i].ID+','+data[i].PRICE+'">'+data[i].ITEM_NAME+'</option>');
              $('#ln_item').append('<option value="'+data[i].ITEM_NAME+','+data[i].ID+','+data[i].PRICE+'">'+data[i].ITEM_NAME+'</option>');
              $('#sp_item').append('<option value="'+data[i].ITEM_NAME+','+data[i].ID+','+data[i].PRICE+'">'+data[i].ITEM_NAME+'</option>');
            }


          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}
class Menu_Item{
  constructor(name,id,quantity,price){
    this.name = name;
    this.id = id;
    this.quantity = quantity;
    this.price = price;
  }
}

class Meal{
  constructor(name,menu){
    this.name = name;
    this.menu = menu;
  }
}

$(document).ready(function(){
      var group_name = null;

      var contact_fname = null;
      var contact_lname = null; 
      var contact_email =null; 
      var contact_phone = null; 
      var number_of_peope = null; 
      var date = null;
      var meals = [];
      var breakfast = [];
      var lunch = [];
      var supper = [];
      var actual_meals = [];

  $('#meal1').change(function(e){
    if (this.checked) {
      meals.push($(this).val());
    }else{
    meals=remove(meals,$(this).val());
    }
    console.log(meals);
  });


    $('#meal2').change(function(e){
    if (this.checked) {
      meals.push($(this).val());
    }else{
    meals=remove(meals,$(this).val());
    }
    console.log(meals);
  });

    $('#meal3').change(function(e){
    if (this.checked) {
      meals.push($(this).val());
    }else{
    meals=remove(meals,$(this).val());
    }
    console.log(meals);
  });

    $('#next1').click(function (event) {
      event.preventDefault();
       group_name = $.trim($('#group_name').val()); 
       contact_fname = $.trim($('#contact_fname').val()); 
       contact_lname = $.trim($('#contact_lname').val()); 
       contact_email = $.trim($('#contact_email').val()); 
       contact_phone = $.trim($('#contact_phone').val()); 
       number_of_peope = $.trim($('#number_of_peope').val()); 
       date = $.trim($('#date').val()); 

      if (group_name.length ==0 || contact_fname.length ==0 || contact_lname.length ==0 || contact_email.length ==0 || contact_phone.length ==0 || number_of_peope.length ==0 || date.length==0) { alert("All fields are mandatory!"); return;}
      if (contact_phone.length != 10) {alert("Please enter a valid phone number in the format 07...");return;}
      if (number_of_peope < 2) {alert("The number of people must be 2 or more!"); return;}
      if (meals.length == 0) {alert("You haven't selected any meal!");return;}

      var today = new Date();
      var chosen = new Date(date);
      var nextWeek = new Date();
      nextWeek.setDate(nextWeek.getDate() + 7);

      if (chosen.getTime() < today.getTime()) { alert("Please choose a day in the future!"); return;}
      if(chosen.getTime() > nextWeek.getTime()){alert("Ensure the event date is less than 7 days ahead"); return;}
      

      //alert(breakfast);
      $('#contact_info').hide();
      $('#select_menu_div').show();
      for(var  i =0; i< meals.length; i++){
        if (meals[i] == 'BREAKFAST') { $('#bf_menu_div').show();}
        if (meals[i] == 'LUNCH') { $('#ln_menu_div').show();}
        if (meals[i] == 'SUPPER') { $('#sp_menu_div').show();}      }
        getSalesItems();
        $('#finalbtn').show();
    });



    //Add Breakfast
    $('#bf_add').click(function(e){
      e.preventDefault();
      var details = $('#bf_item').val().split(',');
      var name =details[0];
      var id = details[1];
      var price = details[2];
      var quantity = $('#bfq').val();
      if (isNaN(quantity)) {alert("Invalid quantity"); return;}
      if (quantity < 1) {alert("Quantity can not be less than 1"); return;}

      breakfast.push(new Menu_Item(name, id,quantity,price));
      $('#bf_menu_table').empty();
      //<tr><th>#</th><th>Food name</th> <th>Quantity</th> <th>Unit price</th></tr>
      //  <tr><td>#</td><td>Food name</td> <td>Quantity</td> <td>Unit price</td></tr>
      var total = 0;
      for(var i =0; i<breakfast.length; i++){
        $('#bf_menu_table').append('<tr><td>'+(i+1)+'</td><td>'+breakfast[i].name+'</td> <td>'+breakfast[i].quantity+'</td> <td>'+breakfast[i].price+'</td></tr>');
        total = total + (breakfast[i].quantity*breakfast[i].price);
      }

      $('#bf_menu_table').append('<tr><td></td><td><b>Total</b></td> <td></td> <td>'+total+'</td></tr>');


    });

    //Reset
    $('#bf_reset').click(function(e){
      e.preventDefault();
      breakfast =[];
      $('#bf_menu_table').empty();

    });

    //Add Lunch
    $('#ln_add').click(function(e){
      e.preventDefault();
      var details = $('#ln_item').val().split(',');
      var name =details[0];
      var id = details[1];
      var price = details[2];
      var quantity = $('#lnq').val();
      if (isNaN(quantity)) {alert("Invalid quantity"); return;}
      if (quantity < 1) {alert("Quantity can not be less than 1"); return;}

      lunch.push(new Menu_Item(name, id,quantity,price));
      $('#ln_menu_table').empty();
      //<tr><th>#</th><th>Food name</th> <th>Quantity</th> <th>Unit price</th></tr>
      //  <tr><td>#</td><td>Food name</td> <td>Quantity</td> <td>Unit price</td></tr>
      var total = 0;
      for(var i =0; i<lunch.length; i++){
        $('#ln_menu_table').append('<tr><td>'+(i+1)+'</td><td>'+lunch[i].name+'</td> <td>'+lunch[i].quantity+'</td> <td>'+lunch[i].price+'</td></tr>');
        total = total + (lunch[i].quantity*lunch[i].price);
      }

      $('#ln_menu_table').append('<tr><td></td><td><b>Total</b></td> <td></td> <td>'+total+'</td></tr>');


    });

    //Reset
    $('#ln_reset').click(function(e){
      e.preventDefault();
      lunch =[];
      $('#ln_menu_table').empty();

    });

        //Add Supper
    $('#sp_add').click(function(e){
      e.preventDefault();
      var details = $('#sp_item').val().split(',');
      var name =details[0];
      var id = details[1];
      var price = details[2];
      var quantity = $('#spq').val();
      if (isNaN(quantity)) {alert("Invalid quantity"); return;}
      if (quantity < 1) {alert("Quantity can not be less than 1"); return;}

      supper.push(new Menu_Item(name, id,quantity,price));
      $('#sp_menu_table').empty();
      //<tr><th>#</th><th>Food name</th> <th>Quantity</th> <th>Unit price</th></tr>
      //  <tr><td>#</td><td>Food name</td> <td>Quantity</td> <td>Unit price</td></tr>
      var total = 0;
      for(var i =0; i<supper.length; i++){
        $('#sp_menu_table').append('<tr><td>'+(i+1)+'</td><td>'+supper[i].name+'</td> <td>'+supper[i].quantity+'</td> <td>'+supper[i].price+'</td></tr>');
        total = total + (supper[i].quantity*supper[i].price);
      }

      $('#sp_menu_table').append('<tr><td></td><td><b>Total</b></td> <td></td> <td>'+total+'</td></tr>');


    });

    //Reset
    $('#sp_reset').click(function(e){
      e.preventDefault();
      supper =[];
      $('#sp_menu_table').empty();

    });
//Cancel
  
  $('#cancel').click(function(e){
    e.preventDefault();
       group_name = null; 
       contact_fname = null;
       contact_lname = null; 
       contact_email =null; 
       contact_phone = null; 
       number_of_peope = null; 
       date = null;
       meals = [];
       breakfast = [];
       lunch = [];
       supper = [];
       $('#select_menu_div').hide();
       $('#bf_menu_div').hide();
       $('#ln_menu_div').hide();
       $('#sp_menu_div').hide();
       $('#contact_info').show();
       $('#finalbtn').hide();
       $('#pay_order_div').hide();

  });

  $('#done').click(function(e){
    
    e.preventDefault();
    for(var i=0; i<meals.length; i++){
      var name = meals[i];
      if (name == 'BREAKFAST') {
        if (breakfast.length == 0) {alert("Please add a menu for breakfast"); return;}
        else{actual_meals.push(new Meal(name, breakfast));}
      }else if (name == 'LUNCH') {
        if (lunch.length == 0) {alert("Please add a menu for lunch"); return;}
        else{actual_meals.push(new Meal(name, lunch));}
      }else if (name == 'SUPPER') {
        if (supper.length == 0) {alert("Please add a menu for supper"); return;}
        else{actual_meals.push(new Meal(name, supper));}
      }

    }

    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{new_order : 1,group_name:group_name,contact_fname:contact_fname,contact_lname:contact_lname,number_of_peope:number_of_peope, contact_email:contact_email,contact_phone:contact_phone,date:date,meals:actual_meals},
          success : function (res){
          //  alert(res); 
            $('#total_amt').text("Ksh."+res);
             $('#pay_order_div').show();
           /* $('#cancel').trigger('click');
            $('#meal1').prop('checked', false);
            $('#meal2').prop('checked', false);
            $('#meal3').prop('checked', false);*/

          },
          error : function (res){
            alert('error');
            console.log(res);

          }
        });
  });
  $('#pay_order').click(function(e){
    e.preventDefault();
    var tid = $('#tid').val();
    if (tid.length != 10) {alert("Please enter a valid Transaction ID"); return;}
    if (!isNaN(tid)){alert("Please enter a valid Transaction ID"); return;}
   // alert(tid);

   $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{pay_order:1,tid:tid,group_name:group_name,contact_fname:contact_fname,contact_lname:contact_lname,number_of_peope:number_of_peope, contact_email:contact_email,contact_phone:contact_phone,date:date,meals:actual_meals},
          success : function (res){
           alert(res);
            //return;
            $('#cancel').trigger('click');
            $('#meal1').prop('checked', false);
            $('#meal2').prop('checked', false);
            $('#meal3').prop('checked', false);

          },
          error : function (res){
            alert('error');
            console.log(res);

          }
        });
  });

});

</script>
  </body>
</html>