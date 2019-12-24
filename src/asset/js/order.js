
/*
$("#existingCustomerToggle").click(function() {
	$("#newCustomerDiv").hide();
	$("#existingCustomerDiv").fadeIn();
	
});
$("#newCustomerToggle").click(function() {
	$("#existingCustomerDiv").hide();
	$("#newCustomerDiv").fadeIn();
});
*/
$(".date").datepicker({
    format: "dd/mm/yyyy",
    setDate: new Date()
});
$("#selectCustomer").select2();
