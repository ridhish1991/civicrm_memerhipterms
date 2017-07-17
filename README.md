# CiviCRM Membership Terms Extension

This simple [CiviCRM](http://civicrm.org) extension lets you record membership terms whenever it is created and renewed.

### Demo
[Click here to check live demo of this extension](http://139.59.65.109/demo/civicrm_membershipterms/)

### How it works?
* It will create civicrm_membership_terms database table when extension is installed
* Using hooks, it will take data from membership create and renew process and will record term information
* With use of hooks, it shows membership terms information in Membership view and contribution view
* Also API method is available to fetch membership terms

### Use of Hooks
* hook_civicrm_postProcess
** This hook is used to save memebership terms data when new membership is created or existing gets renewed
** It will also capture related contribution if payment was received

* hook_civicrm_buildForm
** This hook is used to show membership terms when membership is viewed in popup or as page
** This will also show membership term in contribution record viewing
** Here are refernce snapshots, showing how it membership terms will be displayed
