<?php
namespace Visol\EasyvoteCompetition\Controller;


/***************************************************************
 *
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
 *  the Free Software Foundation; either version 3 of the License, or
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
 * ParticipationController
 */
class ParticipationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * participationRepository
	 *
	 * @var \Visol\EasyvoteCompetition\Domain\Repository\ParticipationRepository
	 * @inject
	 */
	protected $participationRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$participations = $this->participationRepository->findAll();
		$this->view->assign('participations', $participations);
	}

	/**
	 * action show
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
	 * @return void
	 */
	public function showAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation) {
		$this->view->assign('participation', $participation);
	}

	/**
	 * action new
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $newParticipation
	 * @ignorevalidation $newParticipation
	 * @return void
	 */
	public function newAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $newParticipation = NULL) {
		$this->view->assign('newParticipation', $newParticipation);
	}

	/**
	 * action create
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $newParticipation
	 * @return void
	 */
	public function createAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $newParticipation) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->participationRepository->add($newParticipation);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
	 * @ignorevalidation $participation
	 * @return void
	 */
	public function editAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation) {
		$this->view->assign('participation', $participation);
	}

	/**
	 * action update
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
	 * @return void
	 */
	public function updateAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->participationRepository->update($participation);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
	 * @return void
	 */
	public function deleteAction(\Visol\EasyvoteCompetition\Domain\Model\Participation $participation) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->participationRepository->remove($participation);
		$this->redirect('list');
	}

	/**
	 * action listForCommunityUser
	 *
	 * @return void
	 */
	public function listForCommunityUserAction() {
		
	}

}