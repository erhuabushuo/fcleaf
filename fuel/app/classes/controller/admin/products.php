<?php
class Controller_Admin_Products extends Controller_Admin 
{
	
	public function action_upload()
	{
		$path = DOCROOT . DS . 'upload' . DS .'products';
		if (!is_dir($path))
		{
			try
			{
				File::create_dir(DOCROOT . DS . 'upload', 'products', 0777);
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
					'urlpath'  => Uri::base() . DS . 'upload' . DS .  'products' . DS . $filename,
			);
		}
	
		return new Response(json_encode($result));
	}

	public function action_index()
	{
		$config = array(
				'pagination_url' => \Uri::base().'admin/products/index/',
				'total_items' => Model_Product::find()->count(),
				'per_page' => 20,
				'uri_segment' => 4,
		);
		$pagination = Pagination::forge('pagination', $config);
		$data['products'] = Model_Product::find()->related('category')->order_by('id', 'desc')->limit($pagination->per_page)->offset($pagination->offset)->get();
		$this->template->set_global('pagination', $pagination->render(), false);
		$this->template->title = "产品";
		$this->template->content = View::forge('admin/products/index', $data);

	}

	public function action_view($id = null)
	{
		$data['product'] = Model_Product::find($id);

		$this->template->title = "Product";
		$this->template->content = View::forge('admin/products/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Product::validate('create');

			if ($val->run())
			{
				$product = Model_Product::forge(array(
					'title' => Input::post('title'),
					'category_id' => Input::post('category_id'),
					'price' => Input::post('price'),
					'is_recommended' => Input::post('is_recommended', 0) == 0 ? 0 : 1,
					//'click_num' => Input::post('click_num'), 
					'img' => Input::post('img'),
					'summary' => Input::post('summary'),
				));
				
				if ($product and $product->save())
				{
					Session::set_flash('success', e('已添加产品 #'.$product->title.'.'));

					Response::redirect('admin/products');
				}

				else
				{
					Session::set_flash('error', e('无法保存产品.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		Package::load('CKEditor');
		$categories = Model_Category::getAllCategories(array_search('产品', Model_Category::$_types))->as_array();
		$this->template->set_global('categories', $categories, false);
		$this->template->title = "产品";
		$this->template->content = View::forge('admin/products/create');
		$this->template->set_global('scripts', Asset::js(array('ajaxupload.js','my.js')), false);

	}

	public function action_edit($id = null)
	{
		$product = Model_Product::find($id);
		$val = Model_Product::validate('edit');

		if ($val->run())
		{
			$product->title = Input::post('title');
			$product->category_id = Input::post('category_id');
			$product->price = Input::post('price');
			$product->is_recommended = Input::post('is_recommended', 0) == 0 ? 0 : 1;
			$product->img = Input::post('img');
			$product->summary = Input::post('summary');

			if ($product->save())
			{
				Session::set_flash('success', e('已更新产品 #' . $product->title));

				Response::redirect('admin/products');
			}

			else
			{
				Session::set_flash('error', e('无法更新产品 #' . $product->title));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$product->title = $val->validated('title');
				$product->category_id = $val->validated('category_id');
				$product->price = $val->validated('price');
				$product->is_recommended = $val->validated('is_recommended', 0) == 0 ? 0 : 1;
				$product->img = $val->validated('img');
				$product->summary = $val->validated('summary');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('product', $product, false);
		}
		Package::load('CKEditor');
		$categories = Model_Category::getAllCategories(array_search('产品', Model_Category::$_types))->as_array();
		$this->template->set_global('categories', $categories, false);
		$this->template->title = "产品";
		$this->template->content = View::forge('admin/products/edit');
		$this->template->set_global('scripts', Asset::js(array('ajaxupload.js','my.js')), false);
	}

	public function action_delete($id = null)
	{
		if ($product = Model_Product::find($id))
		{
			$product->delete();

			Session::set_flash('success', e('Deleted product #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete product #'.$id));
		}

		Response::redirect('admin/products');

	}


}