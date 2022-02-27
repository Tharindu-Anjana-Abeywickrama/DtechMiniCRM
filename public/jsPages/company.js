
function loadeCompanyDetails(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "companylist",
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            var html="";
           
            $(data.company_details.data).each(function (key, val) {
                var email=val.email;
                var website_name=val.website_name;
                if(email==null){
                    email="";     
                }
                if(website_name==null){
                    website_name="";     
                }
                html+='<tr>';
                html+='<td style="display:none;">'+val.id+'</td>';
                html+='<td style="display:none;">storage/'+val.logo_path+'</td>';
                html+='<td><img id="frame2" width="25px;" height="25px;" src="storage/'+val.logo_path+'" class="img-fluid" width="150px;" height="150px;"/> '+'</td>';
                html+='<td>'+val.company_name+'</td>';
                html+='<td>'+email+'</td>';
                html+='<td>'+website_name+'</td>';
                html+='<td><button type="button" style="background-color: #5cb85c !important" onclick="viewEmployee('+val.id+')" class="btn btn-primary btn-sm">View Employee</button>&nbsp;&nbsp;&nbsp;<span><i onclick="deleteCompany('+val.id+')"  class="fa-solid fa-trash"></i></span></td>';
                html+='</tr>';
            });
         
            $('#companyBody').html(html);
            var last_page=data.company_details.last_page;
            var current_page=data.company_details.current_page;
            var last_page_url=data.company_details.last_page_url;
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
            // console.log(data);
         }
    });
} 

function loadTableData(url){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "companylist?page="+url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
             var html="";
           
            $(data.company_details.data).each(function (key, val) {
                var email=val.email;
                var website_name=val.website_name;
                if(email==null){
                    email="";     
                }
                if(website_name==null){
                    website_name="";     
                }
                html+='<tr>';
                html+='<td style="display:none;">'+val.id+'</td>';
                html+='<td style="display:none;">storage/'+val.logo_path+'</td>';
                html+='<td><img id="frame2" width="25px;" height="25px;" src="storage/'+val.logo_path+'" class="img-fluid" width="150px;" height="150px;"/> '+'</td>';
                html+='<td>'+val.company_name+'</td>';
                html+='<td>'+email+'</td>';
                html+='<td>'+website_name+'</td>';
                html+='<td><button type="button" style="background-color: #5cb85c !important" onclick="viewEmployee('+val.id+')" class="btn btn-primary btn-sm">View Employee</button>&nbsp;&nbsp;&nbsp;<span><i onclick="deleteCompany('+val.id+')"  class="fa-solid fa-trash"></i></span></td>';
                html+='</tr>';
            });
         
            $('#companyBody').html(html);
            var last_page=data.company_details.last_page;
            var current_page=data.company_details.current_page;
            var last_page_url=data.company_details.last_page_url;
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
            // console.log(data);
         }
    });
}

$("#companyBody").on('click','tr',function(e){
    e.preventDefault(); 

    clearImage();
    var values = $(this).find('td').map(function() {
        return $(this).text();
    });
    var id=values[0];
    var imagePath=values[1];
    var companyName=values[3];
    var email=values[4];
    var websiteName=values[5];

    $('#id').val(id);
    $('#company_name').val(companyName);
    $('#email').val(email);
    $('#website_name').val(websiteName);

    $('#frame').removeAttr('src');
    $('#frame').attr('src',imagePath);
    $('#btnSubmit').html('Update');
}); 



$(document).ready(function (e) {
   
   
    loadeCompanyDetails();
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#laravel-ajax-file-upload').submit(function (e) {
            e.preventDefault(); 

             var company_id=$('#id').val();
            if(company_id==""){
                //Saved
                var formData = new FormData(this);
            
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "store-file",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        // console.log(data); 
                        loadeCompanyDetails();
                        if(data=="This email name is saved already"){
                            Swal.fire(
                                'Not saved!',
                                'This email name is saved already!',
                                'error'
                            );       
                        }else{
                        Swal.fire(
                            'Saved success!',
                            'Company profile has been successfully created!',
                            'success'
                        );    
                        }

                    },
                    error: function (data) {
                        if(data.responseJSON.errors.company_name=="The company name field is required."){
                            printErrorMsg("The company name field is required.");
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
                    url: "store-file/"+company_id,
                    dataType: 'json',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        
                        Swal.fire(
                            'Updated success!',
                            'Company profile has been successfully updated!',
                            'success'
                        );  
                        // console.log(data);
                        loadeCompanyDetails();
                        
                    },
                    error: function (data) {
                        // console.log(data);
                        if(data.responseJSON.errors.company_name=="The company name field is required."){
                            printErrorMsg("The company name field is required.");
                        }
                    }
                });
            }
    
           
        });
    
    
        
        
       
    });

 function printErrorMsg(msg){ 
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
    
 }   


function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}
function clearImage() {
    document.getElementById('formFile').value = null;
    frame.src = "";
    $('#id').val("");
    $('#company_name').val("");
    $('#email').val("");
    $('#website_name').val("");
    $('#btnSubmit').html('Save');
    $('#frame').attr('src','storage/default.jpg');
    $('.print-error-msg').attr('style','display:none;');
    
  
}


function deleteCompany(company_id){


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
            deleteCom(company_id);
           
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

function deleteCom(company_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: "store-file-destroy/"+company_id,
        dataType: 'json',
        data: "",
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            this.reset();
            //  console.log(data);
             
        },
        error: function (data) {
            // console.log(data);
              
        }
    });
}

function viewEmployee(companyID){ 
  
    window.location.replace('employee/'+companyID);
    
}