<?php
namespace Visol\EasyvoteCompetition\Service;


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

class CompetitionService {

	/**
	 * participationRepository
	 *
	 * @var \Visol\EasyvoteCompetition\Domain\Repository\ParticipationRepository
	 * @inject
	 */
	protected $participationRepository = NULL;

	/**
	 * voteRepository
	 *
	 * @var \Visol\EasyvoteCompetition\Domain\Repository\VoteRepository
	 * @inject
	 */
	protected $voteRepository = NULL;

	public function userCanVoteForParticiation($participationUid) {
		/** @var \Visol\EasyvoteCompetition\Domain\Model\Participation $participation */
		$participation = $this->participationRepository->findByUid($participationUid);
		$communityUser = $this->getCurrentCommunityUser();
		$votesForUserAndParticipation = $this->voteRepository->findByParticipationAndCommunityUser($participation, $communityUser);

		switch ($participation->getCompetition()->getVotingFrequency()) {
			case \Visol\EasyvoteCompetition\Domain\Model\Competition::VOTINGFREQUENCY_ONCEPERPARTICIPATION:
				if (count($votesForUserAndParticipation)) {
					// we have at least one vote, but only one is allowed, therefore the user cannot vote for this participation
					return FALSE;
				} else {
					return TRUE;
				}
				break;
			case \Visol\EasyvoteCompetition\Domain\Model\Competition::VOTINGFREQUENCY_EVERY24HOURSPERPARTICIPATION:
				if (count($votesForUserAndParticipation)) {
					/** @var \Visol\EasyvoteCompetition\Domain\Model\Vote $latestVoteForParticipation */
					$latestVoteForParticipation = $votesForUserAndParticipation->getFirst();
					$timestampOfLatestVote = $latestVoteForParticipation->getCrdate()->getTimestamp();
					if ($timestampOfLatestVote > (time() - 86400)) {
						// the latest vote was cast within the last 24 hours, so no other vote allowed for now
						return FALSE;
					} else {
						return TRUE;
					}
				} else {
					return TRUE;
				}
				break;
		}

	}

	/**
	 * @var \Visol\Easyvote\Domain\Repository\CommunityUserRepository
	 * @inject
	 */
	protected $communityUserRepository;

	/**
	 * @return null|\Visol\Easyvote\Domain\Model\CommunityUser
	 */
	public function getCurrentCommunityUser() {
		$frontendUserUid = (int)$GLOBALS['TSFE']->fe_user->user['uid'];
		if ($frontendUserUid > 0) {
			return $this->communityUserRepository->findByUid($frontendUserUid);
		} else {
			return NULL;
		}
	}

}