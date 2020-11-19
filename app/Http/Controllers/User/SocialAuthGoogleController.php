<?php
namespace App\Http\Controllers;use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialGoogleAccountService;class SocialAuthGoogleController extends Controller
{
  /**
   * Create a redirect method to google api.
   *
   * @return void
   */
    public function redirect($role)
    {
		session(['role' => $role]);
        return Socialite::driver('google')->redirect();
    }/**
     * Return a callback method from google api.
     *
     * @return callback URL from google
     */
    public function callback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);?>
		<script>
				    window.opener.location = '/home';
				    window.close();
			</script>
	<?php	
       // return redirect()->to('/home');
    }
}