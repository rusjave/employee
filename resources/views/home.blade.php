@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
				<li><a href="#">Reports</a></li>
				<li class="active add-modal"><a href="#"  data-toggle="modal" data-target="#AddModal "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add<span class="sr-only">(current)</span></a></li>
				<li><a href="#">Export</a></li>
			</ul>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Dashboard</h1>
			@if(isset($data))
    <div class="table table-responsive">
      <table class="table table-striped table-sm" id="table">
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th width="150px">Address</th>
            <th>Registared Date</th>
            <th>Phone</th>
            <th>Email</th>
            <th width="150px">Company Name</th>
            <th width="150px">Company Number</th>
            <th width="150px"></th>
          </tr>
        </thead>
        <tbody>
          {{ csrf_field() }}
        <?php $no = 1; ?>
        @forelse ($data as $value)
        <tr class="post{{$value->id}}">
          <td>{{ $no++ }}</td>
          <?php  echo '<td>'.ucfirst(trans($value->first_name)).'</td>';?>
          <?php  echo '<td>'.ucfirst(trans($value->last_name)).'</td>';?>
          <td>{{ $value->address }}</td>
          <td>{{ $value->registered_date }}</td>
          <td>{{ $value->phone }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->company->name }}</td>
          <td>{{ $value->company->phone }}</td>
          
          <td>
            <a href="#" class="btn btn-default btn-info btn-sm" data-toggle="modal" 
              data-target="#show" data-id="{{$value->id}}" data-first-name="{{$value->first_name}}" data-last-name="{{$value->last_name}}" 
              data-address="{{$value->address}}" data-registered-date="{{$value->registered_date}}"
              data-phone="{{$value->phone}}" data-email="{{$value->email}}" data-company-name="{{$value->company->name}}" data-company-phone="{{$value->company->phone}}"> 
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            </a>
            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" 
              data-target="#edit" data-id="{{$value->id}}" data-first-name="{{$value->first_name}}" data-last-name="{{$value->last_name}}"
              data-address="{{$value->address}}" data-registered-date="{{$value->registered_date}}" data-phone="{{$value->phone}}" 
              data-email="{{$value->email}}" data-company-name="{{$value->company->name}}" data-company-phone="{{$value->company->phone}}"> 
              <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" 
                data-target="#delete" data-id="{{$value->id}}" data-title="{{$value->name}}" data-body="{{$value->description}}">
              <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
          @empty
        <p class="pull-right">No employee availble.</p>
        @endforelse
        </tbody>
      </table>
        {!! $data->render() !!}
        @else
        {{ $message }}
        @endif
      </div> 
        </div>
      </div>
    </div>

