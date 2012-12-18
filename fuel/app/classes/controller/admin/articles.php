<?php

class Controller_Admin_Articles extends Controller_Admin 
{
	
	public function action_upload()
	{
		$path = DOCROOT . DS . 'upload' . DS .'articles';
		if (!is_dir($path))
		{
			try
			{
				File::create_dir(DOCROOT . DS . 'upload', 'articles', 0777);
			}
			catch (InvalidPathException $e)
			{
				// Basepath does not exist or is not writable
			}
			catch (FileAccessException $e)
			{
				// Basepath is not writable
			}
		}
		$config = array(
			'path'		 => $path,
			'randomize' => true,
			'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
		);
		
		Upload::process($config);
		
		if (Upload::is_valid())
		{
			Upload::save();
                        $fileinfo = Upload::get_files(0);
			$filename = $fileinfo['saved_as'];
			
			$result = array(
				'filename' => $filename,
				'urlpath'  => Uri::base() . DS . 'upload' . DS .  'articles' . DS . $filename,	
			);
		}
		
		return new Response(json_encode($result));
	}
	
	public function action_index()
	{
		$config = array(
			'pagination_url' => \Uri::base().'admin/articles/index/',
			'total_items' => Model_Article::find()->count(),
			'per_page' => 20,
			'uri_segment' => 4,
		);
		$pagination = Pagination::forge('pagination', $config);
		$data['articles'] = Model_Article::find()->related('category')->order_by('id', 'desc')->limit($pagination->per_page)->offset($pagination->offset)->get();
		$this->template->set_global('pagination', $pagination->render(), false);
		$this->template->title = "文章";
		$this->template->content = View::forge('admin/articles/index', $data);
	}

	public function action_view($id = null)
	{
		$data['article'] = Model_Article::find($id);

		$this->template->title = "Article";
		$this->template->content = View::forge('admin/articles/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Article::validate('create');

			if ($val->run())
			{
				$article = Model_Article::forge(array(
					'title' => Input::post('title'),
					'summary' => Input::post('summary'),
					'category_id' => Input::post('category_id'),
					'is_recommended' => Input::post('is_recommended', 0) == 0 ? 0 : 1,
					'img' => Input::post('img'),
				));
                                

				if ($article and $article->save())
				{
					Session::set_flash('success', e('已添加文章 '.$article->title.'.'));

					Response::redirect('admin/articles');
				}

				else
				{
					Session::set_flash('error', e('无法保存文章。'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		Package::load('CKEditor');
		$this->template->title = "文章";
		$categories = Model_Category::getAllCategories(array_search('文章', Model_Category::$_types))->as_array();
		$this->template->content = View::forge('admin/articles/create');
		$this->template->set_global('categories', $categories, false);
		$this->template->set_global('scripts', Asset::js(array('ajaxupload.js','my.js')), false);
	}

	public function action_edit($id = null)
	{
		$article = Model_Article::find($id);
		$val = Model_Article::validate('edit');

		if ($val->run())
		{
			$article->title = Input::post('title');
			$article->summary = Input::post('summary');
			$article->category_id = Input::post('category_id');
			$article->is_recommended = Input::post('is_recommended', 0) === 0 ? 0 : 1;
			$article->img = Input::post('img');

			if ($article->save())
			{
				Session::set_flash('success', e('已更新文章 ' . $article->title));

				Response::redirect('admin/articles');
			}

			else
			{
				Session::set_flash('error', e('无法更新文章 ' . $article->title));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$article->title = $val->validated('title');
				$article->summary = $val->validated('summary');
				//$article->clicked_num = $val->validated('clicked_num');
				//$article->is_recommended = $val->validated('is_recommended');
				$article->img = $val->validated('img');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('article', $article, false);
		}
       Package::load('CKEditor');
       $categories = Model_Category::getAllCategories(array_search('文章', Model_Category::$_types))->as_array();
		$this->template->title = "文章";
		$this->template->content = View::forge('admin/articles/edit');
		$this->template->set_global('categories', $categories, false);
		$this->template->set_global('scripts', Asset::js(array('ajaxupload.js','my.js')), false);
	}

	public function action_delete($id = null)
	{
		if ($article = Model_Article::find($id))
		{
			$article->delete();

			Session::set_flash('success', e('已删除文章 #'.$article->title));
		}

		else
		{
			Session::set_flash('error', e('Could not delete article #'.$id));
		}

		Response::redirect('admin/articles');

	}


}