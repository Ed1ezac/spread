import { default as cardUtils } from './utils.js';

const cardNumberUtils = {

    reFormatCardNumber: function (e) {
        let target = e.currentTarget;
        return setTimeout(() => {
            let value = target.value;
            value = cardUtils.replaceFullWidthChars(value);
            value = cardNumberUtils.formatFullCardNumber(value);
            return cardUtils.safeVal(value, target, e);
        });
    },

    formatCardNumber: function (e) {
        // Only format if input is a number
        let re;
        let digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) { return; }

        let target = e.currentTarget;
        let value = target.value;
        let card = cardUtils.cardFromNumber(value + digit);
        let length = (value.replace(/\D/g, '') + digit);

        let upperLength = 16;
        if (card) { upperLength = card.length[card.length.length - 1]; }
        if (length >= upperLength) { return; }

        // Return if focus isn't at the end of the text
        if ((target.selectionStart != null) &&
            (target.selectionStart !== value.length)) { return; }

        if (card){
            re = /(?:^|\s)(\d{4})$/;
        }

        // If '4242' + 4
        if (re.test(value + digit)) {
            e.preventDefault();
            return setTimeout(() => target.value = value + ' ' + digit);
            // If '424' + 2
        } else if (re.test(value + digit)) {
            e.preventDefault();
            return setTimeout(() => target.value = value + digit + ' ');
        }
    },

    formatBackCardNumber: function (e) {
        let target = e.currentTarget;
        let value = target.value;
        // Return unless backspacing
        if (e.which !== 8) { return; }
        // Return if focus isn't at the end of the text
        if ((target.selectionStart != null) &&
            (target.selectionStart !== value.length)) { return; }

        // Remove the digit + trailing space
        if (/\d\s$/.test(value)) {
            e.preventDefault();
            return setTimeout(() => target.value = value.replace(/\d\s$/, ''));
            // Remove digit if ends in space + digit
        } else if (/\s\d?$/.test(value)) {
            e.preventDefault();
            return setTimeout(() => target.value = value.replace(/\d$/, ''));
        }
    },

    formatFullCardNumber: function (num) {
        num = num.toString().replace(/\D/g, '');
        let card = cardUtils.cardFromNumber(num);
        if (!card) { return num; }

        let upperLength = card.length[card.length.length - 1];
        num = num.slice(0, upperLength);

        if (card.format.global) {
            return cardUtils.__guard__(num.match(card.format), x => x.join(' '));
        } else {
            let groups = card.format.exec(num);
            if (groups == null) { return; }
            groups.shift();
            // @TODO: Change to native filter()
            //groups = grep(groups, n => n); // Filter empty groups
            return groups.join(' ');
        }
    },

    //Restrictions
    restrictCardNumber: function (e) {
        let target = e.currentTarget;
        let digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) { return; }
        if (cardUtils.hasTextSelected(target)) { return; }
        // Restrict number of digits
        let value = (target.value + digit).replace(/\D/g, '');
        let card = cardUtils.cardFromNumber(value);

        if (card) {
            return value.length <= card.length[card.length.length - 1];
        } else {
            // All other cards are 16 digits long
            return value.length <= 16;
        }
    },

    //validation
    validateCardNumber: function (num) {
        num = (num + '').replace(/\s+|-/g, '');
        if (!/^\d+$/.test(num)) { return false; }

        let card = cardUtils.cardFromNumber(num);
        if (!card) { return false; }

        return Array.from(card.length).includes(num.length) &&
            ((card.luhn === false) || cardUtils.luhnCheck(num));
    },
}

export default cardNumberUtils;