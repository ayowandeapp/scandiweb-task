//"use strict";
$(document).ready(function(){

    $('#sku').keyup(function(){
        var sku = $('#sku').val();
        var dbsku= '';
        if(sku == ''){
            $('#chksku').html("<font color='red'>sku field required</font>");
        }else{
            $('#chksku').html("<font color='red'></font>");
            //check in database if sku exist already
            chkskudb(sku);
        }

    })
    function chkskudb(sku){
        var dbsku= '';
        $.ajax({
                method:'GET',
                url:'/product/chk_sku/'+sku,
                success:function(resp){
                    //alert(resp);
                     if(resp=='false'){
                        $('#chksku').html("<font color='red'>sku not available</font>"); 
                        //return false;
                        window.dbsku= resp;                           
                    }else if(resp=='true'){
                        $('#chksku').html("<font color='green'>sku  available</font>");
                        //return true;
                        window.dbsku= resp;
                    }
                },error:function(){
                    alert('Error');
                }
            })
    }
    function chkname(name){
        if(name == ''){
            //alert("sku required");
            $('#chkname').html("<font color='red'>name field required</font>");
        }else{
             $('#chkname').html("<font color='red'></font>");
            //return true;
            }
    }
    $('#name').keyup(function(){
        var name = $('#name').val();
        //alert(name);
        chkname(name);
    })
    $('#price').keyup(function(){
        var price = $('#price').val();
        //alert(sku);
        chkprice(price);
    })
    function chkprice(price){
        if(price == '' || price < 1 || isNaN(price)){
            //alert("sku required");
            $('#chkprice').html("<font color='red'>price field required</font>");
         }else{
            $('#chkprice').html("<font color='red'></font>");
            //return true;
        }
    }
    $('#typeSwitch').change(function(){
        $('#chktype').html("<font color='red'></font>");
    })
    
    $("#submit").click(function(){
        var sku= $("#sku").val();
        var name= $("#name").val();
        var price=$("#price").val();
        var typeSwitch=$("#typeSwitch").val();
        var size = $("#size").val();
        var weight = $("#weight").val();
        var length = $("#length").val();
        var width = $("#width").val();
        var height = $("#height").val();
        if(sku.length == 0){
            $('#chksku').html("<font color='red'>sku field required</font>");
           }else{
            $('#chksku').html("<font color='red'></font>");
            //return true;
        }
        //check name
        chkname(name);
        //check price
        chkprice(price);
        if(typeSwitch == 'please choose'){
            //alert("sku required");
            $('#chktype').html("<font color='red'>Type field required</font>");
         }else{
            $('#chktype').html("<font color='red'></font>");
            //return true;
        }
        if(typeSwitch == 'disc' && (size =='' || size < 1 || isNaN(size))){
            //alert("sku required");
            $('#chksize').html("<font color='red'>Size field required</font>");
            }else{
                $('#chksize').html("<font color='red'></font>");
            }
        if(typeSwitch == 'book' && (weight =='' || weight < 1 || isNaN(weight))){
            //alert("sku required");
            $('#chkweight').html("<font color='red'>weight field required</font>");
            }else{
                $('#chkweight').html("<font color='red'></font>");
            }
        if(typeSwitch == 'furniture' && length =='' && width =='' && height ==''){
            //alert("sku required");
            $('#chkheight').html("<font color='red'>field required</font>");
            }else{
                $('#chkheight').html("<font color='red'></font>");
            }


        if((sku !=''  && window.dbsku!='false' && name != '' && price != '' && typeSwitch != 'please choose') && ((size !='' || weight !='') || (length !='' && width !='' && height !=''))){
                $('#form1').submit();
        }else{
            chkskudb(sku);
            return false;
        }

    });
});
$("#typeSwitch").on("change", function() {
    $(".selectable").hide();
    var optionValue= $(this).val();
    $("#" + optionValue).show();
})