DROP TABLE IF EXISTS `civicrm_membership_terms`;

-- /*******************************************************
-- *
-- * civicrm_membership_terms
-- *
-- * To record membership terms/periods
-- *
-- *******************************************************/
CREATE TABLE `civicrm_membership_terms` (
     `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Unique MembershipTerms ID',
     `membership_id` int unsigned    COMMENT 'FK to Membership Table',
     `contribution_id` int unsigned    COMMENT 'FK to Contribution Table',
     `start_date` date    COMMENT 'Start date of membership term',
     `end_date` date    COMMENT 'End date of membership term' 
,
        PRIMARY KEY (`id`)
 
 
,          CONSTRAINT FK_civicrm_membership_terms_contribution_id FOREIGN KEY (`contribution_id`) REFERENCES `civicrm_contribution`(`id`) ON DELETE CASCADE,          CONSTRAINT FK_civicrm_membership_terms_membership_id FOREIGN KEY (`membership_id`) REFERENCES `civicrm_membership`(`id`) ON DELETE CASCADE  
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;