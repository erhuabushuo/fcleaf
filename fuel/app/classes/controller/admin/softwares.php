<?php
class Controller_Admin_Softwares extends Controller_Admin 
{

        public function action_testupload()
        {
            return new Response(1);
        }
    
	public function action_upload()
	{
		$path = DOCROOT . DS . 'upload' . DS .'softwares';
		if (!is_dir($path))
		{
			try
			{
				File::create_dir(DOCROOT . DS . 'upload', 'softwares', 0777);
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
					'urlpath'  => Uri::base() . DS . 'upload' . DS .  'softwares' . DS . $filename,
			);
		}
	
		return new Response(json_encode($result));
	}
        
        public function action_async_upload()
        {
                $path = DOCROOT . DS . 'upload' . DS .'storehouse';
                $subdir = date("Y-M-d");
                $subpath = $path . DS . $subdir;
		if (!is_dir($path))
		{
			try
			{
				File::create_dir(DOCROOT . DS . 'upload', 'storehouse', 0777);
                                if (!is_dir($subpath))
                                    File::create_dir($path, $subdir, 0777);
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
				'path'		 => $subpath,
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
					'filename' => $subdir . DS . $filename,
					'urlpath'  => Uri::base() . DS . 'upload' . DS .  'storehouse' . DS . $subdir . DS . $filename,
			);
		}
	
		return new Response(json_encode($result));
        }
        
        public function action_test()
        {
            $data = array();
            $this->template->title = "测试上传";
            $this->template->content = View::forge("admin/softwares/test", $data);
        }
	
	public function action_index()
	{
		$data['softwares'] = Model_Software::find('all');
		$this->template->title = "Softwares";
		$this->template->content = View::forge('admin/softwares/index', $data);

	}

	public function action_view($id = null)
	{
		$data['software'] = Model_Software::find($id);
		$this->template->title = "Software";
		$this->template->content = View::forge('admin/softwares/test', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Software::validate('create');

			if ($val->run())
			{
				$software = Model_Software::forge(array(
					'title' => Input::post('title'),
					'category_id' => Input::post('category_id'),
					'file' => Input::post('file'),
					'is_recommended' => Input::post('is_recommended'),
					'img' => Input::post('img'),
					'summary' => Input::post('summary'),
				));

				if ($software and $software->save())
				{
					Session::set_flash('success', e('Added software #'.$software->id.'.'));

					Response::redirect('admin/softwares');
				}

				else
				{
					Session::set_flash('error', e('Could not save software.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		Package::load('CKEditor');
		$categories = Model_Category::getAllCategories(array_search('软件', Model_Category::$_types))->as_array();
		$this->template->set_global('categories', $categories, false);
                $scripts = Asset::js(array('ajaxupload.js', 'swfupload.js', 'jquery-asyncUpload-0.1.js','my.js'));
                $upload_js = View::forge('admin/softwares/async_upload');
                $all_scripts = $scripts . $upload_js;
		$this->template->set_global('scripts', $all_scripts, false);
		$this->template->title = "软件";
		$this->template->content = View::forge('admin/softwares/create');
		
	}

	public function action_edit($id = null)
	{
		$software = Model_Software::find($id);
		$val = Model_Software::validate('edit');

		if ($val->run())
		{
			$software->title = Input::post('title');
			$software->category_id = Input::post('category_id');
			$software->file = Input::post('file');
			$software->is_recommended = Input::post('is_recommended');
			$software->img = Input::post('img');
			$software->summary = Input::post('summary');

			if ($software->save())
			{
				Session::set_flash('success', e('Updated software #' . $id));

				Response::redirect('admin/softwares');
			}

			else
			{
				Session::set_flash('error', e('Could not update software #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$software->title = $val->validated('title');
				$software->category_id = $val->validated('category_id');
				$software->file = $val->validated('file');
				$software->is_recommended = $val->validated('is_recommended');
				$software->img = $val->validated('img');
				$software->summary = $val->validated('summary');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('software', $software, false);
		}

		$this->template->title = "Softwares";
		$this->template->content = View::forge('admin/softwares/edit');

	}

	public function action_delete($id = null)
	{
		if ($software = Model_Software::find($id))
		{
			$software->delete();

			Session::set_flash('success', e('Deleted software #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete software #'.$id));
		}

		Response::redirect('admin/softwares');

	}


}