$(function() {

    const ui = new Interfaz();
    const action = new ACTIONS();

    var tableCodes = $('#table-codes').DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "/admin/getCodes",
        columns: [
            {data : 'name'},
            {data : 'code'},
            {data : 'status', className: "text-center"},
            {data : 'sede'},
            {
                data : 'total',
                render: $.fn.dataTable.render.number( ',', '.', 2, '$' )

            },
            {data : 'kind_apply'},
            {data : 'application_date'},
            {data: 'comments'},
            {data : 'actions', orderable: false, searchable: false,},
        ],
        fnDrawCallback: function( oSettings ) {
            $('#table-codes .btn-delete').on('click', function(){
                const id = $(this).data('target');
                $.open_confirm(id, 'modal-delete', 'form-delete-code');
            });

            $('#table-codes .btn-edit').on('click', function(){
                const id = $(this).data('target');
                action.getDataCode(id);
            });
        },
    });

    $(document).on('submit', '#form-add-code', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = new FormData(this);
        $.ajax({
            url: "/admin/code/create",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                console.log(res)
                if(res.succes){
                    tableCodes.ajax.reload();
                    ui.showModal('modal-code-add', 'hide');
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                    document.getElementById("form-add-code").reset();
                }else{
                    alert(res.msg);
                    ui.showModal('modal-code-add', 'hide');
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
                ui.showModal('modal-code-add', 'hide');
                ui.enableBtn();
                ui.showSpinner('hidden');
                alert('Error, intente más tarde');
            }
        })
    });

    $(document).on('submit', '#form-update-code', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = new FormData(this);
        $.ajax({
            url: "/admin/code/update",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                if(res.succes){
                    tableCodes.ajax.reload();
                    ui.showModal('modal-code-update', 'hide');
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                    document.getElementById("form-update-code").reset();
                }else{
                    alert(res.msg);
                    ui.showModal('modal-code-update', 'hide');
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

    $(document).on('submit', '#form-delete-code', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = $(this).serialize();

        $.ajax({
            url: '/admin/code/destroy',
            type: "POST",
            data: data,
            dataType: 'JSON',
            success: function(res){
                tableCodes.ajax.reload();
                ui.showModal('modal-delete', 'hide');
                ui.enableBtn();
                ui.showSpinner('hidden');
                
                console.log(res)
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        })
    });

    $('.only-number').on('keypress', function(event){
        return ui.onlyNumberKey(event);
    }); 

    $('#modal-add-code').on('click', function(){
        action.getCode().then(json =>{
            action.appendCode(json.code);
        });
    });

    action.getEmployees().then(json => {
        action.appendData(json.employee);
    })

    $.open_confirm = function(id, target, form){
        ui.showModal(target, 'show');
        $(`#${form} #id`).val(id);
    }
    
});