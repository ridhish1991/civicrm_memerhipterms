{* template block that contains membership terms *}
<div id="membership_view_membership_terms">
  <div class="crm-accordion-wrapper">
        <div class="crm-accordion-header">{ts}Membership Terms/Periods{/ts}</div>
        <div class="crm-accordion-body">
          <table class="crm-info-panel">
            <thead>
              <tr>
                <th class="bold">{ts}Term{/ts}</th>
                <th class="bold">{ts}Contribution{/ts}</th>
              </tr>
            </thead>
            <tbody>
		{if !$membership_terms}
		<tr><td colspan=2>No terms</td></tr>
		{/if}
              {foreach from=$membership_terms item=_term}
              <tr>
                <td>{$_term.start_date|crmDate} - {$_term.end_date|crmDate}</td>
                <td class="label bold">
                  {if $_term.contribution_id}
                    <a href="{crmURL p='civicrm/contact/view/contribution' q="reset=1&id=`$_term.contribution_id`&action=view"}" title="{ts}View Contribution{/ts}" class="action-item crm-hover-button">
                      View
                    </a>
                  {/if}
                </td>
              </tr>
              {/foreach}

            </tbody>
        </div>
  </div>
</div>
{* reposition the membership terms block *}
<script type="text/javascript">
  cj('#membership_view_membership_terms').insertAfter('form#MembershipView .crm-info-panel')
</script>
