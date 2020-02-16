
<?php include_once './includes/header.inc';  ?>
  <body>
<?php  
session_start();
if (!isset($_SESSION['id'])) {
  header("Location : ./index.php");
  exit();
}
if ($_SESSION['user_type'] != 'CASHIER') {
  header("Location : ./index.php");
  exit();
  
}
include_once('./includes/cashier_menu.php');

?>
    <div class="page">
      <!-- navbar-->
<?php include_once './includes/horizontal_bar.inc';  ?>
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./store_manager.php">Home</a></li>
            <li class="breadcrumb-item active"> Make sales      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Sale</h1>
          </header>





   


         <div class="row">
           
             <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Items in cat </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Quantity</th>
                          <th>Unit price</th>
                          <th>Sub total</th>
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody id="items-table">
                       
                       
                      </tbody>
                    </table>
                  </div>
                </div>
                   <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Done</button>
                      </div>
                    </div>
              </div>

            </div>
         </div>

         
         <div class="row">
              <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add item to sell</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <select id="item_name" type="text"  class="mr-3 form-control">
                       
                      </select>
                    </div>
                   

                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Quantity </label>
                      <input id="quantity" type="number" placeholder="Quantity of this food to sell" class="mr-3 form-control form-control" >
                    </div>

                    <div class="form-group">
                       
                       <button type="submit" class="btn btn-primary" id="add_to_cat">Add</button>&nbsp;&nbsp;
                       <button type="submit" class="btn btn-secondary">Abort Sale</button>&nbsp;&nbsp;
                       <button type="submit" class="btn btn-warning" id="new_sale">New Sale</button>&nbsp;&nbsp;
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
  class Item {

  constructor(name,quantity,price,id) {
    this.name = name;
    this.quantity = parseFloat(quantity);
    this.price = price;
    this.id = id;
    this.total = this.price*this.quantity;
  }

  increament(add){
    this.quantity = (this.quantity + add);
    this.total = this.quantity * this.price;
  }

}

function add(cat,item){
  for (var i = 0; i < cat.length; i++) {
    if (cat[i].id == item.id) {
      cat[i].increament(item.quantity);
      return cat;
    }
    
  }
  cat.push(item);
  return cat;
}

function remove(cat, id){
  var cat1=[];
  for(var i =0; i < cat.length; i++){
    if (cat[i].id != id) {cat1.push(cat[i]);}
  }
  cat = cat1;
  cat1 = null;
  return cat;
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
    getSalesItems();
    var cat = [];
    
    $("#add_to_cat").click(function (e) {
    e.preventDefault();

    var n = $('#item_name').val().split(",");
    var quantity = $('#quantity').val();
    var name = n[0];
    var id = n[1];
    var price =n[2];

    if (quantity == "" || quantity < 1) {
      alert("Invalid quantity");
      exit();
    }
    var item = new Item(name,quantity,price,id);
    //cat.push(item);
    cat =add(cat,item);

    $('#items-table').empty();
    var total_p = 0;
    for (var i=0; i < cat.length; i++) {
      var cati= cat[i];
      $('#items-table').append('<tr><td>'+(i+1)+'</td><td>'+cati.name+'</td><td>'+cati.quantity+'</td><td>'+cati.price+'</td><td>'+cati.total+'</td><td><button style="width :100px;" class="btn btn-danger btn-sm remove" rid="'+cati.id+'">Remove</button></td></tr>');
      //alert(i.quantity)
      total_p+=cat[i].total;
    }

    $('#items-table').append('<tr style="border-top: 1px solid black; padding-top:10px;"><td></td><td><b>Total</b></td><td></td><td></td><td><b>Ksh.'+total_p+'</b></td><td></td></tr>');




  });//Add

    //Clear Cat

    $('#new_sale').click(function(e){
      e.preventDefault();
      cat = [];
      $('#items-table').empty();
    });

    //Remove from cat
    $("body").on("click", ".remove", function (event) {
    event.preventDefault();
      var id = $(this).attr('rid');
    cat = remove(cat,id);

    //Redisplay
    $('#items-table').empty();
    var total_p = 0;
    for (var i=0; i < cat.length; i++) {
      var cati= cat[i];
      $('#items-table').append('<tr><td>'+(i+1)+'</td><td>'+cati.name+'</td><td>'+cati.quantity+'</td><td>'+cati.price+'</td><td>'+cati.total+'</td><td><button style="width :100px;" class="btn btn-danger btn-sm remove" rid="'+cati.id+'">Remove</button></td></tr>');
      //alert(i.quantity)
      total_p+=cat[i].total;
    }

    $('#items-table').append('<tr style="border-top: 1px solid black; padding-top:10px;"><td></td><td><b>Total</b></td><td></td><td></td><td><b>Ksh.'+total_p+'</b></td><td></td></tr>');
    });

    //Done Selecting

    $('#done').on('click',function(e){
      e.preventDefault();
      if (cat.length == 0) {
        alert('Please select items!');
      }else{
        $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{sale : 1, cat: cat},
          success : function (res){
            alert(res);
            $('#new_sale').trigger("click");

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


      