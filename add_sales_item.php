
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
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active"> Add  sales item      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Create new sales item</h1>
          </header>
         
         <div class="row" id="sales_item_form">
              <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>New Sales Items</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <input id="item_name" type="text" placeholder="Item Name" class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Quantity</label>
                      <input id="quantity" type="text" value="0" class="mr-3 form-control form-control" enabled>
                    </div>

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Percentage profit expected</label>
                      <input id="profit" type="number" placeholder="% profit you expect from this product" class="mr-3 form-control form-control" >
                    </div>

                    <div class="form-group">
                      <input type="submit" value="Next" class="mr-3 btn btn-primary" id="add_to_item">
                    </div>
                  </form>
                </div>
              </div>
            </div>
         </div>



         <div class="row" id="ingrediets_display" style="display: none;" >
          <div class="col-lg-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4 id="span_name">Add ingredients for</h4>
                </div>
                <div class="card-body">
                  <p class="text-danger">Please be sure to include all ingredients for acountability in the store.</p>
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-sm-2">Item</label>
                      <div class="col-sm-10">
                        <select id="store"  class="form-control form-control-success">
                         
                        </select>
                        <small class="form-text"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2">Quatient</label>
                      <div class="col-sm-10">
                        <input id="division" type="number" placeholder="e.g 0.001" class="form-control form-control-warning">
                        <small class="form-text">Quatient of the item that make one salable unit of this item</small>
                        <small class="form-text text-warning">Try as much to be accurate here.</small>
                      </div>
                    </div>
                    <div class="form-group row">       
                      <div class="col-sm-10 offset-sm-2">
                        <input type="submit" value="Reset" class="btn btn-secondary" id="reset">
                        <input type="submit" value="Add" class="btn btn-primary" id="add_ing">
                        <input type="submit" value="Done" class="btn btn-primary" id="done">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!--
              <div class="container">
  

  <center>
    <div class="jumbotron">

      <center><h2>Add Sales Item</h2></center>
      <center>
        <div id="ingrediets_display" style="display: none;">
          <h2>Ingredients for <span id="span_name"></span></h2>
          <table id="items_table">
          
          </table>
        
      </div>
      </center>
        <form class="form-inline" id="sales_item_form">
          
          <div class="form-group mb-2">
            <label for="staticEmail2" class="sr-only">Item name</label>

            
            <input class="form-control form-control-sm" id="item_name" type="text" placeholder="Item name"> 
           
         </div>

          <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control form-control-sm" placeholder="Quantity" id="quantity" value="0" disabled>
          </div>

          <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control form-control-sm" placeholder="Percentage profit" id="profit" min="1">
          </div>
          
          <button type="submit" class="btn btn-primary mb-2 btn-sm" id="add_to_item">Add</button>&nbsp;

        </form>

        <center>
          
        <form class="form-inline" id="ingredients_form" style="display: none">
          
          <div class="form-group mb-2">
            <label for="staticEmail2" class="sr-only">Ingredient</label>

             
            <select class="form-control form-control-sm" id="store">
            <option value="Meat,1">Meat</option><!--Name-
            <option value="Sugar,2">Sugar</option>
            <option value="Wheat flour,3">Wheat Flour</option>

          </select>
           
         </div>

          <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control form-control-sm" placeholder="Division e.g 0.002" id="division" min="1">
          </div>
          
          <button type="submit" class="btn btn-primary mb-2 btn-sm" id="add_ing">Add</button>&nbsp;
           <button type="submit" class="btn btn-primary mb-2 btn-sm" id="done">Done</button>&nbsp;
          <button type="submit" class="btn btn-danger mb-2 btn-sm" id="reset">Reset</button>&nbsp;

        </form>
        </center>


        </div>
  </center>
</div>

          -->

             <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Ingredients added for </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Division</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="items_table">
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                   <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Done</button>
                      </div>
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
              <p>Design by <a href="#" class="external">Nashon</a></p>
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
  class Sales_Item {
    //$name, $unit,$div,$qtty,$price

  constructor(name,quantity,profit) {
    this.name = name;
    this.quantity = quantity;
    this.profit = parseFloat(profit);
    this.division = 1;
    this.unit = 'None';

  }



}

//Class for ingredient
class Ingredient{
  //($food_name,$store_item,$store_item_id,$division)
  constructor(food_name,store_item,store_item_id,division,unit_p){
    this.unit_p = parseFloat(unit_p);
    this.food_name = food_name;
    this.store_item = store_item;
    this.store_item_id = store_item_id;
    this.division = parseFloat(division);
    this.price = this.division*this.unit_p;
  }
  increament(add){
    this.division= (this.division)+(add*1);
    this.price = this.division*this.unit_p;
  }
}

