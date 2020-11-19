<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialTwitterAccountService;

class SocialAuthTwitterController extends Controller
{
  /**
   * Create a redirect method to twitter api.
   *
   * @return void
   */
    public function redirect($role)
    {   
	    session(['role' => $role]);
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback(SocialTwitterAccountService $service)
    {
		
        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
        auth()->login($user);
        ?>
		<script>
				    window.opener.location = '/home';
				    window.close();
			</script>
	<?php	
       // return redirect()->to('/home');
    }
}