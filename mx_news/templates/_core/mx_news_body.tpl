<!-- BEGIN use_comments -->
<table width="100%" cellpadding="5" cellspacing="0" class="forumline" style="border-top:none;">
	<!--
  	<tr>
		<th class="thCornerL" colspan="2">{use_comments.L_COMMENTS}</th>
  	</tr>
  	-->
	<!-- BEGIN no_comments -->
  	<tr>
		<td colspan="2" class="row1" align="center"><span class="genmed">{use_comments.no_comments.L_NO_COMMENTS}</span></td>
  	</tr>
	<!-- END no_comments -->

	<!-- BEGIN text -->
		<tr>
			<td class="row1"><span class="discreet">[{use_comments.text.TIME}]</span> &nbsp;<span class="cattitle">{use_comments.text.TITLE}</span></td>
			<td class="row1" align="right">
			<!-- BEGIN auth_edit -->
			{use_comments.text.auth_edit.B_EDIT_IMG}
			<!-- <a href="{use_comments.text.auth_edit.U_COMMENT_EDIT}">[{use_comments.text.auth_edit.L_COMMENT_EDIT}]</a>-->
			<!-- END auth_edit -->
			<!-- BEGIN auth_delete -->
			{use_comments.text.auth_delete.B_DELETE_IMG}
			<!-- <a href="{use_comments.text.auth_delete.U_COMMENT_DELETE}">[{use_comments.text.auth_delete.L_COMMENT_DELETE}]</a>-->
			<!-- END auth_delete -->
			</td>
		</tr>
		<tr>
			<td class="row1" colspan="2" valign="top"><span class="genmed">{use_comments.text.TEXT}</span> </td>
		</tr>
	<!-- END text -->
</table>

<!-- BEGIN comments_pag -->
<br />
<table width="100%" cellspacing="1" cellpadding="0" border="0">
  <tr>
	<td><span class="nav"><!--{use_comments.comments_pag.PAGE_NUMBER}--></span></td>
	<td align="right"><span class="nav">{use_comments.comments_pag.PAGINATION}</span></td>
  </tr>
</table>
<!-- END comments_pag -->

<!-- BEGIN auth_post -->
<br />
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  	<tr>
		<td>{use_comments.auth_post.B_REPLY_IMG}</td>
  	</tr>
</table>
<br clear="all" />
<!-- END auth_post -->
<!-- END use_comments -->