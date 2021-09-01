<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyData = Company::paginate(10);
        return view('company.index',["companyData"=>$companyData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create'); 
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
            'name' => 'required',
            'logo' =>'dimensions:min_width=100,min_height=100',
        ]);
        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        if ($request->hasfile('logo')) {
            $destination_path = 'public/logo';
            $file = $request->file('logo');
            $image_name = time().'_'. $file->getClientOriginalName();
            $request->file('logo')->storeAs($destination_path ,$image_name);
            $company->logo = $image_name; 
        } else {
            echo "No file selected";
        }
        $query = $company->save();
        if ($query) {
            return redirect('/Companies')->with('success','Company Added successfully');
        } else {
            return back()->with('fail','Something went wrong');
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
    public function edit(Company $Company)
    {
        return view('company.create',['data'=>$Company]);
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
       $company=  Company::find($id);
       $this->validate($request, [
            'name' => 'required',
            'logo' =>'dimensions:min_width=100,min_height=100',
        ]);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        if ($request->hasfile('logo')) {
            $destination_path = 'public/logo';
            $file = $request->file('logo');
            $image_name = time().'_'. $file->getClientOriginalName();
            $request->file('logo')->storeAs($destination_path ,$image_name);
            $company->logo = $image_name; 
        } else {
            echo  "No file selected";
        }
        $result = $company->update();
        if ($result) {
            return redirect('/Companies')->with('success','Company Updated successfully');
        } else {
            return back()->with('fail','Something went wrong');
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
        $company=  Company::find($id);
        $company->delete();
        return redirect()->back()->with('success','Company deleted successfully');
    }
}
