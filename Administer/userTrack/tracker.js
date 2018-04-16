/***
 Tracker, to be included on the pages where user movement must be monitored
***/

'use strict';

var UST = {
    DEBUG: false,
    settings: {
        isStatic: true,
        recordClick: true,
        recordMove: true,
        recordKeyboard: true,
        delay: 200,
        maxMoves: 400,
        serverPath: "//localhost/userTrack",
        percentangeRecorded: 100,
    }
};

UST.randomToken = function () {
    return Math.random().toString(36).substr(2) + Math.random().toString(36).substr(2);
};

UST.enableRecord = function() {
    localStorage.noRecord = 'false';
};

UST.disableRecord = function() {
    localStorage.noRecord = 'true';
};

UST.canRecord = function () {
    // If is mobile device
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        return false;
    }

    // If it is in iframe, don't record
    if (top !== self) {
        return false;
    }

    // If we don't want to be recorded
    if (localStorage.noRecord === 'true') {
        return false;
    }

    return true;
};

UST.testRequirements = function () {
    // Test that jQuery exists
    if(typeof jQuery === 'undefined')
        return "Did you include jQuery before tracker.js?";

    // Test that jQuery version is new enough
    // Don't break the script, just display an warning
    
    var versions = jQuery.fn.jquery.split('.');
    var oldEnough = versions[0] > 1 || (versions[1] >= 8 && versions[2] >= 1);
    if(!oldEnough)
        console.log("Your jQuery version seems to be old. userTrack requires at least jQuery 1.8.1");

    return 'ok';
}

