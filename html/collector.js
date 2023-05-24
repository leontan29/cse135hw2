
// send a packet of data to endpoint
function send(data, endpoint) {
    var params = new URLSearchParams();
    params.append('page', window.location.pathname);
    
    for (var key in data) {
	params.append(key, data[key]);
    }

    navigator.sendBeacon(endpoint, params);
}

// send static and perf data such as user-agent, page load time, etc.
function sendStaticData() {
    var data = {
	// static
	user_agent: window.navigator.userAgent,
	language: window.navigator.language,
	cookie_enabled: window.navigator.cookieEnabled,
	screen_height: screen.height,
	screen_width: screen.width,
	window_height: window.innerHeight,
	window_width: window.innerWidth,
	network_type: navigator.connection.type,
    };
    send(data, '/api/static');
}
sendStaticData();


function sendPerfData() {
    // https://levelup.gitconnected.com/measuring-navigation-time-with-the-javascript-navigation-api-1bffa7eacc93
    const perf_entries = performance.getEntriesByType('navigation');
    const [p] = perf_entries;
    var data = {
	// perf
	timing: JSON.stringify(p),
	page_load_begin: p.loadEventStart,
	page_load_end: p.loadEventEnd,
	page_load_time: p.loadEventEnd - p.loadEventStart,
    };
    send(data, '/api/perf');
}
sendPerfData();


// activities are accumuted in activity_accum[]
let activity_accum = [
    // start with current page info
    ['enter_page_at', Date.now()],
];

// if the activity_accum[] is not empty, send content to
// to server, and empty it.
function sendActivityData(force) {
    if (!force && activity_accum.length < 10) {
	// avoid sending too frequently
	return;
    }
    
    let activities = activity_accum;
    activity_accum = [];

    if (!activities) {
	// nothing to send
	return;
    }

    var data = {};
    for (var item in activities) {
	const [typ, value] = item;
	data[typ] = value;
    }
    send(data, '/api/activity');
}

// keeps track of idle-time
var idle_time = 0;
function reset_idle_time() {
    if (idle_time > 2000) {
	// significant idle time
	activity_accum.push(['idle_time', idle_time]);
	activity_accum.push(['idle_time_ended_at', Date.now()]);
	idle_time = 0;
    }
}

document.addEventListener('mousemove', (e) => {
    reset_idle_time();
    activity_accum.push(['mouse_x', e.offsetX]);
    activity_accum.push(['mouse_y', e.offsetY]);
    sendActivityData(false);
});

document.addEventListener('click', (e) => {
    reset_idle_time();
    activity_accum.push(['click_x', e.offsetX]);
    activity_accum.push(['click_y', e.offsetY]);
    sendActivityData(false);
});

document.addEventListener('keydown', (e) => {
    reset_idle_time();
    activity_accum.push(['key', e.key]);
    sendActivityData(false);
});

document.addEventListener('scroll', (e) => {
    reset_idle_time();
    activity_accum.push(['scroll_y', window.scrollY]);
    sendActivityData(false);
});

// on page unload, send all accumulated activity data
document.addEventListener('unload', (e) => {
    reset_idle_time();
    activity_accum.push(['leave_page_at', Date.now()]);
    sendActivityData(true);
});

// check idle time every 100ms
setInterval(() => {
    idle_time += 100;
    sendActivityData(false);
}, 100);

