<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use Config;
class CommonController extends Controller
{
	
	
	public function __construct()
    {
	    
    }
/*===============================================
      OPEN CONFIRM BOX TO COMPLETE THE REPROT 
==============================================*/	
    public function confirmModal(Request $request)
	{
	  
	 $roleIdArr = Config::get('constant.role_id');
	 $confirm_message =$request->confirm_message;
	 $confirm_message_1 =$request->confirm_message_1;
	 $leftButtonName =$request->leftButtonName;
	 $leftButtonId =$request->leftButtonId;
	 $leftButtonCls =$request->leftButtonCls;
	 $id = $request->id;
	 if ($request->ajax()) {
		return view('modal.confirmModal', compact('id','confirm_message','confirm_message_1','leftButtonName','leftButtonId','leftButtonCls'));
	 } 

	}
	
}