<?php

class Controller_Captcha extends Controller
{
	public function action_index()
	{
		Package::load("captcha");
		Captcha::instance()->generate();
	}
}