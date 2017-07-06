{* template block that contains membership term *}
<table id="contribution_view_mem_term">
  <tr>
    <td class="label">{ts}Membership Term{/ts}</td>
    <td>{$membership_term.start_date|crmDate} - {$membership_term.end_date|crmDate}</td>
  </tr>
</table>
{* reposition the membership terms block *}
<script type="text/javascript">
  //cj('#contribution_view_mem_term-tr').appendTo('form#ContributionView .crm-info-panel')
  cj('form#ContributionView .crm-info-panel').first().append(cj('#contribution_view_mem_term tr'));
  cj('#contribution_view_mem_term').remove();
</script>