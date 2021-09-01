<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $EmployeeData = Employee::with('company')->paginate(10);
        return view('Employee.index',["Data"=>$EmployeeData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyData = Company::all();
        return view('Employee.create',['companyLists'=>$companyData] ); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Fname' => 'required',
            'Lname' => 'required',
            'email' => 'required',
            'company' => 'required',
            'phone' => 'required',
        ]);
        $emp = new Employee();
        $emp->firstName = $request->input('Fname');
        $emp->lastName = $request->input('Lname');
        $emp->email = $request->input('email');
        $emp->company_id = $request->input('company');
        $emp->phone = $request->input('phone');
        $query = $emp->save();
        if ($query) {
            return redirect('/EmployeeResources')->with('success','Employee Added successfully');
        } else {
            return back()->with('fail','something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $EmployeeResource)
    {
        $companyData = Company::all();
        return view('Employee.create',['data'=>$EmployeeResource,'companyLists'=>$companyData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emp=  Employee::find($id);
        $this->validate($request, [
            'Lname' => 'required',
            'email' => 'required',
            'company' => 'required',
            'phone' => 'required',
        ]);
        $emp->firstName = $request->input('Fname');
        $emp->lastName = $request->input('Lname');
        $emp->email = $request->input('email');
        $emp->company_id = $request->input('company');
        $emp->phone = $request->input('phone');
        $query = $emp->update();
        if ($query) {
            return redirect('/EmployeeResources')->with('success','Employee Updated successfully');
        } else {
            return back()->with('fail','something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp=  Employee::find($id);
        $emp->delete();
        return redirect()->back()->with('success','Employee deleted successfully');
    }
}
