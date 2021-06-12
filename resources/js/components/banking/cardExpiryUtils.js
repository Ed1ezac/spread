import { default as cardUtils } from './utils.js';

const cardExpiryUtils = {
    // Adds maxlength to Expiry field
    handleExpiryAttributes: function(e){
        e.setAttribute('maxlength', 9);
    },

    //format
    formatExpiry: function (e) {
        // Only format if input is a number
        let digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) { return; }

        let target = e.currentTarget;
        let val = target.value + digit;

        if (/^\d$/.test(val) && !['0', '1'].includes(val)) {
            e.preventDefault();
            return setTimeout(() => target.value = (`0${val} / `));

        } else if (/^\d\d$/.test(val)) {
            e.preventDefault();
            return setTimeout(function () {
                // Split for months where we have the second digit > 2 (past 12) and turn
                // that into (m1)(m2) => 0(m1) / (m2)
                let m1 = parseInt(val[0], 10);
                let m2 = parseInt(val[1], 10);
                if ((m2 > 2) && (m1 !== 0)) {
                    return target.value = (`0${m1} / ${m2}`);
                } else {
                    return target.value = (`${val} / `);
                }
            });
        }
    },

    reFormatExpiry: function (e) {
        let target = e.currentTarget;
        return setTimeout(function () {
            let value = target.value;
            value = cardUtils.replaceFullWidthChars(value);
            value = cardExpiryUtils.formatFullExpiry(value);
            return cardUtils.safeVal(value, target, e);
        });
    },

    formatFullExpiry: function (expiry) {
        let parts = expiry.match(/^\D*(\d{1,2})(\D+)?(\d{1,4})?/);
        if (!parts) { return ''; }

        let mon = parts[1] || '';
        let sep = parts[2] || '';
        let year = parts[3] || '';

        if (year.length > 0) {
            sep = ' / ';
        } else if (sep === ' /') {
            mon = mon.substring(0, 1);
            sep = '';
        } else if ((mon.length === 2) || (sep.length > 0)) {
            sep = ' / ';
        } else if ((mon.length === 1) && !['0', '1'].includes(mon)) {
            mon = `0${mon}`;
            sep = ' / ';
        }
        return mon + sep + year;
    },

    formatForwardExpiry: function (e) {
        let digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) { return; }

        let target = e.currentTarget;
        let val = target.value;

        if (/^\d\d$/.test(val)) {
            return target.value = (`${val} / `);
        }
    },

    formatBackExpiry: function (e) {
        let target = e.currentTarget;
        let value = target.value;
        // Return unless backspacing
        if (e.which !== 8) { return; }
        // Return if focus isn't at the end of the text
        if ((target.selectionStart != null) &&
            (target.selectionStart !== value.length)) { return; }
        // Remove the trailing space + last digit
        if (/\d\s\/\s$/.test(value)) {
            e.preventDefault();
            return setTimeout(() => target.value = value.replace(/\d\s\/\s$/, ''));
        }
    },

    formatForwardSlashAndSpace: function (e) {
        let which = String.fromCharCode(e.which);
        if ((which !== '/') && (which !== ' ')) { return; }

        let target = e.currentTarget;
        let val = target.value;

        if (/^\d$/.test(val) && (val !== '0')) {
            return target.value = (`0${val} / `);
        }
    },

    //Restriction
    restrictExpiry: function (e) {
        let target = e.currentTarget;
        let digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) { return; }

        if (cardUtils.hasTextSelected(target)) { return; }

        let value = target.value + digit;
        value = value.replace(/\D/g, '');

        if (value.length > 6) { return false; }
    },

    //validation
    validateCardExpiry: function (month, year) {
        if(!month){return false;}
        if(!year){
            ({ month, year } = cardExpiryUtils.cardExpiryVal(month));
        }
        // Allow passing an object
        if ((typeof month === 'object') && 'month' in month) {
            ({ month, year } = month);
        }

        if (!month || !year) { return false; }

        month = month.toString().trim();
        year = year.toString().trim();

        if (!/^\d+$/.test(month)) { return false; }
        if (!/^\d+$/.test(year)) { return false; }
        if (!(1 <= month && month <= 12)) { return false; }

        if (year.length === 2) {
            if (year < 70) {
                year = `20${year}`;
            } else {
                year = `19${year}`;
            }
        }
        if (year.length !== 4) { return false; }
        let expiry = new Date(year, month);
        let currentTime = new Date;
        // Months start from 0 in JavaScript
        expiry.setMonth(expiry.getMonth() - 1);
        // The cc expires at the end of the month,
        // so we need to make the expiry the first day
        // of the month after
        expiry.setMonth(expiry.getMonth() + 1, 1);

        return expiry > currentTime;
    },

    cardExpiryVal: function (value) {
        let [month, year] = Array.from(value.split(/[\s\/]+/, 2));
        // Allow for year shortcut
        if (((year != null ? year.length : undefined) === 2) && /^\d+$/.test(year)) {
            let prefix = (new Date).getFullYear();
            prefix = prefix.toString().slice(0, 2);
            year = prefix + year;
        }

        month = parseInt(month, 10);
        year = parseInt(year, 10);

        return { month, year };
    },
}
export default cardExpiryUtils;