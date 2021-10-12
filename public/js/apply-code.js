$(function() {

    const ui = new Interfaz();

    $(document).on('submit', '#form-apply-code', function(e){
        e.preventDefault();
        ui.blockBtn();
        document.getElementById("msg-code").classList.add("hidden");
        ui.showSpinner('visible');
        ui.showModal('modal-apply-code', 'show');
        let data = new FormData(this);
        $.ajax({
            url: "/apply-code/update",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                if(res.succes){
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                    document.getElementById("form-apply-code").reset();
                    document.getElementById("msg-code").textContent = res.msg; 
                    document.getElementById("msg-code").classList.remove("hidden");
                    ui.enableBtn();
                    console.log(res)
                }else{
                    alert(res.msg);
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                    document.getElementById("msg-code").textContent = res.msg; 
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