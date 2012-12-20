<?php

class Controller_Home extends Controller_Template
{
	public function action_index()
	{
		$data = array();
		$this->template->title = '网站首页';
		$this->template->content = View::forge('home/index', $data);
	}
}