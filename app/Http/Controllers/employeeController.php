<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = employee::paginate(10);;
        foreach ($employees as $employee){
            $employee->company = $employee->assignedCompany;
        }
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return View('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'string|email|unique:employees',
        ]);

            $employee = new employee();
            $employee->first_name = $request->get('first_name');
            $employee->last_name = $request->get('last_name');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');
            $employee->company = $request->get('company');

            $employee->save();
            $msg = "New employee added successfully! ";
            return redirect('api/employee')->with('success', $msg);


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
    public function edit($id)
    {
        $employee = employee::find($id);
        $company = Company::find($employee->company);
        $employee->company  = $company;
        $companies = Company::all();

        return view('employee.edit', compact('employee', 'companies'));
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

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'string|email',
        ]);

            $employee = employee::find($id);
            $employee->first_name = $request->get('first_name');
            $employee->last_name = $request->get('last_name');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');
            $employee->company = $request->get('company');

            $employee->save();
            $msg = "Employee updated successfully! ";
            return redirect('api/employee')->with('success', $msg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            employee::destroy($id);
            $msg = "Employee removed successful! ";
            return redirect('api/employee')->with('success', $msg);
        }
        catch (\Throwable $e){
            return redirect('api/employee')->with('error', "Something went wrong");
        }
    }
}
