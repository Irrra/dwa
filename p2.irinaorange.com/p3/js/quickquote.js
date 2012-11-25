/* quickquote.js
 * code for calculating the cost of shooting 
 * author: Irina Danilova
 * created for the project 3, cscie-75, Harvard University Extension School
 */
 
 /* on document load:
		- wait for a form submission,
		- validate form (uses jQuery Validator Plug-In),
		- calculate and display results in a "quote" div
*/
$(document).ready( function() {
	$('#quoteForm').submit(function(e) {	 	  
	$('#quoteForm').validate(
		 { 
			 rules: {
				custname: {required: true},
				custphone: {phoneUS: true},
				shoottime: {range: [1,72]}
			},
			messages: {
				custname: "Please enter your name.",
				custphone: "Please specify a valid US phone number."
			} 
		} 
	); 
	  e.preventDefault();
      composeMessage();
	}); // end of submit
	}); // end of ready
	
	/* display the results of calculations */
	function composeMessage() {
	
	/* create variables */
	var firstName = $('#custname').val(); // Customer Name
	var myEvent = $('#eventtype option:selected'); // Type of shoot selected
	var myEventName = myEvent.text();
	var myEventType = myEvent.val();
	var hours = $('#shoottime').val(); // Hours of shooting
		if (hours == undefined || hours <=0 || hours > 72) {hours = 1;}
	var lowres = $('#lowres').val();
		if (lowres == undefined || lowres <=0 || lowres > 100) {lowres = 0;}
	var hires = $('#hires').val();
		if (hires == undefined || hires <=0 || hires > 100 ) {hires = 0;}
	var baseRate =0;
	var quickQuote=0;
	
	/* perform calculations */
	baseRate = calculateBaseRate(myEventType);
	quickQuote = calculateFinalCost(baseRate, hours, hires, lowres);
	
	/* display a quote to customer */
	 $('#quote').html("<p>Dear " + firstName + "!</p>");
	 $('#quote').append("<p>Thank you for choosing '" + myEventName + "' shooting with Idealcapture!</p>");
	 $('#quote').append("<p>Based on your selection, your base rate is $" + baseRate+ " / hour.</p>");
	 $('#quote').append("<p>The length of your shoot will be " + hours+ " hours.</p>");
	 /* check if any extra images were requested */
	 if (lowres !=0 || hires !=0) 
	 {
		$('#quote').append("<p>You are interested in additional images: " + hires + " hi-res and " + lowres + " low-res.</p>");
	} 
	 
	 $('#quote').append("<p>Your total quote is: $" + quickQuote  + ".</p>");
	
 }
 
 /* figure out the base rate for a specific type of shooting */
 function calculateBaseRate(typeOfShoot) {

	var hourlyRate;
	// switch between shooting options with different rates 
	 switch(typeOfShoot)
	{
	case 'individual', 'kids', 'ceremony', 'lovestory':
	  hourlyRate = 120;
	  break;
	  
	 case 'mitzvahs', 'birthdays':
	  hourlyRate = 125;
	  break;
	  
	case 'family', 'bothparts':
	  hourlyRate = 150;
	  break;
	  
	default:
	  hourlyRate = 120;
	} 
	return hourlyRate;
 }
 
  /* figure out the approximate total cost based ototaln rate, hours, and extra images */
 function calculateFinalCost(baseRate, hours, extraHi, extraLow) {
	
	var baseHours = 0;
	var extraHours = 0;
	var extraRate = 100;
	var extraHiRate = 5;
	var extraLowRate = 2.5;
	var finalQuote = 0;
	
	if (hours>0 && hours<= 4) {
		baseHours = hours;
		extraHours = 0;
	}
	else if (hours > 4){
		baseHours = 4;
		extraHours = hours - 4;
	}
	finalQuote = baseHours*baseRate + extraHours*extraRate + extraHi*extraHiRate + extraLow*extraLowRate;
	return finalQuote;
 }