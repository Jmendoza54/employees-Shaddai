class Interfaz{

    blockBtn(){
        $('button[type="submit"]').attr('disabled', 'disabled');
    }

    enableBtn(){
        $('button[type="submit"], button[type="button"]').removeAttr('disabled');
    }

    showSpinner(vista){
        const spinner = $('.sk-cube-grid');
        const body = $('.body-cont');
        
        if(vista == 'visible'){
            body.addClass('hidden');
            spinner.removeClass('hidden');
        }else{
            body.removeClass('hidden');
            spinner.addClass('hidden');
        }
    }

    showModal(id, action){
        $(`#${id}`).modal(action);
    }

    onlyNumberKey(evt) { 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57 || ASCIICode == 186 || ASCIICode == 96)) 
            return false; 
        return true; 
    }
}