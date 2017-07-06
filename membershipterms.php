<?php

require_once 'membershipterms.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function membershipterms_civicrm_config(&$config) {
  _membershipterms_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function membershipterms_civicrm_xmlMenu(&$files) {
  _membershipterms_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function membershipterms_civicrm_install() {
  _membershipterms_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function membershipterms_civicrm_postInstall() {
  _membershipterms_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function membershipterms_civicrm_uninstall() {
  _membershipterms_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function membershipterms_civicrm_enable() {
  _membershipterms_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function membershipterms_civicrm_disable() {
  _membershipterms_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function membershipterms_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _membershipterms_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function membershipterms_civicrm_managed(&$entities) {
  _membershipterms_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function membershipterms_civicrm_caseTypes(&$caseTypes) {
  _membershipterms_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function membershipterms_civicrm_angularModules(&$angularModules) {
  _membershipterms_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function membershipterms_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _membershipterms_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * This function will hook MembershipTerms entity type into CiviCRM
 * 
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function membershipterms_civicrm_entityTypes(&$entityTypes) {
  $entityTypes[] = array(
    'name' => 'MembershipTerms',
    'class' => 'CRM_Membershipterms_DAO_MembershipTerms',
    'table' => 'civicrm_membershipterms',
  );
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * This hook is used to insert partial template/view of membership term(s)
 * 
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildForm
 */
function membershipterms_civicrm_buildForm($formName, &$form) {
  
  // To insert list of membership terms into membership view
  if ($formName == 'CRM_Member_Form_MembershipView') {

    $membership_terms = array(); // Store all membership terms in array

    // get membership terms for requested membership and push in array
    $dao_membership_terms = new CRM_Membershipterms_DAO_MembershipTerms();
    $dao_membership_terms->membership_id = $form->get('id');
    $dao_membership_terms->find();
    while ($dao_membership_terms->fetch()) {
      CRM_Core_DAO::storeValues($dao, $membership_terms[]);
    }

    // Add terms data into form
    $form->assign('membership_terms', $membership_terms);
    
    // insert a terms list template block in the membership view
    $templatePath = realpath(dirname(__FILE__)."/templates");
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/membership_terms.tpl"
     ));
  }

  // To insert membership term into contribution view
  else if($formName == 'CRM_Contribute_Form_ContributionView') {

    // get membership term detail for the contribution if recorded
    $dao_membership_terms = new CRM_Membershipterms_DAO_MembershipTerms();
    $dao_membership_terms->contrubution_id = $form->get('id');
    $dao_membership_terms->find(TRUE);

    // If membership term was recorded
    if(!empty($dao_membership_terms->id)) {
      // Add term data into form
      $form->assign('membership_term', (array)$dao_membership_terms);

      // insert term detail template block in the contribution view
      $templatePath = realpath(dirname(__FILE__)."/templates");
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => "{$templatePath}/contribution_membership_term.tpl"
       ));
    }
  }
}

/**
 * Implements hook_civicrm_postProcess().
 *
 * This hook will store membership term info when membership is created or renewed
 * 
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postProcess
 */
function membershipterms_civicrm_postProcess($formName, &$form) { 

  // Check if membership is renewed
  if($formName == 'CRM_Member_Form_MembershipRenewal') {

    // get start date from form default values
    $form_default_values = $form->getVar('_defaultValues');
    $start_date = date('Y-m-d', strtotime($form_default_values['end_date'] . ' +1 day'));

    // get contribution ID from lineItems received in parameters of form object
    $contribution_id = NULL;
    $form_params = $form->getVar('_params');
    if(!empty($form_params['lineItems'])) {
      $contribution_line = current(current($form_params['lineItems']));
      if(!empty($contribution_line)) {
        $contribution_id = $contribution_line['contribution_id'];
        $dao_membership_terms->contribution_id = $contribution_line['contribution_id'];
      }
    }

    // create end date from form variable
    $end_date = substr($form->getVar('endDate'), 0, 4) . '-'
      . substr($form->getVar('endDate'), 4, 2) . '-'
      . substr($form->getVar('endDate'), 6, 2);

    // save membership term
    $dao_membership_terms = new CRM_Membershipterms_DAO_MembershipTerms();
    $dao_membership_terms->start_date = $start_date;
    $dao_membership_terms->end_date = $end_date;
    $dao_membership_terms->membership_id = $form->getVar('_id');
    if(!empty($contribution_id)) {
      $dao_membership_terms->contribution_id = $contribution_id;
    }
    $dao_membership_terms->save();
  }

  // Check if membership is created
  else if($formName == 'CRM_Member_Form_Membership') {

    // get membership detail
    $dao_membership = new CRM_Member_DAO_Membership();
    $dao_membership->id = $form->getVar('_id');
    $dao_membership->find(TRUE);

    // get payment detail
    $dao_payment = new CRM_Member_DAO_MembershipPayment();
    $dao_payment->membership_id = $form->getVar('_id');
    $dao_payment->find(TRUE);

    // prepare term data and save it
    $dao_membership_terms = new CRM_Membershipterms_DAO_MembershipTerms();
    $dao_membership_terms->start_date = $dao_membership->start_date;
    $dao_membership_terms->end_date = $dao_membership->end_date;
    $dao_membership_terms->membership_id = $form->getVar('_id');

    if(!empty($dao_payment->contribution_id)) {
      $dao_membership_terms->contribution_id = $dao_payment->contribution_id;
    }
    $dao_membership_terms->save();
  }
}