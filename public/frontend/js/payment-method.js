// Create a Stripe client.
var stripe = Stripe(stripeClient);
//var stripe = Stripe("{{env('STRIPE_KEY')}}");
// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
//var card = elements.create('card', {style: style});
var card = elements.create('card', {hidePostalCode: true, style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  emptyServeErrorMsg();
  //disableFooterNextBtn();
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayErrorMsg(event.error.message);//.textContent = event.error.message;
  } else {
    emptyServeErrorMsg();
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');

form.addEventListener('submit', function(event) {
  event.preventDefault();
  emptyServeErrorMsg();
  
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
     // errorElement.textContent = result.error.message;
	  displayErrorMsg(result.error.message);
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');

  //Remove element
  var element = document.getElementsByName('stripeToken');
  //console.log(element.length);
  if(element.length > 0){
  	$('input[name=stripeToken').remove();
  	//element.parentNode.removeChild(element);
  }
    

  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
 /* Submit the form*/
  submitForm();
}


function submitForm(){
 	$('.card-server-error').html('');
  $('.error').html('');
  /*show button loader*/
  var btn = $('.save-stor-card');
  $('.stripe-spinner').css('display','inline-block');
  
	/* get the action attribute from the <form action=""> element */
	var form = $('#payment-form');
  var formSerialze = form.serialize();
  var hiddenPath = $('#path').val();
  
  if(hiddenPath == 'register'){
    form = $('#Signup-Form');
    formSerialze = $("#Signup-Form, #payment-form").serialize();
  }else{
    formSerialze = form.serializeArray();
    var planSelected = $('.updatePlan.selected');
    if(planSelected.length >0){
      var selectedPlanId = planSelected.data("stripe");
	
      var selectedPaymentMethod = $("input[name='payment_method']:checked").val()
      formSerialze.push({ name: "plan", value: selectedPlanId });
      formSerialze.push({ name: "payment_method", value: selectedPaymentMethod });
    }
  }
	
  $.ajax({
        url     : form.attr('action'),
        type    : form.attr('method'),
        data    : formSerialze,
        dataType: 'json',
        success : function ( json )
        {
           /*stop loader*/
          $('.stripe-spinner').css('display','none');
          if(json.success){
            /*check redirect url exist*/
            if(typeof (json.redirect_url) != 'undefined' && json.redirect_url != null &&json.redirect_url != ''){
              window.location = json.redirect_url;
            }else{
              if(typeof (json.message) != 'undefined' && json.message != null && json.message != ""){
                notification('Success',json.message,'top-right','success',2000);
              }else{
                notification('Success','Your Plan is successfully activated.','top-right','success',2000);
              }
              //redirect current page
              setTimeout(function(){
                window.location.reload();
              },2000);
            }
          }else{
            alert(json.msg);
          }	 
        },
        error: function( json )
        {
           /*stop loader*/
            $('.stripe-spinner').css('display','none');
            if(json.status === 422) {
                $("#stripeCardModal").modal("hide");
                $('html, body').animate({
                    scrollTop: $("#sign-up-sec").offset().top
                }, 2000);
                var errors = json.responseJSON['errors'];
                //console.log(errors);
              	//displayErrorMsg(errors);
                $.each(errors, function (keys, values) {
                  if($.isPlainObject(values)) {
                      $.each(values, function (key, value) {                     
                        var key = key.replace('.','_');
                          $('.'+key+'_error').show().append(value);
                        });
                    }
                    else if(Array.isArray(values)){
                      $.each(values, function (key, value) {                     
                        var key = keys.replace('.','_');
                          $('.'+key+'_error').show().append(value);
                      });
                    }
                  });
            }else{
            	displayErrorMsg(json['msg']);
            }
        }
    });
}

function displayErrorMsg(errors){
	$('.card-server-error').html(errors).show();
}

function emptyServeErrorMsg(){
	$('.card-server-error').html('');
}	
