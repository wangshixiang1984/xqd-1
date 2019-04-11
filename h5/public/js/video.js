/**
 * @license
 * Video.js 7.4.1 <http://videojs.com/>
 * Copyright Brightcove, Inc. <https://www.brightcove.com/>
 * Available under Apache License Version 2.0
 * <https://github.com/videojs/video.js/blob/master/LICENSE>
 *
 * Includes vtt.js <https://github.com/mozilla/vtt.js>
 * Available under Apache License Version 2.0
 * <https://github.com/mozilla/vtt.js/blob/master/LICENSE>
 */

(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory(require('global/document'), require('global/window')) :
    typeof define === 'function' && define.amd ? define(['global/document', 'global/window'], factory) :
    (global.videojs = factory(global.document,global.window));
  }(this, (function (document,window$1) {
    document = document && document.hasOwnProperty('default') ? document['default'] : document;
    window$1 = window$1 && window$1.hasOwnProperty('default') ? window$1['default'] : window$1;
  
    var version = "7.4.1";
  
    function _inheritsLoose(subClass, superClass) {
      subClass.prototype = Object.create(superClass.prototype);
      subClass.prototype.constructor = subClass;
      subClass.__proto__ = superClass;
    }
  
    function _setPrototypeOf(o, p) {
      _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
        o.__proto__ = p;
        return o;
      };
  
      return _setPrototypeOf(o, p);
    }
  
    function isNativeReflectConstruct() {
      if (typeof Reflect === "undefined" || !Reflect.construct) return false;
      if (Reflect.construct.sham) return false;
      if (typeof Proxy === "function") return true;
  
      try {
        Date.prototype.toString.call(Reflect.construct(Date, [], function () {}));
        return true;
      } catch (e) {
        return false;
      }
    }
  
    function _construct(Parent, args, Class) {
      if (isNativeReflectConstruct()) {
        _construct = Reflect.construct;
      } else {
        _construct = function _construct(Parent, args, Class) {
          var a = [null];
          a.push.apply(a, args);
          var Constructor = Function.bind.apply(Parent, a);
          var instance = new Constructor();
          if (Class) _setPrototypeOf(instance, Class.prototype);
          return instance;
        };
      }
  
      return _construct.apply(null, arguments);
    }
  
    function _assertThisInitialized(self) {
      if (self === void 0) {
        throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
      }
  
      return self;
    }
  
    function _taggedTemplateLiteralLoose(strings, raw) {
      if (!raw) {
        raw = strings.slice(0);
      }
  
      strings.raw = raw;
      return strings;
    }
  
    /**
     * @file create-logger.js
     * @module create-logger
     */
  
    var history = [];
    /**
     * Log messages to the console and history based on the type of message
     *
     * @private
     * @param  {string} type
     *         The name of the console method to use.
     *
     * @param  {Array} args
     *         The arguments to be passed to the matching console method.
     */
  
    var LogByTypeFactory = function LogByTypeFactory(name, log) {
      return function (type, level, args) {
        var lvl = log.levels[level];
        var lvlRegExp = new RegExp("^(" + lvl + ")$");
  
        if (type !== 'log') {
          // Add the type to the front of the message when it's not "log".
          args.unshift(type.toUpperCase() + ':');
        } // Add console prefix after adding to history.
  
  
        args.unshift(name + ':'); // Add a clone of the args at this point to history.
  
        if (history) {
          history.push([].concat(args));
        } // If there's no console then don't try to output messages, but they will
        // still be stored in history.
  
  
        if (!window$1.console) {
          return;
        } // Was setting these once outside of this function, but containing them
        // in the function makes it easier to test cases where console doesn't exist
        // when the module is executed.
  
  
        var fn = window$1.console[type];
  
        if (!fn && type === 'debug') {
          // Certain browsers don't have support for console.debug. For those, we
          // should default to the closest comparable log.
          fn = window$1.console.info || window$1.console.log;
        } // Bail out if there's no console or if this type is not allowed by the
        // current logging level.
  
  
        if (!fn || !lvl || !lvlRegExp.test(type)) {
          return;
        }
  
        fn[Array.isArray(args) ? 'apply' : 'call'](window$1.console, args);
      };
    };
  
    function createLogger(name) {
      // This is the private tracking variable for logging level.
      var level = 'info'; // the curried logByType bound to the specific log and history
  
      var logByType;
      /**
       * Logs plain debug messages. Similar to `console.log`.
       *
       * Due to [limitations](https://github.com/jsdoc3/jsdoc/issues/955#issuecomment-313829149)
       * of our JSDoc template, we cannot properly document this as both a function
       * and a namespace, so its function signature is documented here.
       *
       * #### Arguments
       * ##### *args
       * Mixed[]
       *
       * Any combination of values that could be passed to `console.log()`.
       *
       * #### Return Value
       *
       * `undefined`
       *
       * @namespace
       * @param    {Mixed[]} args
       *           One or more messages or objects that should be logged.
       */
  
      var log = function log() {
        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
          args[_key] = arguments[_key];
        }
  
        logByType('log', level, args);
      }; // This is the logByType helper that the logging methods below use
  
  
      logByType = LogByTypeFactory(name, log);
      /**
       * Create a new sublogger which chains the old name to the new name.
       *
       * For example, doing `videojs.log.createLogger('player')` and then using that logger will log the following:
       * ```js
       *  mylogger('foo');
       *  // > VIDEOJS: player: foo
       * ```
       *
       * @param {string} name
       *        The name to add call the new logger
       * @return {Object}
       */
  
      log.createLogger = function (subname) {
        return createLogger(name + ': ' + subname);
      };
      /**
       * Enumeration of available logging levels, where the keys are the level names
       * and the values are `|`-separated strings containing logging methods allowed
       * in that logging level. These strings are used to create a regular expression
       * matching the function name being called.
       *
       * Levels provided by Video.js are:
       *
       * - `off`: Matches no calls. Any value that can be cast to `false` will have
       *   this effect. The most restrictive.
       * - `all`: Matches only Video.js-provided functions (`debug`, `log`,
       *   `log.warn`, and `log.error`).
       * - `debug`: Matches `log.debug`, `log`, `log.warn`, and `log.error` calls.
       * - `info` (default): Matches `log`, `log.warn`, and `log.error` calls.
       * - `warn`: Matches `log.warn` and `log.error` calls.
       * - `error`: Matches only `log.error` calls.
       *
       * @type {Object}
       */
  
  
      log.levels = {
        all: 'debug|log|warn|error',
        off: '',
        debug: 'debug|log|warn|error',
        info: 'log|warn|error',
        warn: 'warn|error',
        error: 'error',
        DEFAULT: level
      };
      /**
       * Get or set the current logging level.
       *
       * If a string matching a key from {@link module:log.levels} is provided, acts
       * as a setter.
       *
       * @param  {string} [lvl]
       *         Pass a valid level to set a new logging level.
       *
       * @return {string}
       *         The current logging level.
       */
  
      log.level = function (lvl) {
        if (typeof lvl === 'string') {
          if (!log.levels.hasOwnProperty(lvl)) {
            throw new Error("\"" + lvl + "\" in not a valid log level");
          }
  
          level = lvl;
        }
  
        return level;
      };
      /**
       * Returns an array containing everything that has been logged to the history.
       *
       * This array is a shallow clone of the internal history record. However, its
       * contents are _not_ cloned; so, mutating objects inside this array will
       * mutate them in history.
       *
       * @return {Array}
       */
  
  
      log.history = function () {
        return history ? [].concat(history) : [];
      };
      /**
       * Allows you to filter the history by the given logger name
       *
       * @param {string} fname
       *        The name to filter by
       *
       * @return {Array}
       *         The filtered list to return
       */
  
  
      log.history.filter = function (fname) {
        return (history || []).filter(function (historyItem) {
          // if the first item in each historyItem includes `fname`, then it's a match
          return new RegExp(".*" + fname + ".*").test(historyItem[0]);
        });
      };
      /**
       * Clears the internal history tracking, but does not prevent further history
       * tracking.
       */
  
  
      log.history.clear = function () {
        if (history) {
          history.length = 0;
        }
      };
      /**
       * Disable history tracking if it is currently enabled.
       */
  
  
      log.history.disable = function () {
        if (history !== null) {
          history.length = 0;
          history = null;
        }
      };
      /**
       * Enable history tracking if it is currently disabled.
       */
  
  
      log.history.enable = function () {
        if (history === null) {
          history = [];
        }
      };
      /**
       * Logs error messages. Similar to `console.error`.
       *
       * @param {Mixed[]} args
       *        One or more messages or objects that should be logged as an error
       */
  
  
      log.error = function () {
        for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
          args[_key2] = arguments[_key2];
        }
  
        return logByType('error', level, args);
      };
      /**
       * Logs warning messages. Similar to `console.warn`.
       *
       * @param {Mixed[]} args
       *        One or more messages or objects that should be logged as a warning.
       */
  
  
      log.warn = function () {
        for (var _len3 = arguments.length, args = new Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
          args[_key3] = arguments[_key3];
        }
  
        return logByType('warn', level, args);
      };
      /**
       * Logs debug messages. Similar to `console.debug`, but may also act as a comparable
       * log if `console.debug` is not available
       *
       * @param {Mixed[]} args
       *        One or more messages or objects that should be logged as debug.
       */
  
  
      log.debug = function () {
        for (var _len4 = arguments.length, args = new Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {
          args[_key4] = arguments[_key4];
        }
  
        return logByType('debug', level, args);
      };
  
      return log;
    }
  
    /**
     * @file log.js
     * @module log
     */
    var log = createLogger('VIDEOJS');
    var createLogger$1 = log.createLogger;
  
    function clean(s) {
      return s.replace(/\n\r?\s*/g, '');
    }
  
    var tsml = function tsml(sa) {
      var s = '',
          i = 0;
  
      for (; i < arguments.length; i++) {
        s += clean(sa[i]) + (arguments[i + 1] || '');
      }
  
      return s;
    };
  
    /**
     * @file obj.js
     * @module obj
     */
  
    /**
     * @callback obj:EachCallback
     *
     * @param {Mixed} value
     *        The current key for the object that is being iterated over.
     *
     * @param {string} key
     *        The current key-value for object that is being iterated over
     */
  
    /**
     * @callback obj:ReduceCallback
     *
     * @param {Mixed} accum
     *        The value that is accumulating over the reduce loop.
     *
     * @param {Mixed} value
     *        The current key for the object that is being iterated over.
     *
     * @param {string} key
     *        The current key-value for object that is being iterated over
     *
     * @return {Mixed}
     *         The new accumulated value.
     */
    var toString = Object.prototype.toString;
    /**
     * Get the keys of an Object
     *
     * @param {Object}
     *        The Object to get the keys from
     *
     * @return {string[]}
     *         An array of the keys from the object. Returns an empty array if the
     *         object passed in was invalid or had no keys.
     *
     * @private
     */
  
    var keys = function keys(object) {
      return isObject(object) ? Object.keys(object) : [];
    };
    /**
     * Array-like iteration for objects.
     *
     * @param {Object} object
     *        The object to iterate over
     *
     * @param {obj:EachCallback} fn
     *        The callback function which is called for each key in the object.
     */
  
  
    function each(object, fn) {
      keys(object).forEach(function (key) {
        return fn(object[key], key);
      });
    }
    /**
     * Array-like reduce for objects.
     *
     * @param {Object} object
     *        The Object that you want to reduce.
     *
     * @param {Function} fn
     *         A callback function which is called for each key in the object. It
     *         receives the accumulated value and the per-iteration value and key
     *         as arguments.
     *
     * @param {Mixed} [initial = 0]
     *        Starting value
     *
     * @return {Mixed}
     *         The final accumulated value.
     */
  
    function reduce(object, fn, initial) {
      if (initial === void 0) {
        initial = 0;
      }
  
      return keys(object).reduce(function (accum, key) {
        return fn(accum, object[key], key);
      }, initial);
    }
    /**
     * Object.assign-style object shallow merge/extend.
     *
     * @param  {Object} target
     * @param  {Object} ...sources
     * @return {Object}
     */
  
    function assign(target) {
      for (var _len = arguments.length, sources = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        sources[_key - 1] = arguments[_key];
      }
  
      if (Object.assign) {
        return Object.assign.apply(Object, [target].concat(sources));
      }
  
      sources.forEach(function (source) {
        if (!source) {
          return;
        }
  
        each(source, function (value, key) {
          target[key] = value;
        });
      });
      return target;
    }
    /**
     * Returns whether a value is an object of any kind - including DOM nodes,
     * arrays, regular expressions, etc. Not functions, though.
     *
     * This avoids the gotcha where using `typeof` on a `null` value
     * results in `'object'`.
     *
     * @param  {Object} value
     * @return {boolean}
     */
  
    function isObject(value) {
      return !!value && typeof value === 'object';
    }
    /**
     * Returns whether an object appears to be a "plain" object - that is, a
     * direct instance of `Object`.
     *
     * @param  {Object} value
     * @return {boolean}
     */
  
    function isPlain(value) {
      return isObject(value) && toString.call(value) === '[object Object]' && value.constructor === Object;
    }
  
    /**
     * @file computed-style.js
     * @module computed-style
     */
    /**
     * A safe getComputedStyle.
     *
     * This is needed because in Firefox, if the player is loaded in an iframe with
     * `display:none`, then `getComputedStyle` returns `null`, so, we do a
     * null-check to make sure that the player doesn't break in these cases.
     *
     * @function
     * @param    {Element} el
     *           The element you want the computed style of
     *
     * @param    {string} prop
     *           The property name you want
     *
     * @see      https://bugzilla.mozilla.org/show_bug.cgi?id=548397
     */
  
    function computedStyle(el, prop) {
      if (!el || !prop) {
        return '';
      }
  
      if (typeof window$1.getComputedStyle === 'function') {
        var cs = window$1.getComputedStyle(el);
        return cs ? cs[prop] : '';
      }
  
      return '';
    }
  
    function _templateObject() {
      var data = _taggedTemplateLiteralLoose(["Setting attributes in the second argument of createEl()\n                has been deprecated. Use the third argument instead.\n                createEl(type, properties, attributes). Attempting to set ", " to ", "."]);
  
      _templateObject = function _templateObject() {
        return data;
      };
  
      return data;
    }
    /**
     * Detect if a value is a string with any non-whitespace characters.
     *
     * @private
     * @param  {string} str
     *         The string to check
     *
     * @return {boolean}
     *         Will be `true` if the string is non-blank, `false` otherwise.
     *
     */
  
    function isNonBlankString(str) {
      return typeof str === 'string' && /\S/.test(str);
    }
    /**
     * Throws an error if the passed string has whitespace. This is used by
     * class methods to be relatively consistent with the classList API.
     *
     * @private
     * @param  {string} str
     *         The string to check for whitespace.
     *
     * @throws {Error}
     *         Throws an error if there is whitespace in the string.
     */
  
  
    function throwIfWhitespace(str) {
      if (/\s/.test(str)) {
        throw new Error('class has illegal whitespace characters');
      }
    }
    /**
     * Produce a regular expression for matching a className within an elements className.
     *
     * @private
     * @param  {string} className
     *         The className to generate the RegExp for.
     *
     * @return {RegExp}
     *         The RegExp that will check for a specific `className` in an elements
     *         className.
     */
  
  
    function classRegExp(className) {
      return new RegExp('(^|\\s)' + className + '($|\\s)');
    }
    /**
     * Whether the current DOM interface appears to be real (i.e. not simulated).
     *
     * @return {boolean}
     *         Will be `true` if the DOM appears to be real, `false` otherwise.
     */
  
  
    function isReal() {
      // Both document and window will never be undefined thanks to `global`.
      return document === window$1.document;
    }
    /**
     * Determines, via duck typing, whether or not a value is a DOM element.
     *
     * @param  {Mixed} value
     *         The value to check.
     *
     * @return {boolean}
     *         Will be `true` if the value is a DOM element, `false` otherwise.
     */
  
    function isEl(value) {
      return isObject(value) && value.nodeType === 1;
    }
    /**
     * Determines if the current DOM is embedded in an iframe.
     *
     * @return {boolean}
     *         Will be `true` if the DOM is embedded in an iframe, `false`
     *         otherwise.
     */
  
    function isInFrame() {
      // We need a try/catch here because Safari will throw errors when attempting
      // to get either `parent` or `self`
      try {
        return window$1.parent !== window$1.self;
      } catch (x) {
        return true;
      }
    }
    /**
     * Creates functions to query the DOM using a given method.
     *
     * @private
     * @param   {string} method
     *          The method to create the query with.
     *
     * @return  {Function}
     *          The query method
     */
  
    function createQuerier(method) {
      return function (selector, context) {
        if (!isNonBlankString(selector)) {
          return document[method](null);
        }
  
        if (isNonBlankString(context)) {
          context = document.querySelector(context);
        }
  
        var ctx = isEl(context) ? context : document;
        return ctx[method] && ctx[method](selector);
      };
    }
    /**
     * Creates an element and applies properties, attributes, and inserts content.
     *
     * @param  {string} [tagName='div']
     *         Name of tag to be created.
     *
     * @param  {Object} [properties={}]
     *         Element properties to be applied.
     *
     * @param  {Object} [attributes={}]
     *         Element attributes to be applied.
     *
     * @param {module:dom~ContentDescriptor} content
     *        A content descriptor object.
     *
     * @return {Element}
     *         The element that was created.
     */
  
  
    function createEl(tagName, properties, attributes, content) {
      if (tagName === void 0) {
        tagName = 'div';
      }
  
      if (properties === void 0) {
        properties = {};
      }
  
      if (attributes === void 0) {
        attributes = {};
      }
  
      var el = document.createElement(tagName);
      Object.getOwnPropertyNames(properties).forEach(function (propName) {
        var val = properties[propName]; // See #2176
        // We originally were accepting both properties and attributes in the
        // same object, but that doesn't work so well.
  
        if (propName.indexOf('aria-') !== -1 || propName === 'role' || propName === 'type') {
          log.warn(tsml(_templateObject(), propName, val));
          el.setAttribute(propName, val); // Handle textContent since it's not supported everywhere and we have a
          // method for it.
        } else if (propName === 'textContent') {
          textContent(el, val);
        } else {
          el[propName] = val;
        }
      });
      Object.getOwnPropertyNames(attributes).forEach(function (attrName) {
        el.setAttribute(attrName, attributes[attrName]);
      });
  
      if (content) {
        appendContent(el, content);
      }
  
      return el;
    }
    /**
     * Injects text into an element, replacing any existing contents entirely.
     *
     * @param  {Element} el
     *         The element to add text content into
     *
     * @param  {string} text
     *         The text content to add.
     *
     * @return {Element}
     *         The element with added text content.
     */
  
    function textContent(el, text) {
      if (typeof el.textContent === 'undefined') {
        el.innerText = text;
      } else {
        el.textContent = text;
      }
  
      return el;
    }
    /**
     * Insert an element as the first child node of another
     *
     * @param {Element} child
     *        Element to insert
     *
     * @param {Element} parent
     *        Element to insert child into
     */
  
    function prependTo(child, parent) {
      if (parent.firstChild) {
        parent.insertBefore(child, parent.firstChild);
      } else {
        parent.appendChild(child);
      }
    }
    /**
     * Check if an element has a class name.
     *
     * @param  {Element} element
     *         Element to check
     *
     * @param  {string} classToCheck
     *         Class name to check for
     *
     * @return {boolean}
     *         Will be `true` if the element has a class, `false` otherwise.
     *
     * @throws {Error}
     *         Throws an error if `classToCheck` has white space.
     */
  
    function hasClass(element, classToCheck) {
      throwIfWhitespace(classToCheck);
  
      if (element.classList) {
        return element.classList.contains(classToCheck);
      }
  
      return classRegExp(classToCheck).test(element.className);
    }
    /**
     * Add a class name to an element.
     *
     * @param  {Element} element
     *         Element to add class name to.
     *
     * @param  {string} classToAdd
     *         Class name to add.
     *
     * @return {Element}
     *         The DOM element with the added class name.
     */
  
    function addClass(element, classToAdd) {
      if (element.classList) {
        element.classList.add(classToAdd); // Don't need to `throwIfWhitespace` here because `hasElClass` will do it
        // in the case of classList not being supported.
      } else if (!hasClass(element, classToAdd)) {
        element.className = (element.className + ' ' + classToAdd).trim();
      }
  
      return element;
    }
    /**
     * Remove a class name from an element.
     *
     * @param  {Element} element
     *         Element to remove a class name from.
     *
     * @param  {string} classToRemove
     *         Class name to remove
     *
     * @return {Element}
     *         The DOM element with class name removed.
     */
  
    function removeClass(element, classToRemove) {
      if (element.classList) {
        element.classList.remove(classToRemove);
      } else {
        throwIfWhitespace(classToRemove);
        element.className = element.className.split(/\s+/).filter(function (c) {
          return c !== classToRemove;
        }).join(' ');
      }
  
      return element;
    }
    /**
     * The callback definition for toggleClass.
     *
     * @callback module:dom~PredicateCallback
     * @param    {Element} element
     *           The DOM element of the Component.
     *
     * @param    {string} classToToggle
     *           The `className` that wants to be toggled
     *
     * @return   {boolean|undefined}
     *           If `true` is returned, the `classToToggle` will be added to the
     *           `element`. If `false`, the `classToToggle` will be removed from
     *           the `element`. If `undefined`, the callback will be ignored.
     */
  
    /**
     * Adds or removes a class name to/from an element depending on an optional
     * condition or the presence/absence of the class name.
     *
     * @param  {Element} element
     *         The element to toggle a class name on.
     *
     * @param  {string} classToToggle
     *         The class that should be toggled.
     *
     * @param  {boolean|module:dom~PredicateCallback} [predicate]
     *         See the return value for {@link module:dom~PredicateCallback}
     *
     * @return {Element}
     *         The element with a class that has been toggled.
     */
  
    function toggleClass(element, classToToggle, predicate) {
      // This CANNOT use `classList` internally because IE11 does not support the
      // second parameter to the `classList.toggle()` method! Which is fine because
      // `classList` will be used by the add/remove functions.
      var has = hasClass(element, classToToggle);
  
      if (typeof predicate === 'function') {
        predicate = predicate(element, classToToggle);
      }
  
      if (typeof predicate !== 'boolean') {
        predicate = !has;
      } // If the necessary class operation matches the current state of the
      // element, no action is required.
  
  
      if (predicate === has) {
        return;
      }
  
      if (predicate) {
        addClass(element, classToToggle);
      } else {
        removeClass(element, classToToggle);
      }
  
      return element;
    }
    /**
     * Apply attributes to an HTML element.
     *
     * @param {Element} el
     *        Element to add attributes to.
     *
     * @param {Object} [attributes]
     *        Attributes to be applied.
     */
  
    function setAttributes(el, attributes) {
      Object.getOwnPropertyNames(attributes).forEach(function (attrName) {
        var attrValue = attributes[attrName];
  
        if (attrValue === null || typeof attrValue === 'undefined' || attrValue === false) {
          el.removeAttribute(attrName);
        } else {
          el.setAttribute(attrName, attrValue === true ? '' : attrValue);
        }
      });
    }
    /**
     * Get an element's attribute values, as defined on the HTML tag.
     *
     * Attributes are not the same as properties. They're defined on the tag
     * or with setAttribute.
     *
     * @param  {Element} tag
     *         Element from which to get tag attributes.
     *
     * @return {Object}
     *         All attributes of the element. Boolean attributes will be `true` or
     *         `false`, others will be strings.
     */
  
    function getAttributes(tag) {
      var obj = {}; // known boolean attributes
      // we can check for matching boolean properties, but not all browsers
      // and not all tags know about these attributes, so, we still want to check them manually
  
      var knownBooleans = ',' + 'autoplay,controls,playsinline,loop,muted,default,defaultMuted' + ',';
  
      if (tag && tag.attributes && tag.attributes.length > 0) {
        var attrs = tag.attributes;
  
        for (var i = attrs.length - 1; i >= 0; i--) {
          var attrName = attrs[i].name;
          var attrVal = attrs[i].value; // check for known booleans
          // the matching element property will return a value for typeof
  
          if (typeof tag[attrName] === 'boolean' || knownBooleans.indexOf(',' + attrName + ',') !== -1) {
            // the value of an included boolean attribute is typically an empty
            // string ('') which would equal false if we just check for a false value.
            // we also don't want support bad code like autoplay='false'
            attrVal = attrVal !== null ? true : false;
          }
  
          obj[attrName] = attrVal;
        }
      }
  
      return obj;
    }
    /**
     * Get the value of an element's attribute.
     *
     * @param {Element} el
     *        A DOM element.
     *
     * @param {string} attribute
     *        Attribute to get the value of.
     *
     * @return {string}
     *         The value of the attribute.
     */
  
    function getAttribute(el, attribute) {
      return el.getAttribute(attribute);
    }
    /**
     * Set the value of an element's attribute.
     *
     * @param {Element} el
     *        A DOM element.
     *
     * @param {string} attribute
     *        Attribute to set.
     *
     * @param {string} value
     *        Value to set the attribute to.
     */
  
    function setAttribute(el, attribute, value) {
      el.setAttribute(attribute, value);
    }
    /**
     * Remove an element's attribute.
     *
     * @param {Element} el
     *        A DOM element.
     *
     * @param {string} attribute
     *        Attribute to remove.
     */
  
    function removeAttribute(el, attribute) {
      el.removeAttribute(attribute);
    }
    /**
     * Attempt to block the ability to select text.
     */
  
    function blockTextSelection() {
      document.body.focus();
  
      document.onselectstart = function () {
        return false;
      };
    }
    /**
     * Turn off text selection blocking.
     */
  
    function unblockTextSelection() {
      document.onselectstart = function () {
        return true;
      };
    }
    /**
     * Identical to the native `getBoundingClientRect` function, but ensures that
     * the method is supported at all (it is in all browsers we claim to support)
     * and that the element is in the DOM before continuing.
     *
     * This wrapper function also shims properties which are not provided by some
     * older browsers (namely, IE8).
     *
     * Additionally, some browsers do not support adding properties to a
     * `ClientRect`/`DOMRect` object; so, we shallow-copy it with the standard
     * properties (except `x` and `y` which are not widely supported). This helps
     * avoid implementations where keys are non-enumerable.
     *
     * @param  {Element} el
     *         Element whose `ClientRect` we want to calculate.
     *
     * @return {Object|undefined}
     *         Always returns a plain object - or `undefined` if it cannot.
     */
  
    function getBoundingClientRect(el) {
      if (el && el.getBoundingClientRect && el.parentNode) {
        var rect = el.getBoundingClientRect();
        var result = {};
        ['bottom', 'height', 'left', 'right', 'top', 'width'].forEach(function (k) {
          if (rect[k] !== undefined) {
            result[k] = rect[k];
          }
        });
  
        if (!result.height) {
          result.height = parseFloat(computedStyle(el, 'height'));
        }
  
        if (!result.width) {
          result.width = parseFloat(computedStyle(el, 'width'));
        }
  
        return result;
      }
    }
    /**
     * Represents the position of a DOM element on the page.
     *
     * @typedef  {Object} module:dom~Position
     *
     * @property {number} left
     *           Pixels to the left.
     *
     * @property {number} top
     *           Pixels from the top.
     */
  
    /**
     * Get the position of an element in the DOM.
     *
     * Uses `getBoundingClientRect` technique from John Resig.
     *
     * @see http://ejohn.org/blog/getboundingclientrect-is-awesome/
     *
     * @param  {Element} el
     *         Element from which to get offset.
     *
     * @return {module:dom~Position}
     *         The position of the element that was passed in.
     */
  
    function findPosition(el) {
      var box;
  
      if (el.getBoundingClientRect && el.parentNode) {
        box = el.getBoundingClientRect();
      }
  
      if (!box) {
        return {
          left: 0,
          top: 0
        };
      }
  
      var docEl = document.documentElement;
      var body = document.body;
      var clientLeft = docEl.clientLeft || body.clientLeft || 0;
      var scrollLeft = window$1.pageXOffset || body.scrollLeft;
      var left = box.left + scrollLeft - clientLeft;
      var clientTop = docEl.clientTop || body.clientTop || 0;
      var scrollTop = window$1.pageYOffset || body.scrollTop;
      var top = box.top + scrollTop - clientTop; // Android sometimes returns slightly off decimal values, so need to round
  
      return {
        left: Math.round(left),
        top: Math.round(top)
      };
    }
    /**
     * Represents x and y coordinates for a DOM element or mouse pointer.
     *
     * @typedef  {Object} module:dom~Coordinates
     *
     * @property {number} x
     *           x coordinate in pixels
     *
     * @property {number} y
     *           y coordinate in pixels
     */
  
    /**
     * Get the pointer position within an element.
     *
     * The base on the coordinates are the bottom left of the element.
     *
     * @param  {Element} el
     *         Element on which to get the pointer position on.
     *
     * @param  {EventTarget~Event} event
     *         Event object.
     *
     * @return {module:dom~Coordinates}
     *         A coordinates object corresponding to the mouse position.
     *
     */
  
    function getPointerPosition(el, event) {
      var position = {};
      var box = findPosition(el);
      var boxW = el.offsetWidth;
      var boxH = el.offsetHeight;
      var boxY = box.top;
      var boxX = box.left;
      var pageY = event.pageY;
      var pageX = event.pageX;
  
      if (event.changedTouches) {
        pageX = event.changedTouches[0].pageX;
        pageY = event.changedTouches[0].pageY;
      }
  
      position.y = Math.max(0, Math.min(1, (boxY - pageY + boxH) / boxH));
      position.x = Math.max(0, Math.min(1, (pageX - boxX) / boxW));
      return position;
    }
    /**
     * Determines, via duck typing, whether or not a value is a text node.
     *
     * @param  {Mixed} value
     *         Check if this value is a text node.
     *
     * @return {boolean}
     *         Will be `true` if the value is a text node, `false` otherwise.
     */
  
    function isTextNode(value) {
      return isObject(value) && value.nodeType === 3;
    }
    /**
     * Empties the contents of an element.
     *
     * @param  {Element} el
     *         The element to empty children from
     *
     * @return {Element}
     *         The element with no children
     */
  
    function emptyEl(el) {
      while (el.firstChild) {
        el.removeChild(el.firstChild);
      }
  
      return el;
    }
    /**
     * This is a mixed value that describes content to be injected into the DOM
     * via some method. It can be of the following types:
     *
     * Type       | Description
     * -----------|-------------
     * `string`   | The value will be normalized into a text node.
     * `Element`  | The value will be accepted as-is.
     * `TextNode` | The value will be accepted as-is.
     * `Array`    | A one-dimensional array of strings, elements, text nodes, or functions. These functions should return a string, element, or text node (any other return value, like an array, will be ignored).
     * `Function` | A function, which is expected to return a string, element, text node, or array - any of the other possible values described above. This means that a content descriptor could be a function that returns an array of functions, but those second-level functions must return strings, elements, or text nodes.
     *
     * @typedef {string|Element|TextNode|Array|Function} module:dom~ContentDescriptor
     */
  
    /**
     * Normalizes content for eventual insertion into the DOM.
     *
     * This allows a wide range of content definition methods, but helps protect
     * from falling into the trap of simply writing to `innerHTML`, which could
     * be an XSS concern.
     *
     * The content for an element can be passed in multiple types and
     * combinations, whose behavior is as follows:
     *
     * @param {module:dom~ContentDescriptor} content
     *        A content descriptor value.
     *
     * @return {Array}
     *         All of the content that was passed in, normalized to an array of
     *         elements or text nodes.
     */
  
    function normalizeContent(content) {
      // First, invoke content if it is a function. If it produces an array,
      // that needs to happen before normalization.
      if (typeof content === 'function') {
        content = content();
      } // Next up, normalize to an array, so one or many items can be normalized,
      // filtered, and returned.
  
  
      return (Array.isArray(content) ? content : [content]).map(function (value) {
        // First, invoke value if it is a function to produce a new value,
        // which will be subsequently normalized to a Node of some kind.
        if (typeof value === 'function') {
          value = value();
        }
  
        if (isEl(value) || isTextNode(value)) {
          return value;
        }
  
        if (typeof value === 'string' && /\S/.test(value)) {
          return document.createTextNode(value);
        }
      }).filter(function (value) {
        return value;
      });
    }
    /**
     * Normalizes and appends content to an element.
     *
     * @param  {Element} el
     *         Element to append normalized content to.
     *
     * @param {module:dom~ContentDescriptor} content
     *        A content descriptor value.
     *
     * @return {Element}
     *         The element with appended normalized content.
     */
  
    function appendContent(el, content) {
      normalizeContent(content).forEach(function (node) {
        return el.appendChild(node);
      });
      return el;
    }
    /**
     * Normalizes and inserts content into an element; this is identical to
     * `appendContent()`, except it empties the element first.
     *
     * @param {Element} el
     *        Element to insert normalized content into.
     *
     * @param {module:dom~ContentDescriptor} content
     *        A content descriptor value.
     *
     * @return {Element}
     *         The element with inserted normalized content.
     */
  
    function insertContent(el, content) {
      return appendContent(emptyEl(el), content);
    }
    /**
     * Check if an event was a single left click.
     *
     * @param  {EventTarget~Event} event
     *         Event object.
     *
     * @return {boolean}
     *         Will be `true` if a single left click, `false` otherwise.
     */
  
    function isSingleLeftClick(event) {
      // Note: if you create something draggable, be sure to
      // call it on both `mousedown` and `mousemove` event,
      // otherwise `mousedown` should be enough for a button
      if (event.button === undefined && event.buttons === undefined) {
        // Why do we need `buttons` ?
        // Because, middle mouse sometimes have this:
        // e.button === 0 and e.buttons === 4
        // Furthermore, we want to prevent combination click, something like
        // HOLD middlemouse then left click, that would be
        // e.button === 0, e.buttons === 5
        // just `button` is not gonna work
        // Alright, then what this block does ?
        // this is for chrome `simulate mobile devices`
        // I want to support this as well
        return true;
      }
  
      if (event.button === 0 && event.buttons === undefined) {
        // Touch screen, sometimes on some specific device, `buttons`
        // doesn't have anything (safari on ios, blackberry...)
        return true;
      }
  
      if (event.button !== 0 || event.buttons !== 1) {
        // This is the reason we have those if else block above
        // if any special case we can catch and let it slide
        // we do it above, when get to here, this definitely
        // is-not-left-click
        return false;
      }
  
      return true;
    }
    /**
     * Finds a single DOM element matching `selector` within the optional
     * `context` of another DOM element (defaulting to `document`).
     *
     * @param  {string} selector
     *         A valid CSS selector, which will be passed to `querySelector`.
     *
     * @param  {Element|String} [context=document]
     *         A DOM element within which to query. Can also be a selector
     *         string in which case the first matching element will be used
     *         as context. If missing (or no element matches selector), falls
     *         back to `document`.
     *
     * @return {Element|null}
     *         The element that was found or null.
     */
  
    var $ = createQuerier('querySelector');
    /**
     * Finds a all DOM elements matching `selector` within the optional
     * `context` of another DOM element (defaulting to `document`).
     *
     * @param  {string} selector
     *         A valid CSS selector, which will be passed to `querySelectorAll`.
     *
     * @param  {Element|String} [context=document]
     *         A DOM element within which to query. Can also be a selector
     *         string in which case the first matching element will be used
     *         as context. If missing (or no element matches selector), falls
     *         back to `document`.
     *
     * @return {NodeList}
     *         A element list of elements that were found. Will be empty if none
     *         were found.
     *
     */
  
    var $$ = createQuerier('querySelectorAll');
  
    var Dom = /*#__PURE__*/Object.freeze({
      isReal: isReal,
      isEl: isEl,
      isInFrame: isInFrame,
      createEl: createEl,
      textContent: textContent,
      prependTo: prependTo,
      hasClass: hasClass,
      addClass: addClass,
      removeClass: removeClass,
      toggleClass: toggleClass,
      setAttributes: setAttributes,
      getAttributes: getAttributes,
      getAttribute: getAttribute,
      setAttribute: setAttribute,
      removeAttribute: removeAttribute,
      blockTextSelection: blockTextSelection,
      unblockTextSelection: unblockTextSelection,
      getBoundingClientRect: getBoundingClientRect,
      findPosition: findPosition,
      getPointerPosition: getPointerPosition,
      isTextNode: isTextNode,
      emptyEl: emptyEl,
      normalizeContent: normalizeContent,
      appendContent: appendContent,
      insertContent: insertContent,
      isSingleLeftClick: isSingleLeftClick,
      $: $,
      $$: $$
    });
  
    /**
     * @file guid.js
     * @module guid
     */
  
    /**
     * Unique ID for an element or function
     * @type {Number}
     */
    var _guid = 1;
    /**
     * Get a unique auto-incrementing ID by number that has not been returned before.
     *
     * @return {number}
     *         A new unique ID.
     */
  
    function newGUID() {
      return _guid++;
    }
  
    /**
     * @file dom-data.js
     * @module dom-data
     */
    /**
     * Element Data Store.
     *
     * Allows for binding data to an element without putting it directly on the
     * element. Ex. Event listeners are stored here.
     * (also from jsninja.com, slightly modified and updated for closure compiler)
     *
     * @type {Object}
     * @private
     */
  
    var elData = {};
    /*
     * Unique attribute name to store an element's guid in
     *
     * @type {String}
     * @constant
     * @private
     */
  
    var elIdAttr = 'vdata' + new Date().getTime();
    /**
     * Returns the cache object where data for an element is stored
     *
     * @param {Element} el
     *        Element to store data for.
     *
     * @return {Object}
     *         The cache object for that el that was passed in.
     */
  
    function getData(el) {
      var id = el[elIdAttr];
  
      if (!id) {
        id = el[elIdAttr] = newGUID();
      }
  
      if (!elData[id]) {
        elData[id] = {};
      }
  
      return elData[id];
    }
    /**
     * Returns whether or not an element has cached data
     *
     * @param {Element} el
     *        Check if this element has cached data.
     *
     * @return {boolean}
     *         - True if the DOM element has cached data.
     *         - False otherwise.
     */
  
    function hasData(el) {
      var id = el[elIdAttr];
  
      if (!id) {
        return false;
      }
  
      return !!Object.getOwnPropertyNames(elData[id]).length;
    }
    /**
     * Delete data for the element from the cache and the guid attr from getElementById
     *
     * @param {Element} el
     *        Remove cached data for this element.
     */
  
    function removeData(el) {
      var id = el[elIdAttr];
  
      if (!id) {
        return;
      } // Remove all stored data
  
  
      delete elData[id]; // Remove the elIdAttr property from the DOM node
  
      try {
        delete el[elIdAttr];
      } catch (e) {
        if (el.removeAttribute) {
          el.removeAttribute(elIdAttr);
        } else {
          // IE doesn't appear to support removeAttribute on the document element
          el[elIdAttr] = null;
        }
      }
    }
  
    /**
     * @file events.js. An Event System (John Resig - Secrets of a JS Ninja http://jsninja.com/)
     * (Original book version wasn't completely usable, so fixed some things and made Closure Compiler compatible)
     * This should work very similarly to jQuery's events, however it's based off the book version which isn't as
     * robust as jquery's, so there's probably some differences.
     *
     * @file events.js
     * @module events
     */
    /**
     * Clean up the listener cache and dispatchers
     *
     * @param {Element|Object} elem
     *        Element to clean up
     *
     * @param {string} type
     *        Type of event to clean up
     */
  
    function _cleanUpEvents(elem, type) {
      var data = getData(elem); // Remove the events of a particular type if there are none left
  
      if (data.handlers[type].length === 0) {
        delete data.handlers[type]; // data.handlers[type] = null;
        // Setting to null was causing an error with data.handlers
        // Remove the meta-handler from the element
  
        if (elem.removeEventListener) {
          elem.removeEventListener(type, data.dispatcher, false);
        } else if (elem.detachEvent) {
          elem.detachEvent('on' + type, data.dispatcher);
        }
      } // Remove the events object if there are no types left
  
  
      if (Object.getOwnPropertyNames(data.handlers).length <= 0) {
        delete data.handlers;
        delete data.dispatcher;
        delete data.disabled;
      } // Finally remove the element data if there is no data left
  
  
      if (Object.getOwnPropertyNames(data).length === 0) {
        removeData(elem);
      }
    }
    /**
     * Loops through an array of event types and calls the requested method for each type.
     *
     * @param {Function} fn
     *        The event method we want to use.
     *
     * @param {Element|Object} elem
     *        Element or object to bind listeners to
     *
     * @param {string} type
     *        Type of event to bind to.
     *
     * @param {EventTarget~EventListener} callback
     *        Event listener.
     */
  
  
    function _handleMultipleEvents(fn, elem, types, callback) {
      types.forEach(function (type) {
        // Call the event method for each one of the types
        fn(elem, type, callback);
      });
    }
    /**
     * Fix a native event to have standard property values
     *
     * @param {Object} event
     *        Event object to fix.
     *
     * @return {Object}
     *         Fixed event object.
     */
  
  
    function fixEvent(event) {
      function returnTrue() {
        return true;
      }
  
      function returnFalse() {
        return false;
      } // Test if fixing up is needed
      // Used to check if !event.stopPropagation instead of isPropagationStopped
      // But native events return true for stopPropagation, but don't have
      // other expected methods like isPropagationStopped. Seems to be a problem
      // with the Javascript Ninja code. So we're just overriding all events now.
  
  
      if (!event || !event.isPropagationStopped) {
        var old = event || window$1.event;
        event = {}; // Clone the old object so that we can modify the values event = {};
        // IE8 Doesn't like when you mess with native event properties
        // Firefox returns false for event.hasOwnProperty('type') and other props
        //  which makes copying more difficult.
        // TODO: Probably best to create a whitelist of event props
  
        for (var key in old) {
          // Safari 6.0.3 warns you if you try to copy deprecated layerX/Y
          // Chrome warns you if you try to copy deprecated keyboardEvent.keyLocation
          // and webkitMovementX/Y
          if (key !== 'layerX' && key !== 'layerY' && key !== 'keyLocation' && key !== 'webkitMovementX' && key !== 'webkitMovementY') {
            // Chrome 32+ warns if you try to copy deprecated returnValue, but
            // we still want to if preventDefault isn't supported (IE8).
            if (!(key === 'returnValue' && old.preventDefault)) {
              event[key] = old[key];
            }
          }
        } // The event occurred on this element
  
  
        if (!event.target) {
          event.target = event.srcElement || document;
        } // Handle which other element the event is related to
  
  
        if (!event.relatedTarget) {
          event.relatedTarget = event.fromElement === event.target ? event.toElement : event.fromElement;
        } // Stop the default browser action
  
  
        event.preventDefault = function () {
          if (old.preventDefault) {
            old.preventDefault();
          }
  
          event.returnValue = false;
          old.returnValue = false;
          event.defaultPrevented = true;
        };
  
        event.defaultPrevented = false; // Stop the event from bubbling
  
        event.stopPropagation = function () {
          if (old.stopPropagation) {
            old.stopPropagation();
          }
  
          event.cancelBubble = true;
          old.cancelBubble = true;
          event.isPropagationStopped = returnTrue;
        };
  
        event.isPropagationStopped = returnFalse; // Stop the event from bubbling and executing other handlers
  
        event.stopImmediatePropagation = function () {
          if (old.stopImmediatePropagation) {
            old.stopImmediatePropagation();
          }
  
          event.isImmediatePropagationStopped = returnTrue;
          event.stopPropagation();
        };
  
        event.isImmediatePropagationStopped = returnFalse; // Handle mouse position
  
        if (event.clientX !== null && event.clientX !== undefined) {
          var doc = document.documentElement;
          var body = document.body;
          event.pageX = event.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc && doc.clientLeft || body && body.clientLeft || 0);
          event.pageY = event.clientY + (doc && doc.scrollTop || body && body.scrollTop || 0) - (doc && doc.clientTop || body && body.clientTop || 0);
        } // Handle key presses
  
  
        event.which = event.charCode || event.keyCode; // Fix button for mouse clicks:
        // 0 == left; 1 == middle; 2 == right
  
        if (event.button !== null && event.button !== undefined) {
          // The following is disabled because it does not pass videojs-standard
          // and... yikes.
  
          /* eslint-disable */
          event.button = event.button & 1 ? 0 : event.button & 4 ? 1 : event.button & 2 ? 2 : 0;
          /* eslint-enable */
        }
      } // Returns fixed-up instance
  
  
      return event;
    }
    /**
     * Whether passive event listeners are supported
     */
  
    var _supportsPassive = false;
  
    (function () {
      try {
        var opts = Object.defineProperty({}, 'passive', {
          get: function get() {
            _supportsPassive = true;
          }
        });
        window$1.addEventListener('test', null, opts);
        window$1.removeEventListener('test', null, opts);
      } catch (e) {// disregard
      }
    })();
    /**
     * Touch events Chrome expects to be passive
     */
  
  
    var passiveEvents = ['touchstart', 'touchmove'];
    /**
     * Add an event listener to element
     * It stores the handler function in a separate cache object
     * and adds a generic handler to the element's event,
     * along with a unique id (guid) to the element.
     *
     * @param {Element|Object} elem
     *        Element or object to bind listeners to
     *
     * @param {string|string[]} type
     *        Type of event to bind to.
     *
     * @param {EventTarget~EventListener} fn
     *        Event listener.
     */
  
    function on(elem, type, fn) {
      if (Array.isArray(type)) {
        return _handleMultipleEvents(on, elem, type, fn);
      }
  
      var data = getData(elem); // We need a place to store all our handler data
  
      if (!data.handlers) {
        data.handlers = {};
      }
  
      if (!data.handlers[type]) {
        data.handlers[type] = [];
      }
  
      if (!fn.guid) {
        fn.guid = newGUID();
      }
  
      data.handlers[type].push(fn);
  
      if (!data.dispatcher) {
        data.disabled = false;
  
        data.dispatcher = function (event, hash) {
          if (data.disabled) {
            return;
          }
  
          event = fixEvent(event);
          var handlers = data.handlers[event.type];
  
          if (handlers) {
            // Copy handlers so if handlers are added/removed during the process it doesn't throw everything off.
            var handlersCopy = handlers.slice(0);
  
            for (var m = 0, n = handlersCopy.length; m < n; m++) {
              if (event.isImmediatePropagationStopped()) {
                break;
              } else {
                try {
                  handlersCopy[m].call(elem, event, hash);
                } catch (e) {
                  log.error(e);
                }
              }
            }
          }
        };
      }
  
      if (data.handlers[type].length === 1) {
        if (elem.addEventListener) {
          var options = false;
  
          if (_supportsPassive && passiveEvents.indexOf(type) > -1) {
            options = {
              passive: true
            };
          }
  
          elem.addEventListener(type, data.dispatcher, options);
        } else if (elem.attachEvent) {
          elem.attachEvent('on' + type, data.dispatcher);
        }
      }
    }
    /**
     * Removes event listeners from an element
     *
     * @param {Element|Object} elem
     *        Object to remove listeners from.
     *
     * @param {string|string[]} [type]
     *        Type of listener to remove. Don't include to remove all events from element.
     *
     * @param {EventTarget~EventListener} [fn]
     *        Specific listener to remove. Don't include to remove listeners for an event
     *        type.
     */
  
    function off(elem, type, fn) {
      // Don't want to add a cache object through getElData if not needed
      if (!hasData(elem)) {
        return;
      }
  
      var data = getData(elem); // If no events exist, nothing to unbind
  
      if (!data.handlers) {
        return;
      }
  
      if (Array.isArray(type)) {
        return _handleMultipleEvents(off, elem, type, fn);
      } // Utility function
  
  
      var removeType = function removeType(el, t) {
        data.handlers[t] = [];
  
        _cleanUpEvents(el, t);
      }; // Are we removing all bound events?
  
  
      if (type === undefined) {
        for (var t in data.handlers) {
          if (Object.prototype.hasOwnProperty.call(data.handlers || {}, t)) {
            removeType(elem, t);
          }
        }
  
        return;
      }
  
      var handlers = data.handlers[type]; // If no handlers exist, nothing to unbind
  
      if (!handlers) {
        return;
      } // If no listener was provided, remove all listeners for type
  
  
      if (!fn) {
        removeType(elem, type);
        return;
      } // We're only removing a single handler
  
  
      if (fn.guid) {
        for (var n = 0; n < handlers.length; n++) {
          if (handlers[n].guid === fn.guid) {
            handlers.splice(n--, 1);
          }
        }
      }
  
      _cleanUpEvents(elem, type);
    }
    /**
     * Trigger an event for an element
     *
     * @param {Element|Object} elem
     *        Element to trigger an event on
     *
     * @param {EventTarget~Event|string} event
     *        A string (the type) or an event object with a type attribute
     *
     * @param {Object} [hash]
     *        data hash to pass along with the event
     *
     * @return {boolean|undefined}
     *         Returns the opposite of `defaultPrevented` if default was
     *         prevented. Otherwise, returns `undefined`
     */
  
    function trigger(elem, event, hash) {
      // Fetches element data and a reference to the parent (for bubbling).
      // Don't want to add a data object to cache for every parent,
      // so checking hasElData first.
      var elemData = hasData(elem) ? getData(elem) : {};
      var parent = elem.parentNode || elem.ownerDocument; // type = event.type || event,
      // handler;
      // If an event name was passed as a string, creates an event out of it
  
      if (typeof event === 'string') {
        event = {
          type: event,
          target: elem
        };
      } else if (!event.target) {
        event.target = elem;
      } // Normalizes the event properties.
  
  
      event = fixEvent(event); // If the passed element has a dispatcher, executes the established handlers.
  
      if (elemData.dispatcher) {
        elemData.dispatcher.call(elem, event, hash);
      } // Unless explicitly stopped or the event does not bubble (e.g. media events)
      // recursively calls this function to bubble the event up the DOM.
  
  
      if (parent && !event.isPropagationStopped() && event.bubbles === true) {
        trigger.call(null, parent, event, hash); // If at the top of the DOM, triggers the default action unless disabled.
      } else if (!parent && !event.defaultPrevented) {
        var targetData = getData(event.target); // Checks if the target has a default action for this event.
  
        if (event.target[event.type]) {
          // Temporarily disables event dispatching on the target as we have already executed the handler.
          targetData.disabled = true; // Executes the default action.
  
          if (typeof event.target[event.type] === 'function') {
            event.target[event.type]();
          } // Re-enables event dispatching.
  
  
          targetData.disabled = false;
        }
      } // Inform the triggerer if the default was prevented by returning false
  
  
      return !event.defaultPrevented;
    }
    /**
     * Trigger a listener only once for an event.
     *
     * @param {Element|Object} elem
     *        Element or object to bind to.
     *
     * @param {string|string[]} type
     *        Name/type of event
     *
     * @param {Event~EventListener} fn
     *        Event listener function
     */
  
    function one(elem, type, fn) {
      if (Array.isArray(type)) {
        return _handleMultipleEvents(one, elem, type, fn);
      }
  
      var func = function func() {
        off(elem, type, func);
        fn.apply(this, arguments);
      }; // copy the guid to the new function so it can removed using the original function's ID
  
  
      func.guid = fn.guid = fn.guid || newGUID();
      on(elem, type, func);
    }
  
    var Events = /*#__PURE__*/Object.freeze({
      fixEvent: fixEvent,
      on: on,
      off: off,
      trigger: trigger,
      one: one
    });
  
    /**
     * @file setup.js - Functions for setting up a player without
     * user interaction based on the data-setup `attribute` of the video tag.
     *
     * @module setup
     */
    var _windowLoaded = false;
    var videojs;
    /**
     * Set up any tags that have a data-setup `attribute` when the player is started.
     */
  
    var autoSetup = function autoSetup() {
      // Protect against breakage in non-browser environments and check global autoSetup option.
      if (!isReal() || videojs.options.autoSetup === false) {
        return;
      }
  
      var vids = Array.prototype.slice.call(document.getElementsByTagName('video'));
      var audios = Array.prototype.slice.call(document.getElementsByTagName('audio'));
      var divs = Array.prototype.slice.call(document.getElementsByTagName('video-js'));
      var mediaEls = vids.concat(audios, divs); // Check if any media elements exist
  
      if (mediaEls && mediaEls.length > 0) {
        for (var i = 0, e = mediaEls.length; i < e; i++) {
          var mediaEl = mediaEls[i]; // Check if element exists, has getAttribute func.
  
          if (mediaEl && mediaEl.getAttribute) {
            // Make sure this player hasn't already been set up.
            if (mediaEl.player === undefined) {
              var options = mediaEl.getAttribute('data-setup'); // Check if data-setup attr exists.
              // We only auto-setup if they've added the data-setup attr.
  
              if (options !== null) {
                // Create new video.js instance.
                videojs(mediaEl);
              }
            } // If getAttribute isn't defined, we need to wait for the DOM.
  
          } else {
            autoSetupTimeout(1);
            break;
          }
        } // No videos were found, so keep looping unless page is finished loading.
  
      } else if (!_windowLoaded) {
        autoSetupTimeout(1);
      }
    };
    /**
     * Wait until the page is loaded before running autoSetup. This will be called in
     * autoSetup if `hasLoaded` returns false.
     *
     * @param {number} wait
     *        How long to wait in ms
     *
     * @param {module:videojs} [vjs]
     *        The videojs library function
     */
  
  
    function autoSetupTimeout(wait, vjs) {
      if (vjs) {
        videojs = vjs;
      }
  
      window$1.setTimeout(autoSetup, wait);
    }
  
    if (isReal() && document.readyState === 'complete') {
      _windowLoaded = true;
    } else {
      /**
       * Listen for the load event on window, and set _windowLoaded to true.
       *
       * @listens load
       */
      one(window$1, 'load', function () {
        _windowLoaded = true;
      });
    }
  
    /**
     * @file stylesheet.js
     * @module stylesheet
     */
    /**
     * Create a DOM syle element given a className for it.
     *
     * @param {string} className
     *        The className to add to the created style element.
     *
     * @return {Element}
     *         The element that was created.
     */
  
    var createStyleElement = function createStyleElement(className) {
      var style = document.createElement('style');
      style.className = className;
      return style;
    };
    /**
     * Add text to a DOM element.
     *
     * @param {Element} el
     *        The Element to add text content to.
     *
     * @param {string} content
     *        The text to add to the element.
     */
  
    var setTextContent = function setTextContent(el, content) {
      if (el.styleSheet) {
        el.styleSheet.cssText = content;
      } else {
        el.textContent = content;
      }
    };
  
    /**
     * @file fn.js
     * @module fn
     */
    /**
     * Bind (a.k.a proxy or context). A simple method for changing the context of
     * a function.
     *
     * It also stores a unique id on the function so it can be easily removed from
     * events.
     *
     * @function
     * @param    {Mixed} context
     *           The object to bind as scope.
     *
     * @param    {Function} fn
     *           The function to be bound to a scope.
     *
     * @param    {number} [uid]
     *           An optional unique ID for the function to be set
     *
     * @return   {Function}
     *           The new function that will be bound into the context given
     */
  
    var bind = function bind(context, fn, uid) {
      // Make sure the function has a unique ID
      if (!fn.guid) {
        fn.guid = newGUID();
      } // Create the new function that changes the context
  
  
      var bound = function bound() {
        return fn.apply(context, arguments);
      }; // Allow for the ability to individualize this function
      // Needed in the case where multiple objects might share the same prototype
      // IF both items add an event listener with the same function, then you try to remove just one
      // it will remove both because they both have the same guid.
      // when using this, you need to use the bind method when you remove the listener as well.
      // currently used in text tracks
  
  
      bound.guid = uid ? uid + '_' + fn.guid : fn.guid;
      return bound;
    };
    /**
     * Wraps the given function, `fn`, with a new function that only invokes `fn`
     * at most once per every `wait` milliseconds.
     *
     * @function
     * @param    {Function} fn
     *           The function to be throttled.
     *
     * @param    {Number}   wait
     *           The number of milliseconds by which to throttle.
     *
     * @return   {Function}
     */
  
    var throttle = function throttle(fn, wait) {
      var last = Date.now();
  
      var throttled = function throttled() {
        var now = Date.now();
  
        if (now - last >= wait) {
          fn.apply(void 0, arguments);
          last = now;
        }
      };
  
      return throttled;
    };
    /**
     * Creates a debounced function that delays invoking `func` until after `wait`
     * milliseconds have elapsed since the last time the debounced function was
     * invoked.
     *
     * Inspired by lodash and underscore implementations.
     *
     * @function
     * @param    {Function} func
     *           The function to wrap with debounce behavior.
     *
     * @param    {number} wait
     *           The number of milliseconds to wait after the last invocation.
     *
     * @param    {boolean} [immediate]
     *           Whether or not to invoke the function immediately upon creation.
     *
     * @param    {Object} [context=window]
     *           The "context" in which the debounced function should debounce. For
     *           example, if this function should be tied to a Video.js player,
     *           the player can be passed here. Alternatively, defaults to the
     *           global `window` object.
     *
     * @return   {Function}
     *           A debounced function.
     */
  
    var debounce = function debounce(func, wait, immediate, context) {
      if (context === void 0) {
        context = window$1;
      }
  
      var timeout;
  
      var cancel = function cancel() {
        context.clearTimeout(timeout);
        timeout = null;
      };
      /* eslint-disable consistent-this */
  
  
      var debounced = function debounced() {
        var self = this;
        var args = arguments;
  
        var _later = function later() {
          timeout = null;
          _later = null;
  
          if (!immediate) {
            func.apply(self, args);
          }
        };
  
        if (!timeout && immediate) {
          func.apply(self, args);
        }
  
        context.clearTimeout(timeout);
        timeout = context.setTimeout(_later, wait);
      };
      /* eslint-enable consistent-this */
  
  
      debounced.cancel = cancel;
      return debounced;
    };
  
    /**
     * @file src/js/event-target.js
     */
    /**
     * `EventTarget` is a class that can have the same API as the DOM `EventTarget`. It
     * adds shorthand functions that wrap around lengthy functions. For example:
     * the `on` function is a wrapper around `addEventListener`.
     *
     * @see [EventTarget Spec]{@link https://www.w3.org/TR/DOM-Level-2-Events/events.html#Events-EventTarget}
     * @class EventTarget
     */
  
    var EventTarget = function EventTarget() {};
    /**
     * A Custom DOM event.
     *
     * @typedef {Object} EventTarget~Event
     * @see [Properties]{@link https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent}
     */
  
    /**
     * All event listeners should follow the following format.
     *
     * @callback EventTarget~EventListener
     * @this {EventTarget}
     *
     * @param {EventTarget~Event} event
     *        the event that triggered this function
     *
     * @param {Object} [hash]
     *        hash of data sent during the event
     */
  
    /**
     * An object containing event names as keys and booleans as values.
     *
     * > NOTE: If an event name is set to a true value here {@link EventTarget#trigger}
     *         will have extra functionality. See that function for more information.
     *
     * @property EventTarget.prototype.allowedEvents_
     * @private
     */
  
  
    EventTarget.prototype.allowedEvents_ = {};
    /**
     * Adds an `event listener` to an instance of an `EventTarget`. An `event listener` is a
     * function that will get called when an event with a certain name gets triggered.
     *
     * @param {string|string[]} type
     *        An event name or an array of event names.
     *
     * @param {EventTarget~EventListener} fn
     *        The function to call with `EventTarget`s
     */
  
    EventTarget.prototype.on = function (type, fn) {
      // Remove the addEventListener alias before calling Events.on
      // so we don't get into an infinite type loop
      var ael = this.addEventListener;
  
      this.addEventListener = function () {};
  
      on(this, type, fn);
      this.addEventListener = ael;
    };
    /**
     * An alias of {@link EventTarget#on}. Allows `EventTarget` to mimic
     * the standard DOM API.
     *
     * @function
     * @see {@link EventTarget#on}
     */
  
  
    EventTarget.prototype.addEventListener = EventTarget.prototype.on;
    /**
     * Removes an `event listener` for a specific event from an instance of `EventTarget`.
     * This makes it so that the `event listener` will no longer get called when the
     * named event happens.
     *
     * @param {string|string[]} type
     *        An event name or an array of event names.
     *
     * @param {EventTarget~EventListener} fn
     *        The function to remove.
     */
  
    EventTarget.prototype.off = function (type, fn) {
      off(this, type, fn);
    };
    /**
     * An alias of {@link EventTarget#off}. Allows `EventTarget` to mimic
     * the standard DOM API.
     *
     * @function
     * @see {@link EventTarget#off}
     */
  
  
    EventTarget.prototype.removeEventListener = EventTarget.prototype.off;
    /**
     * This function will add an `event listener` that gets triggered only once. After the
     * first trigger it will get removed. This is like adding an `event listener`
     * with {@link EventTarget#on} that calls {@link EventTarget#off} on itself.
     *
     * @param {string|string[]} type
     *        An event name or an array of event names.
     *
     * @param {EventTarget~EventListener} fn
     *        The function to be called once for each event name.
     */
  
    EventTarget.prototype.one = function (type, fn) {
      // Remove the addEventListener alialing Events.on
      // so we don't get into an infinite type loop
      var ael = this.addEventListener;
  
      this.addEventListener = function () {};
  
      one(this, type, fn);
      this.addEventListener = ael;
    };
    /**
     * This function causes an event to happen. This will then cause any `event listeners`
     * that are waiting for that event, to get called. If there are no `event listeners`
     * for an event then nothing will happen.
     *
     * If the name of the `Event` that is being triggered is in `EventTarget.allowedEvents_`.
     * Trigger will also call the `on` + `uppercaseEventName` function.
     *
     * Example:
     * 'click' is in `EventTarget.allowedEvents_`, so, trigger will attempt to call
     * `onClick` if it exists.
     *
     * @param {string|EventTarget~Event|Object} event
     *        The name of the event, an `Event`, or an object with a key of type set to
     *        an event name.
     */
  
  
    EventTarget.prototype.trigger = function (event) {
      var type = event.type || event;
  
      if (typeof event === 'string') {
        event = {
          type: type
        };
      }
  
      event = fixEvent(event);
  
      if (this.allowedEvents_[type] && this['on' + type]) {
        this['on' + type](event);
      }
  
      trigger(this, event);
    };
    /**
     * An alias of {@link EventTarget#trigger}. Allows `EventTarget` to mimic
     * the standard DOM API.
     *
     * @function
     * @see {@link EventTarget#trigger}
     */
  
  
    EventTarget.prototype.dispatchEvent = EventTarget.prototype.trigger;
    var EVENT_MAP;
  
    EventTarget.prototype.queueTrigger = function (event) {
      var _this = this;
  
      // only set up EVENT_MAP if it'll be used
      if (!EVENT_MAP) {
        EVENT_MAP = new Map();
      }
  
      var type = event.type || event;
      var map = EVENT_MAP.get(this);
  
      if (!map) {
        map = new Map();
        EVENT_MAP.set(this, map);
      }
  
      var oldTimeout = map.get(type);
      map.delete(type);
      window$1.clearTimeout(oldTimeout);
      var timeout = window$1.setTimeout(function () {
        // if we cleared out all timeouts for the current target, delete its map
        if (map.size === 0) {
          map = null;
          EVENT_MAP.delete(_this);
        }
  
        _this.trigger(event);
      }, 0);
      map.set(type, timeout);
    };
  
    /**
     * @file mixins/evented.js
     * @module evented
     */
    /**
     * Returns whether or not an object has had the evented mixin applied.
     *
     * @param  {Object} object
     *         An object to test.
     *
     * @return {boolean}
     *         Whether or not the object appears to be evented.
     */
  
    var isEvented = function isEvented(object) {
      return object instanceof EventTarget || !!object.eventBusEl_ && ['on', 'one', 'off', 'trigger'].every(function (k) {
        return typeof object[k] === 'function';
      });
    };
    /**
     * Adds a callback to run after the evented mixin applied.
     *
     * @param  {Object} object
     *         An object to Add
     * @param  {Function} callback
     *         The callback to run.
     */
  
  
    var addEventedCallback = function addEventedCallback(target, callback) {
      if (isEvented(target)) {
        callback();
      } else {
        if (!target.eventedCallbacks) {
          target.eventedCallbacks = [];
        }
  
        target.eventedCallbacks.push(callback);
      }
    };
    /**
     * Whether a value is a valid event type - non-empty string or array.
     *
     * @private
     * @param  {string|Array} type
     *         The type value to test.
     *
     * @return {boolean}
     *         Whether or not the type is a valid event type.
     */
  
  
    var isValidEventType = function isValidEventType(type) {
      return (// The regex here verifies that the `type` contains at least one non-
        // whitespace character.
        typeof type === 'string' && /\S/.test(type) || Array.isArray(type) && !!type.length
      );
    };
    /**
     * Validates a value to determine if it is a valid event target. Throws if not.
     *
     * @private
     * @throws {Error}
     *         If the target does not appear to be a valid event target.
     *
     * @param  {Object} target
     *         The object to test.
     */
  
  
    var validateTarget = function validateTarget(target) {
      if (!target.nodeName && !isEvented(target)) {
        throw new Error('Invalid target; must be a DOM node or evented object.');
      }
    };
    /**
     * Validates a value to determine if it is a valid event target. Throws if not.
     *
     * @private
     * @throws {Error}
     *         If the type does not appear to be a valid event type.
     *
     * @param  {string|Array} type
     *         The type to test.
     */
  
  
    var validateEventType = function validateEventType(type) {
      if (!isValidEventType(type)) {
        throw new Error('Invalid event type; must be a non-empty string or array.');
      }
    };
    /**
     * Validates a value to determine if it is a valid listener. Throws if not.
     *
     * @private
     * @throws {Error}
     *         If the listener is not a function.
     *
     * @param  {Function} listener
     *         The listener to test.
     */
  
  
    var validateListener = function validateListener(listener) {
      if (typeof listener !== 'function') {
        throw new Error('Invalid listener; must be a function.');
      }
    };
    /**
     * Takes an array of arguments given to `on()` or `one()`, validates them, and
     * normalizes them into an object.
     *
     * @private
     * @param  {Object} self
     *         The evented object on which `on()` or `one()` was called. This
     *         object will be bound as the `this` value for the listener.
     *
     * @param  {Array} args
     *         An array of arguments passed to `on()` or `one()`.
     *
     * @return {Object}
     *         An object containing useful values for `on()` or `one()` calls.
     */
  
  
    var normalizeListenArgs = function normalizeListenArgs(self, args) {
      // If the number of arguments is less than 3, the target is always the
      // evented object itself.
      var isTargetingSelf = args.length < 3 || args[0] === self || args[0] === self.eventBusEl_;
      var target;
      var type;
      var listener;
  
      if (isTargetingSelf) {
        target = self.eventBusEl_; // Deal with cases where we got 3 arguments, but we are still listening to
        // the evented object itself.
  
        if (args.length >= 3) {
          args.shift();
        }
  
        type = args[0];
        listener = args[1];
      } else {
        target = args[0];
        type = args[1];
        listener = args[2];
      }
  
      validateTarget(target);
      validateEventType(type);
      validateListener(listener);
      listener = bind(self, listener);
      return {
        isTargetingSelf: isTargetingSelf,
        target: target,
        type: type,
        listener: listener
      };
    };
    /**
     * Adds the listener to the event type(s) on the target, normalizing for
     * the type of target.
     *
     * @private
     * @param  {Element|Object} target
     *         A DOM node or evented object.
     *
     * @param  {string} method
     *         The event binding method to use ("on" or "one").
     *
     * @param  {string|Array} type
     *         One or more event type(s).
     *
     * @param  {Function} listener
     *         A listener function.
     */
  
  
    var listen = function listen(target, method, type, listener) {
      validateTarget(target);
  
      if (target.nodeName) {
        Events[method](target, type, listener);
      } else {
        target[method](type, listener);
      }
    };
    /**
     * Contains methods that provide event capabilities to an object which is passed
     * to {@link module:evented|evented}.
     *
     * @mixin EventedMixin
     */
  
  
    var EventedMixin = {
      /**
       * Add a listener to an event (or events) on this object or another evented
       * object.
       *
       * @param  {string|Array|Element|Object} targetOrType
       *         If this is a string or array, it represents the event type(s)
       *         that will trigger the listener.
       *
       *         Another evented object can be passed here instead, which will
       *         cause the listener to listen for events on _that_ object.
       *
       *         In either case, the listener's `this` value will be bound to
       *         this object.
       *
       * @param  {string|Array|Function} typeOrListener
       *         If the first argument was a string or array, this should be the
       *         listener function. Otherwise, this is a string or array of event
       *         type(s).
       *
       * @param  {Function} [listener]
       *         If the first argument was another evented object, this will be
       *         the listener function.
       */
      on: function on$$1() {
        var _this = this;
  
        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
          args[_key] = arguments[_key];
        }
  
        var _normalizeListenArgs = normalizeListenArgs(this, args),
            isTargetingSelf = _normalizeListenArgs.isTargetingSelf,
            target = _normalizeListenArgs.target,
            type = _normalizeListenArgs.type,
            listener = _normalizeListenArgs.listener;
  
        listen(target, 'on', type, listener); // If this object is listening to another evented object.
  
        if (!isTargetingSelf) {
          // If this object is disposed, remove the listener.
          var removeListenerOnDispose = function removeListenerOnDispose() {
            return _this.off(target, type, listener);
          }; // Use the same function ID as the listener so we can remove it later it
          // using the ID of the original listener.
  
  
          removeListenerOnDispose.guid = listener.guid; // Add a listener to the target's dispose event as well. This ensures
          // that if the target is disposed BEFORE this object, we remove the
          // removal listener that was just added. Otherwise, we create a memory leak.
  
          var removeRemoverOnTargetDispose = function removeRemoverOnTargetDispose() {
            return _this.off('dispose', removeListenerOnDispose);
          }; // Use the same function ID as the listener so we can remove it later
          // it using the ID of the original listener.
  
  
          removeRemoverOnTargetDispose.guid = listener.guid;
          listen(this, 'on', 'dispose', removeListenerOnDispose);
          listen(target, 'on', 'dispose', removeRemoverOnTargetDispose);
        }
      },
  
      /**
       * Add a listener to an event (or events) on this object or another evented
       * object. The listener will only be called once and then removed.
       *
       * @param  {string|Array|Element|Object} targetOrType
       *         If this is a string or array, it represents the event type(s)
       *         that will trigger the listener.
       *
       *         Another evented object can be passed here instead, which will
       *         cause the listener to listen for events on _that_ object.
       *
       *         In either case, the listener's `this` value will be bound to
       *         this object.
       *
       * @param  {string|Array|Function} typeOrListener
       *         If the first argument was a string or array, this should be the
       *         listener function. Otherwise, this is a string or array of event
       *         type(s).
       *
       * @param  {Function} [listener]
       *         If the first argument was another evented object, this will be
       *         the listener function.
       */
      one: function one$$1() {
        var _this2 = this;
  
        for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
          args[_key2] = arguments[_key2];
        }
  
        var _normalizeListenArgs2 = normalizeListenArgs(this, args),
            isTargetingSelf = _normalizeListenArgs2.isTargetingSelf,
            target = _normalizeListenArgs2.target,
            type = _normalizeListenArgs2.type,
            listener = _normalizeListenArgs2.listener; // Targeting this evented object.
  
  
        if (isTargetingSelf) {
          listen(target, 'one', type, listener); // Targeting another evented object.
        } else {
          var wrapper = function wrapper() {
            _this2.off(target, type, wrapper);
  
            for (var _len3 = arguments.length, largs = new Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
              largs[_key3] = arguments[_key3];
            }
  
            listener.apply(null, largs);
          }; // Use the same function ID as the listener so we can remove it later
          // it using the ID of the original listener.
  
  
          wrapper.guid = listener.guid;
          listen(target, 'one', type, wrapper);
        }
      },
  
      /**
       * Removes listener(s) from event(s) on an evented object.
       *
       * @param  {string|Array|Element|Object} [targetOrType]
       *         If this is a string or array, it represents the event type(s).
       *
       *         Another evented object can be passed here instead, in which case
       *         ALL 3 arguments are _required_.
       *
       * @param  {string|Array|Function} [typeOrListener]
       *         If the first argument was a string or array, this may be the
       *         listener function. Otherwise, this is a string or array of event
       *         type(s).
       *
       * @param  {Function} [listener]
       *         If the first argument was another evented object, this will be
       *         the listener function; otherwise, _all_ listeners bound to the
       *         event type(s) will be removed.
       */
      off: function off$$1(targetOrType, typeOrListener, listener) {
        // Targeting this evented object.
        if (!targetOrType || isValidEventType(targetOrType)) {
          off(this.eventBusEl_, targetOrType, typeOrListener); // Targeting another evented object.
        } else {
          var target = targetOrType;
          var type = typeOrListener; // Fail fast and in a meaningful way!
  
          validateTarget(target);
          validateEventType(type);
          validateListener(listener); // Ensure there's at least a guid, even if the function hasn't been used
  
          listener = bind(this, listener); // Remove the dispose listener on this evented object, which was given
          // the same guid as the event listener in on().
  
          this.off('dispose', listener);
  
          if (target.nodeName) {
            off(target, type, listener);
            off(target, 'dispose', listener);
          } else if (isEvented(target)) {
            target.off(type, listener);
            target.off('dispose', listener);
          }
        }
      },
  
      /**
       * Fire an event on this evented object, causing its listeners to be called.
       *
       * @param   {string|Object} event
       *          An event type or an object with a type property.
       *
       * @param   {Object} [hash]
       *          An additional object to pass along to listeners.
       *
       * @return {boolean}
       *          Whether or not the default behavior was prevented.
       */
      trigger: function trigger$$1(event, hash) {
        return trigger(this.eventBusEl_, event, hash);
      }
    };
    /**
     * Applies {@link module:evented~EventedMixin|EventedMixin} to a target object.
     *
     * @param  {Object} target
     *         The object to which to add event methods.
     *
     * @param  {Object} [options={}]
     *         Options for customizing the mixin behavior.
     *
     * @param  {string} [options.eventBusKey]
     *         By default, adds a `eventBusEl_` DOM element to the target object,
     *         which is used as an event bus. If the target object already has a
     *         DOM element that should be used, pass its key here.
     *
     * @return {Object}
     *         The target object.
     */
  
    function evented(target, options) {
      if (options === void 0) {
        options = {};
      }
  
      var _options = options,
          eventBusKey = _options.eventBusKey; // Set or create the eventBusEl_.
  
      if (eventBusKey) {
        if (!target[eventBusKey].nodeName) {
          throw new Error("The eventBusKey \"" + eventBusKey + "\" does not refer to an element.");
        }
  
        target.eventBusEl_ = target[eventBusKey];
      } else {
        target.eventBusEl_ = createEl('span', {
          className: 'vjs-event-bus'
        });
      }
  
      assign(target, EventedMixin);
  
      if (target.eventedCallbacks) {
        target.eventedCallbacks.forEach(function (callback) {
          callback();
        });
      } // When any evented object is disposed, it removes all its listeners.
  
  
      target.on('dispose', function () {
        target.off();
        window$1.setTimeout(function () {
          target.eventBusEl_ = null;
        }, 0);
      });
      return target;
    }
  
    /**
     * @file mixins/stateful.js
     * @module stateful
     */
    /**
     * Contains methods that provide statefulness to an object which is passed
     * to {@link module:stateful}.
     *
     * @mixin StatefulMixin
     */
  
    var StatefulMixin = {
      /**
       * A