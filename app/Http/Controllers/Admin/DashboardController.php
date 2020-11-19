<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Config;
use Response;

class DashboardController extends Controller
{
	protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
    }
	public function index(){
		access_denied_user('dashboard_listing');
		return view('admin.dashboard.index');	
	}
}
?>