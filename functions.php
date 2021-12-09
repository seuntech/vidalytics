<script type="text/javascript">
        function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }
        
/*
         function setCookie(key, value) {
                 var expires = new Date();
                 expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
                 document.cookie = key + '=' + value +';path=/'+ ';expires=' + expires.toUTCString();
             }
 */
            //60 * 1000 = 60 second 60* (60 * 1000) = 60 mins which is 1 hour 24* (60* (60 * 1000)) = 1 day which 24 hours 
</script>
<script type="text/javascript">
// Create our number formatter.
var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'NGN',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

function empty(varable){
    if(varable == null){return true;}
    var n=varable.replace(" ","");
    if(n.length > 0){return false;}
    return true;
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}//$.urlParam('p')

jQuery(document).ready(function($){
 $(document).mouseup(function (e)
{
    var container = $(".specialhide");
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        container.hide(50);
    }
});


$(".specialhide").hover(function()
{
  $(this).show();
},
function()
{
  $(this).hide();
});




jQuery('.moneyOnly').keypress(function(event){
    if (event.which == 46 || event.which == 8)
        {
        //do nothing
        }
        else 
        {
            if (event.which < 48 || event.which > 57 ) 
            {
			    event.preventDefault();	
			}	
        }
        
        formatCurrency($(this));
});

jQuery('.numberOnly').keypress(function(event){
	if(event.which !=8 && isNaN(String.fromCharCode(event.which))){
		event.preventDefault();
	}
	//	console.log(event.which);
});

jQuery('.digitsOnly').keypress(function(event){
	//if(event.which !=8 && isNaN(String.fromCharCode(event.which))){
		//event.preventDefault();
//	}
    
    if (event.which == 46 || event.which == 8)
        {
        //do nothing
        }
        else 
        {
            if (event.which < 48 || event.which > 57 ) 
            {
			    event.preventDefault();	
			}	
        }
	//	console.log(event.which);
});

    });
    
    function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input) {
    var blur = "blurd";
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}


    
    
function selectElementContents(el) {
    var body = document.body, range, sel;
    if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
            range.selectNodeContents(el);
            sel.addRange(range);
        } catch (e) {
            range.selectNode(el);
            sel.addRange(range);
        }
    } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
        document.execCommand("copy");
    }
}
</script>
