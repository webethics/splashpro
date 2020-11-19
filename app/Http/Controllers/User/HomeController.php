<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\UpdateUserProfile;
use App\Http\Requests\Frontend\UpdateUserPassword;
use App\Http\Requests\Frontend\CreateContactRequest;

use App\Http\Requests\Frontend\UploadProfilePhoto;
use App\Http\Requests\Frontend\UploadBanner;

use App\Models\Article;
use App\Models\Download;
use App\Models\Role;
use App\Models\User;use App\Models\Plan;
use App\Models\Subscription;
use App\Models\EmailTemplate;
use App\Models\TempRequestUser;
use League\Csv\Writer;	
use Auth;
use Config;
use App\Models\CmsPage;
use Response;
use Hash;
use DB;
use DateTime;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
	//Records per page 
	protected $per_page;
	private $qr_code_path;
	public function __construct()
    {
		$this->per_page = Config::get('constant.posts_per_page');;
		$this->report_path = public_path('/uploads/users');
    }
	
	
	public function home_page()
    {
		
		
    }
	
	public function services()
    {
		return view('frontend.pages.home.services');
    }
	public function traffic()
    {
		return view('frontend.pages.home.traffics');
    }
	public function leads()
    {
		return view('frontend.pages.home.leads');
    }
	
}
