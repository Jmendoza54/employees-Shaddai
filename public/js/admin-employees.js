$(function() {

    const ui = new Interfaz();
    const action = new ACTIONS();

    var tableEmployees = $('#table-employees').DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "/admin/tableEmployees",
        columns: [
            {data : 'name'},
            {data : 'sede'},
            {data : 'job'},
            {data : 'status'},
            {data : 'code'},
            {data : 'admission_date'},
            {data: 'photo_qr'},
            {data: 'photo_employee'},
            {data : 'actions'},
        ],
        fnDrawCallback: function( oSettings ) {
            $('#table-employees .btn-delete').on('click', function(){
                const id = $(this).data('target');
                $.open_confirm(id, 'modal-delete', 'form-delete-employee');
            });

            $('#table-employees .btn-edit').on('click', function(){
                const id = $(this).data('target');
                action.getResult(id);
            });

            $('#table-employees .btn-down-date').on('click', function(){
                const id = $(this).data('target');
                $.open_confirm(id, 'modal-update-down-date', 'form-update-down-date');
            });
        },
    });

    tableEmployees.on( 'search.dt', function () {
        console.log( 'Currently applied global search: '+ tableEmployees.search() );
    } );

    $(document).on('submit', '#form-employee-add', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = new FormData(this);
        $.ajax({
            url: "/admin/employee/create",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                if(res.succes){
                    tableEmployees.ajax.reload();
                    ui.showModal('modal-employee-add', 'hide');
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                    document.getElementById("form-employee-add").reset();
                }else{
                    alert(res.msg);
                    ui.showModal('modal-employee-add', 'hide');
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

    $(document).on('submit', '#form-employee-update', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = new FormData(this);
        $.ajax({
            url: "/admin/employee/update",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                if(res.succes){
                    tableEmployees.ajax.reload();
                    ui.showModal('modal-employee-update', 'hide');
                    ui.enableBtn();
                    ui.showSpinner('hidden');
                    document.getElementById("form-employee-update").reset();
                    console.log(res)
                }else{
                    alert(res.msg);
                    ui.showModal('modal-employee-update', 'hide');
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

    $(document).on('submit', '#form-delete-employee', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = $(this).serialize();

        $.ajax({
            url: '/admin/employee/destroy',
            type: "POST",
            data: data,
            dataType: 'JSON',
            success: function(res){
                tableEmployees.ajax.reload();
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

    $(document).on('submit', '#form-update-down-date', function(e){
        e.preventDefault();
        ui.blockBtn();
        ui.showSpinner('visible');
        let data = $(this).serialize();

        $.ajax({
            url: '/admin/employee/down-date',
            type: "POST",
            data: data,
            dataType: 'JSON',
            success: function(res){
                tableEmployees.ajax.reload();
                ui.showModal('modal-update-down-date', 'hide');
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

    $.open_confirm = function(id, target, form){
        ui.showModal(target, 'show');
        $(`#${form} #id`).val(id);
    }
    
});