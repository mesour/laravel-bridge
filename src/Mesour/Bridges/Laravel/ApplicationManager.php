<?php
/**
 * This file is part of the Mesour Laravel Bridges (http://components.mesour.com/version3/bridges/laravel)
 *
 * Copyright (c) 2016 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace App\Mesour;

use Mesour\InvalidArgumentException;

class ApplicationManager
{

	const OPT_NAME = 'name';

	private $config;

	protected $defaults = [
		self::OPT_NAME => 'mesourApp',
	];

	public function __construct($config)
	{
		$this->config = !$config ? [] : $config;

		$this->application = new \Mesour\UI\Application($this->getOption(self::OPT_NAME));
		$this->application->setSession(new Session(app('session')));
		$this->application->setRequest($_REQUEST);
	}

	public function getApplication()
	{
		return $this->application;
	}

	protected function getOption($name)
	{
		if (!isset($this->defaults[$name])) {
			throw new InvalidArgumentException("Config with name '$name' was not recognized.");
		}
		return isset($this->config[$name]) ? $this->config[$name] : $this->defaults[$name];
	}

}