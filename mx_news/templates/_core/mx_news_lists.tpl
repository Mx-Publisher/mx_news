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
			<td class="row1">
				<span class="discreet">[{use_comments.text.TIME}]</span>
				<br><span class="cattitle">{use_comments.text.TITLE}</span>
				<p><span class="genmed">{use_comments.text.TEXT}</span>

				<!-- BEGIN more -->
				<p><a href="{use_comments.text.more.U_COMMENT_MORE}">[{use_comments.text.more.L_COMMENT_MORE}]</a>
				<!-- END more -->
			</td>
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

<!-- END use_comments -->
