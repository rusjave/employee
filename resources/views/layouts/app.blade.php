<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Employee</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-glyphicons.css') }}">

    <link rel="stylesheet" href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Employee</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<form class="navbar-form navbar-right" action="/result" method="POST" role="search">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="q" placeholder="Search products here" id="searchName">
            <button type="submit" class="btn btn-default">
              <span class="glyphicon glyphicon-search"></span>
            </button> 
          </form>
				</div>
        
			</div>
		</nav>
    
			@yield('content')
	</div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-2.2.4.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

		<script type="text/javascript">
      
    $(document).ready(function(){
         // Add 
      $('body').on('click', '#submitForm', function(){
          var registerForm = $("#addEmployee");
          var formData = registerForm.serialize();
          $( '#first-name-error' ).html( "" );
          $( '#last-name-error' ).html( "" );
          $( '#address-error' ).html( "" );
          $( '#registered-date-error' ).html( "" );
          $( '#phone-error' ).html( "" );
          $( '#email-date-error' ).html( "" );
          $( '#email-date-error' ).html( "" );


          $.ajax({
              url:'/addEmployee',
              type:'POST',
              data:formData,
              success:function(data) {
                console.log(data);
                if(data.errors) {
									if(data.errors.first_name){
										$( '#first-name-error' ).html( data.errors.first_name[0] );
									}
									if(data.errors.last_name){
										$( '#last-name-error' ).html( data.errors.last_name[0] );
									}
									if(data.errors.address){
										$( '#address-error' ).html( data.errors.address[0] )
                  }
                  if(data.errors.registered_date){
										$( '#registered-date-error' ).html( data.errors.registered_date[0] )
                  }
                  if(data.errors.phone){
										$( '#phone-error' ).html( data.errors.phone[0] )
                  }
                  if(data.errors.email){
										$( '#email-error' ).html( data.errors.email[0] )
									}       
                }
                var json = data;
                  if(json.status == 200) {
                    alert(json.message);
                    setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                } else {
                  alert("Added Failed!");
                }
              },
          });
      });
      // Show  
      $('#show').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var first_name = button.data('first-name');
        var id = button.data('id');
        var last_name = button.data('last-name');
        var address = button.data('address');
        var created_at = button.data('created-at');
        var resgistered_date = button.data('registered-date');
        var phone = button.data('phone');
        var email = button.data('email');
        var company_name = button.data('company-name');
        var company_phone = button.data('company-phone');
        var modal = $(this);
  
        modal.find('.modal-body #first_name_show').val(first_name);
        modal.find('.modal-body #id_show').val(id);
        modal.find('.modal-body #last_name_show').val(last_name);
        modal.find('.modal-body #address_show').val(address);
        modal.find('.modal-body #created_at_show').val(created_at);
        modal.find('.modal-body #registered_date_show').val(resgistered_date);
        modal.find('.modal-body #phone_show').val(phone);
        modal.find('.modal-body #email_show').val(email);
        modal.find('.modal-body #company_name_show').val(company_name);
        modal.find('.modal-body #company_phone_show').val(company_phone);
      })
      // Edit   
      $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var first_name = button.data('first-name');
        var id = button.data('id');
        var last_name = button.data('last-name');
        var address = button.data('address');
        var created_at = button.data('created-at');
        var resgistered_date = button.data('registered-date');
        var phone = button.data('phone');
        var email = button.data('email');
        var company_name = button.data('company-name');
        var modal = $(this);
  
        modal.find('.modal-body #first_name_edit').val(first_name);
        modal.find('.modal-body #id_edit').val(id);
        modal.find('.modal-body #last_name_edit').val(last_name);
        modal.find('.modal-body #address_edit').val(address);
        modal.find('.modal-body #created_at_edit').val(created_at);
        modal.find('.modal-body #registered_date_edit').val(resgistered_date);
        modal.find('.modal-body #phone_edit').val(phone);
        modal.find('.modal-body #email_edit').val(email);
        modal.find('.modal-body #company_name_edit').val(company_name);
      })
      // Update 
        $('.modal-footer').on('click', '#updateEmployee', function(){       
          if($('#company_id_edit').val() == '') {
            alert('Please select new company!');
          }
          $.ajax({  
              url:'/updateEmployee',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_edit').val(),
                'first_name' : $('#first_name_edit').val(),
                'last_name' : $('#last_name_edit').val(),
                'address' : $('#address_edit').val(),
                'registered_date' : $('#registered_date_edit').val(),
                'phone' : $('#phone_edit').val(), 
                'email' : $('#email_edit').val(),
                'company_id' : $('#company_id_edit').val()     
              },
              success:function(data) {
                  console.log(data);
                  if(data.errors) {
                    if(data.errors.first_name){
                      $( '#first-name-edit-error' ).html( data.errors.first_name[0] );
                    }
                    if(data.errors.last_name){
                        $( '#last-name-edit-error' ).html( data.errors.last_name[0] );
                    }
                    if(data.errors.address){
                      $( '#address-edit-error' ).html( data.errors.address[0] );
                    }
                    if(data.errors.address){
                      $( '#creates-at-edit-error' ).html( data.errors.address[0] );
                    }
                    if(data.errors.registered_date){
                      $( '#creates-at-edit-error' ).html( data.errors.registered_date[0] );
                    } 
                    if(data.errors.phone){
                      $( '#phone-edit-error' ).html( data.errors.phone[0] );
                    }
                    if(data.errors.email){
                      $( '#email-edit-error' ).html( data.errors.email[0] );
                    }
                    // if(data.errors.company_id){
                    //   $( '#company-name-show-edit-error').html( data.errors.company_id[0] );
                    // }      
                  }
                  var json = data;
                  if(json.status == 200) {
                     alert(json.message);
                     setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                  }else {
                    alert('Update Failed!');
                  }   
              },
          });
      });
      // Delete 
        $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
  
        modal.find('.modal-body #id_delete').val(id);
      })
        $('.modal-footer').on('click', '#deleteEmployee', function(){         
          $.ajax({
              url:'/deleteEmployee',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_delete').val(),
              },
              success:function(data) {
                  console.log(data);
                  var json = data;
                  if (json.status == 200) {
                    alert("Deleted Success!");
                    setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                  } else {
                    alert("Deleted Failed!");
                  }
                },
            });
          });
      });
      // registered date
      $(function(){
        $("#registered_date").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
        })
      });
    </script>
</body>
</html>