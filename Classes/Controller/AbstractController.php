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
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * competitionRepository
     *
     * @var \Visol\EasyvoteCompetition\Domain\Repository\CompetitionRepository
     * @inject
     */
    protected $competitionRepository = null;

    /**
     * participationRepository
     *
     * @var \Visol\EasyvoteCompetition\Domain\Repository\ParticipationRepository
     * @inject
     */
    protected $participationRepository = null;

    /**
     * voteRepository
     *
     * @var \Visol\EasyvoteCompetition\Domain\Repository\VoteRepository
     * @inject
     */
    protected $voteRepository = null;

    /**
     * @var \Visol\EasyvoteCompetition\Service\CompetitionService
     * @inject
     */
    protected $competitionService;

    /**
     * communityUserRepository
     *
     * @var \Visol\Easyvote\Domain\Repository\CommunityUserRepository
     * @inject
     */
    protected $communityUserRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * @return \Visol\Easyvote\Domain\Model\CommunityUser|bool
     */
    protected function getLoggedInUser()
    {
        if ((int)$GLOBALS['TSFE']->fe_user->user['uid'] > 0) {
            $communityUser = $this->communityUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            if ($communityUser instanceof \Visol\Easyvote\Domain\Model\CommunityUser) {
                return $communityUser;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
