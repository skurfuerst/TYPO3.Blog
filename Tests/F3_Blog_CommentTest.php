<?php
declare(ENCODING = 'utf-8');

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
 * @subpackage Tests
 * @version $Id$
 */

/**
 * @package Blog
 * @subpackage Tests
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class F3_Blog_CommentTest extends F3_Testing_BaseTestCase {

	/**
	 * Make sure Comment is protoype
	 *
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @test
	 */
	public function commentIsPrototype() {
		$firstInstance = $this->componentFactory->getComponent('F3_Blog_Domain_Comment');
		$secondInstance = $this->componentFactory->getComponent('F3_Blog_Domain_Comment');
		$this->assertNotSame($secondInstance, $firstInstance, 'F3_Blog_Domain_Comment is not prototype.');
	}
}

?>