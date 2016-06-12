<?php
namespace Visol\EasyvoteCompetition\Domain\Repository;


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
use Visol\Easyvote\Domain\Model\CommunityUser;

/**
 * The repository for Votes
 */
class VoteRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    public function findByParticipationAndCommunityUser(
        \Visol\EasyvoteCompetition\Domain\Model\Participation $participation,
        \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
    ) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('participation', $participation),
                $query->equals('communityUser', $communityUser)
            )
        );
        // latest vote first
        $query->setOrderings(array(
            'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
        ));
        return $query->execute();
    }

	/**
	 * @param CommunityUser $communityUser
	 * @param bool $respectStoragePage
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByCommunityUser(CommunityUser $communityUser, $respectStoragePage = true) {
		$query = $this->createQuery();
		if (!$respectStoragePage) {
			$query->getQuerySettings()->setRespectStoragePage(false);
		}
		$query->matching(
			$query->equals('communityUser', $communityUser)
		);
		return $query->execute();
	}

}