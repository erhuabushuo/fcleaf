<?php

class Controller_Admin extends Controller_Base {

	public $template = 'admin/template';

	public function before()
	{
		parent::before();

		if ( ! Auth::member(100) and Request::active()->action != 'login')
		{
			Response::redirect('admin/login');
		}
	}

	public function action_login()
	{
		// Already logged in
		Auth::check() and Response::redirect('admin');
		
		$val = Validation::forge();
		
		$view = View::forge('admin/login', array('val' => $val), false);
		$view->set_global("title", '登陆');

		if (Input::method() == 'POST')
		{
			$val->add('email', '邮箱或用户名')
			    ->add_rule('required');
			$val->add('password', '密码')
			    ->add_rule('required')
				 ->add('captcha', '验证码')
				 ->add_rule('required');

			if ($val->run())
			{
				
				if (Session::get('captcha') == Input::post('captcha'))
				{
					$auth = Auth::instance();
	
					// check the credentials. This assumes that you have the previous table created
					if (Auth::check() or $auth->login(Input::post('email'), Input::post('password')))
					{
						// credentials ok, go right in
						$current_user = Model_User::find_by_username(Auth::get_screen_name());
						Session::set_flash('success', e('Welcome, '.$current_user->username));
						Response::redirect('admin');
					}
					else
					{
						$view->set_global('login_error', 'Fail');
					}
				}
				else
				{
					$view->set_global('login_error', '验证码错误');
				}
			}
		}
		
		return $view;
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('admin');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		$this->template->title = 'Dashboard';
		$this->template->content = View::forge('admin/dashboard');
	}

}

/* End of file admin.php */
