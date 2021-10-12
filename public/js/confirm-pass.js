$(function() {

    const ui = new Interfaz();

    $(document).on('submit', '#form-confirm-pwd', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        ui.showModal('modal-apply-code', 'show');
        document.getElementById("msg-code").classList.add("hidden");
        let data = new FormData(this);
        $.ajax({
            url: "/verify-password",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                if(res.succes){
                    window.location.href = res.url;
                }else{
                    document.getElementById("msg-code").textContent = res.msg; 
                    document.getElementById("msg-code").classList.remove("hidden");
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
            }
        })
    });

    $('.only-number').on('keypress', function(event){
        return ui.onlyNumberKey(event);
    });  
});