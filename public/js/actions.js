class ACTIONS{

    getResult(id){

        $.ajax({
            url: '/admin/getEmployee/' + id,
            method: 'GET',
            success: function(data){
                if(data.succes){
                    $.each(data.employee, function(key, value){
                        $(`#form-employee-update #${key}`).val(value);
                    });
                    $('#modal-employee-update').modal('show');
                }else{
                    alert(data.msg);
                }
            }
        })
    }

    getDataCode(id){
        $.ajax({
            url: '/admin/getCode/' + id,
            method: 'GET',
            success: function(data){
                if(data.succes){
                    $.each(data.employee, function(key, value){
                        $(`#form-update-code input[name="${key}"], #form-update-code select[name="${key}"], #form-update-code textarea[name="${key}"]`).val(value);
                    });
                    $('#modal-code-update').modal('show');
                }else{
                    alert(data.msg);
                }
            }
        })
    }

    async getEmployees(){
        const url = '/admin/getEmployees';
        const urlGetEmployees = await fetch(url);
        const data = await urlGetEmployees.json();

        return data;
    }

    async getCode(){
        const url = '/admin/getDiscCode';
        const urlGetCode = await fetch(url);
        const data = await urlGetCode.json();

        return data;
    }

    appendData(employee){
        let select = "<option value=''>Seleccionar un empleado</option>";
        employee.forEach(emp => {
            select += `<option value='${emp.id}'>${emp.name} ${emp.lastname}</option>`;
        });

        document.querySelector('#form-add-code #employee_id').innerHTML = select;
        document.querySelector('#form-update-code #employee_id').innerHTML = select;
    }

    appendCode(code){
        document.querySelector('#form-add-code input[name="code"]').value = code;
    }
    
}