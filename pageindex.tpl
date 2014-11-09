<wacms:include header.tpl />
<wacms:if pages>				<div class="mpBox">
					<style type="text/css">
					.page_table td {
						border-top: solid #aaa 1px;:
					}
					</style>
					<table class="page_table" cellspacing="0">
						<tr style="background: url('{cms_dir}images/box-head-gradient.gif') 100%">
							<th>|ID:</th>
							<th>Title:</th>
							<th>URL:</th>
							<th>Lead-In:</th>
							<th>Modified:</th>
						</tr>
<wacms:start pages>						<tr>
							<td>{page_id}</td>
							<td><a href="{cms_dir}{page_url}">{page_title}</a></td>
							<td>{page_url}</td>
							<td>{page_lead_in}</td>
							<td>{modified}</td>
						</tr>
</wacms:end pages>					</table>
				</div>
</wacms:if pages><wacms:include footer.tpl />