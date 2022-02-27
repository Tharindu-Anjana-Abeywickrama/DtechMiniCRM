
function loadeEmployeeDetails(){ 
    var companyId=$('#company').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "employeelist/"+companyId,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            // alert('File has been uploaded successfully');
            var html="";
           
            $(data.employee_details.data).each(function (key, val) {
                var email=val.email;
                var phone=val.phone;
                if(email==null){
                    email="";
                }
                if(phone==null){
                    phone="";
                }

                html+='<tr>';
                html+='<td style="display:none;">'+val.id+'</td>';
                html+='<td style="display:none;">'+val.company+'</td>';
                html+='<td>'+val.frist_name+'</td>';
                html+='<td>'+val.last_name+'</td>';
                html+='<td>'+email+'</td>';
                html+='<td>'+phone+'</td>';
                html+='<td><span><i onclick="deleteEmployee('+val.id+')"  class="fa-solid fa-trash"></i></span></td>';
                html+='</tr>';
            });
         
            $('#employeeBody').html(html);
            var last_page=data.employee_details.last_page;
            var current_page=data.employee_details.current_page;
            var last_page_url=data.employee_details.last_page_url;
            var Previous=1;
            if(current_page>1){
                Previous=current_page-1;
            }    
            var Next=current_page+1;
            if(last_page_url==current_page){
                Next=current_page;
            }

            var pagination="";
            pagination+='<nav aria-label="Page navigation example">';
            pagination+='<ul class="pagination">';
            pagination+='<li class="page-item"><a class="page-link" href="#" onclick="loadTableData('+Previous+')">Previous</a></li>';
            for(var i=1;i<=last_page;i++){
                if(current_page==i){
                    pagination+='<li class="page-item active"><a class="page-link"  onclick="loadTableData('+i+')">'+i+'</a></li>'   
                   }else{
                   pagination+='<li class="page-item"><a class="page-link"onclick="loadTableData('+i+')">'+i+'</a></li>'
                   }
            } 
            pagination+='<li class="page-item"><a class="page-link" onclick="loadTableData('+Next+')" >Next</a></li>';
            pagination+='</ul>';
            pagination+='</nav>';

        

            $('#pagination').html(pagination);
        },
        error: function (data) {
            console.log(data);
            // alert('The given data was invalid');
        }
    });
}  

function loadTableData(url){
    var companyId=$('#company').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "employeelist/"+companyId+"?page="+url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            // alert('File has been uploaded successfully');
            var html="";
           
            $(data.employee_details.data).each(function (key, val) {
                html+='<tr>';
                html+='<td style="display:none;">'+val.id+'</td>';
                html+='<td style="display:none;">'+val.company+'</td>';
                html+='<td>'+val.frist_name+'</td>';
                html+='<td>'+val.last_name+'</td>';
                html+='<td>'+val.email+'</td>';
                html+='<td>'+val.phone+'</td>';
                html+='<td><span><i onclick="deleteEmployee('+val.id+')"  class="fa-solid fa-trash"></i></span></td>';
                html+='</tr>';
            });
         
            $('#employeeBody').html(html);
            var last_page=data.employee_details.last_page;
            var current_page=data.employee_details.current_page;
            var last_page_url=data.employee_details.last_page_url;
            var Previous=1;
            if(current_page>1){
                Previous=current_page-1;
            }    
            var Next=current_page+1;
            if(last_page_url==current_page){
                Next=current_page;
            }

            var pagination="";
            pagination+='<nav aria-label="Page navigation example">';
            pagination+='<ul class="pagination">';
            pagination+='<li class="page-item"><a class="page-link" onclick="loadTableData('+Previous+')">Previous</a></li>';
            for(var i=1;i<=last_page;i++){ 
                if(current_page==i){
                 pagination+='<li class="page-item active"><a class="page-link"  onclick="loadTableData('+i+')">'+i+'</a></li>'   
                }else{
                pagination+='<li class="page-item"><a class="page-link"onclick="loadTableData('+i+')">'+i+'</a></li>'
                }
            } 
            pagination+='<li class="page-item"><a class="page-link" onclick="loadTableData('+Next+')" >Next</a></li>';
            pagination+='</ul>';
            pagination+='</nav>';

        

            $('#pagination').html(pagination);
        },
        error: function (data) {
            console.log(data);
            // alert('The given data was invalid');
        }
    });
}

