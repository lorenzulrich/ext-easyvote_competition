<?php
namespace Visol\EasyvoteCompetition\Tests\Unit\Controller;

    /***************************************************************
     *  Copyright notice
     *
     *  (c) 2014 Lorenz Ulrich <lorenz.ulrich@visol.ch>, visol digitale Dienstleistungen GmbH
     *            Jonas Renggli <jonas.renggli@visol.ch>, visol digitale Dienstleistungen GmbH
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
 * Test case for class Visol\EasyvoteCompetition\Controller\ParticipationController.
 *
 * @author Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @author Jonas Renggli <jonas.renggli@visol.ch>
 */
class ParticipationControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var \Visol\EasyvoteCompetition\Controller\ParticipationController
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = $this->getMock('Visol\\EasyvoteCompetition\\Controller\\ParticipationController',
            array('redirect', 'forward', 'addFlashMessage'), array(), '', false);
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function listActionFetchesAllParticipationsFromRepositoryAndAssignsThemToView()
    {

        $allParticipations = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '',
            false);

        $participationRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\ParticipationRepository',
            array('findAll'), array(), '', false);
        $participationRepository->expects($this->once())->method('findAll')->will($this->returnValue($allParticipations));
        $this->inject($this->subject, 'participationRepository', $participationRepository);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->once())->method('assign')->with('participations', $allParticipations);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenParticipationToView()
    {
        $participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $this->inject($this->subject, 'view', $view);
        $view->expects($this->once())->method('assign')->with('participation', $participation);

        $this->subject->showAction($participation);
    }

    /**
     * @test
     */
    public function newActionAssignsTheGivenParticipationToView()
    {
        $participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->once())->method('assign')->with('newParticipation', $participation);
        $this->inject($this->subject, 'view', $view);

        $this->subject->newAction($participation);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenParticipationToParticipationRepository()
    {
        $participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();

        $participationRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\ParticipationRepository',
            array('add'), array(), '', false);
        $participationRepository->expects($this->once())->method('add')->with($participation);
        $this->inject($this->subject, 'participationRepository', $participationRepository);

        $this->subject->createAction($participation);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenParticipationToView()
    {
        $participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $this->inject($this->subject, 'view', $view);
        $view->expects($this->once())->method('assign')->with('participation', $participation);

        $this->subject->editAction($participation);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenParticipationInParticipationRepository()
    {
        $participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();

        $participationRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\ParticipationRepository',
            array('update'), array(), '', false);
        $participationRepository->expects($this->once())->method('update')->with($participation);
        $this->inject($this->subject, 'participationRepository', $participationRepository);

        $this->subject->updateAction($participation);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenParticipationFromParticipationRepository()
    {
        $participation = new \Visol\EasyvoteCompetition\Domain\Model\Participation();

        $participationRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\ParticipationRepository',
            array('remove'), array(), '', false);
        $participationRepository->expects($this->once())->method('remove')->with($participation);
        $this->inject($this->subject, 'participationRepository', $participationRepository);

        $this->subject->deleteAction($participation);
    }

    /**
     * @test
     */
    public function listActionFetchesAllParticipationsFromRepositoryAndAssignsThemToView()
    {

        $allParticipations = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '',
            false);

        $participationRepository = $this->getMock('Visol\\EasyvoteCompetition\\Domain\\Repository\\ParticipationRepository',
            array('findAll'), array(), '', false);
        $participationRepository->expects($this->once())->method('findAll')->will($this->returnValue($allParticipations));
        $this->inject($this->subject, 'participationRepository', $participationRepository);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->once())->method('assign')->with('participations', $allParticipations);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
