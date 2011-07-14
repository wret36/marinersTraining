<?php
/**
 * @package 		PyroCMS
 * @subpackage 		Latest blog Widget
 * @author			Richard Malibiran
 *
 * Show Latest blog in your site with a widget. Intended for use on cms pages
 *
 * Usage : on a CMS page add {widget_area('name_of_area')}
 * where 'name_of_area' is the name of the widget area you created in the admin control panel
 * 
 * NOTE: based on Latest Post Widget by Erik Berman
 */

class Widget_Latest_news extends Widgets
{
	public $title = 'Latest News';
	public $description = 'Display latest News with a widget.';
	public $author = 'Richard Malibiran';
	public $website = 'www.98labs.com';
	public $version = '1.0';

	// build form fields for the backend
	// MUST match the field name declared in the form.php file
	public $fields = array(
		array(
			'field'   => 'limit',
			'label'   => 'Number of posts',
		)
	);

	public function form($options)
	{
		!empty($options['limit']) OR $options['limit'] = 5;

		return array(
			'options' => $options
		);
	}

	public function run($options)
	{
		// load the blog module's model
		class_exists('Blog_m') OR $this->load->model('blog/blog_m');

		// sets default number of posts to be shown
		empty($options['limit']) AND $options['limit'] = 5;

		// retrieve the records using the blog module's model
		$blog_widget = $this->blog_m->limit($options['limit'])->get_many_by(array('status' => 'live', 'created_on_order' => 'DESC'));

		// returns the variables to be used within the widget's view
		return array('blog_widget' => $blog_widget);
	}
}