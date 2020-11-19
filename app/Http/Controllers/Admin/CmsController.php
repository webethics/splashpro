<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePageRequest;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Storage;
use Auth;
use Config;
use Response;
use Session;
class CmsController extends Controller
{
	//private $photos_path;
	public function __construct()
    {
		//$this->photos_path = public_path('/uploads/logo/');
    }
   
	/*
	* SETTING LAYOUT 
	*/
    public function index()
    {
		access_denied_user('cms_pages_listing');
		$CmsPage =  CmsPage::all();
        return view('admin.cms.index',compact('CmsPage'));
    }
	
	/*
	* EDIT EMAIL TEMPLATE 
	*/
	public function cms_page_edit($id){
		access_denied_user('cms_pages_edit');
		//display edit page of email template
			$result = CmsPage::where('id', '=' , $id)->get();
			
			return view('admin.cms.edit_page' , compact('result'));
	}

	public function cms_page_create(){
		return view('admin.cms.create_page' , compact('result'));
	}

	public function cms_page_update(CreatePageRequest $request){
		access_denied_user('cms_pages_create');
	    $title = $request->input('title');
	    $slug = $request->input('slug');
	    $content = $request->input('content');
	    $page_id = $request->input('page_id');
	    // update email template
	    $data = array('title'=>$title,'slug'=>$slug,'content'=>$content);
		$CmsPage_update  = CmsPage::where('id', '=', $page_id);
		
		$CmsPage_update->update($data);
		Session::flash('success', 'Page has been Updated.');
		return redirect('admin/cms-pages/edit/'.$page_id); 

	  
	}
	
	public function cms_page_new(CreatePageRequest $request){
		
		$response = [];
    	$response['success'] = false;
    	$response['message'] = 'Invalid Request';
		//if($request->ajax()){
			$data =array();
			$data['title']	= $request->title;
			$data['slug'] =  $this->slugify($request->title);
			$data['content'] = $request->content;
			
			$dat = CmsPage::create($data);

			$response['success'] = true;
			$response['message'] = 'New Customer created Successfully';
			
		//}
		return redirect('admin/cms-pages'); 
	}
	
	function slugify($string, $replace = array(), $delimiter = '-') {
		// https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
		if (!extension_loaded('iconv')) {
		throw new Exception('iconv module not loaded');
		}
		// Save the old locale and set the new locale to UTF-8
		$oldLocale = setlocale(LC_ALL, '0');
		setlocale(LC_ALL, 'en_US.UTF-8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
		if (!empty($replace)) {
		$clean = str_replace((array) $replace, ' ', $clean);
		}
		// $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower($clean);
		$clean = preg_replace("/[\/_|+ -!@#$%^&*()]+/", $delimiter, $clean);
		$clean = trim($clean, $delimiter);
		// Revert back to the old locale
		setlocale(LC_ALL, $oldLocale);
		return $clean;
	}
	
	public function page_delete($page_id){
		if($page_id){
			$page  = CmsPage::where('id',$page_id)->first();
			
			if($page){
				CmsPage::where('id',$page_id)->delete();
				$result =array('success' => true);	
				return Response::json($result, 200);
				
			}else{
				
				$result =array('success' => false,'message'=>'This account can not be deleted');	
				return Response::json($result, 200);
			}
			
		}
	}
}
