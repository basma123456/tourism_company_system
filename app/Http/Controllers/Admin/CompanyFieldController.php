<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyFieldRequest;
use App\Models\CompanyField;
use Illuminate\Http\Request;

class CompanyFieldController extends Controller
{
    public function index(Request $request)
    {
        $query = CompanyField::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%" . $request->search . "%");
            });
        }
        $companyFields = $query->latest()->get();
        return view('admin/company_fields/index', compact('companyFields'));
    }


    public function create(Request $request)
    {
        return view('admin/company_fields/create');
    }

    public function store(CompanyFieldRequest $companyFieldRequest)
    {
        $activeStatus = 0;
        if ($companyFieldRequest->active == 1) {
            $activeStatus = 1;
        }
        CompanyField::create(array_merge($companyFieldRequest->only('name'), ['active' => $activeStatus]));
        return redirect(route('admin.company_fields.index'))->with(['success' => __('lang.you inserted CompanyField successfully')]);
    }

    public function edit(CompanyField $companyField)
    {
        return view('admin/company_fields/edit', compact('companyField'));
    }

    public function update(CompanyFieldRequest $companyFieldRequest, CompanyField $companyField)
    {
        $activeStatus = 0;
        if ($companyFieldRequest->active == 1) {
            $activeStatus = 1;
        }
        $companyField->update(array_merge($companyFieldRequest->only('name' ) , ['active' => $activeStatus]));
        return redirect()->back()->with(['success' => __('lang.airline has been updated successfully')]);
    }


    public function destroy(CompanyField $companyField)
    {
        $companyField->delete();
        return redirect(route('admin.company_fields.index'))->with(['success' => 'lang.you have deleted  company successfully']);
    }
}