UST.init = function () {

    UST.DEBUG && console.log(localStorage);

    // Make sure all client-side requirements for userTrack are fulfilled
    var errorStarting = UST.testRequirements();
    if(errorStarting !== 'ok') {
        console.log('userTrack tracker could not be started.', errorStarting)
        return;
    }

    if (!UST.canRecord()) {
        return;
    }

    // Get root url to website/ to server
    function getContextPath() {
        if (UST.settings.serverPath !== '') {
            return UST.settings.serverPath + '/';
        }

        return '/';
    }

    // Get domain name, without www.
    function getDomain() {
        // Always remove www. from the begining
        if (document.domain.indexOf('www.') === 0) {
            return document.domain.substr(4);
        }

        return document.domain;
    }

    // Auxiliary function to prepend '0' to get a 4 digit number
    function coord4(x) {
        x = x.toString();

        while (x.length < 4) {
            x = '0' + x;
        }

        return x;
    }

    // Auxiliary function to get a point from a string, space separated resolution
    function getCoord4(x) {
        var p = {};
        x = x.toString();
        p.x = x.substring(0, 4);
        p.y = x.substring(4);

        while (p.x[0] === '0') {
            p.x = p.x.substring(1);
        }

        while (p.y[0] === '0') {
            p.y = p.y.substring(1);
        }

        return p;
    }


    UST.sendData =  function(clientPageID) {

        // Send movements
        var toSend = [];
        for (var v in movements) {
            var obj = getCoord4(v);
            obj.count = movements[v];
            toSend.push(obj);
        }

        if (toSend.length > 3) {
            movements = {};
            jQuery.ajax({
                type: "POST",
                crossDomain: UST.settings.serverPath !== '',
                data: {
                    movements: JSON.stringify(toSend),
                    what: 'movements',
                    clientPageID: clientPageID
                },
                url: getContextPath() + 'addData.php',
                beforeSend: function (x) {
                    if (x && x.overrideMimeType) {
                        x.overrideMimeType("application/j-son;charset=UTF-8");
                    }
                },
                success: function (data) {
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });
        }

        // Send clicks
        toSend = [];
        for (v in clicks) {
            var obj = getCoord4(v);
            obj.count = clicks[v];
            toSend.push(obj);
        }
        clicks = {};

        if (toSend.length > 0) {
            jQuery.ajax({
                type: "POST",
                crossDomain: UST.settings.serverPath !== '',
                data: { 
                    movements: JSON.stringify(toSend),
                    what: 'clicks', 
                    clientPageID: clientPageID
                },
                url: getContextPath() + 'addData.php',
                beforeSend: function (x) {
                    if (x && x.overrideMimeType) {
                        x.overrideMimeType("application/j-son;charset=UTF-8");
                    }
                },
                success: function (data) {
                    localStorage.removeItem('clicks');
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });
        }

        // Send partial record stored in localStorage to server
        var cachedRecords = localStorage.getItem('record');

        if (cachedRecords !== null && cachedRecords !== undefined){
            if(cachedRecords.length > 30){
                jQuery.ajax({
                    type: "POST",
                    crossDomain: UST.settings.serverPath !== '',
                    data: {
                        record: cachedRecords,
                        what: 'partial',
                        clientPageID: clientPageID
                    },
                    url: getContextPath() + 'addData.php',
                    beforeSend: function (x) {
                        if (x && x.overrideMimeType) {
                            x.overrideMimeType("application/j-son;charset=UTF-8");
                        }
                    },
                    success: function (data) {
                    },
                    error: function (data) {
                        console.log(data.responseText);
                    }
                });
            }
        }
    };

    // Client token
    var lastTokenDate = localStorage.getItem('lastTokenDate');
    if (localStorage.getItem('token') === null || (new Date() - Date.parse(lastTokenDate) > 600000)) {
        localStorage.setItem('token', UST.randomToken());
    }

    var token = localStorage.getItem('token');
    localStorage.setItem('lastTokenDate', new Date());

    // Make sure tab is focused while recording
    var focused = true;
    jQuery(document).hover(function () { focused = true; },
                          function () { focused = false; });

    /*** Tracker ***/
    var lastDate = new Date();
    var scrollTimeout = null;
    var maxTimeout = 3000;
    var movements = {};
    var clicks = {};
    var record = [];

    // Last movement coordinates, relX -> static anchor
    var lastX, lastY, relX = 0;

    // Only record movements of SOME visitors
    var ignoreThreshold = 100 - UST.settings.percentangeRecorded;
    var mustRecord = Math.random() * 100 >= ignoreThreshold;

    var cachedClicks = localStorage.getItem('clicks');
    if (cachedClicks !== null && cachedClicks !== undefined) {
        clicks = JSON.parse(cachedClicks);
        UST.sendData(localStorage.getItem('clientPageID'));
    }

    // Send complete record stored in localStorage to server
    var cachedRecords = localStorage.getItem('record');
    localStorage.removeItem('record');

    if (cachedRecords !== null && cachedRecords !== undefined){
        if (cachedRecords.length > 50) {
            jQuery.ajax({
                type: "POST",
                data: {
                    record: cachedRecords,
                    what: 'record',
                    clientPageID: localStorage.getItem('clientPageID')
                },
                url: getContextPath() + 'addData.php',
                beforeSend: function (x) {
                    if (x && x.overrideMimeType) {
                        x.overrideMimeType("application/j-son;charset=UTF-8");
                    }
                },
                success: function () {},
                error: function (data) {
                    console.log(data.responseText);
                }
            });
        } else {
            // Too little data for a recording
            localStorage.removeItem('record');
        }
    }

    // Get clientPageID (based on token and current page info)
    var clientPageID;
    var clientID = localStorage.clientID;
    jQuery.ajax({
        type: "POST",
        crossDomain: UST.settings.serverPath !== '',
        dataType: "JSON",
        data: { 
            resolution: ((window.innerWidth || (document.documentElement.clientWidth + 17) ) + ' ' + (window.innerHeight || (document.documentElement.clientHeight) )),
            token: token, 
            url: window.location.pathname + window.location.search, 
            domain: getDomain(),
            clientID: clientID,
        },
        url: getContextPath() + 'tracker/createClient.php',
        beforeSend: function (x) {
            if (x && x.overrideMimeType) {
                x.overrideMimeType("application/j-son;charset=UTF-8");
            }
        },
        success: function (data) {
            UST.DEBUG && console.log(data);

            // Save current page session ID
            clientPageID = data.clientPageID;

            // Cache clientPageID for sending full recording on next page load
            localStorage.setItem('clientPageID', clientPageID);

            // Also cache client id
            localStorage.setItem('clientID', data.clientID);

            startSendingData();
        },
        error: function (data) {
            console.log(data.responseText);
        }
    });


    // Clear partial data
    jQuery.ajax({
        type: "POST",
        data: {
            clientPageID : localStorage.getItem('clientPageID')
        },
        crossDomain: UST.settings.serverPath !== '',
        url: getContextPath() + 'helpers/clearPartial.php',
        success: function () {
            UST.DEBUG && console.log('partials cleared');
        },
        error: function (data) {
            console.log("Could not clear partial!" + data.responseText);
        }
    });

    if (UST.settings.isStatic) {
        relX = parseInt(getContentDiv().offset().left);
    }

    // Record clicks
    jQuery(document).click(function (e) {
        if (!focused) {
            return;
        }

        if (UST.settings.recordClick) {
            var p = coord4(e.pageX - relX).toString() + coord4(e.pageY);
            
            if (clicks[p] === undefined) {
                clicks[p] = 0;
            }

            clicks[p]++;
        }
        
        if (mustRecord) {
            record.push({ t: 'c', x: e.pageX, y: e.pageY });
            localStorage.setItem('record', JSON.stringify(record));
            localStorage.setItem('url', window.location.pathname + window.location.search);
        }

        if (jQuery(e.target).closest('a').length) {
            localStorage.setItem('clicks', JSON.stringify(clicks));
            localStorage.setItem('url', window.location.pathname + window.location.search);
        }
    });

    // Record scroll
    jQuery(window).scroll(function () {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function () {
            record.push({ t: 's', x: jQuery(window).scrollLeft(), y: jQuery(window).scrollTop() });
            localStorage.setItem('record', JSON.stringify(record));
        }, 100);
    });

    // Record mouse movements
    jQuery(document).mousemove(function (e) {
        if (!focused)
            return;

        var curDate = new Date();
        var passed = curDate - lastDate;
        if (passed < UST.settings.delay)
            return;

        if (--UST.settings.maxMoves > 0 && passed < maxTimeout) {
            if (lastX !== undefined && UST.settings.recordMove) {
                var p = coord4(lastX).toString() + coord4(lastY);

                // Also filter some possible invalid movements
                if (!(lastX === 0 || lastY === 0)){
                    if (movements[p] === undefined)
                        movements[p] = 0;
                    movements[p] ++;
                }
            }

            if (mustRecord && !(lastX === 0 || lastY === 0)) {
                record.push({ t: 'm', x: e.pageX, y: e.pageY });
                localStorage.setItem('record', JSON.stringify(record));
            }
        }

        lastDate = curDate;
        lastX = e.pageX;
        lastY = e.pageY;
        if (UST.settings.isStatic) {
            lastX -= relX;
        }
    });

    /* Record keyboard input */
    if (UST.settings.recordKeyboard) {
        jQuery(document).on('blur', 'input, textarea', function () {

            //Don't record val change on password inputs or 
            //  elements with class 'noRecord'
            if (jQuery(this).hasClass('noRecord') || jQuery(this).attr('type') == 'password')
                return;

            // Add unique selector to the blured element
            var uniquePath = jQuery(this).getPath();
            record.push({ t: 'b', p: uniquePath, v: jQuery(this).val() });
            localStorage.setItem('record', JSON.stringify(record));
        });
    }

    /*!@TODO: CHANGE IN NEXT VERSION
    // Record select option change
    jQuery(document).on('change', 'select', function () {

        //Don't record val change on password inputs or 
        //  elements with class 'noRecord'
        if (jQuery(this).hasClass('noRecord') || jQuery(this).attr('type') == 'password')
            return;

        var uniquePath = jQuery(this).getPath();
        record.push({ t: 'b', p: uniquePath, v: jQuery(this).val() });
        localStorage.setItem('record', JSON.stringify(record));
    });*/

    // Start sending data after clientPageID is received
    function startSendingData () {
        // Send data to server once in a while, exponential
        setTimeout(function () { recurseSend(1000); }, 100);
    }

    function recurseSend(t) {
        UST.DEBUG && console.log("Sending data for clientPageID: ", clientPageID);
        
        if (t < 15000)
            t += 800;

        UST.sendData(clientPageID);
        setTimeout(function () { recurseSend(t); }, t);
    }

    // Get unqiue path to div
    jQuery.fn.getPath = function () {
        if (this.length != 1) throw 'Requires one element.';
        var path, node = this;
        if (node[0].id) return "#" + node[0].id;
        while (node.length) {
            var realNode = node[0],
                name = realNode.localName;
            if (!name) break;
            name = name.toLowerCase();
            var parent = node.parent();
            var siblings = parent.children(name);
            if (siblings.length > 1) {
                name += ':eq(' + siblings.index(realNode) + ')';
            }
            path = name + (path ? '>' + path : '');
            node = parent;
        }
        return path;
    };
};


jQuery(function () {
    UST.init();
});

/**
 * Playback Functions
 *
 * Used if frame is insider userTrack admin panel
 */
if (top !== self) {

    var elementUnder = null, lastElement = null;
    var lastEvent = null;

    // Allow cross-domain interactions using HTML5 postMessage
    var receiver = function (event) {

        // Don't filter requests by domain, no security problems
        if (event.origin == UST.settings.serverPath || true) {
            // Check if JSON
            if (event.data[0] == '!' || event.data[0] > 'A' && event.data[0] < 'z')
                return;

            var data = JSON.parse(event.data);

            if (data.task !== undefined)
                lastEvent = event;

            switch (data.task) {
                // Allow hover events to be triggered, alter stylesheet
                case 'CSS':
                    for (var i = 0; ; ++i) {
                        var classes = document.styleSheets[i];
                        if (classes === undefined || classes === null)
                            break;
                        classes = classes.rules;

                        if (classes === undefined || classes === null)
                            continue;

                        for (var x = 0; x < classes.length; x++) {
                            var ss = "";
                            if (classes[x].selectorText !== undefined) {
                                classes[x].selectorText = classes[x].selectorText.replace(':hover', '.hover');
                            }
                        }
                    }
                    break;

                    // Set element under
                case 'EL':
                    elementUnder = document.elementFromPoint(data.x, data.y);

                    break;

                    // Trigger hover
                case 'HOV':
                    iframeHover();
                    break;

                    // Trigger click
                case 'CLK':
                    iframeRealClick();
                    break;
                    // Update input value
                case 'VAL':
                    jQuery(data.sel).trigger('focus').val(data.val);
                    break;
                    // Return iframe size
                case 'SZ':
                    event.source.postMessage(JSON.stringify({
                        task: 'SZ',
                        w: document.body.clientWidth,
                        h: document.body.clientHeight
                    }), event.origin);
                    break;
                    // Return iframe path
                case 'PTH':
                    event.source.postMessage(JSON.stringify({ task: 'PTH', p: location.pathname }), event.origin);
                    break;
                    // Scroll iframe
                case 'SCR':
                    jQuery(document).scrollTop(data.top);
                    jQuery(document).scrollLeft(data.left);
                    break;
                    // X position of first div
                case 'STATIC':
                    event.source.postMessage(JSON.stringify({ task: 'STATIC', X: getContentDiv().offset().left }), event.origin);
                    break;

                    // Append the html2canvas library
                case 'addHtml2canvas':
                    if(typeof window.html2canvasAdded === "undefined") {
                        window.html2canvasAdded = true;
                        var s = document.createElement("script");
                        s.type = "text/javascript";
                        document.body.appendChild(s);
                        s.onload = function () {
                            event.source.postMessage(JSON.stringify({ task: 'html2canvasAdded'}), event.origin);
                        };
                        s.src = UST.settings.serverPath + '/lib/html2canvas/html2canvas.js';
                    } else {
                        // The script is already added
                        event.source.postMessage(JSON.stringify({ task: 'html2canvasAdded'}), event.origin);
                    }
                break;

                    // Return a screenshot of the site
                case 'screenshot':
                    html2canvas(document.body, {
                        logging: false,
                        useCORS: false,
                        proxy: UST.settings.serverPath + '/lib/html2canvas/proxy.php',
                    }).then(function(canvas) {
                        var img = new Image();
                        img.onload = function() {
                            img.onload = null;
                            event.source.postMessage(JSON.stringify({ task: 'screenshot', img: img.src }), event.origin);
                        };
                        img.onerror = function() {
                            img.onerror = null;
                            window.console.log("Not loaded image from canvas.toDataURL");

                        };
                        img.src = canvas.toDataURL("image/png");
                    });
                break;

            }
        }
    };

    // Send scroll event back to panel
    //iframe is scrolled
    jQuery(document).scroll(function () {
        var t = jQuery(this).scrollTop();
        var l = jQuery(this).scrollLeft();
        if (lastEvent !== null) {
            lastEvent.source.postMessage(JSON.stringify({ task: 'SCROLL', top: t, left: l }), lastEvent.origin);
        } else {
            console.log("Scroll event happened before parent call to iframe");
        }
    });

    // Triger click
    var iframeRealClick = function () {
        if (elementUnder !== null) {
            if (elementUnder.nodeName == 'SELECT') {
                jQuery(elementUnder).get(0).setAttribute('size', elementUnder.options.length);
            } else {
                var link = jQuery(elementUnder).parents('a').eq(0);
                if (link !== undefined) {
                    link = link.attr('href');
                    if (link !== undefined && (link.indexOf('//') != -1 || link.indexOf('www.') != -1) && link.indexOf(window.location.host) == -1)
                        link = 'external';
                }
                if (link != 'external') {
                    fireEvent(elementUnder, 'click');
                } else {
                    alert('User has left the website');
                }
            }
        }

        if (lastElement !== null && lastElement.nodeName == 'SELECT')
            jQuery(lastElement).get(0).setAttribute('size', 1);
        lastElement = elementUnder;

    };

    // Trigger hover event
    var lastHover = null;
    var lastParents = null;
    var iframeHover = function () {
        if (lastHover != elementUnder) {
            var parents = jQuery(elementUnder).parents().addBack();

            if (lastParents !== null) {
                lastParents.removeClass("hover");
                lastParents.trigger("mouseout");
            }

            parents.addClass("hover");
            parents.trigger("mouseover");

            lastParents = parents;
        } else {
            return 1;
        }

        // No element is currently hovered
        lastHover = elementUnder;
        return 0;
    };

    // Function used to trigger click event
    var fireEvent = function (element, event) {
        var evt;
        if (document.createEvent) {
            // Dispatch for firefox + others
            evt = document.createEvent("HTMLEvents");
            evt.initEvent(event, true, true); // event type,bubbling,cancelable
            return !element.dispatchEvent(evt);
        } else {
            // Dispatch for IE
            evt = document.createEventObject();
            return element.fireEvent('on' + event, evt);
        }
    };

    window.addEventListener('message', receiver, false);
}

// Helper function for static-width websites
function getContentDiv() {

    var mostProbable = jQuery('body');
    var maxP = 0;
    var documentWidth = jQuery(document).width();
    var documentHeight = jQuery(document).height();

    jQuery('div').each(function () {

        var probability = 0;
        var t = jQuery(this);

        if (t.css('position') == 'static' || t.css('position') == 'relative')
            probability += 2;

        if (t.height() > documentHeight / 2)
            probability += 3;

        if (t.parent().is('body'))
            probability++;

        if (t.css('marginLeft') == t.css('marginRight'))
            probability++;

        if (t.attr('id') == 'content')
            probability += 2;

        if (t.attr('id') == 'container')
            probability++;

        if (t.width() != documentWidth)
            probability += 2;

        if (probability > maxP) {
            maxP = probability;
            mostProbable = t;
        }

    });
    return mostProbable;
}
