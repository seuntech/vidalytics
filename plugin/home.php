<?php 
$engine = new engine();
?>



<div class="row mt-5">
<?php
$row = $engine->getactve_product(3);
for($dbc = 0; $dbc < count($row); $dbc++){
    
    $id = $row[$dbc]['id'];
    $name = $row[$dbc]['name'];
    $code = $row[$dbc]['code'];
    $price = $row[$dbc]['price'];
    ?>

<div class="col-4">
<div class="h3">SKU : <?php echo $code;?></div>
<img src="product/<?php echo $id;?>.jpg" width="100%" alt="item1" />
<div class="h2"><?php echo $name;?></div>
<div class="h3"><?php echo $engine->toMoney($price);?></div>


<a href="plugin/addtocart.php?code=<?php echo $code;?>" class="btn btn-primary">{%ADD_TO_CART%}</a>

</div>

<?php
}

?>
</div>