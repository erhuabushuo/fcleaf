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
		$data['articles'] = Model_Article::find('all');
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
					//'clicked_num' => Input::post('clicked_num', 0),
					'is_recommmended' => Input::post('is_recommmended', 0) == 0 ? 0 : 1,
					'img' => Input::post('img'),
				));
                                

				if ($article and $article->save())
				{
					Session::set_flash('success', e('已添加文章 #'.$article->id.'.'));

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
		$this->template->content = View::forge('admin/articles/create');

	}

	public function action_edit($id = null)
	{
		$article = Model_Article::find($id);
		$val = Model_Article::validate('edit');

		if ($val->run())
		{
			$article->title = Input::post('title');
			$article->summary = Input::post('summary');
			// $article->clicked_num = Input::post('clicked_num');
			$article->is_recommmended = Input::post('is_recommmended', 0) === 0 ? 0 : 1;
			$article->img = Input::post('img');

			if ($article->save())
			{
				Session::set_flash('success', e('已更新文章 #' . $id));

				Response::redirect('admin/articles');
			}

			else
			{
				Session::set_flash('error', e('无法更新文章 #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$article->title = $val->validated('title');
				$article->summary = $val->validated('summary');
				//$article->clicked_num = $val->validated('clicked_num');
				//$article->is_recommmended = $val->validated('is_recommmended');
				$article->img = $val->validated('img');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('article', $article, false);
		}
                
                Package::load('CKEditor');

		$this->template->title = "文章";
		$this->template->content = View::forge('admin/articles/edit');

	}

	public function action_delete($id = null)
	{
		if ($article = Model_Article::find($id))
		{
			$article->delete();

			Session::set_flash('success', e('Deleted article #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete article #'.$id));
		}

		Response::redirect('admin/articles');

	}


}