<?php

/**
 * MembershipTerms.get API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_membership_terms_get($params) {

    $options = _civicrm_api3_get_options_from_params($params, TRUE, 'Membershipterms', 'get');
    if ($options['is_count']) {
        return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
    }
    
    $membership_terms = array();
	$dao_membership_terms = new CRM_Membershipterms_DAO_MembershipTerms();
    foreach($options['input_params'] as $_input_param_key => $_input_param_val) {
        $dao_membership_terms->{$_input_param_key} = $_input_param_val;
    }
	$dao_membership_terms->find();
    
    while ($dao_membership_terms->fetch()) {
      CRM_Core_DAO::storeValues($dao_membership_terms, $membership_terms[]);
    }

	return civicrm_api3_create_success($membership_terms, $params, 'Membershipterms', 'get');
}
