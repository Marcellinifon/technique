

var selector_status = null,
    server_url = app_url;

var errorsForm = {
    user_id:false,
    devise_id:false,
    amount:false,
};


/**
 * Function for get language
 * @param {
 * } e
 */

function getLang(e) {
    lang = e;
}
/**
 * Request for getToken form helper
 * @param {
 * } callback
 */

/**
 * Request for body location gettiing
 *
 */
/**
 * Body location initiation
 * @param {
 *
 * } locations
 */

/**
 *sub body location initiation
 * @param {
 * } location_id
 * @param {*} callback
 */





function ajGet(url, success, error_callback) {
    let u = server_url + url;
    $.ajax({
        type: "GET",
        url: u,
        dataType: "json",
        contentType: false,
        processData: false,
        success: success,
        error: error_callback,
    })
}


function myFilter() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");

    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
}

function validation(e) {
    if(e.id==="amount"){
        if (e.value.replace(/\s/g, '') ==='') {
            errorsForm.amount=false;
            $("#"+e.id).css("border","1px solid red");
        }else if(e.value > amount){
            errorsForm.amount=false;
            $("#"+e.id).css("border","1px solid red");
        }else if(e.value===0){
            errorsForm.amount=false;
            $("#"+e.id).css("border","1px solid red");
        }else{
            delete errorsForm.amount;
            $("#"+e.id).css("border","1px solid green");
        }
    }else if(e.id==="dv_select"){
        if(e.value.replace(/\s/g, '') === ''){
            errorsForm.devise_id=false;
            $("#"+e.id).css("border","1px solid red");
        }else{
            delete errorsForm.devise_id;
            $("#"+e.id).css("border","1px solid green");
        }
    }else if(e.id==="user_select"){
        if(e.value.replace(/\s/g, '') === ''){
            errorsForm.user_id=false;
            $("#"+e.id).css("border","1px solid red");
        }else{
            delete errorsForm.user_id;
            $("#"+e.id).css("border","1px solid green");
        }

        console.log(errorsForm);
    }
    if (Object.keys(errorsForm).length===0) {
        $("#send").removeAttr("disabled");
    }else{
        $("#send").attr("disabled","disabled");
    }

}

function loadInputValue(user_id){
ajGet("/api/allUser",function(response){
        response.users.forEach(user => {
            if (user.id != user_id) {
                $("#user_select").append(`<option value='${user.id}'>${user.name +' ( '+ user.email+' )'} </option>`);
            }
        });

        response.devise.forEach(dv => {
            $("#dv_select").append(`<option value='${dv.id}'>${dv.acronym}</option>`);
        });
    },function (error){
        Swal.fire({
            title: 'Error!',
            text: 'Une erreur est survenue veuillez bien vouloir reprendre l\'oppération, si cela perciste contactez le service client merci',
            icon: 'error',
            confirmButtonText: 'Cool'
        })
});
}
