<?php

/**
 * Nette Framework
 *
 * Copyright (c) 2004, 2009 David Grudl (http://davidgrudl.com)
 *
 * This source file is subject to the "Nette license" that is bundled
 * with this package in the file license.txt.
 *
 * For more information please see http://nettephp.com
 *
 * @copyright  Copyright (c) 2004, 2009 David Grudl
 * @license    http://nettephp.com/license  Nette license
 * @link       http://nettephp.com
 * @category   Nette
 * @package    Nette\Application
 */

/*namespace Nette\Application;*/

require_once dirname(__FILE__) . '/../FreezableObject.php';



/**
 * Presenter request. Immutable object.
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2004, 2009 David Grudl
 * @package    Nette\Application
 *
 * @property   string $presenterName
 * @property   array $params
 * @property   array $post
 * @property   array $files
 */
final class PresenterRequest extends /*Nette\*/FreezableObject
{
	/** method */
	const FORWARD = 'FORWARD';

	/** flag */
	const SECURED = 'secured';

	/** flag */
	const RESTORED = 'restored';

	/** @var string */
	private $method;

	/** @var array */
	private $flags = array();

	/** @var string */
	private $name;

	/** @var array */
	private $params;

	/** @var array */
	private $post;

	/** @var array */
	private $files;



	/**
	 * @param  string  fully qualified presenter name (module:module:presenter)
	 * @param  string  method
	 * @param  array   variables provided to the presenter usually via URL
	 * @param  array   variables provided to the presenter via POST
	 * @param  array   all uploaded files
	 */
	public function __construct($name, $method, array $params, array $post = array(), array $files = array(), array $flags = array())
	{
		$this->name = $name;
		$this->method = $method;
		$this->params = $params;
		$this->post = $post;
		$this->files = $files;
		$this->flags = $flags;
	}



	/**
	 * Sets the presenter name.
	 * @param  string
	 * @return void
	 */
	public function setPresenterName($name)
	{
		$this->updating();
		$this->name = $name;
	}



	/**
	 * Retrieve the presenter name.
	 * @return string
	 */
	public function getPresenterName()
	{
		return $this->name;
	}



	/**
	 * Sets variables provided to the presenter.
	 * @param  array
	 * @return void
	 */
	public function setParams(array $params)
	{
		$this->updating();
		$this->params = $params;
	}



	/**
	 * Returns all variables provided to the presenter (usually via URL).
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}



	/**
	 * Sets variables provided to the presenter via POST.
	 * @param  array
	 * @return void
	 */
	public function setPost(array $params)
	{
		$this->updating();
		$this->post = $params;
	}



	/**
	 * Returns all variables provided to the presenter via POST.
	 * @return array
	 */
	public function getPost()
	{
		return $this->post;
	}



	/**
	 * Sets all uploaded files.
	 * @param  array
	 * @return void
	 */
	public function setFiles(array $files)
	{
		$this->updating();
		$this->files = $files;
	}



	/**
	 * Returns all uploaded files.
	 * @return array
	 */
	public function getFiles()
	{
		return $this->files;
	}



	/**
	 * Sets the method.
	 * @param  string
	 * @return void
	 */
	public function setMethod($method)
	{
		$this->method = $method;
	}



	/**
	 * Checks if the method is the given one.
	 * @param  string
	 * @return bool
	 */
	public function isMethod($method)
	{
		return strcasecmp($this->method, $method) === 0;
	}



	/**
	 * Checks if the method is POST.
	 * @return bool
	 */
	public function isPost()
	{
		return strcasecmp($this->method, 'post') === 0;
	}



	/**
	 * Sets the flag.
	 * @param  string
	 * @param  bool
	 * @return void
	 */
	public function setFlag($flag, $value = TRUE)
	{
		$this->updating();
		$this->flags[$flag] = (bool) $value;
	}



	/**
	 * Checks the flag.
	 * @param  string
	 * @return bool
	 */
	public function hasFlag($flag)
	{
		return !empty($this->flags[$flag]);
	}

}
