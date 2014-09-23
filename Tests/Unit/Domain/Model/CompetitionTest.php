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
 * Test case for class \Visol\EasyvoteCompetition\Domain\Model\Competition.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @author Jonas Renggli <jonas.renggli@visol.ch>
 */
class CompetitionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Visol\EasyvoteCompetition\Domain\Model\Competition
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Visol\EasyvoteCompetition\Domain\Model\Competition();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForIntegerSetsType() {
		$this->subject->setType(12);

		$this->assertAttributeEquals(
			12,
			'type',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleShortReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitleShort()
		);
	}

	/**
	 * @test
	 */
	public function setTitleShortForStringSetsTitleShort() {
		$this->subject->setTitleShort('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'titleShort',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleLongReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitleLong()
		);
	}

	/**
	 * @test
	 */
	public function setTitleLongForStringSetsTitleLong() {
		$this->subject->setTitleLong('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'titleLong',
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
	public function getVotingFrequencyReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getVotingFrequency()
		);
	}

	/**
	 * @test
	 */
	public function setVotingFrequencyForIntegerSetsVotingFrequency() {
		$this->subject->setVotingFrequency(12);

		$this->assertAttributeEquals(
			12,
			'votingFrequency',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getParticipationEndDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getParticipationEndDate()
		);
	}

	/**
	 * @test
	 */
	public function setParticipationEndDateForDateTimeSetsParticipationEndDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setParticipationEndDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'participationEndDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getParticipationsReturnsInitialValueForParticipation() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getParticipations()
		);
	}

	/**
	 * @test
	 */
	public function setParticipationsForObjectStorageContainingParticipationSetsParticipations() {
		$participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();
		$objectStorageHoldingExactlyOneParticipations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneParticipations->attach($participation);
		$this->subject->setParticipations($objectStorageHoldingExactlyOneParticipations);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneParticipations,
			'participations',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addParticipationToObjectStorageHoldingParticipations() {
		$participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();
		$participationsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$participationsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($participation));
		$this->inject($this->subject, 'participations', $participationsObjectStorageMock);

		$this->subject->addParticipation($participation);
	}

	/**
	 * @test
	 */
	public function removeParticipationFromObjectStorageHoldingParticipations() {
		$participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();
		$participationsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$participationsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($participation));
		$this->inject($this->subject, 'participations', $participationsObjectStorageMock);

		$this->subject->removeParticipation($participation);

	}
}
