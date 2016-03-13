<?php
/**
 * This file is part of the Mesour Laravel Bridges (http://components.mesour.com/version3/bridges/laravel)
 *
 * Copyright (c) 2016 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette\Laravel;

use Mesour;

/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class SessionSection implements Mesour\Components\Session\ISessionSection
{

	/** @var string */
	private $name;

	/** @var Session */
	private $session;

	public function __construct($name, Session $session)
	{
		$this->name = $name;
		$this->session = $session;
	}

	public function remove()
	{
		$this->session->removeSectionData($this->name);
	}

	public function set($key, $value)
	{
		if (!Mesour\Components\Utils\Helpers::validateKeyName($key)) {
			throw new Mesour\InvalidArgumentException(
				'SessionSection name must be integer or string, ' . gettype($key) . ' given.'
			);
		}
		$this->session->setValueForSection($this->name, $key, $value);
		return $this;
	}

	public function get($key = null, $default = null)
	{
		return $this->session->getValueForSection($this->name, $key, $default);
	}

	public function loadState($data)
	{
		//do nothing, loaded by framework
	}
}