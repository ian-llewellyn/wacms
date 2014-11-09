<wacms:include header.tpl />
<wacms:if news>			<div class="mpBox">
				<h2 class="template">Latest News</h2>
				<div class="mpBox_body">
<wacms:start news>					<div class="news_item">
						<div class="news_date">{day}<wacms:include dayuru.tpl /> <wacms:include monthconvert.tpl /> {year}</div>
						<div class="news_headline"><wacms:if news_id><a href="/news/?id={news_id}">{news_headline}</a></wacms:if news_id><wacms:if NOT news_id>{news_headline}</wacms:if NOT news_id></div>
<wacms:if news_lead_in>						<div class="news_lead_in">{news_lead_in}</div>
</wacms:if news_lead_in><wacms:if news_id>						<div class="news_more"><a href="/news/?id={news_id}">more...</a></div>
</wacms:if news_id>					</div>
</wacms:end news>				</div>
			</div>
</wacms:if news>

<wacms:include footer.tpl />