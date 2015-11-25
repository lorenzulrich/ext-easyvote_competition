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
 * CompetitionController
 */
class CompetitionController extends AbstractController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $competitions = $this->competitionRepository->findAll();
        $this->view->assign('competitions', $competitions);
    }

    /**
     * action show
     *
     * @param \Visol\EasyvoteCompetition\Domain\Model\Participation $participation
     * @param int $openSharer
     * @return void
     */
    public function showAction(
        \Visol\EasyvoteCompetition\Domain\Model\Participation $participation = null,
        $openSharer = 0
    ) {
        $competition = $this->competitionRepository->findByUid((int)$this->settings['competition']);
        $communityUser = $this->competitionService->getCurrentCommunityUser();

        $this->view->assign('communityUser', $communityUser);
        $this->view->assign('competition', $competition);
        $this->view->assign('participation', $participation);
        $this->view->assign('openSharer', (bool)$openSharer);
    }

    /**
     * action archive
     *
     * @return void
     */
    public function archiveAction()
    {

    }

    /**
     * action listForCommunityUser
     *
     * @return void
     */
    public function listForCommunityUserAction()
    {

    }

}