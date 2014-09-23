<?php
namespace Visol\EasyvoteCompetition\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Lorenz Ulrich <lorenz.ulrich@visol.ch>, visol digitale Dienstleistungen GmbH
 *  			Jonas Renggli <jonas.renggli@visol.ch>, visol digitale Dienstleistungen GmbH
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
 * Test case for class Visol\EasyvoteCompetition\Controller\CompetitionController.
 *
 * @author Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @author Jonas Renggli <jonas.renggli@visol.ch>
 */
class CompetitionControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Visol\EasyvoteCompetition\Controller\CompetitionController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Visol\\EasyvoteCompetition\\Controller\\CompetitionController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCompetitionsFromRepositoryAndAssignsThemToView() {

		$allCompetitions = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$competitionRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\CompetitionRepository', array('findAll'), array(), '', FALSE);
		$competitionRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCompetitions));
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('competitions', $allCompetitions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCompetitionToView() {
		$competition = new \Visol\EasyvoteCompetition\Domain\Model\Competition();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('competition', $competition);

		$this->subject->showAction($competition);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCompetitionsFromRepositoryAndAssignsThemToView() {

		$allCompetitions = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$competitionRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\CompetitionRepository', array('findAll'), array(), '', FALSE);
		$competitionRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCompetitions));
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('competitions', $allCompetitions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
