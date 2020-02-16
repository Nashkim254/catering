
<?php include_once './includes/header.inc';  ?>
  <body>
<?php  
session_start();
if (!isset($_SESSION['id'])) {
  header("Location : ./index.php");
  exit();
}
if ($_SESSION['user_type'] != 'STORE_MANAGER') {
  header("Location : ./index.php");
  exit();
  
}
include_once('./includes/store_keeper_menu.php');

?>
    <div class="page">
      <!-- navbar-->
<?php include_once './includes/horizontal_bar.inc';  ?>
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./store_manager.php">Home</a></li>
            <li class="breadcrumb-item active"> Issue cooking ingredients      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Issue cooking ingredients</h1>
          </header>





          <div class="row" id="to_prepare" style="display: none;">
          <div class="col-lg-6 col-lg-12" id="items_to_prepare_display">
              <div class="card">
                <div class="card-header">
                  <h4>Items to prepare </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Quantity to cook</th>
                          <th>Ingredients</th>
                        </tr>
                      </thead>
                      <tbody id="items_to_prepare">
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                   <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-secondary" id="removeAll">Remove All</button>
                      </div>
                    </div>
              </div>

            </div>





             <div class="col-lg-6" id="ings_display" style="display: none;">
              <div class="card">
                <div class="card-header">
                  <h4 id="title">Ingredients  for </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                         
                          <th>Name</th>
                          <th>Division</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody id="ings">
                      
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                   <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-secondary" id="closeIngs">Close</button>
                      </div>
                    </div>
              </div>

            </div>
           
         </div>


         <div class="row" id="to_issue" style="display: none;">
           
             <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Items to be issued </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Quantity</th>
                        </tr>
                      </thead>
                      <tbody id="items_to_take">
                      </tbody>
                    </table>
                  </div>
                </div>
                   <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-secondary" id="closeToIssue">Close</button>
                      </div>
                    </div>
              </div>

            </div>
         </div>

         
         <div class="row">
              <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add Item to cook</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <select id="item_name" type="text" class="mr-3 form-control">
                      </select>

                    </div>
                   

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Quantity to cook</label>
                      <input id="quantity" type="number" placeholder="Quantity of this food to cook" class="mr-3 form-control form-control" >
                    </div>

                    <div class="form-group">
                       <button type="submit" class="btn btn-secondary">Cancel</button>&nbsp;&nbsp;
                       <button type="submit" class="btn btn-primary" id="addItem">Add</button>&nbsp;&nbsp;
                      <input type="submit" value="Done" class="mr-3 btn btn-primary" id="done">
                    </div>
                  </form>
                </div>
              </div>
            </div>
         </div>



          
        </div>
      </section>
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Maseno University Cartering &copy; 2019-2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="#" class="external">Nshon</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
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

//Sale
  class Sales_Item{
    constructor(name, id, quantity){
      this.name = name;
      this.id = id;
      this.quantity = quantity*1;
      this.ingredients = getIngredients(this.id, this.quantity);

    }

    updateQuantity(add){
      this.quantity = this.quantity*1+add*1;
      for(var i =0; i<this.ingredients.length; i++){
        this.ingredients[i].updateTotal(add*1);
      }
    }

  }
