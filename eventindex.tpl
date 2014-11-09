<wacms:include header.tpl />

<wacms:if events>			<div class="mpBox">
				<h2 class="template"><a href="/event/">Latest event</a></h2>
				<div class="mpBox_body">
<wacms:start events>					<div class="event_item">
						
						<span class="event_title"><wacms:if event_id><a href="/events/?id={event_id}">{event_title}</a></wacms:if event_id><wacms:if NOT event_id>{event_title}</wacms:if NOT event_id></span><span class="event_date"> - {day}<wacms:include dayuru.tpl /> <wacms:include monthconvert.tpl /> {year} @ {hour}:{minute}</span>
<wacms:if event_lead_in>						<div class="event_lead_in">{event_lead_in}</div>
</wacms:if event_lead_in><wacms:if event_id>						<div class="event_more"><a href="/events/?id={event_id}">more...</a></div>
</wacms:if event_id>					</div>
</wacms:end events>				</div>
			</div>
</wacms:if events>
<wacms:include footer.tpl />