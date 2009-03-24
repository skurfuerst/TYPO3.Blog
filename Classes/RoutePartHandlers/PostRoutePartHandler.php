<?php
declare(ENCODING = 'utf-8');
namespace F3\Blog\RoutePartHandlers;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * @package FLOW3
 * @subpackage MVC
 * @version $Id$
 */

/**
 * post route part handler
 *
 * @package FLOW3
 * @subpackage MVC
 * @version $Id$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 */
class PostRoutePartHandler extends \F3\FLOW3\MVC\Web\Routing\DynamicRoutePart {

	/**
	 * Splits the given value into the date and title of the post and sets this
	 * value to an identity array accordingly.
	 *
	 * @param string $value The value (ie. part of the request path) to match. This string is rendered by findValueToMatch()
	 * @return boolean TRUE if the request path formally matched
	 * @author Robert Lemke <robert@typo3.org>
	 */
	protected function matchValue($value) {
		if (!parent::matchValue($value)) {
			return FALSE;
		}
		$matches = array();
		preg_match('/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})\/([a-zA-Z\-]+)/', $value, $matches);
		$this->value = array(
			'__identity' => array(
				'date' => new \DateTime($matches[3] . '/' . $matches[2] . '/' . $matches[1]),
				'title' => $matches[4]
		)
		);
		return TRUE;
	}

	/**
	 * Checks if the remaining request path starts with the path signature of a post, which
	 * is: YYYY/MM/DD/TITLE eg. 2009/03/09/My-First-Blog-Entry
	 *
	 * If the request path matches this pattern, the matching part is returned as the "value
	 * to match" for further processing in matchValue(). The remaining part of the requestPath
	 * (eg. the format ".html") is ignored.
	 *
	 * @param string $requestPath The request path acting as the subject for matching in this Route Part
	 * @return string The post identifying part of the request path or an empty string if it doesn't match
	 * @author Robert Lemke <robert@typo3.org>
	 */
	protected function findValueToMatch($requestPath) {
		$matches = array();
		preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}\/[a-zA-Z\-]+/', $requestPath, $matches);
		return (count($matches) === 1) ? current($matches) : '';
	}

	/**
	 * Resolves the name of the post
	 *
	 * @param \F3\Blog\Domain\Model\Post $value The Post object
	 * @return boolean TRUE if the post could be resolved and stored in $this->value, otherwise FALSE.
	 * @author Robert Lemke <robert@typo3.org>
	 */
	protected function resolveValue($value) {
		if (!$value instanceof \F3\Blog\Domain\Model\Post) return FALSE;
		$this->value = $value->getDate()->format('Y/m/d/');
		$this->value .= str_replace(' ', '-', $value->getTitle());
		return TRUE;
	}
}
?>