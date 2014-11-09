<wacms:include header.tpl />
				<div class="mpBox">
					<h2 class="template">{event_title}</h2>
					<wacms:start event><div class="event_datetime" style="margin: 0.7em 1em"><div class="month"><wacms:include monthconvert.tpl /></div><div class="day">{day}</div><div class="time">{hour}<span style="text-decoration: blink">:</span>{minute}</div></div></wacms:end event>
					<div class="mpBox_body eighty">
						<p>{event_description}</p>
					</div>
				</div>
<wacms:include footer.tpl />