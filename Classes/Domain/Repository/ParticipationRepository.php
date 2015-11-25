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

/**
 * The repository for Participations
 */
class ParticipationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByCompetition(\Visol\EasyvoteCompetition\Domain\Model\Competition $competition)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('competition', $competition),
                $query->equals('disabled', 0)
            )
        );
        $query->setOrderings(array(
            'cachedRank' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
        ));
        return $query->execute();
    }

    /**
     * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
     * @param \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
     * @return NULL|\Visol\EasyvoteCompetition\Domain\Model\Participation
     */
    public function findOneByCompetitionAndCommunityUser(
        \Visol\EasyvoteCompetition\Domain\Model\Competition $competition,
        \Visol\Easyvote\Domain\Model\CommunityUser $communityUser
    ) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('competition', $competition),
                $query->equals('communityUser', $communityUser)
            )
        );
        return $query->execute()->getFirst();
    }

    /**
     * @param \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
     * @return bool
     */
    public function updateCachedVotesAndCachedRankForCompetition(
        \Visol\EasyvoteCompetition\Domain\Model\Competition $competition
    ) {
        $sql = 'UPDATE tx_easyvotecompetition_domain_model_participation AS participation
			LEFT JOIN (
				SELECT participation, COUNT(*) number_of_votes
				FROM  tx_easyvotecompetition_domain_model_vote
				WHERE deleted = 0 AND hidden = 0
				GROUP BY participation
				) AS vote
			ON participation.uid = vote.participation
			SET cached_votes = CASE
				WHEN vote.number_of_votes IS NULL THEN 0
				WHEN vote.number_of_votes > 0 THEN number_of_votes
			END
			WHERE participation.competition = ' . $competition->getUid() . '
			AND participation.deleted = 0 AND participation.hidden = 0 AND participation.disabled = 0';
        $GLOBALS['TYPO3_DB']->sql_query($sql);

        /* http://stackoverflow.com/a/14297055/1517316 */
        $GLOBALS['TYPO3_DB']->sql_query('SET @prev_value = NULL;');
        $GLOBALS['TYPO3_DB']->sql_query('SET @rank_count = 0;');
        $sql = '
			UPDATE tx_easyvotecompetition_domain_model_participation
			SET cached_rank = CASE
				WHEN @prev_value = cached_votes THEN @rank_count
				WHEN @prev_value := cached_votes THEN @rank_count := @rank_count + 1
				ELSE @rank_count := @rank_count + 1
			END
			WHERE competition = ' . $competition->getUid() . ' AND deleted = 0 AND hidden = 0 AND disabled = 0
			ORDER BY cached_votes DESC';
        $GLOBALS['TYPO3_DB']->sql_query($sql);

        /* Compare cached votes with calculated votes
            SELECT uid,title,cached_votes,cached_rank,calculated_votes FROM `tx_easyvotecompetition_domain_model_participation` AS participation
            LEFT JOIN
            (
                SELECT participation, COUNT(*) calculated_votes
                FROM  tx_easyvotecompetition_domain_model_vote
                WHERE deleted = 0 AND hidden = 0
                GROUP BY participation
            )  vote ON participation.uid = vote.participation ORDER by cached_rank
         */

        return true;
    }

}