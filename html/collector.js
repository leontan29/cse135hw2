function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
	let c = ca[i];
	while (c.charAt(0) == ' ') {
	    c = c.substring(1);
	}
	if (c.indexOf(name) == 0) {
	    return c.substring(name.length, c.length);
	}
    }
    return "";
}

function setCookie(name, value, days) {
  var expirationDate = new Date();
  expirationDate.setDate(expirationDate.getDate() + days);

  var cookieValue = encodeURIComponent(value) + '; expires=' + expirationDate.toUTCString() + '; path=/';
  document.cookie = name + '=' + cookieValue;
}

function generateRandomString(length) {
  var charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var randomString = '';

  if (window.crypto && window.crypto.getRandomValues) {
    var values = new Uint32Array(length);
    window.crypto.getRandomValues(values);
    for (var i = 0; i < length; i++) {
      randomString += charset[values[i] % charset.length];
    }
  } else {
    for (var i = 0; i < length; i++) {
      randomString += charset.charAt(Math.floor(Math.random() * charset.length));
    }
  }

  return randomString;
}


const TRACKERNAME = 'cse135tracker';
let tracker = getCookie(TRACKERNAME);
if (!tracker) {
    tracker = '' + Date().getTime() + ':' + generateRandomString(10);
    setCookie(TRACKERNAME, tracker, 1);
}


// send a packet of data to endpoint
function send(data, endpoint) {
    // always include the tracker and the page path
    data['tracker'] = tracker;
    data['page'] = window.location.pathname;
    json = JSON.stringify(data);
    var params = new URLSearchParams();
    params.append("json", json);
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
	network_type: navigator.connection.effectiveType,
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
    if (!force && activity_accum.length < 50) {
	// avoid sending too frequently
	return;
    }

    // take out all activities in the accum
    let activities = activity_accum;
    activity_accum = [];

    if (!activities) {
	// nothing to send
	return;
    }

    // make a data msg
    var data = {};
    for (var item in activities) {
	const [typ, value] = item;
	data[typ] = value;
    }
    // send it
    send(data, '/api/activity');
}

// ----------------------------------------
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

// check idle time every 100ms
setInterval(() => {
    idle_time += 100;
    // force send every 5 second
    force = (idle_time % 5000 == 0);
    sendActivityData(force);
}, 100);


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

// ------------------------------
// collect errors
window.onerror = (msg, src, line, col, error) => {
    let str = `${msg} (${src}:${line})`;
    activity_accum.push(['error', str]);
    sendActivityData(false);
}


// ------------------------------
// user done with page: send all accumulated activity data
document.addEventListener('visibilitychange', () => {
    if (document.visibilityState == 'hidden') {
	reset_idle_time();
	sendActivityData(true);
    }
});

document.addEventListener('unload', (e) => {
    activity_accum.push(['leave_page_at', Date.now()]);
    sendActivityData(true);
});

