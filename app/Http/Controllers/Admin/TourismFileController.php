<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TourismFileRequest;
use App\Models\Client;
use App\Models\CompanyField;
use App\Models\Country;
use App\Models\TourismFile;
use Illuminate\Http\Request;
use function Carbon\Traits\get;

class TourismFileController extends Controller
{

    public function index(Request $request)
    {
        $query = TourismFile::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('Fcode', 'like', "%" . $request->search . "%")
                    ->orWhere('Fname', 'like', "%" . $request->search . "%")
                    ->orWhere('adults_no', $request->search)
                    ->orWhere('child_no', $request->search)
                    ->orWhere('infants_no', $request->search);
            });
        }

        if ($request->filled('date')) {
            $query->where(function ($q) use ($request) {
                $q->whereDate('arrival_date', $request->date)
                    ->orWhereDate('leave_date', $request->date)
                    ->orWhereDate('created_date', $request->date);
            });
        }
        if ($request->filled('type')) {
            $query->where('Ftype', $request->type);
        }

        if ($request->filled('client')) {
            $query->where('emp', $request->client);
        }
        if ($request->filled('country')) {
            $query->where('nationality', $request->country);
        }

        if ($request->filled('closed') && $request->closed == 1) {
            $query->where('closed', 1);
        }

        if ($request->filled('approved') && $request->approved == 1) {
            $query->where('approved', 1);
        }


        $tourismFiles = $query->with('country')->latest()->get();
        $clients = Client::select('id', 'name')->get();
        $countries = Country::select('id', 'country_code', 'country_name', 'country_name_ar')->get();
        $country_name = app()->getLocale() == 'ar' ? 'country_name_ar' : 'country_name';
        $companyFields = CompanyField::get();

        return view('admin/tourism_files/index', compact('tourismFiles', 'clients', 'countries', 'country_name' , 'companyFields'));
    }


    public function create(Request $request)
    {
        $clients = Client::select('id', 'name')->get();
        $countries = Country::select('id', 'country_code', 'country_name', 'country_name_ar')->get();
        $country_name = app()->getLocale() == 'ar' ? 'country_name_ar' : 'country_name';
        $compayFields = CompanyField::get();
        return view('admin/tourism_files/create' , compact( 'clients', 'countries', 'country_name' , 'compayFields'));
    }

    public function store(TourismFileRequest $tourismFileRequest)
    {
        $approvedStatus = 0;
        $closedStatus = 0;
        if ($tourismFileRequest->approved == 1) {
            $approvedStatus = 1;
        }
        if ($tourismFileRequest->closed == 1) {
            $closedStatus = 1;
        }

        TourismFile::create(array_merge($tourismFileRequest->only('Fcode',
            'Ftype',
            'Fname',
            'emp',
            'adults_no',
            'child_no',
            'infants_no',
            'arrival_date',
            'leave_date',
            'nationality',
            'created_date'),
            ['approved' => $approvedStatus ,  'closed' => $closedStatus , 'Fcode' => rand(100000 , 999999)])
        );
        return redirect(route('admin.tourism_files.index'))->with(['success' => __('lang.you inserted TourismFile successfully')]);
    }

    public function edit(TourismFile $tourismFile)
    {
        $clients = Client::select('id' , 'name')->get();
        $countries = Country::select('id' , 'country_name' ,'country_name_ar')->get();
        $country_name = app()->getLocale() == 'ar' ? 'country_name_ar' : 'country_name';
        $companyFields = CompanyField::get();

        return view('admin/tourism_files/edit', compact('tourismFile' , 'clients' , 'country_name' , 'countries' , 'companyFields'));
    }

    public function update(TourismFileRequest $tourismFileRequest, TourismFile $tourismFile)
//    public function update(Request $tourismFileRequest, TourismFile $tourismFile)

    {
        $approvedStatus = 0;
        $closedStatus = 0;
        if ($tourismFileRequest->approved == 1) {
            $approvedStatus = 1;
        }
        if ($tourismFileRequest->closed == 1) {
            $closedStatus = 1;
        }

        $tourismFile->update(array_merge($tourismFileRequest->only('Fcode',
                'Ftype',
                'Fname',
                'emp',
                'adults_no',
                'child_no',
                'infants_no',
                'arrival_date',
                'leave_date',
                'nationality',
                'created_date'),
                ['approved' => $approvedStatus ,  'closed' => $closedStatus ])
        );
        return redirect()->back()->with(['success' => __('lang.TourismFile has been updated successfully')]);
    }


    public function destroy(TourismFile $TourismFile)
    {
        $TourismFile->delete();
        return redirect(route('admin.tourism_files.index'))->with(['success' => 'lang.you have deleted  tourismFile successfully']);
    }


}
