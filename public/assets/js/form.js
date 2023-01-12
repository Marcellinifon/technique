$("#encours").hide();
        $("#send").attr("disabled","disabled");
        var amount = "00";
        loadInputValue(user_id);
        function getUserSolde() {

            $.ajax({
                type: "GET",
                url: "/api/balance/"+user_id,
                dataType: "json",
                contentType: false,
                processData: false,
                success: (response)=>{
                    amount = response.amount;
                    $('p[id=solde_form]').text(`votres solde est de : ${response.amount} FCFA`) ;
                },
                error: (error)=>{
                    console.log(error);
                },
            })
         }
         getUserSolde();

        function formTraitement() {
            $("#send").on('click',function (event) {
            $("#send").hide();
            $("#encours").show();

            var receive_id  = $('#user_select').val();
            var devise_id  = $('#dv_select').val();
            var amount  = $('#amount').val();
            var sender_id = user_id;

            var formData={
                receive_id:receive_id,
                sender_id:sender_id,
                devise_id:devise_id,
                amount:amount,

            };
            let url = "/api/saveTransfer"

            Swal.fire({
                icon: 'warning',
                title: 'Voullez-vous vraiment continuer avec l\'envoie d\'argent?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: `Non`,
                }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: (formData),
                        success: function(response){
                            if (response.status) {
                                getUserSolde()
                                Swal.fire('Envoie!', `${response.msg}`, 'success')
                                $("#send").show();
                                $("#encours").hide();
                            }else{
                                Swal.fire('Ooops!', `${response.msg}`, 'error');
                                $("#send").show();
                                $("#encours").hide();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR)
                        }
                    });
                }else{
                    $("#send").show();
                    $("#encours").hide();
                }
            })

            // event.preventDefault();
            });
        }

        $(document).ready(formTraitement());
