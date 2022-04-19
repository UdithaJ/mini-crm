<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Exceptions;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $companies = Company::paginate(10);;
        return view('company.index', compact('companies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:companies',
            'name' => 'required',
        ]);

            $company = Company::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'website' => $request->get('website'),
            ]);

            $file = $request->file('logo');

            if ($file){

                $extension = $file->getClientOriginalExtension();
                $location = 'public/logos' .  '/' . $company->id;
                $logo = uniqId() . '.' . $extension;

                $file->storeAs($location, $logo);
                $path = "logos" . '/' . $company->id . '/' . $logo;
                $company->logo = $path;
            }


            $company->save();
            $msg = "New Company added successful! ";
            return redirect('api/company')->with('success', $msg);

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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $company->employees = $company->companyEmployees;

        return view('company.edit', compact('company'));
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
            'email' => 'required|string|email',
            'name' => 'required',
        ]);

            $company = Company::find($id);

            $file = $request->file('logo');

            if ($file){

                $extension = $file->getClientOriginalExtension();
                $location = 'public/logos' .  '/' . $company->id;
                $logo = uniqId() . '.' . $extension;

                $file->storeAs($location, $logo);
                $path = "logos" . '/' . $company->id . '/' . $logo;
                $company->logo = $path;
            }

            $company->name = $request->get('name');
            $company->email = $request->get('email');
            $company->website = $request->get('website');

            $company->save();
            $msg = "Company details updated successful! ";
            return redirect('api/company')->with('success', $msg);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            Company::destroy($id);
            $msg = "Company removed successful! ";
            return redirect('api/company')->with('success', $msg);
        }
        catch (\Throwable $e){
            return redirect('api/company')->with('error', "Something went wrong");
        }





    }
}
