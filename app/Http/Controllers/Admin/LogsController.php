<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsTrait;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    use LogsTrait;

//    public function index(Request $request)
//    {
//        if (checkModulePermission('logs', 'view')) {
//
//            if($request->reset == "reset"){
//                $request->replace([]);
//            }
//            $users = User::get();
//            $modules = Logs::groupBy('module_name')->pluck('module_name');
//            $query = Logs::query();
//            if ($request->search_input !== '' && is_numeric($request->search_input)) {
//                $query = $query->where('item_id', +($request->search_input));
//            } elseif ($request->search_input !== '') {
//                $query = $query->where('action', 'like', "%" . $request->search_input . "%");
//            }
//
//            if (!empty($request->admin_id)) { //here
//                $query = $query->where('admin_id', +($request->admin_id));
//            }
//
//            if  ($request->module_name != '') {
////                dd('df');
//                $query = $query->where('module_name', $request->module_name);
//            }
//
//            if (!empty($request->from_date)) {
//                $query = $query->whereDate('created_at', ">=", $request->from_date);
//            }
//            if (!empty($request->to_date)) {
//                $query = $query->whereDate('created_at', "<=", $request->to_date);
//            }
//
//            $logs = $query->with('user')->latest()->paginate(config('app.admin_pagination_number')) ->appends($request->all());
////            $logs = $query->get();
//
//            return view('admin.logs.index', ['logs' => $logs, 'users' => $users, 'modules' => $modules]);
//        } else {
//            return redirect()->back()->with('error', __('lang.not permitted'));
//        }
//    }

    public function index(Request $request)
    {
        if (checkModulePermission('logs', 'view')) {

            if($request->reset == "reset"){
                $request->replace([]);
            }
            $users = User::get();
            $modules = Logs::groupBy('module_name')->pluck('module_name');
            $query = Logs::query();
            if ($request->filled('search_input')  && is_numeric($request->search_input)) {
                $query->where('item_id', (int)($request->search_input));
            } elseif ($request->filled('search_input')  ) {
                $query->where('action', 'like', "%" . $request->search_input . "%");
            }

            if (  $request->filled('admin_id') ) { //here
                $query->where('admin_id', (int)($request->admin_id));
            }

            if  ($request->filled('module_name')  ) {
//                dd('df');
                $query->where('module_name', $request->module_name);
            }

            if ( $request->filled('from_date') ) {
                $query->whereDate('created_at', ">=", $request->from_date);
            }
            if ( $request->filled('to_date') ) {
                $query->whereDate('created_at', "<=", $request->to_date);
            }

            $logs = $query->with('user')->latest()->paginate(config('app.pagination_number')) ->appends($request->query());
//            $logs = $query->get();

            return view('admin.logs.index', ['logs' => $logs, 'users' => $users, 'modules' => $modules]);
        } else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }



//    public function edit(Logs $event_type)
//    {
//        if (checkModulePermission('logs', 'edit')) {
//            return view('admin.logs.edit', compact('event_type'));
//        }else{
//            return redirect()->back()->with('error',  __('lang.deletion done successfully') );
//        }
//    }


    public function destroy(Logs $log)
    {
        if (checkModulePermission('logs', 'delete')) {
            $this->saveAction('logs', $log->id, 'delete');
            $log->delete();

            return redirect(route('admin.logs.index'))->with('status', __('lang.Log has been Deleted Successfully'));
        } else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

}
