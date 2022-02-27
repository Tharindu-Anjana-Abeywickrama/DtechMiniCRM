<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css" integrity="sha512-y4S4cBeErz9ykN3iwUC4kmP/Ca+zd8n8FDzlVbq5Nr73gn1VBXZhpriQ7avR+8fQLpyq4izWm0b8s6q4Vedb9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
#employeeBody tr:hover td,
#employeeBody tr:hover td.highlight
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
             <input type="hidden" class="form-control" id="employeeId" name="employeeId" aria-describedby="employeeId">
             <input type="hidden" class="form-control" id="company" name="company" aria-describedby="company" value='{{$posts}}'>
             <label for="company_name" class="form-label">Frist  Name</label><span  style="color:red !important;">&nbsp;&nbsp;<b>*</b></span>
             <input type="text" class="form-control" id="frist_name" name="frist_name" aria-describedby="company_name">
             <div class="alert alert-danger print-error-msg1" style="display:none">
                  <ul></ul>
              </div>
        </div>
        <div class="mb-3">
             <label for="last_name" class="form-label">Last Name</label><span  style="color:red !important;">&nbsp;&nbsp;<b>*</b></span>
             <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="last_name">
             <div class="alert alert-danger print-error-msg2" style="display:none">
                  <ul></ul>
              </div>
        </div>
        <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Email address</label>
             <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
         </div>
        <div class="mb-3">
             <label for="phone" class="form-label">Phone Number</label>
             <input type="number" class="form-control" id="phone" name="phone" aria-describedby="phone">
           
       </div>
        
        <div class="mb-3">
            
        </div>
        
        <button  type="button" onclick="clearForm()" class="btn btn-danger mt-3" style="background-color: #dc3545 !important">Clear</button>
       
        <button type="submith" id="btnSubmit" class="btn btn-primary mt-3" style="background-color: green !important">Save</button> 

        </div> 
        <div class="card col-md-8">

       
        <table class="table">
  <thead>
    <tr>
      <th scope="col" style="display:none;">#</th>
      <th scope="col" style="display:none;">#</th>
      <th scope="col">Frist Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Phone</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="employeeBody">
    
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
<script src="../jsPages/employee.js"></script>