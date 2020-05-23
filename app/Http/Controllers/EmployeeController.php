<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Employee;
use App\Company;
use View;
use App\http\Requests;

class EmployeeController extends Controller
{
/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
    $data = Employee::with('company')->paginate(10);
    $companies = Company::all();
		return view('/home', compact('data', 'companies'));
	}

	public function addEmployee(Request $request) 
	{  
		//dd('dd');
		$validator = Validator::make($request->all(), [
				'first_name' => 'required|min:2',
				'last_name' => 'required|min:2',
        'address' => 'required',
        'registered_date' => 'required',
        'phone' => 'required|numeric',
        'email' => 'required',
        'company_id' => 'required',
		]);

		$input = $request->all();

		if ($validator->fails()){
		return Response::json(['errors' => $validator->errors()]);
		}
		else {
		$emp = new Employee();
		$emp->first_name = $request->first_name;
		$emp->last_name = $request->last_name;
    $emp->address = $request->address;
    $emp->phone = $request->phone;
    $emp->email = $request->email;
    $emp->company_id = $request->company_id;
    $emp->registered_date = $request->registered_date;
		$emp->save();
		
		if($emp->save()){
			$res['status'] = "200";
			$res['message'] ="Added Success!";
			$res['value'] = "$emp";
			return Response::json($res);
		}
		else {
			$res['status'] = "400";
			$res['message'] = "Failed to Add!";
			return response($res);
			}
		}
  }
  
  // Update Product
  public function updateEmployee(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'address' => 'required',
        'registered_date' => 'required',
        'phone' => 'required|numeric',
        'email' => 'required',
        'company_id' => 'required'
      ]);

      $input = $request->all();
  
      if ($validator->fails()){
      return Response::json(['errors' => $validator->errors()]);
      }
      else {
      $emp = Employee::findorFail($request->id);
      $emp->id = $request->id;
      $emp->first_name = $request->first_name;
      $emp->last_name = $request->last_name;
      $emp->address = $request->address;
      $emp->phone = $request->phone;
      $emp->email = $request->email;
      $emp->company_id = $request->company_id;
      $emp->registered_date = $request->registered_date;
		  $emp->save();
      
      if($emp->save()){
        $res['status'] = "200";
        $res['message'] ="Update Success!";
        $res['value'] = "$emp";
        return Response::json($res);
      }
      else {
        $res['status'] = "400";
        $res['message'] = "Updated Failed!";
        return response($res);
      }

    }    
  }

  // Delete Product
  public function deleteEmployee(Request $request)
  {
    $product = Employee::find($request->id)->delete();
    if($product == true) {
      $res['status'] = "200";
      $res['message'] ="Deleted Success!";
      $res['value'] = "$product";
      return Response::json($res);
    }
    else {
      $res['status'] = "400";
      $res['message'] = "Deleted Failed!";
      return response($res);
    }
   
  }

  public function search()
	{
		$q = Input::get ('q');
		if($q != ""){
			$data = Employee::orderBy('first_name', 'asc')->where('first_name', 'LIKE', '%' . $q . '%')
											->orWhere ('last_name', 'LIKE', '%' . $q . '%')
											->paginate (2)
											->setPath('');
			$data->appends(array(
				'q' => Input::get ('q') 
			));
			if(count( $data) > 0){
				return view('home')->withData($data);
			}
		}
			return view('home')->withMessage ('No Products found. Try to search again !');
	}

  public function autoComplete(Request $request)
  {
    $term = $request->term;
    $data = Employee::where('first_name', 'LIKE', '%' .$term. '%')
                    ->take(10)
                    ->get();
    $result = array();
    foreach ($data as $key => $value) {
      $result[] = ['id' => $value->id, 'value'=>$value->name];
    }
    return response()->json($result);
  }
		

}