<!-- Modal form to add a product -->
<div id="AddModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add new product</h4>
            </div>
            <div class="modal-body" style="overflow: hidden;">
                <div id="success-msg" class="hide">
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <strong>Added Success!</strong>
                    </div>
                </div>
                <div>
                    <form class="form-horizontal" method="POST" id="addEmployee">
                        {{ csrf_field() }}
                         <input type="hidden" name="id" id="id">
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="first name">First Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="first_name" name="first_name" placeholder="" required="">
                           <span class="text-danger">
                                <strong id="first-name-error"></strong>
                            </span>
                          </div>
                        </div>
												<div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="first name">Last Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="last_name" name="last_name" placeholder="" required="">
                           <span class="text-danger">
                                <strong id="last-name-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="address">Address:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="address" name="address" placeholder="" required="">
                           <span class="text-danger">
                                <strong id="address-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="registered date">Registered Date:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="registered_date" name="registered_date" placeholder="" required="">
                           <span class="text-danger">
                                <strong id="registered-date-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="phone">Phone:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required="">
                           <span class="text-danger">
                                <strong id="phone-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="email">Email:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" placeholder="" required="">
                           <span class="text-danger">
                                <strong id="email-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="company_id">Company</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="company_id" id="company_id">
                            <option value="">Please select company</option>
                              @foreach ($companies as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endforeach
                            </select>
                           <span class="text-danger">
                                <strong id="email-error"></strong>
                            </span>  
                          </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">
                      <span class="glyphicon glyphicon-save"></span>
                    Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
                      <span class="glyphicon glyphicon-remove"></span>
                    Close
                      </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to show a product -->
<div class="modal fade" role="dialog" id="show" tabindex="1" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View product</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group row">
            <label class="control-label col-sm-2" for="name">ID:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_show" name="name" placeholder="Product Name here" disabled>
            </div>   
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2" for="first_name">First Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control text-capitalize" id="first_name_show" name="first_name" disabled>
            </div>   
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="last_name">Last Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control text-capitalize" id="last_name_show" name="last_name" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="type">Address:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="address_show" name="address" disabled>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="registered date">Registered Date:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="registered_date_show" name="registered_date_show" placeholder="" required="" disabled>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="registered date">Phone:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="phone_show" name="phone_show" placeholder="" required="" disabled>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="registered date">Email:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email_show" name="email_show" placeholder="" required="" disabled>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="company name">Company Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company_name_show" name="company_name_show" placeholder="" required="" disabled>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
          <span class="glyphicon glyphicon-remove"></span>
        Close
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal form to edit a post -->
<div class="modal fade" role="dialog" id="edit" tabindex="1" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update product</h4>
      </div>
       <div class="modal-body" style="overflow: hidden;">
          <div id="success-msg-update" class="hide">
              <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <strong>Update Success!</strong>
              </div>
          </div>
        <form class="form-horizontal" method="POST">
          {{csrf_field()}}
          <div class="form-group row">
            <label class="control-label col-sm-2" for="name"></label>
            <div class="col-sm-10">
              <input type="hidden" class="form-control" id="id_edit" name="id" disabled="">
            </div>   
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="first name">First Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control text-capitalize" id="first_name_edit" name="first_name_edit" placeholder="" required="">
              <span class="text-danger">
                  <strong id="first-name-edit-error"></strong>
              </span>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="first name">Last Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control text-capitalize" id="last_name_edit" name="last_name_edit" placeholder="" required="">
              <span class="text-danger">
                  <strong id="last-name-edit-error"></strong>
              </span>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="address">Address:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control text-capitalize" id="address_edit" name="address_edit" placeholder="" required="">
              <span class="text-danger">
                  <strong id="address-edit-error"></strong>
              </span>
            </div>
          </div> 
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="registered date">Registered Date:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="registered_date_edit" name="registered_date_edit" placeholder="" required="">
              <span class="text-danger">
                  <strong id="registered-date-edit-error"></strong>
              </span>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="phone">Phone:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="phone_edit" name="phone_edit" placeholder="" required="">
              <span class="text-danger">
                  <strong id="phone-edit-error"></strong>
              </span>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email_edit" name="email_edit" placeholder="" required="">
              <span class="text-danger">
                  <strong id="email-edit-error"></strong>
              </span>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="email">Company Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company_name_edit" name="company_name_edit" placeholder="" required="" disabled>
              <span class="text-danger">
                  <strong id="email-edit-error"></strong>
              </span>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="company name"></label>
            <div class="col-sm-10">
              <select class="form-control" name="company_id" id="company_id_edit" required="">
              <option value="">Please select new company</option> 
                @foreach ($companies as $c)
                  <option value="{{ $c->id }}" >{{ $c->name }}</option>
                @endforeach
              </select>
              <span class="text-danger">
                <!-- <strong id="company-name-show-edit-error"></strong> -->
              </span>
            </div>
          </div>
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" id="updateEmployee" class="btn btn-primary btn-prime white btn-flat ">
          <span class="glyphicon glyphicon-save"></span>
        Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
          <span class="glyphicon glyphicon-remove"></span>
        Close
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal form to delete a product -->
<div class="modal fade" role="dialog" id="delete" tabindex="1" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Delete Confirmation</h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
          <div id="success-msg-delete" class="hide">
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <strong>Delete Success!</strong>
              </div>
          </div>
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
        <input type="hidden" class="form-control" id="id_delete" name="id" disabled="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel
        </button>
        <button type="submit" class="btn btn-warning " id="deleteEmployee">Yes, Delete
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection