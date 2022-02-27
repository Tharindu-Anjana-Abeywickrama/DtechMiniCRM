
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css" integrity="sha512-y4S4cBeErz9ykN3iwUC4kmP/Ca+zd8n8FDzlVbq5Nr73gn1VBXZhpriQ7avR+8fQLpyq4izWm0b8s6q4Vedb9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
#companyBody tr:hover td,
#companyBody tr:hover td.highlight
{
    background:	#87CEEB;
}

.btn-danger{
  background-color: #dc3545 !important;
}
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         
          
        </h2>
        <div class="row col-md-12 mt-2">
        <div class="card col-md-4">
        <form id="laravel-ajax-file-upload">
        {{ csrf_field() }}
        <div class="mb-3">
              
       
             <input type="hidden" class="form-control" id="id" name="id" aria-describedby="company_id">
             <label for="company_name" class="form-label">Company Name</label><span  style="color:red !important;">&nbsp;&nbsp;<b>*</b></span>
             <input type="text" class="form-control" id="company_name" name="company_name" aria-describedby="company_name">
             <div class="alert alert-danger print-error-msg" style="display:none">
                  <ul></ul>
              </div>

        </div>
        <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Email address</label>
             <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
         </div>
        <div class="mb-3">
             <label for="website_name" class="form-label">Website Name</label>
             <input type="text" class="form-control" id="website_name" name="website_name" aria-describedby="websiteName">
           
       </div>
        <div class="row mb-3">
             <div class="col-md-6">
             <label for="Image" class="form-label">Select Logo image Upload with Preview</label>
                <input class="form-control" type="file" name="file"  id="formFile" onchange="preview()"> 
                <!-- <input type="file" name="file" placeholder="Choose File" id="file"> -->
               
            </div>
            <div class="col-md-6">
            
            <img id="frame" src="storage/default.jpg" class="img-fluid" width="150px;" height="150px;"/>
            </div>
        </div> 
        <div class="mb-3">
            
        </div>
        <button  type="button" onclick="clearImage()" class="btn btn-danger mt-3" style="background-color: #dc3545 !important">Clear</button>
        <button type="submith" id="btnSubmit" class="btn btn-primary mt-3" style="background-color: green !important">Save</button> 

        </div> 
        <div class="card col-md-8">
       
        <table class="table">
  <thead>
    <tr>
      <th scope="col" style="display:none;">#</th>
      <th scope="col" style="display:none;">#</th>
      <th scope="col">Logo</th>
      <th scope="col">Company</th>
      <th scope="col">E-mail</th>
      <th scope="col">Website</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="companyBody">
    
  </tbody>
</table>
<span id="pagination"></span>
       </div> 
        </div>
        

    </x-slot>

    <div class="py-12">
        
    </div>
</x-app-layout>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.js" integrity="sha512-vDRRSInpSrdiN5LfDsexCr56x9mAO3WrKn8ZpIM77alA24mAH3DYkGVSIq0mT5coyfgOlTbFyBSUG7tjqdNkNw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="jsPages/company.js" type="text/javascript"></script>
