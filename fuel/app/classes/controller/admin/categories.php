<?php

class Controller_Admin_Categories extends Controller_Admin
{
	
	public function action_index()
	{
		$data = array();
		$categories = Model_Category::getAll()->as_array();
		$data['categories'] = $categories;
		$data['types']      = Model_Category::$_types;
		$this->template->title = "分类";
		$this->template->content = View::forge('admin/categories/index', $data);
	}
	
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Category::validate('create');
			if ($val->run())
			{
				$category = Model_Category::forge(array(
					'title' => Input::post('title'),
					'type'  => Input::post('type'),
					'pid'   => Input::post('pid'),
					'order' => Input::post('order', 0),
				));
				
				if ($category and $category->save())
				{
					if (Input::post('pid') == 0)
					{
						$category->struct = $category->id;
					}
					else
					{
						$parent_category = Model_Category::find($category->pid);
						$category->struct = $parent_category->struct . '-' . $category->pid;
					}
					if ($category and $category->save())
					{
						Session::set_flash('success', e('已添加分类 '.$category->title.'.'));
						Response::redirect('admin/categories');
					} 
					else 
					{
						Session::set_flash('error', e('无法保存分类。'));
					}
				}
				else
				{
					Session::set_flash('error', e('无法保存分类。'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "分类";
		$this->template->content = View::forge('admin/categories/create');
		$this->template->scripts = View::forge('admin/categories/js');
		$categories = Model_Category::getAllCategories()->as_array();
		
		$this->template->set_global('types', Model_Category::$_types, false);
		$this->template->set_global('categories', $categories);
		
	}
	
	
	public function action_edit($id = null)
	{
		$category = Model_Category::find($id);
		$val = Model_Category::validate('edit');
		
		if ($val->run())
		{
			$category->title = Input::post('title');
			$category->type  = Input::post('type');
			$category->pid = Input::post('pid');
			$category->order = Input::post('order', 0);

			if ($category and $category->save())
			{
				if (Input::post('pid') == 0)
				{
					$category->struct = $category->id;
				}
				else
				{
					$parent_category = Model_Category::find($category->pid);
					$category->struct = $parent_category->struct . '-' . $category->pid;
				}
				if ($category and $category->save())
				{
					Session::set_flash('success', e('已更新分类 '.$category->title.'.'));
					Response::redirect('admin/categories');
				}
				else
				{
					Session::set_flash('error', e('无法保存分类。'));
				}
			}
			else
			{
				Session::set_flash('error', e('无法保存分类。'));
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$category->title = $val->validated('title');
				$category->type = $val->validated('type');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('category', $category, false);
		}
		$this->template->title = "分类";
		$this->template->content = View::forge('admin/categories/edit');
		$this->template->scripts = View::forge('admin/categories/js');
		$categories = Model_Category::getAllCategories()->as_array();
	
	
		$this->template->set_global('types', Model_Category::$_types, false);
		$this->template->set_global('categories', $categories);
	
	}
	
	public function action_get_all($type = 0)
	{
		$data = array();
		$data['categories'] = Model_Category::getAllCategories($type)->as_array();
		return View::forge('admin/categories/options', $data);
	}
}