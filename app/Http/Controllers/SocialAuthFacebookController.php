<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use App\Providers\RouteServiceProvider;
class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
		//session(['role' => $role]);
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
		
	
        auth()->login($user);

		?>
			<script>
				    window.opener.location = '/home';
				    window.close();
			</script>
	<?php 			
        //return redirect()->to('/home');
    }
}