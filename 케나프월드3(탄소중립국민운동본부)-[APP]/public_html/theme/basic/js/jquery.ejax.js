
(function($){
	function ejax(options) {

		options = $.extend(true, {}, $.ajaxSettings, ejax.defaults, options)

		if ($.isFunction(options.url)) {
			options.url = options.url()
		}
		
		var hash = parseURL(options.url).hash
		

		var containerType = $.type(options.container)
		if (containerType !== 'string') {
			throw "expected string value for 'container' option; got " + containerType
		}

		var context = options.context = $(options.container)
		if (!context.length) {
			throw "the container selector '" + options.container + "' did not match anything"
		}

		if (!options.data) options.data = {}
		if ($.isArray(options.data)) {
			options.data.push({name: '_ejax', value: options.container})
		} else {
			options.data._ejax = options.container
		}

		function fire(type, args, props) {
			if (!props) props = {}
			props.relatedTarget = options.target
			var event = $.Event(type, props)
			context.trigger(event, args)
			return !event.isDefaultPrevented()
		}

		var timeoutTimer

		options.beforeSend = function(xhr, settings) {
			// No timeout for non-GET requests
			// Its not safe to request the resource again with a fallback method.
			/*
			if (settings.type !== 'GET') {
				settings.timeout = 0
			}
			*/
			
			xhr.setRequestHeader('X-EJAX', 'true')
			xhr.setRequestHeader('X-EJAX-Container', options.container)

			if (!fire('e:beforeSend', [xhr, settings]))
				return false

			if (settings.timeout > 0) {
				timeoutTimer = setTimeout(function() {
				if (fire('e:timeout', [xhr, options]))
					xhr.abort('timeout')
				}, settings.timeout)

				// Clear timeout setting so jquerys internal timeout isn't invoked
				settings.timeout = 0
			}

			var url = parseURL(document.location.href)
			if (hash) url.hash = hash
			options.requestUrl = stripInternalParams(url)
		}

		options.complete = function(xhr, textStatus) {
			if (timeoutTimer)
			clearTimeout(timeoutTimer)

			// visibled add
			if (xhr.readyState == 4 && options.visibled){
				// yy 전용
				if(options.backyard){
					var w_h = ($(window).scrollTop() * -1) + 70 + "px";
					$(options.backyard).css("position", "fixed").css("top", w_h);
				}

				setTimeout(function (){
					$(options.container).addClass(options.visibled);
				}, 100);
			}

			fire('e:complete', [xhr, textStatus, options])

			fire('e:end', [xhr, options])
		}

		options.error = function(xhr, textStatus, errorThrown) {
			var container = extractContainer("", xhr, options)

			var allowed = fire('e:error', [xhr, textStatus, errorThrown, options])
			if (options.type == 'GET' && textStatus !== 'abort' && allowed) {
				locationReplace(container.url, options)
			}
		}

		options.success = function(data, status, xhr) {
			var previousState = ejax.state

			// If $.ejax.defaults.version is a function, invoke it first.
			// Otherwise it can be a static string.
			var currentVersion = typeof $.ejax.defaults.version === 'function' ?
			$.ejax.defaults.version() :
			$.ejax.defaults.version

			var latestVersion = xhr.getResponseHeader('X-EJAX-Version')

			var container = extractContainer(data, xhr, options)

			var url = parseURL(container.url)
			if (hash) {
				url.hash = hash
				container.url = url.href
			}

			// If there is a layout version mismatch, hard load the new url
			if (currentVersion && latestVersion && currentVersion !== latestVersion) {
				locationReplace(container.url, options)
				return
			}

			// If the new response is missing a body, hard load the page
			if (!container.contents) {
				locationReplace(container.url, options)
				return
			}

			ejax.state = {
				id: options.id || uniqueId(),
				url: container.url,
				title: container.title,
				container: options.container,
				fragment: options.fragment,
				timeout: options.timeout
			}

			if (options.push || options.replace) {
				window.history.replaceState(ejax.state, container.title, container.url)
			}

			// Only blur the focus if the focused element is within the container.
			var blurFocus = $.contains(context, document.activeElement)

			// Clear out any focused controls before inserting new page contents.
			if (blurFocus) {
				try {
					document.activeElement.blur()
				} catch (e) { /* ignore */ }
			}

			if (container.title) document.title = container.title

			fire('e:beforeReplace', [container.contents, options], {
				state: ejax.state,
				previousState: previousState
			})
			
			if(options.inner)
				context.html(container.contents)

			// FF bug: Won't autofocus fields that are inserted via JS.
			// This behavior is incorrect. So if theres no current focus, autofocus
			// the last field.
			//
			// http://www.w3.org/html/wg/drafts/html/master/forms.html
			var autofocusEl = context.find('input[autofocus], textarea[autofocus]').last()[0]
			if (autofocusEl && document.activeElement !== autofocusEl) {
				autofocusEl.focus()
			}

			executeScriptTags(container.scripts)

			var scrollTo = options.scrollTo

			// Ensure browser scrolls to the element referenced by the URL anchor
			if (hash) {
				var name = decodeURIComponent(hash.slice(1))
				var target = document.getElementById(name) || document.getElementsByName(name)[0]
				if (target) scrollTo = $(target).offset().top
			}

			if (typeof scrollTo == 'number') $(window).scrollTop(scrollTo)

			fire('e:success', [data, status, xhr, options])
		}


		// Initialize ejax.state for the initial page load. Assume we're
		// using the container and options of the link we're loading for the
		// back button to the initial page. This ensures good back button
		// behavior.
		if (!ejax.state) {
			ejax.state = {
				id: uniqueId(),
				url: window.location.href,
				title: document.title,
				container: options.container,
				fragment: options.fragment,
				timeout: options.timeout
			}
			window.history.replaceState(ejax.state, document.title)
		}

		// Cancel the current request if we're already ejaxing
		abortXHR(ejax.xhr)

		ejax.options = options
		var xhr = ejax.xhr = $.ajax(options)

		if (xhr.readyState > 0) {
			if (options.push && !options.replace) {
				// Cache current container element before replacing it
				cachePush(ejax.state.id, [options.container, cloneContents(context)])

				window.history.pushState(null, "", options.requestUrl)
			}

			fire('e:start', [xhr, options])
			fire('e:send', [xhr, options])
		}

		return ejax.xhr
	}

	// Internal: Hard replace current state with url.
	//
	// Work for around WebKit
	//   https://bugs.webkit.org/show_bug.cgi?id=93506
	//
	// Returns nothing.
	function locationReplace(url, options) {
		window.history.replaceState(null, "", ejax.state.url)
		window.location.replace(url)
	}

	var initialPop = true
	var initialURL = window.location.href
	var initialState = window.history.state

	// Initialize $.ejax.state if possible
	// Happens when reloading a page and coming forward from a different
	// session history.
	if (initialState && initialState.container) {
		ejax.state = initialState
	}

	// Non-webkit browsers don't fire an initial popstate event
	if ('state' in window.history) {
		initialPop = false
	}

	// popstate handler takes care of the back and forward buttons
	//
	// You probably shouldn't use ejax on pages with other pushState
	// stuff yet.
	function onejaxPopstate(event) {

		// Hitting back or forward should override any pending ejax request.
		if (!initialPop) {
			abortXHR(ejax.xhr)
		}

		var previousState = ejax.state
		var state = event.state
		var direction
		if (state && state.container) {
			// When coming forward from a separate history session, will get an
			// initial pop with a state we are already at. Skip reloading the current
			// page.
			if (initialPop && initialURL == state.url) return

			if (previousState) {
				// If popping back to the same state, just skip.
				// Could be clicking back from hashchange rather than a pushState.
				if (previousState.id === state.id) return

				// Since state IDs always increase, we can deduce the navigation direction
				direction = previousState.id < state.id ? 'forward' : 'back'
			}

			var cache = cacheMapping[state.id] || []
			var containerSelector = cache[0] || state.container
			var container = $(containerSelector), contents = cache[1]

			if (container.length) {
				if (previousState) {
					// Cache current container before replacement and inform the
					// cache which direction the history shifted.
					cachePop(direction, previousState.id, [containerSelector, cloneContents(container)])
				}

				var popstateEvent = $.Event('e:popstate', {
					state: state,
					direction: direction
				})
				container.trigger(popstateEvent)

				var options = {
					id: state.id,
					url: state.url,
					container: containerSelector,
					push: false,
					fragment: state.fragment,
					timeout: state.timeout,
					scrollTo: false
				}

				if (contents) {
					container.trigger('e:start', [null, options])

					ejax.state = state
					if (state.title) document.title = state.title
					var beforeReplaceEvent = $.Event('e:beforeReplace', {
						state: state,
						previousState: previousState
					})
					container.trigger(beforeReplaceEvent, [contents, options])
					
					if(options.inner)
						container.html(contents)
								
					// visibled add
					if($(container.selector).hasClass(ejax.options.visibled)){
						// yy전용
						if(ejax.options.backyard)
							$(ejax.options.backyard).css("position", "relative").css("top", "");
						$(container.selector).removeClass(ejax.options.visibled);
					}
					
					container.trigger('e:end', [null, options])
				} else {
					ejax(options)
				}

				// Force reflow/relayout before the browser tries to restore the
				// scroll position.
				container[0].offsetHeight // eslint-disable-line no-unused-expressions
			} else {
				locationReplace(location.href, options)
			}
		}
		initialPop = false
	}

	// Internal: Abort an XmlHttpRequest if it hasn't been completed,
	// also removing its event handlers.
	function abortXHR(xhr) {
		if ( xhr && xhr.readyState < 4) {
			xhr.onreadystatechange = $.noop
			xhr.abort()
		}
	}

	// Internal: Generate unique id for state object.
	//
	// Use a timestamp instead of a counter since ids should still be
	// unique across page loads.
	//
	// Returns Number.
	function uniqueId() {
		return (new Date).getTime()
	}

	function cloneContents(container) {
		var cloned = container.clone()
		// Unmark script tags as already being eval'd so they can get executed again
		// when restored from cache. HAXX: Uses jQuery internal method.
		cloned.find('script').each(function(){
			if (!this.src) $._data(this, 'globalEval', false)
		})
		return cloned.contents()
	}

	// Internal: Strip internal query params from parsed URL.
	//
	// Returns sanitized url.href String.
	function stripInternalParams(url) {
		url.search = url.search.replace(/([?&])(_ejax|_)=[^&]*/g, '').replace(/^&/, '')
		return url.href.replace(/\?($|#)/, '$1')
	}

	// Internal: Parse URL components and returns a Locationish object.
	//
	// url - String URL
	//
	// Returns HTMLAnchorElement that acts like Location.
	function parseURL(url) {
		var a = document.createElement('a')
		a.href = url
		return a
	}

	// Internal: Return the `href` component of given URL object with the hash
	// portion removed.
	//
	// location - Location or HTMLAnchorElement
	//
	// Returns String
	function stripHash(location) {
		return location.href.replace(/#.*/, '')
	}

	// Internal: Build options Object for arguments.
	//
	// For convenience the first parameter can be either the container or
	// the options object.
	//
	// Examples
	//
	//   optionsFor('#container')
	//   // => {container: '#container'}
	//
	//   optionsFor('#container', {push: true})
	//   // => {container: '#container', push: true}
	//
	//   optionsFor({container: '#container', push: true})
	//   // => {container: '#container', push: true}
	//
	// Returns options Object.
	function optionsFor(container, options) {
		if (container && options) {
			options = $.extend({}, options)
			options.container = container
			return options
		} else if ($.isPlainObject(container)) {
			return container
		} else {
			return {container: container}
		}
	}

	// Internal: Filter and find all elements matching the selector.
	//
	// Where $.fn.find only matches descendants, findAll will test all the
	// top level elements in the jQuery object as well.
	//
	// elems    - jQuery object of Elements
	// selector - String selector to match
	//
	// Returns a jQuery object.
	function findAll(elems, selector) {
		return elems.filter(selector).add(elems.find(selector))
	}

	function parseHTML(html) {
		return $.parseHTML(html, document, true)
	}

	// Internal: Extracts container and metadata from response.
	//
	// 1. Extracts X-EJAX-URL header if set
	// 2. Extracts inline <title> tags
	// 3. Builds response Element and extracts fragment if set
	//
	// data    - String response data
	// xhr     - XHR response
	// options - ejax options Object
	//
	// Returns an Object with url, title, and contents keys.
	function extractContainer(data, xhr, options) {
		var obj = {}, fullDocument = /<html/i.test(data)

		// Prefer X-EJAX-URL header if it was set, otherwise fallback to
		// using the original requested url.
		var serverUrl = xhr.getResponseHeader('X-EJAX-URL')
		obj.url = serverUrl ? stripInternalParams(parseURL(serverUrl)) : options.requestUrl

		var $head, $body
		// Attempt to parse response html into elements
		if (fullDocument) {
			$body = $(parseHTML(data.match(/<body[^>]*>([\s\S.]*)<\/body>/i)[0]))
			var head = data.match(/<head[^>]*>([\s\S.]*)<\/head>/i)
			$head = head != null ? $(parseHTML(head[0])) : $body
		} else {
			$head = $body = $(parseHTML(data))
		}

		// If response data is empty, return fast
		if ($body.length === 0)
			return obj

		// If there's a <title> tag in the header, use it as
		// the page's title.
		obj.title = findAll($head, 'title').last().text()

		if (options.fragment) {
			var $fragment = $body
			// If they specified a fragment, look for it in the response
			// and pull it out.
			if (options.fragment !== 'body') {
				$fragment = findAll($fragment, options.fragment).first()
			}

			if ($fragment.length) {
				obj.contents = options.fragment === 'body' ? $fragment : $fragment.contents()

				// If there's no title, look for data-title and title attributes
				// on the fragment
				if (!obj.title)
					obj.title = $fragment.attr('title') || $fragment.data('title')
			}

		} else if (!fullDocument) {
			obj.contents = $body
		}

		// Clean up any <title> tags
		if (obj.contents) {
			// Remove any parent title elements
			obj.contents = obj.contents.not(function() { return $(this).is('title') })

			// Then scrub any titles from their descendants
			obj.contents.find('title').remove()

			// Gather all script[src] elements
			obj.scripts = findAll(obj.contents, 'script[src]').remove()
			obj.contents = obj.contents.not(obj.scripts)
		}

		// Trim any whitespace off the title
		if (obj.title) obj.title = $.trim(obj.title)

		return obj
	}

	// Load an execute scripts using standard script request.
	//
	// Avoids jQuery's traditional $.getScript which does a XHR request and
	// globalEval.
	//
	// scripts - jQuery object of script Elements
	//
	// Returns nothing.
	function executeScriptTags(scripts) {
	if (!scripts) return

		var existingScripts = $('script[src]')

		scripts.each(function() {
			var src = this.src
			var matchedScripts = existingScripts.filter(function() {
				return this.src === src
			})
			if (matchedScripts.length) return

			var script = document.createElement('script')
			var type = $(this).attr('type')
			if (type) script.type = type
			script.src = $(this).attr('src')
			document.head.appendChild(script)
		})
	}

	// Internal: History DOM caching class.
	var cacheMapping      = {}
	var cacheForwardStack = []
	var cacheBackStack    = []

	// Push previous state id and container contents into the history
	// cache. Should be called in conjunction with `pushState` to save the
	// previous container contents.
	//
	// id    - State ID Number
	// value - DOM Element to cache
	//
	// Returns nothing.
	function cachePush(id, value) {
		cacheMapping[id] = value
		cacheBackStack.push(id)

		// Remove all entries in forward history stack after pushing a new page.
		trimCacheStack(cacheForwardStack, 0)

		// Trim back history stack to max cache length.
		trimCacheStack(cacheBackStack, ejax.defaults.maxCacheLength)
	}

	// Shifts cache from directional history cache. Should be
	// called on `popstate` with the previous state id and container
	// contents.
	//
	// direction - "forward" or "back" String
	// id        - State ID Number
	// value     - DOM Element to cache
	//
	// Returns nothing.

	function cachePop(direction, id, value) {

		var pushStack, popStack
		cacheMapping[id] = value

		if (direction === 'forward') {
			pushStack = cacheBackStack
			popStack  = cacheForwardStack
		} else {
			pushStack = cacheForwardStack
			popStack  = cacheBackStack
		}

		pushStack.push(id)
		id = popStack.pop()
		if (id) delete cacheMapping[id]

		// Trim whichever stack we just pushed to to max cache length.
		trimCacheStack(pushStack, ejax.defaults.maxCacheLength)
	}

	// Trim a cache stack (either cacheBackStack or cacheForwardStack) to be no
	// longer than the specified length, deleting cached DOM elements as necessary.
	//
	// stack  - Array of state IDs
	// length - Maximum length to trim to
	//
	// Returns nothing.
	function trimCacheStack(stack, length) {
		while (stack.length > length)
		delete cacheMapping[stack.shift()]
	}

	function enable() {
		$.ejax = ejax
		$.ejax.enable = $.noop
		$.ejax.disable = disable
		$.ejax.defaults = {
			timeout: 1500,
			push: true,
			replace: false,
			type: 'GET',
			dataType: 'html',
			scrollTo: false,
			maxCacheLength: 20
		}
		$(window).on('popstate.ejax', onejaxPopstate)
	}

	function disable() {
		$.fn.ejax = function() { return this }
		$.ejax.enable = enable
		$.ejax.disable = $.noop

		$(window).off('popstate.ejax', onejaxPopstate)
	}

	// use ejax
	enable();
	// disable();

	// Add the state property to jQuery's event object so we can use it in
	// $(window).bind('popstate')
	if ($.event.props && $.inArray('state', $.event.props) < 0) {
		$.event.props.push('state')
	} else if (!('state' in $.Event.prototype)) {
		$.event.addProp('state')
	}

})(jQuery)
