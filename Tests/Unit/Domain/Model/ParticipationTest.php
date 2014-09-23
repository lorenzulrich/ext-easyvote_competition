<?php

namespace Visol\EasyvoteCompetition\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Lorenz Ulrich <lorenz.ulrich@visol.ch>, visol digitale Dienstleistungen GmbH
 *           Jonas Renggli <jonas.renggli@visol.ch>, visol digitale Dienstleistungen GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Visol\EasyvoteCompetition\Domain\Model\Participation.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @author Jonas Renggli <jonas.renggli@visol.ch>
 */
class ParticipationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteCompetition\Domain\Model\Participation
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteCompetition\Domain\Model\Participation();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMediaReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMedia()
		);
	}

	/**
	 * @test
	 */
	public function setMediaForStringSetsMedia() {
		$this->subject->setMedia('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'media',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLanguageReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getLanguage()
		);
	}

	/**
	 * @test
	 */
	public function setLanguageForIntegerSetsLanguage() {
		$this->subject->setLanguage(12);

		$this->assertAttributeEquals(
			12,
			'language',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVotingEnabledReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getVotingEnabled()
		);
	}

	/**
	 * @test
	 */
	public function setVotingEnabledForBooleanSetsVotingEnabled() {
		$this->subject->setVotingEnabled(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'votingEnabled',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVotesReturnsInitialValueForVote() {
		$this->assertEquals(
			NULL,
			$this->subject->getVotes()
		);
	}

	/**
	 * @test
	 */
	public function setVotesForVoteSetsVotes() {
		$votesFixture = new \Visol\EasyvoteCompetition\Domain\Model\Vote();
		$this->subject->setVotes($votesFixture);

		$this->assertAttributeEquals(
			$votesFixture,
			'votes',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCommunityUserReturnsInitialValueForCommunityUser() {	}

	/**
	 * @test
	 */
	public function setCommunityUserForCommunityUserSetsCommunityUser() {	}
}
