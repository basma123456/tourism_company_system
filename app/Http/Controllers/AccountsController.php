<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests\AddAccountRequest;

class AccountsController extends Controller
{
     public function index()
    {
        //if(!checkModulePermission('accounts', 'view')) {   return redirect()->route('admin.access_denied');  }
            $data = Account::oldest()->get();
          //$users=User::all();
            return view('accounts.list', compact('data'));
    }

     public function create()
    {
         //  if(!checkModulePermission('accounts', 'add')) {   return redirect()->route('admin.access_denied');  }
            $data = Account::where('parent_id' , null)->get();
            return view('accounts.create', compact('data'));
    }

    public function store (AddAccountRequest $request)
    { 
       // if(!checkModulePermission('accounts', 'add')) {   return redirect()->route('admin.access_denied');  }
                $data = Account::create($request->validated());  
         if($data){   return redirect(route('acc_index'))->with('success','تم الحفظ بنجاح' ); 
          }else{     return redirect()->back()->with('error', 'خطأ حاول مرة اخرى'); }

    }
 public function edit($id)
    {
         // if(!checkModulePermission('accounts', 'edit')) {   return redirect()->route('admin.access_denied');  } 
            $account = Account::find($id);
            $data = Account::where('parent_id' , null)->get();

            return view('accounts.edit', compact('account','data'));
    }

     public function update($id,AddAccountRequest $request)
    {
       // if(!checkModulePermission('accounts', 'edit')) {   return redirect()->route('admin.access_denied');  }
         $req = account::find($id);
         $req->name         = $request->name;
         $req->code          = $request->code; 
         $req->parent_id     = $request->parent_id;
         $success=$req->save();
         if($success){     return redirect()->back()->with('success', 'تم التعديل بنجاح');
          }else{     return redirect()->back()->with('error', 'خطأ حاول مرة اخرى'); }
    }
    public function delete($id)
    {
        //if(!checkModulePermission('accounts', 'delete')) {   return redirect()->route('admin.access_denied');  }
         $data = Account::find($id);
         $action = $data->delete();
         if ($action) {
                return back()->with('success', 'تم الحذف بنجاح');
            } else {
                return back()->with('error', 'خطأ حاول مرة اخرى');
            }
    }
   
    
}
