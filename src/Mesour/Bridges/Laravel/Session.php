<?php
/**
 * This file is part of the Mesour Laravel Bridges (http://components.mesour.com/version3/bridges/laravel)
 *
 * Copyright (c) 2016 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette\Laravel;

use Illuminate\Session\SessionManager;
use Mesour;

/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Session implements Mesour\Components\Session\ISession
{
	/** @var SessionManager */
	private $sessionManager;

	private $sections = [];

	public function __construct(SessionManager $sessionManager)
	{
		$this->sessionManager = $sessionManager;
	}

	/**
	 * @param $section
	 * @return Mesour\Components\Session\ISessionSection
	 * @throws Mesour\InvalidArgumentException
	 */
	public function getSection($section)
	{
		if (!Mesour\Components\Utils\Helpers::validateKeyName($section)) {
			throw new Mesour\InvalidArgumentException(
				'SessionSection name must be integer or string, ' . gettype($section) . ' given.'
			);
		}
		$this->sections[$section] = $section;
		return new SessionSection($section, $this);
	}

	public function hasSection($section)
	{
		return isset($this->sections[$section]);
	}

	public function setValueForSection($section, $key, $value)
	{
		$oldValues = $this->sessionManager->get($section);
		$oldValues = !is_array($oldValues) ? [] : $oldValues;
		$oldValues[$key] = $value;
		$this->sessionManager->set($section, $oldValues);
	}

	public function removeSectionData($section)
	{
		$this->sessionManager->set($section, null);
	}

	public function getValueForSection($section, $key = null, $default = null)
	{
		$values = $this->sessionManager->get($section);
		if (!$key) {
			return $values;
		}
		return isset($values[$key]) ? $values[$key] : $default;
	}

	public function destroy()
	{
	}

	public function loadState()
	{
	}

	public function saveState()
	{
	}
}