
  function invoice(){
    
    var total = parseFloat($("#total").html());
    var nagori = parseFloat($("#nagori").val());
    if($("#nagori").val()==""){
      nagori = 0.0;
    }
    var discount = parseFloat($("#discount").val());
    if($("#discount").val()==""){
      discount = 0.0;
    }
    var paid = parseFloat($("#paid").html());
    if(isNaN(paid)){
      paid = 0;
    }
    var grandTotal = total + nagori - discount;
    $("#grandTotal").html(grandTotal);
    var payment = parseFloat($("#payment").val());
    if($("#payment").val()==""){
      payment = 0.0;
    }
    var advance = payment + paid - grandTotal;
    var due = grandTotal - payment - paid;
    if(advance<0)
      advance = 0.0;
    if(due<0)
      due = 0.0;
    $("#due").html(due);
    $("#advance").html(advance);
  }