$(document).ready(function (e) {
   
    loadeEmployeeDetails();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#laravel-ajax-file-upload').submit(function (e) {
            e.preventDefault();
            var employeeId=$('#employeeId').val();
            if(employeeId==""){
                //Saved
                var formData = new FormData(this);
            
                $.ajax({
                    type: 'POST',
                    url: "employeeDetails",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        // console.log(data); 
                        Swal.fire(
                            'Saved success!',
                            'Employee profile has been successfully created!',
                            'success'
                        );    
                        loadeEmployeeDetails();
                    },
                    error: function (data) {
                        console.log(data);
                        if(data.responseJSON.errors.frist_name=="The frist name field is required."){
                            printErrorMsg1("The frist name field is required.");
                        }

                        if(data.responseJSON.errors.last_name=="The last name field is required."){
                            printErrorMsg2("The last name field is required.");
                        }
                       
                       
                    }
                });
            }else{
                //Update
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "employeeDetails/"+employeeId,
                    dataType: 'json',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        // console.log(data);
                        Swal.fire(
                            'Updated success!',
                            'Employee profile has been successfully updated!',
                            'success'
                        );  
                        loadeEmployeeDetails();
                    },
                    error: function (data) {
                        if(data.responseJSON.errors.frist_name=="The frist name field is required."){
                            printErrorMsg1("The frist name field is required.");
                        }

                        if(data.responseJSON.errors.last_name=="The last name field is required."){
                            printErrorMsg2("The last name field is required.");
                        }
                        
                    }
                });
            }
    
           
        });
    
        
        
       
    });

 function printErrorMsg1(msg){ 
        $(".print-error-msg1").find("ul").html('');
        $(".print-error-msg1").css('display','block');
        $(".print-error-msg1").find("ul").append('<li>'+msg+'</li>');
        
}  
     
function printErrorMsg2(msg){ 
        $(".print-error-msg2").find("ul").html('');
        $(".print-error-msg2").css('display','block');
        $(".print-error-msg2").find("ul").append('<li>'+msg+'</li>');
        
}  


function deleteEmployee(id){ 
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            deleteEmp(id);
           
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
          loadeCompanyDetails();
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      });
      
} 

function deleteEmp(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: "destroy/"+id,
        dataType: 'json',
        data: "",
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => { 
            loadeEmployeeDetails();
            this.reset();
            
             console.log(data);
            
        },
        error: function (data) {
            console.log(data);
            alert('The given data was invalid');
           
        }
    });
}

$("#employeeBody").on('click','tr',function(e){
    e.preventDefault();
    clearForm();
    var values = $(this).find('td').map(function() {
        return $(this).text();
    });
    var employeeId=values[0];
    var companyId=values[1];
    var fristName=values[2];
    var lastName=values[3];
    var email=values[4];
    var phone=values[5];

    $('#employeeId').val(employeeId);
    $('#company').val(companyId);
    $('#frist_name').val(fristName);
    $('#last_name').val(lastName);
    $('#email').val(email);
    $('#phone').val(phone);
    $('#btnSubmit').html('Update');

}); 


function clearForm(){
    $('#id').val("");
    $('#employeeId').val("");
    $('#frist_name').val("");
    $('#last_name').val("");
    $('#email').val("");
    $('#phone').val("");
    $('#btnSubmit').html('Save');
    $('.print-error-msg1').attr('style','display:none;');
    $('.print-error-msg2').attr('style','display:none;');
}