/*function addToCat(cat,item,){
  for (var i = 0; i < cat.length; i++) {
    if (cat[i].name == item.name && cat[i].id == item.id) {
      cat[i]=item;
      return;
    }
    cat.push(item);
  }
}*/
function add(list,item){
  for(var i=0; i < list.length; i++){
    if (list[i].store_item_id == item.store_item_id) {list[i].increament(item.division); return list;}
  }
  list.push(item);
  return list;
}
function remove(list,id){
  var list1 = [];
  for(var i=0; i < list.length; i++){
    if (list[i].store_item_id != id) {list1.push(list[i]);}
  }
  list = list1;
  list1 = null;
  return list;
}

function getStoreItems(){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{get_store_items : 1},
          success : function (res){
            var data =  JSON.parse(res);
            console.log(data);
            //alert(data);
            $('#store').empty();
            for (var i = 0; i < data.length; i++) {

              $('#store').append('<option value="'+data[i].ITEM_NAME+','+data[i].ID+','+data[i].UNIT_PRICE+'">'+data[i].ITEM_NAME+'</option>');
            }
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}

  $(document).ready(function () {
  

  var ingrediets = [];
  var item = null;



  $('#add_to_item').click(function(e){
    e.preventDefault();

    var name = $('#item_name').val().trim();
    var quantity = $('#quantity').val().trim();
    var profit = $('#profit').val().trim();

    if (name.length == 0 || quantity.length ==0 || profit.length == 0) {
      alert('Please enter valid inputs in all fields');
    }else{
      item = new Sales_Item(name,quantity,profit);
      getStoreItems();
      
      $('#sales_item_form').hide();
      $('#ingrediets_display').show();
      $('#span_name').text(name);
      $('#ingredients_form').show();


    }

    //


  });

///F:\Xampp\htdocs\Projects\Catering\add_sales_item.php

//Reset
    
    $('#reset').click(function(e){
      e.preventDefault();
      ingrediets =[];
      $('#sales_item_form').show();
        item = null;
      $('#ingredients_form').hide();
      $('#ingrediets_display').hide();
      $('#span_name').text('');
      $('#items_table').empty();


    });

    //Add ingredient
    $('#add_ing').click(function(e){
      e.preventDefault();
      //($food_name,$store_item,$store_item_id,$division)
      var food_name = item.name;
      var store = $('#store').val().split(',');
      var store_item = store[0];
      var store_item_id = store[1];
      var unit_p = store[2];
      var division = $('#division').val();

      if (isNaN(division) ||  division < 0 || division >= 1 || division == "") {
        alert('Please enter a valid division! Should be a fraction');

      }else{
        ingrediets=add(ingrediets,new Ingredient(food_name,store_item,store_item_id,division,unit_p));
        $('#items_table').empty();
        for(var i =0; i < ingrediets.length; i++){

          $('#items_table').append('<tr><td>'+(i*1+1)+'</td><td>'+ingrediets[i].store_item+'</td><td>'+ingrediets[i].division+'</td><td><button class="btn btn-danger mb-2 btn-sm remove" rid="'+ingrediets[i].store_item_id+'">Remove</button></td></tr>');
        }

        /*
        <tr><th>#</th><th>Name</th><th>Division</th><th>Action</th></tr>
          <tr><td>1</td><td>Name</td><td>Division</td></tr>
        */
        
      }

    });
//Remove from ingredients
$("body").on("click", ".remove", function (event) {
  event.preventDefault();
    var id = $(this).attr('rid');
    ingrediets = remove(ingrediets,id);
    $('#items_table').empty();
        for(var i =0; i < ingrediets.length; i++){
          $('#items_table').append('<tr><td>'+(i*1+1)+'</td><td>'+ingrediets[i].store_item+'</td><td>'+ingrediets[i].division+'</td><td><button class="btn btn-danger mb-2 btn-sm remove" rid="'+ingrediets[i].store_item_id+'">Remove</button></td></tr>');
  }

});


//Clicking done button

    $('#done').click(function(e){
      e.preventDefault();
      if (ingrediets.length == 0) {alert('Please add ingrediets for the food');}
      else{
        $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{add_sales_item : 1, item:item, ingrediets: ingrediets},
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
  });
</script>
  </body>
</html>