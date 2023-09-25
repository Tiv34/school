(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
        typeof define === 'function' && define.amd ? define(factory) :
            (global = global || self, global.portal = factory());
}(this, (function () {

    'use strict';

    const vueDriven = 'vue-driven';

    let navDefaults = {
        openBreakpoint: 1200,
        collapseClass: 'main-nav-collapsed',
        openClass: 'main-nav-opened',
        subCollapseClass: 'sub-nav-collapsed',
        subOpenClass: 'sub-nav-opened'
    };

    class MainNav {
        constructor(element, options) {
            if (!supports()) throw new Error('This browser does not support the required JavaScript methods and browser APIs.');
            this.element = element;
            this.options = Object.assign(navDefaults, options || {});
            this.innerWidth = window.innerWidth;
            this.trigger = this.element.querySelector('.main-nav-toggle > button');
            if (!this.trigger) return false;
            this.grid = document.body.querySelector('main.main-wrapper');
            this.windowResized();
            window.addEventListener('resize', () => this.windowResized());
            this.trigger.addEventListener('click', () => this.toggleMain());
            this.element.querySelectorAll('.sub-nav-toggle > a').forEach(el => {
                el.addEventListener('click', e => this.toggleSub(e));
            });
        }
        windowResized() {
            this.innerWidth = window.innerWidth;
            if (this.innerWidth < this.options.openBreakpoint && !this.grid.classList.contains(this.options.collapseClass))
                this.collapse();
            if (this.innerWidth >= this.options.openBreakpoint && !this.grid.classList.contains(this.options.openClass))
                this.open();
        }
        toggleMain() {
            if (this.grid.classList.contains(this.options.collapseClass)) this.open();
            else this.collapse();
        }
        open() {
            this.element.classList.remove(this.options.collapseClass);
            this.element.classList.add(this.options.openClass);
            this.grid.classList.remove(this.options.collapseClass);
            this.grid.classList.add(this.options.openClass);
        }
        collapse() {
            this.element.classList.remove(this.options.openClass);
            this.element.classList.add(this.options.collapseClass);
            this.grid.classList.remove(this.options.openClass);
            this.grid.classList.add(this.options.collapseClass);
        }
        toggleSub(e) {
            let sub = e.currentTarget.parentNode;
            if (this.grid.classList.contains(this.options.collapseClass)) {
                this.open();
                if (sub.classList.contains(this.options.subOpenClass)) {
                    e.preventDefault();
                    return false;
                }
            }
            if (sub.classList.contains(this.options.subCollapseClass)) {
                sub.classList.remove(this.options.subCollapseClass);
                sub.classList.add(this.options.subOpenClass);
            } else {
                sub.classList.remove(this.options.subOpenClass);
                sub.classList.add(this.options.subCollapseClass);
            }
            e.preventDefault();
            return false;
        }
    }

    let fieldDefaults = {
        actionClass: 'custom-input-action',
        iconClass: 'custom-input-default-icon',
    };

    class Field {
        constructor(element, options) {
            if (!supports()) throw new Error('This browser does not support the required JavaScript methods and browser APIs.');
            this.element = element;
            if (this.element.classList.contains(vueDriven)) return false;
            this.internalType = this.element.type;
            this.options = Object.assign(fieldDefaults, options || {});
            this.trigger = this.element.parentNode.querySelector('.' + this.options.actionClass);
            if (this.trigger) {
                this.trigger.addEventListener('click', e => this.click(e));
                if (this.trigger.dataset.action === 'calendar') this.internalType = 'date';
            }
            if (this.internalType === 'date') {
                this.element.type = 'text';
                this.calendar = new Calendar(this.element);
                this.element.calendar = this.calendar;
            }
        }
        click(e) {
            switch (this.trigger.dataset.action) {
                case 'reset':
                    this.element.value = '';
                    break;
                case 'password':
                    let defaultIcon = this.element.parentNode.querySelector('.' + this.options.iconClass);
                    let hrefIcon = '#icon-shown';
                    if (this.element.getAttribute('type') === 'password') {
                        this.element.setAttribute('type', 'text');
                    } else {
                        this.element.setAttribute('type', 'password');
                        hrefIcon = '#icon-hidden';
                    }
                    Field.setIcon(this.trigger, hrefIcon);
                    if (defaultIcon) Field.setIcon(defaultIcon, hrefIcon);
                    break;
                case 'calendar':
                    this.calendar.toggle();
                    break;
            }
        }
        static setIcon(el, icon) {
            el.querySelector('use').setAttribute('href', icon);
        }
    }

    let calendarOptions = {
        containerClass: 'custom-input-calendar-container',
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        days: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        periodSeparator: '->',
    };

    class Calendar {
        constructor(el) {
            this.element = el;
            this.type = ('type' in this.element.dataset) ? this.element.dataset.type : 'date';
            this.length = ('length' in this.element.dataset) ? parseInt(this.element.dataset.length) : 0;
            this.nofuture = 'nofuture' in this.element.dataset;
            this.date = new Date();
            this.today = {
                year: this.date.getFullYear(),
                month: this.date.getMonth(),
                day: this.date.getDate(),
            };
            this.parseInput();
            this.controls = {};
            this.renderContainers();
            this.setValues();
            if (this.type === 'month') {
                this.changeMode('month');
                this.renderYear();
            } else {
                this.changeMode('day');
                this.renderMonth();
            }
            if ('opened' in this.element.dataset) this.toggle();
            this.observer = new MutationObserver(ms => this.observe(ms));
            this.observer.observe(this.view, {attributes: true});
        }
        observe(mutations) {
            for (let m of mutations) {
                if (m.type === 'attributes' && m.attributeName === 'disabled') this.reset();
            }
        }
        reset() {
            if (!this.dropdown.classList.contains('hide')) this.dropdown.classList.add('hide');
            this.start = Object.assign({}, this.today);
            this.start.day = 0;
            this.start.selected = false;
            this.end = Object.assign({}, this.today);
            this.end.day = 0;
            this.end.selected = false;
            this.view.value = '';
            this.element.value = '';
            if (this.type === 'month') this.renderYear();
            else this.renderMonth();
        }
        parseInput() {
            let times = this.element.value.split(calendarOptions.periodSeparator);
            let ts = Date.parse(times[0]);
            if (isNaN(ts)) {
                this.start = Object.assign({}, this.today);
                this.start.day = 0;
                this.start.selected = false;
                this.setCurrent(this.date);
            } else {
                let s = new Date(ts);
                this.start = {
                    year: s.getFullYear(),
                    month: s.getMonth(),
                    day: s.getDate(),
                    selected: true,
                };
                this.current = Object.assign({}, this.start);
            }
            if (this.start.selected) {
                if (this.type === 'week') {
                    let p = this.getWeek(this.current);
                    this.start = {
                        year: p[0].getFullYear(),
                        month: p[0].getMonth(),
                        day: p[0].getDate(),
                        selected: true,
                    };
                    this.end = {
                        year: p[1].getFullYear(),
                        month: p[1].getMonth(),
                        day: p[1].getDate(),
                        selected: true,
                    };
                    return;
                } else if (this.type === '7days' || this.type === '30days') {
                    let s = new Date(ts),
                        add = (this.type === '7days') ? 6 : 29;
                    s.setDate(s.getDate() + add);
                    this.end = {
                        year: s.getFullYear(),
                        month: s.getMonth(),
                        day: s.getDate(),
                        selected: true,
                    };
                    return;
                }

            }
            if (times.length > 1) {
                let te = Date.parse(times[1]);
                if (isNaN(te)) {
                    this.end = Object.assign({}, this.today);
                    this.end.day = 0;
                    this.end.selected = false;
                } else {
                    let s = new Date(te);
                    this.end = {
                        year: s.getFullYear(),
                        month: s.getMonth(),
                        day: s.getDate(),
                        selected: true,
                    };
                }
            } else {
                this.end = {
                    year: 0,
                    month: 0,
                    day: 0,
                    selected: false,
                };
            }
        }
        renderContainers() {
            let v = document.createElement('input');
            v.type = 'text';
            v.classList = this.element.classList;
            this.element.type = 'hidden';
            this.element.classList.remove('custom-input');
            this.view = this.element.insertAdjacentElement('afterend', v);
            this.view.placeholder = ' ';
            this.view.setAttribute('readonly', true);
            this.view.addEventListener('change', e => this.validate(e));
            this.view.addEventListener('keyup', e => this.validate(e));
            let dc = document.createElement('div');
            dc.classList.add(calendarOptions.containerClass);
            dc.classList.add('hide');
            this.dropdown = this.element.parentNode.appendChild(dc);
            this.nav = this.renderNav();
            this.dropdown.appendChild(this.nav);
            let cb = document.createElement('div');
            cb.classList.add('calendar-body');
            this.body = this.dropdown.appendChild(cb);
            this.body.addEventListener('click', e => this.clickBody(e));
        }
        renderYears() {
            this.clearBody();
            let dt = document.createElement('ul');
            dt.classList.add('years');
            for (let i = this.current.year - 7; i <= this.current.year + 10; i++) {
                let y = document.createElement('li');
                y.dataset.y = i;
                y.textContent = i;
                if (i === this.current.year) y.classList.add('active');
                dt.appendChild(y);
            }
            this.body.appendChild(dt);
        }
        renderYear() {
            this.clearBody();
            let dt = document.createElement('ul');
            dt.classList.add('months');
            calendarOptions.months.forEach((m, i) => {
                let mon = document.createElement('li');
                mon.dataset.m = i;
                mon.textContent = window.T(m);
                if (this.type === 'month') {
                    if (this.start.selected
                        && i === this.start.month
                        && this.current.year === this.start.year) {
                        mon.classList.add('active');
                    }
                    if (i === this.today.month && this.current.year === this.today.year) mon.classList.add('current');
                } else if (i === this.current.month) mon.classList.add('active');
                dt.appendChild(mon);
            });
            this.body.appendChild(dt);
        }
        renderMonth() {
            this.clearBody();
            let dd = document.createElement('ul');
            dd.classList.add('days');
            calendarOptions.days.forEach(item => {
                let day = document.createElement('li');
                day.textContent = window.T(item);
                dd.appendChild(day);
            });
            this.body.appendChild(dd);
            let offset = this.getDaysOffset(),
                dim = this.daysInMonth(),
                days = [],
                dates = document.createElement('ul');
            dates.classList.add('dates');
            for (let i = 1; i <= dim; i++) {
                let d = this.renderDay(i);
                if (i === 1) d.style.gridColumnStart = offset.toString();
                dates.appendChild(d);
            }
            this.body.appendChild(dates);
        }
        renderDay(day) {
            let d = document.createElement('li');
            d.dataset.d = day;
            d.textContent = day;
            if (day === this.start.day
                && this.current.month === this.start.month
                && this.current.year === this.start.year) {
                d.classList.add('active');
                if (['period', 'week', '7days', '30days'].includes(this.type)) d.classList.add('range-start');
            }
            if (day === this.end.day
                && this.current.month === this.end.month
                && this.current.year === this.end.year) {
                d.classList.add('active');
                if (['period', 'week', '7days', '30days'].includes(this.type)) d.classList.add('range-end');
            }
            if (day === this.today.day
                && this.current.month === this.today.month
                && this.current.year === this.today.year) d.classList.add('current');
            if (this.inRange(day)) d.classList.add('in-range');
            if (this.outRange(day)) d.classList.add('out-range');
            return d;
        }
        renderNav() {
            let cn = document.createElement('div');
            cn.classList.add('calendar-nav');
            let prev = document.createElement('span');
            prev.appendChild(renderIcon('left'));
            prev.classList.add('scroll');
            this.controls.prev = cn.appendChild(prev);
            this.controls.prev.addEventListener('click', e => this.clickControl(e, 'prev'));
            let cs = document.createElement('div');
            cs.classList.add('calendar-controls');
            cn.appendChild(cs);
            let month = document.createElement('span');
            month.textContent = window.T(calendarOptions.months[this.current.month]);
            month.classList.add('month');
            this.controls.month = cs.appendChild(month);
            this.controls.month.addEventListener('click', e => this.clickControl(e, 'month'));
            let year = document.createElement('span');
            year.textContent = this.current.year;
            year.classList.add('year');
            this.controls.year = cs.appendChild(year);
            this.controls.year.addEventListener('click', e => this.clickControl(e, 'year'));
            let next = document.createElement('span');
            next.appendChild(renderIcon('right'));
            next.classList.add('scroll');
            this.controls.next = cn.appendChild(next);
            this.controls.next.addEventListener('click', e => this.clickControl(e, 'next'));
            return cn;
        }
        clickControl(e, which) {
            switch(which) {
                case 'next':
                    if (this.mode !== 'day') return;
                    let nd = new Date(this.current.year, this.current.month + 1, this.current.day);
                    this.setCurrent(nd);
                    this.clearBody();
                    this.renderMonth();
                    break;
                case 'prev':
                    if (this.mode !== 'day') return;
                    let pd = new Date(this.current.year, this.current.month - 1, this.current.day);
                    this.setCurrent(pd)
                    this.clearBody();
                    this.renderMonth();
                    break;
                case 'month':
                    this.changeMode('month');
                    this.renderYear();
                    break;
                case 'year':
                    this.changeMode('year');
                    this.renderYears();
                    break;
            }
            this.updateControls();
            console.log(which);
        }
        inRange(day) {
            if (this.end.day === 0) return false;
            return Calendar.getTime(this.start) < Calendar.getTime(this.current, day)
                && Calendar.getTime(this.end) > Calendar.getTime(this.current, day);
        }
        outRange(day) {
            if (this.nofuture && Calendar.getTime(this.current, day) > Calendar.getTime(this.today)) return true;
            if (this.type !== 'period' || !this.start.selected || this.length === 0 ) return false;
            return Calendar.getTime(this.start, this.start.day + this.length - 1) < Calendar.getTime(this.current, day);
        }
        changeMode(mode) {
            if (this.mode !== 'undefined') this.nav.classList.remove('mode-' + this.mode);
            this.mode = mode;
            this.nav.classList.add('mode-' + this.mode);
        }
        setType(type) {
            if (!this.dropdown.classList.contains('hide')) this.dropdown.classList.add('hide');
            this.type = type;
            this.setDate(false);
            if (this.type === 'month') this.renderYear();
            else this.renderMonth();
        }
        updateControls() {
            this.controls.month.textContent = window.T(calendarOptions.months[this.current.month]);
            this.controls.year.textContent = this.current.year;
        }
        clearBody() {
            while(this.body.hasChildNodes()) this.body.removeChild(this.body.firstChild);
        }
        setDate(toggle) {
            switch (this.type) {
                case 'period':
                    if (!this.start.selected || Calendar.getTime(this.current) < Calendar.getTime(this.start)) {
                        this.start = Object.assign({}, this.current);
                        this.start.selected = true;
                    } else {
                        if (Calendar.getTime(this.current) === Calendar.getTime(this.start)) {
                            this.start.day = 0;
                            this.start.selected = false;
                            this.end.day = 0;
                            this.end.selected = false;
                            this.renderMonth();
                        } else {
                            this.end = Object.assign({}, this.current);
                            this.end.selected = true;
                        }
                    }
                    if (!this.end.selected) toggle = false;
                    break;
                case 'date':
                    this.start = Object.assign({}, this.current);
                    this.start.selected = true;
                    break;
                case 'week':
                    let p = this.getWeek(this.current);
                    this.start = {
                        year: p[0].getFullYear(),
                        month: p[0].getMonth(),
                        day: p[0].getDate(),
                        selected: true,
                    };
                    this.end = {
                        year: p[1].getFullYear(),
                        month: p[1].getMonth(),
                        day: p[1].getDate(),
                        selected: true,
                    };
                    break;
                case '7days':
                case '30days':
                    this.start = Object.assign({}, this.current);
                    this.start.selected = true;
                    let s = new Date(this.start.year, this.start.month, this.start.day),
                        add = (this.type === '7days') ? 6 : 29;
                    s.setDate(s.getDate() + add);
                    this.end = {
                        year: s.getFullYear(),
                        month: s.getMonth(),
                        day: s.getDate(),
                        selected: true,
                    };
                    break;
                case 'month':
                    this.start = Object.assign({}, this.current);
                    this.start.day = 1;
                    this.start.selected = true;
                    break;
            }
            this.setValues();
            if (toggle) this.toggle();
        }
        setValues() {
            switch (this.type) {
                case 'period':
                case 'week':
                case '7days':
                case '30days':
                    if (this.start.selected) {
                        this.view.value = Calendar.formatView(this.start) + ' - ';
                        if (this.end.selected) {
                            this.view.value += Calendar.formatView(this.end);
                            this.element.value = Calendar.formatInput(this.start) + calendarOptions.periodSeparator
                                + Calendar.formatInput(this.end);
                        }
                    } else {
                        this.view.value = '';
                        this.element.value = '';
                    }
                    break;
                case 'date':
                    if (this.start.selected) {
                        this.element.value = Calendar.formatInput(this.start);
                        this.view.value = Calendar.formatView(this.start);
                    }
                    break;
                case 'month':
                    if (this.start.selected) {
                        this.element.value = Calendar.formatInput(this.start);
                        this.view.value = window.T(calendarOptions.months[this.start.month]) + ' ' + this.start.year;
                    }
                    break;
            }
        }
        validate(e) {
            e.preventDefault();
            /** TODO User input validate
            console.log(e);
            console.log(this.view.value);
            **/
        }
        clickBody(e) {
            let t = e.target;
            switch (this.mode) {
                case 'day':
                    if ('d' in t.dataset) {
                        let d = parseInt(t.dataset.d);
                        if (this.outRange(d)) return;
                        this.current.day = d;
                        this.setDate(true);
                        this.renderMonth();
                    }
                    break;
                case 'month':
                    if ('m' in t.dataset) {
                        this.current.month = parseInt(t.dataset.m);
                        if (this.type === 'month') {
                            this.setDate(true);
                            this.updateControls();
                            this.renderYear();
                        } else {
                            this.changeMode('day');
                            this.updateControls();
                            this.renderMonth();
                        }
                    }
                    break;
                case 'year':
                    if ('y' in t.dataset) {
                        this.current.year = parseInt(t.dataset.y);
                        this.changeMode('month');
                        this.updateControls();
                        this.renderYear();
                    }
                    break;
            }
        }
        setCurrent(d) {
            this.current = {
                year: d.getFullYear(),
                month: d.getMonth(),
                day: d.getDate(),
            }
        }
        getWeek(obj) {
            let dt = new Date(obj.year, obj.month, obj.day),
                d = dt.getDay() || 7;
            return [new Date(obj.year, obj.month, obj.day + (1 - d)), new Date(obj.year, obj.month, obj.day - d + 7)];
        }
        daysInMonth() {
            return new Date(this.current.year, this.current.month + 1, 0).getDate();
        }
        getDaysOffset() {
            let fd = new Date(this.current.year, this.current.month, 1).getDay();
            if (fd === 0) return 7;
            return fd;
        }
        toggle() {
            if (this.dropdown.classList.contains('hide')) this.dropdown.classList.remove('hide');
            else this.dropdown.classList.add('hide');
        }
        static formatView(obj) {
            let d = obj.day < 10 ? '0' + obj.day : obj.day;
            let m = obj.month < 9 ? '0' + (obj.month + 1) : (obj.month + 1);
            return d + '.' + m + '.' + obj.year;
        }
        static formatInput(obj) {
            let d = obj.day < 10 ? '0' + obj.day : obj.day;
            let m = obj.month < 9 ? '0' + (obj.month + 1) : (obj.month + 1);
            return obj.year + '-' + m + '-' + d;
        }
        static getTime(obj, day) {
            let d = day || obj.day,
                dt = new Date(obj.year, obj.month, d);
            return dt.getTime();
        }
    }

    let selectDefaults = {
        ghostClass: 'custom-select-ghost',
        inputClass: 'custom-select-input',
        dropdownClass: 'custom-select-dropdown',
        dropdownSwitch: 'dropdown-opened',
        autocomplete: 'custom-select-autocomplete',
        resetClass: 'custom-select-action',
        editable: false,
    };

    class Select {
        constructor(element, options) {
            if (!supports()) throw new Error('This browser does not support the required JavaScript methods and browser APIs.');
            this.element = element;
            if (this.element.classList.contains(vueDriven)) return false;
            this.options = Object.assign(selectDefaults, options || {});
            this.init();
        }
        init() {
            this.multiple = this.element.multiple;
            this.focused = null;
            this.reset = null;
            this.search = '';
            if (this.element.classList.contains(this.options.autocomplete)) {
                this.options.editable = true;
                this.autocomplete = true;
                this.multiple = false;
            } else {
                this.autocomplete = false;
            }
            this.element.classList.add(this.options.ghostClass);
            this.container = this.element.parentNode;
            this.label = this.element.nextElementSibling;
            let fi = document.createElement('div');
            fi.classList.add(this.options.inputClass);
            fi.spellcheck = false;
            this.input = this.element.insertAdjacentElement('afterend', fi);
            if (this.options.editable) this.input.contentEditable = 'true';
            if (this.element.disabled) this.input.classList.add('disabled');
            if (this.autocomplete) {
                this.input.classList.add(this.options.autocomplete);
                this.reset = document.createElement('span');
                this.reset.classList.add(this.options.resetClass);
                this.reset.appendChild(renderIcon('close'));
                this.container.appendChild(this.reset);
                this.reset.addEventListener('click', e => this.resetClick(e));
            }
            this.observer = new MutationObserver(ms => this.observe(ms));
            this.observer.observe(this.element, {attributes: true});
            this.input.addEventListener('click', e => this.inputClick(e));
            this.input.addEventListener('blur', e => this.inputBlur(e));
            this.input.addEventListener('keydown', e => this.filterInput(e));
            this.input.addEventListener('keyup', e => this.updateList(e));
            let dc = document.createElement('div');
            dc.classList.add(this.options.dropdownClass);
            this.dropdown = this.input.insertAdjacentElement('afterend', dc);
            this.list = document.createElement('ul');
            this.dropdown.appendChild(this.list);
            this.list.addEventListener('click', e => this.selectOption(e));
            document.addEventListener('mouseup', e => this.hideDropdown(e));
            this.hasEmpty = false;
            this.opts = new Map();
            this.selected = [];
            Array.from(this.element.options).forEach((el, index) => {
                if (!el.hasAttribute('value')) {
                    this.hasEmpty = true;
                    return true;
                }
                let op = {
                    index: index,
                    value: el.value,
                    name: el.text,
                    label: el.hasAttribute('label') ? el.label : '',
                    selected: el.selected,
                };
                this.opts.set(String(el.value), op);
                if (op.selected) this.selected.push(String(el.value));
            });
            this.fillDropdown();
            this.displaySelected(false);
        }
        observe(mutations) {
            for (let m of mutations) {
                if (m.type === 'attributes' && m.attributeName === 'disabled') {
                    if (this.element.disabled) this.input.classList.add('disabled');
                    else this.input.classList.remove('disabled');
                }
            }
        }
        displaySelected(caret = true) {
            this.search = '';
            this.focused = null;
            while(this.input.firstChild) this.input.removeChild(this.input.firstChild);
            this.selected.forEach(item => {
                if (this.opts.has(item)) {
                    let s = this.opts.get(item);
                    this.input.innerText = s.name;
                }
            });
            if (this.options.editable && this.input.hasChildNodes() && caret) {
                let range = document.createRange();
                range.selectNodeContents(this.input);
                range.collapse(false);
                let selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
            }
        }
        fillDropdown() {
            while(this.list.firstChild) this.list.removeChild(this.list.firstChild);
            for (let [key, value] of this.opts) {
                let index = -1;
                if (this.autocomplete && this.search) {
                    index = value.name.toLowerCase().indexOf(this.search.trim().toLowerCase());
                    if (index === -1) continue;
                }
                let op = document.createElement('li');
                op.dataset.key = key;
                if (value.selected) {
                    op.selected = true;
                    op.classList.add('selected');
                }
                if (index >= 0) {
                    if (index > 0) op.appendChild(document.createTextNode(value.name.substring(0, index)));
                    let hl = document.createElement('em'),
                        end = index + this.search.length;
                    hl.innerText = value.name.substring(index, end);
                    op.appendChild(hl);
                    op.appendChild(document.createTextNode(value.name.substring(end)));
                } else op.innerText = value.name;
                if (value.label) {
                    let lb = document.createElement('span');
                    lb.innerText = value.label
                    op.appendChild(lb);
                }
                this.list.appendChild(op);
            }
            if (!this.list.hasChildNodes()) {
                let op = document.createElement('li');
                op.classList.add('no-options');
                op.innerText = window.T('No options');
                this.list.appendChild(op);
            }
        }
        hideDropdown(e) {
            if (!this.input.classList.contains(this.options.dropdownSwitch) || e.target === this.input) return false;
            if (this.dropdown !== e.target) {
                this.input.classList.remove(this.options.dropdownSwitch);
                e.stopPropagation();
                this.displaySelected();
            }
        }
        selectOption(e) {
            let el = e.target.tagName === 'LI' ? e.target : e.target.parentNode,
                val = String(el.dataset.key);
            if (this.opts.has(val)) {
                while (this.selected.length > 0) { // Single mode
                    let old = String(this.selected.shift());
                    if (this.opts.has(old)) {
                        let o = this.opts.get(old);
                        o.selected = false;
                    }
                }
                let o = this.opts.get(val);
                o.selected = true;
                if (this.element.value !== val) {
                    this.element.value = val;
                    this.element.dispatchEvent(new Event('change'));
                }
                this.selected.push(val);
            }
            this.input.classList.remove(this.options.dropdownSwitch);
            this.displaySelected();
            this.input.focus();
        }
        deselect() {
            this.selected = [];
            for (let [key, value] of this.opts) {
                value.selected = false;
            }
            this.element.value = '';
            this.element.dispatchEvent(new Event('change'));
            this.fillDropdown();
        }
        resetClick(e) {
            e.stopPropagation();
            this.search = '';
            this.input.textContent = '';
            this.deselect();
            this.focused = null;
            this.input.focus();
        }
        inputClick(e) {
            if (this.isDisabled() && !this.input.classList.contains(this.options.dropdownSwitch)) {
                e.preventDefault();
                return false;
            }
            e.stopPropagation();
            if (!this.input.classList.contains(this.options.dropdownSwitch)) {
                this.fillDropdown();
                this.input.classList.add(this.options.dropdownSwitch);
                let fs = this.list.querySelector('.selected');
                if (fs) fs.scrollIntoView({block: 'nearest'});
            } else {
                this.input.classList.remove(this.options.dropdownSwitch);
            }
            return false;
        }
        isDisabled() {
            return this.element.disabled || this.element.matches(':disabled');
        }
        inputBlur(e) {
            this.input.childNodes.forEach((el, index) => {
                if (el.tagName === 'BR') el.parentNode.removeChild(el);
            });
        }
        filterInput(e) {
            if (e.code === 'Enter' || e.code === 'NumpadEnter') {
                e.preventDefault();
                if (this.focused) {
                    this.focused.click();
                    this.focused = null;
                }
                return;
            }
            if (e.code === 'Escape') {
                e.preventDefault();
                if (this.input.classList.contains(this.options.dropdownSwitch))
                    this.input.classList.remove(this.options.dropdownSwitch);
                return;
            }
            if (!this.input.classList.contains(this.options.dropdownSwitch))
                this.input.classList.add(this.options.dropdownSwitch);
            if (e.code === 'ArrowDown' || e.code === 'Numpad8') {
                if (!this.focused) {
                    let fl = this.list.querySelector('li');
                    if (fl) {
                        fl.classList.add('focus');
                        this.focused = fl;
                    }
                    return;
                }
                let fl = this.focused.nextElementSibling;
                if (fl) {
                    this.focused.classList.remove('focus');
                    fl.classList.add('focus');
                    this.focused = fl;
                    fl.scrollIntoView({block: 'nearest'});
                    e.preventDefault();
                }
            }
            if ((e.code === 'ArrowUp' || e.code === 'Numpad2') && this.focused) {
                let fl = this.focused.previousElementSibling;
                if (fl) {
                    this.focused.classList.remove('focus');
                    fl.classList.add('focus');
                    this.focused = fl;
                    fl.scrollIntoView({block: 'nearest'});
                    e.preventDefault();
                }
            }
        }
        updateList(e) {
            if (!this.autocomplete) return true;
            if (this.search !== this.input.textContent) {
                this.search = this.input.textContent;
                this.focused = null;
                this.fillDropdown();
            }
        }
    }

    class ColorField {
        constructor(element, options) {
            if (!supports()) throw new Error('This browser does not support the required JavaScript methods and browser APIs.');
            this.element = element;
            if (this.element.classList.contains(vueDriven)) return false;
            this.options = Object.assign(selectDefaults, options || {});
            this.label = this.element.nextElementSibling;
            if (this.label) this.init();
        }

        init() {
            this.label.style.backgroundColor = this.element.value;
            this.element.addEventListener('change', () => {this.label.style.backgroundColor = this.element.value});
        }
    }

    class Translation {
        constructor(t) {
            let trans = t || [];
            this.translations = new Map();
            trans.forEach(item => {
                this.translations.set(item[0], item[1]);
            });
        }
        translate(s) {
            if (this.translations.has(s)) return this.translations.get(s);
            return s;
        }
    }

    let generateId = function() {
        return (Date.now() + Math.random()).toString(36).replace('.', '-');
    }

    let renderIcon = function(id) {
        let svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        let use = document.createElementNS("http://www.w3.org/2000/svg", "use");
        use.setAttribute('href', '#icon-' + id);
        svg.appendChild(use);
        return svg;
    }

    let supports = function () {
        return (
            'querySelector' in document &&
            'addEventListener' in window &&
            'assign' in Object
        );
    };
    return {
        // Color: ColorField,
        // Field: Field,
        // Select: Select,
        MainNav: MainNav,
        // Translation: Translation,
    };
})));

window.addEventListener('DOMContentLoaded', event => {
    let nav = document.getElementById('main-navigation');
    if (nav) new portal.MainNav(nav);
    document.body.querySelectorAll('select.custom-select').forEach(item => {new portal.Select(item);});
    document.body.querySelectorAll('input.custom-input').forEach(item => {new portal.Field(item);});
    document.body.querySelectorAll('input.custom-color').forEach(item => {new portal.Color(item);});
});