baseURL = "http://localhost/tailor/";
$(document).ready(function(){
	$("#addCustomer").click(function(){
		$('#loading').show();
		$(this).prop('disabled', true);
		var name = $("#name").val();
		var mobile = $("#mobile").val();
		var address = $("#address").val();
		$.post(baseURL+'admin/customer/add/',
	    {
	    	name: name,
        mobile: mobile,
        address: address,
        submit: "true"
	    },
	    function(data, status){
	        $('#loading').hide();
	        swal(data);
	        $("#addCustomer").prop('disabled', false);
	        if(data=="success"){
		        swal(
						  'Congratulations',
						  'Customer Added Successfully!<br><a href="'+baseURL+'admin/order/new">Click Here</a> To Place New Order.',
						  'success'
						);
						$("#name").val('');
						$("#mobile").val('');
						$("#address").val('');
	        }
	        else if(data=="duplicate"){
						swal(
						  'Customer Already Exists!!!',
						  'The Customer Information you have enter is already exists',
						  'warning'
						);
	        }
	        else if(data=="empty"){
						swal(
						  'Empty',
						  'Please Fill Name & Mobile No. both...',
						  'warning'
						);
	        }
	        else{
						swal(
						  'Something Went Wrong!!!',
						  'Failed To Add Customer! Try Again...',
						  'error'
						);
	        }
	    });
	});
});