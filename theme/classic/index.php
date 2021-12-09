

<script type="text/javascript">jQuery(document).ready(function($){
(function(){
 
 $("#cart").on("click", function() {
   $(".shopping-cart").fadeToggle( "fast");
 });
 
})();

})
</script>

<nav>
  <div class="container">
    <ul class="navbar-left">
      <li><a href="#">{%HOME%}</a></li>
    </ul> <!--end navbar-left -->

    <ul class="navbar-right">
      <li><a href="#" id="cart"><i class="fa fa-shopping-cart"></i> {%CART%} <span class="badge">{CART_COUNT}</span></a></li>
    </ul> <!--end navbar-right -->
  </div> <!--end container -->
</nav>


<div class="container">
  <div class="shopping-cart">
    <div class="shopping-cart-header">
      <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">{CART_COUNT}</span>
    </div> <!--end shopping-cart-header -->

<div>
    <div class="shopping-cart-total">
        <span class="lighter-text">{%SHIPPING%}:</span>
        <span class="main-color-text">${SHIPPING_TOTAL}</span>
      </div>
      <div class="shopping-cart-total">
        <span class="lighter-text">{%CART_TOTAL%}:</span>
        <span class="main-color-text">${CART_TOTAL}</span>
      </div>
      <div class="shopping-cart-total">
        <span class="lighter-text">{%TOTAL_DUE%}:</span>
        <span class="main-color-text">${TOTAL}</span>
      </div>
</div>

    <ul class="shopping-cart-items">
    {CART_ITEMS}
    </ul>

    <a href="#" class="button">{%CHECKOUT%}</a>
  </div> <!--end shopping-cart -->
</div> <!--end container -->


<div class="container">

{BODY}

</div> <!--end container -->