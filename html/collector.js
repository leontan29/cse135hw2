let static_data = {};
let perf_data = {};
let activity_data= {};

static_data['user-agent'] = window.navigator.userAgent;
static_data['language'] = window.navigator.language;
static_data['cookie-enabled'] = window.navigator.cookieEnabled;
static_data['screen-height'] = screen.height;
static_data['screen-width'] = screen.width;
static_data['window-height'] = window.innerHeight;
static_data['window-width'] = window.innerWidth;
static_data['network-type'] = navigator.connection.type;

// https://levelup.gitconnected.com/measuring-navigation-time-with-the-javascript-navigation-api-1bffa7eacc93
const perf_entries = performance.getEntriesByType('navigation');
{
    const [p] = perf_entries;
    perf_data['timing'] = p;
    perf_data['page-load-begin'] = p.loadEventStart;
    perf_data['page-load-end'] = p.loadEventEnd;
    perf_data['page-load-time'] =  perf_data['page-load-end'] - perf_data['page-load-start'];
}
    
console.log(JSON.stringify(static_data));
console.log(JSON.stringify(perf_data));