//Ingredient
 class Ingredient{
  constructor(name, id, units, div,quantity){
    this.name = name;
    this.id = id;
    this.units = units ;
    this.div = div;
    this.total = this.div*quantity;

  }

  updateTotal(quantity){
    this.total = this.total+ this.div*quantity;
  }

 }

 //Items to issue
 class Store_Item{
    constructor(name, id, quantity,units){
      this.name = name;
      this.id = id;
      this.quantity = quantity;
      this.units = units;
    }

    updateQuantity(add){
      this.quantity = this.quantity*1+add*1;
    }
 }


 function getIngredients(id,quantity){
  var ingredients = [];
    $.ajax({
          url : 'http://localhost/Projects/Catering/Classes/Main.php',
          type : 'post',
          data :{getIngredients : 1, id:id},
          async:false,
          success : function (res){
            data =  JSON.parse(res);
            for (var i =0; i < data.length ; i++) {
              ingredients.push(new Ingredient(data[i].name,data[i].id,data[i].units,data[i].division*1,quantity));
            }
          
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });

    return  ingredients;
 }

    function getSalesItems(){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getSalesItems : 1},
          success : function (res){
          //alert(res);
            var data =  JSON.parse(res);

            $('#item_name').empty();
            for (var i = 0; i < data.length; i++) {
              $('#item_name').append('<option value="'+data[i].ITEM_NAME+','+data[i].ID+','+data[i].PRICE+'">'+data[i].ITEM_NAME+'</option>');
            }


          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}
$(document).ready(function () {
  var items_to_prepare = [];
  var store_items = [];
  getSalesItems();
  $('#addItem').click(function (e) {
    e.preventDefault();
    var item_details = $('#item_name').val().split(',');
    var item_name = item_details[0];
    var item_id = item_details[1]; 
    var plates = $('#quantity').val();
    if (isNaN(plates) || plates < 1) {
      alert('Please enter valid number of plates');
    }else{
      var si = new Sales_Item(item_name, item_id, plates);

          for(var i =0; i < si.ingredients.length; i++){
            var found =false;
          for (var k =  0; k < store_items.length; k++) {
            if (store_items[k].name == si.ingredients[i].name && si.ingredients[i].id == store_items[k].id) {
              found = true;
              store_items[k].updateQuantity(si.ingredients[i].total);
            }
          }
          if (!found) {
            store_items.push(new Store_Item(si.ingredients[i].name,si.ingredients[i].id,si.ingredients[i].total,si.ingredients[i].units));

          }
          }

    //See if the item had already been selected and update.
    var item_found = false;
    for(var i =0; i < items_to_prepare.length; i++){
      if (items_to_prepare[i].name == si.name && items_to_prepare[i].id == si.id) {
        item_found = true;
        items_to_prepare[i].updateQuantity(si.quantity);
      }

    }
     if (!item_found) {items_to_prepare.push(si);}
      $('#items_to_prepare').empty();
      for(var i=0; i<items_to_prepare.length; i++){
        $('#items_to_prepare').append('<tr><td>'+(i+1)+'</td><td>'+items_to_prepare[i].name+'</td><td>'+items_to_prepare[i].quantity+'</td><td><a href="#ings_display" class="view" vid="'+items_to_prepare[i].name+','+items_to_prepare[i].id+','+items_to_prepare[i].quantity+'">See ingredients</a></td></tr>');
       
      }
      $('#items_to_take').empty();
      for(var i =0; i < store_items.length; i++){
        $('#items_to_take').append('<tr><td>'+(i+1)+'</td><td>'+store_items[i].name+'</td><td>'+store_items[i].quantity+store_items[i].units+'</td></tr>');
      }

    }
    $('#to_prepare').show();
    $('#to_issue').show();

  });
  //LICKING DONE BUTTON
  $('#done').click(function(e){
    e.preventDefault();
    if (items_to_prepare.length == 0) {alert('Please pick items first');}else{
      $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{issueItems :1,items_to_prepare:items_to_prepare,store_items:store_items},
          success : function (res){
            alert(res);
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
    }
  });




	function getIngredients(id,quantity){
 	var ingredients = [];
 		$.ajax({
					url : 'http://localhost/Projects/Catering/Classes/Main.php',
					type : 'post',
					data :{getIngredients : 1, id:id},
					async:false,
					success : function (res){
						data =  JSON.parse(res);
						for (var i =0; i < data.length ; i++) {
							ingredients.push(new Ingredient(data[i].name,data[i].id,data[i].units,data[i].division*1,quantity));
						}
					
					},
					error : function (res){
						alert('error');
						console.log(res);
					}
				});

 		return  ingredients;
 }
//Display ings
function displayIngs(id,quantity,name){
 var ings = getIngredients(id,quantity);
 $('#ings').empty();
 $('#title').text('Ingredients  for '+name);
 for(var i=0; i <ings.length; i++){
$('#ings').append('<tr><td>'+ings[i].name+'</td><td>'+ings[i].div+ings[i].units+'</td><td>'+ings[i].total+ings[i].units+'</td></tr>');

 }
 $('#items_to_prepare_display').removeClass('col-lg-12');
 $('#ings_display').show();

}
//End display ings
//Handle see item link

$("body").on("click", ".view", function (event) {
  var details = $(this).attr('vid');
  var arr = details.split(',');
  displayIngs(arr[1],arr[2],arr[0]);
});
//End see item link

//Close ings
$('#closeIngs').click(function(e){
	e.preventDefault();
	$('#ings_display').hide();
	$('#items_to_prepare_display').addClass('col-lg-12');
 	
});

$('#closeToIssue').click(function(e){
	e.preventDefault();
	$('#to_issue').hide();
	//$('#items_to_prepare_display').addClass('col-lg-12');
 	
});
//Remove all
$('#removeAll').click(function(e){
	e.preventDefault();
	 items_to_prepare = [];
  	 store_items = [];
   $('#items_to_prepare').empty();
   $('#items_to_prepare').empty();
   $('#ings').empty();
	$('#to_issue').hide();
	$('#to_prepare').hide();
	//$('#items_to_prepare_display').addClass('col-lg-12');
	
 	
});

  
});

</script>
  </body>
</html>