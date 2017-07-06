<?php

class CRM_Membershipterms_BAO_MembershipTerms extends CRM_Membershipterms_DAO_MembershipTerms {

  /**
   * Membership terms ID
   *
   * @var array
   */
  private $membership_term_id = NULL;

  public set_membership_term_id($id) {
    $this->membership_term_id = $id;
  }

  public get_membership_term_id() {
    return $this->membership_term_id;
  }

  public clear_membership_term_id() {
    $this->membership_term_id = NULL;
  }

  /**
   * Create a new MembershipTerms based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Membershipterms_DAO_MembershipTerms|NULL
   *
  public static function create($params) {
    $className = 'CRM_Membershipterms_DAO_MembershipTerms';
    $entityName = 'MembershipTerms';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
