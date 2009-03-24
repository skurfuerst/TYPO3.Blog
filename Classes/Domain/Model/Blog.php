<?php
declare(ENCODING = 'utf-8');
namespace F3\Blog\Domain\Model;

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
 * @package Blog
 * @subpackage Domain
 * @version $Id$
 */

/**
 * A blog
 *
 * @package Blog
 * @subpackage Domain
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Blog {

	/**
	 * The blog's name
	 *
	 * @var string
	 * @identity
	 */
	protected $name = '';

	/**
	 * A short description of the blog
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * The blog's logo
	 *
	 * @var string
	 */
	protected $logo;

	/**
	 * The posts contained in this blog
	 *
	 * @var array
	 */
	protected $posts = array();

	/**
	 * Constructs this blog
	 *
	 * @param string $name Name of this blog
	 * @return
	 */
	public function __construct($name) {
		$this->name = $name;
	}

	/**
	 * Sets this blog's name
	 *
	 * @param string $name The blog's name
	 * @return void
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the blog's name
	 *
	 * @return string The blog's name
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the description for the blog
	 *
	 * @param string $description
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the description
	 *
	 * @return string
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Adds a post to this blog
	 *
	 * @param \F3\Blog\Domain\Model\Post $post
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function addPost(\F3\Blog\Domain\Model\Post $post) {
		$post->setBlog($this);
		$this->posts[] = $post;
	}

	/**
	 * Returns all posts in this blog
	 *
	 * @return array of \F3\Blog\Domain\Model\Post
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function getPosts() {
		return $this->posts;
	}

	/**
	 * Returns the latest $count posts from the blog
	 *
	 * @param integer $count
	 * @return array of \F3\Blog\Domain\Model\Post
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function getLatestPosts($count = 5) {
		if (is_array($this->posts)) {
			return array_slice($this->posts, -$count, $count, TRUE);
		} else {
			return array();
		}
	}
}
?>