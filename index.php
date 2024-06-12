<?php

require 'frontend/head.php';

?>

<?php

if(isset($_POST["buy"])){
	
	if (isset($_SESSION["shopping_cart"])){
		
		$products_array_id = array_column($_SESSION["shopping_cart"],"products_id");
		if (!in_array($_GET['id'], $products_array_id)) {

			$count = count($_SESSION["shopping_cart"]);
			$products_array = array(
          
          'products_id' => $_GET['id'],
          'name' => $_POST['name'],
          'price' => $_POST['price'],
          'products_quantity' => $_POST['quantity']
		);
		$_SESSION["shopping_cart"][$count]= $products_array;

			
		}
		else{
           
                $_SESSION['fail']='Products Already Added !';
		}
	}
	else{

		$products_array = array(
          
          'products_id' => $_GET['id'],
          'name' => $_POST['name'],
          'price' => $_POST['price'],
          'products_quantity' => $_POST['quantity']
		);
		$_SESSION["shopping_cart"][0]= $products_array;
	}
}

 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["products_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     $_SESSION['fail2']='Products Removed !';  
                }  
           }  
      }  
 }

?>

<?php

require 'frontend/content.php';

?>

<?php

require 'frontend/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
    $('#example').DataTable();
      });
</script>
<?php

?>