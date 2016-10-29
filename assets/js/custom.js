$(window).load(function()
{
	$('#invoiceform .invoiceDate').datepicker({
		format: "dd/mm/yyyy",
		weekStart: 0,
		todayBtn: true,
		clearBtn: true,
		language: "en",
		multidate: false,
		todayHighlight: true
	});
});


var $n=1;
(function ($)
{
    "use strict";
    var mainApp =
	{

        main_fun: function () 
		{
            $('#main-menu').metisMenu();

            $(window).bind("load resize", function ()
			{
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
			
			//  Tax : on off
			$('#tax').change(function()
			{
				if($('#tax').val() == 'off') {$('#taxinput').val("0"); calculTotal(); $('#taxvalue').hide();}
				else{calculTotal(); $('#taxvalue').show();} 
			});
			
			//  Discount : on off
			$('#discount').change(function()
			{
				if($('#discount').val() == 'off') { $('#discountinput').val("0");  calculTotal(); $('#discountvalue').hide(); }
				else{calculTotal(); $('#discountvalue').show();} 
			});
			
			// Currency option
			$('#currency').change(function()
			{
				$('.currency').text($('#currency').val());
			});
			
			$("#removeitem").hide();
			// Add item
			$("#additem").click(function()
			{
				$n++;
				$('#items').append('<div class="row" id="item'+ $n +'"><br/><div class="col-md-12"><div class="col-md-4"><div class="form-group"><label>Item*</label><input class="form-control" name="item'+ $n +'" type="text" placeholder="Description of service or product" required ></div></div><div class="col-md-2"><div class="form-group"><label>QUANTITY*</label><input class="form-control" name="quantity'+ $n +'" type="text" value="1" id="quantity'+ $n +'" onkeypress="return isNumber(event)" onkeyup="calculSubTotal('+ $n +'), calculTotal()" required /></div></div><div class="col-md-3"><div class="form-group"><label>PRICE*</label><input class="form-control" name="price'+ $n +'" type="text" id="price'+ $n +'" onkeypress="return isNumber(event)" onkeyup="calculSubTotal('+ $n +'), calculTotal()" required /></div></div><div class="col-md-3"><div class="form-group"><label>Total</label><br /><span><strong><span class="currency">$</span><span id="subtot'+ $n +'" > 0</span></strong></span><input type="hidden" name="subtothidden'+ $n +'" id="subtothidden'+ $n +'" value="0"></div></div></div></div>');
				$('#nbritem').val($n);
				$("#removeitem").show();
			});
			
			// remove item
			$("#removeitem").click(function()
			{
				$('#item'+$n).remove();
				$n--;
				$('#nbritem').val($n);
				calculTotal();
				
				if($n==1)
				{
				   $("#removeitem").hide();
				}
			});		
     
        },

        initialization: function ()
		{
            mainApp.main_fun();
        }

    }
    // Initializing ///

    $(document).ready(function ()
	{
        mainApp.main_fun();
    });

}(jQuery));

// Round Two function
var roundTwo = function (num) {
    return +(Math.round(num + "e+2")  + "e-2");
};

// Calcul Sub Total
function calculSubTotal(num)
{
	var quantity = $('#quantity'+num).val();
	var price = $('#price'+num).val();
	
	var subtot = price * quantity;
	
	$('#subtot'+num).text(' '+roundTwo(parseFloat(subtot)));
	$('#subtothidden'+num).val(roundTwo(parseFloat(subtot)));
	
	return subtot;
}

//Calcul Total
function calculTotal()
{
	var s=0;
	for (i = 1; i <=$n; i++)
	{
		s = s + calculSubTotal(i);
	}
	$('#subtotal').text(' '+roundTwo(parseFloat(s)));
	$('#subtotalhidden').val(roundTwo(parseFloat(s)));
	
	var discount = $('#discountinput').val();
	var tax = $('#taxinput').val();
	
	var total1 = (s - ((s/100)*discount));
	var total2 = total1 + ((total1/100)*tax);
	$('#total').text(' '+roundTwo(parseFloat(total2)));
	$('#totalhidden').val(roundTwo(parseFloat(total2)));
	
}