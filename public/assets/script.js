if (window.location.pathname === "/product/add_product") {
$(document).ready(function(){

    function validateForm(){
        const form = document.querySelector(".form-validation");
        form.addEventListener("submit",(event)=>{

        //alert('ok');
            if (!form.checkValidity()) {

            event.preventDefault();
            event.reportValidity();
            }

        },false);
    }

    function chkSkuValidity(){
        const sku= document.getElementById("sku");
        sku.addEventListener("input",(event)=>{
            //alert(sku.value);
            $.ajax({
                    method:'GET',
                    url:'/product/chk_sku/'+sku.value,
                    success:function(resp){
                        //alert(resp);
                        if(resp=='false' || sku.value==''){
                            sku.setCustomValidity("SKU not available");
                            $('#chksku').html("<font color='red'>SKU not available</font>");
                            sku.reportValidity();                        
                        }else if(resp=='true'){
                            sku.setCustomValidity("");
                            $('#chksku').html("<font color='green'>sku available</font>");
                        }else{
                            $('#chksku').html("<font color='green'>sku required</font>");
                        }
                    },error:function(){
                     alert('Error');
                    }
                })
        })
    }

    function typeSwitchValidity(){
        const type = document.querySelector("#typeSwitch");
        type.addEventListener("change", (event) => {
            $(".selectable").hide();
            $("#" + type.value.toLowerCase()).show();
            //alert(type.value);
            document.querySelectorAll("#type input").forEach((element) => {
            element.removeAttribute("required");
            });
            if(type.value !=""){
                const select = document.querySelector("#" + type.value.toLowerCase());
                select.querySelectorAll("input").forEach((element) => {
                element.setAttribute("required","");
                });
            }
    })
}


validateForm();
chkSkuValidity();
typeSwitchValidity();
  
});

}


