<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {


            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:companies',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'nif' => 'required',
                'rc' => 'required',
                'assujeti' => 'required'
            ]);

            Company::create($validatedData);

            return redirect()->route('companies.index')->with('success', 'Entreprise créée avec succès.');


    }

    public function show(Company $company)
    {
        // dd($company);
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'nif' => 'required',
                'rc' => 'required',
                'assujeti' => 'required'
            ]);

            $company->update($validatedData);

            return redirect()->route('companies.index')->with('success', 'Entreprise mise à jour avec succès.');


     }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Entreprise supprimée avec succès.');
    }
}
