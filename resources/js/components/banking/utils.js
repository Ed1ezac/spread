import { default as cards } from './cards.js';

const cardUtils = {
    //core
    safeVal: function (value, target, e) {
        if (e.inputType === 'deleteContentBackward') {
          return;
        }
        let cursor;
        try {
            cursor = target.selectionStart;
        } catch (error) {
            cursor = null;
        }
        let last = target.value;
        target.value = value;
        value = target.value;
        if ((cursor !== null) && document.activeElement == target) {
            if (cursor === last.length) { cursor = target.value.length; }
            //Magic code below
            //visit: https://github.com/wuori/vue-credit-card-validation/blob/master/src/utils.js
            //for more info
            if (last !== value) {
                let prevPair = last.slice(cursor - 1, +cursor + 1 || undefined);
                let currPair = target.value.slice(cursor - 1, +cursor + 1 || undefined);
                let digit = value[cursor];
                if (/\d/.test(digit) &&
                    (prevPair === `${digit} `) && (currPair === ` ${digit}`)) { cursor = cursor + 1; }
            }
            target.selectionStart = cursor;
            return target.selectionEnd = cursor;
        }
    },

    luhnCheck: function (num) {
        let odd = true;
        let sum = 0;

        let digits = (num + '').split('').reverse();

        for (let i in digits) {
            let digit = parseInt(digits[i], 10);
            if (odd = !odd) { digit *= 2; }
            if (digit > 9) { digit -= 9; }
            sum += digit;
        }
        return (sum % 10) === 0;
    },

    hasTextSelected: function (target) {
        // If some text is selected
        if ((target.selectionStart != null) &&
            (target.selectionStart !== target.selectionEnd)) { return true; }
        // If some text is selected in IE
        if (cardUtils.__guard__(typeof document !== 'undefined' && document !== null ? document.selection : undefined, x => x.createRange) != null) {
            if (document.selection.createRange().text) { return true; }
        }
        return false;
    },
    
    replaceFullWidthChars: function (str) {
        if (str == null) { str = ''; }
        let fullWidth = '\uff10\uff11\uff12\uff13\uff14\uff15\uff16\uff17\uff18\uff19';
        let halfWidth = '0123456789';

        let value = '';
        let chars = str.split('');

        // Avoid using reserved word `char`
        for (let i in chars) {
            let idx = fullWidth.indexOf(chars[i]);
            if (idx > -1) { 
                chars[i] = halfWidth[idx]; 
            }
            value += chars[i];
        }
        return value;
    },

    cardFromNumber : function (num) {
        num = (num + '').replace(/\D/g, '');
        for (let i in cards) {
            for (let j in cards[i].patterns) {
                let p = cards[i].patterns[j] + '';
                if (num.substr(0, p.length) === p) { return cards[i]; }
            }
        }
    },

    cardFromType: function (type) {
        for (let i in cards) { if (cards[i].type === type) { return cards[i]; } }
    },

    //formatting
    reFormatNumeric: function (e) {
        let target = e.currentTarget;
        return setTimeout(function () {
            let value = target.value;
            value = cardUtils.replaceFullWidthChars(value);
            value = value.replace(/\D/g, '');
            return cardUtils.safeVal(value, target, e);
        });
    },

     // Restrictions
     restrictNumeric: function (e) {
        // Key event is for a browser shortcut
        if (e.metaKey || e.ctrlKey) { return true; }
        // If keycode is a space
        if (e.which === 32) { return false; }
        // If keycode is a special char (WebKit)
        if (e.which === 0) { return true; }
        // If char is a special char (Firefox)
        if (e.which < 33) { return true; }

        let input = String.fromCharCode(e.which);
        // Char is a number or a space
        return (!!/[\d\s]/.test(input)) ? true : e.preventDefault();
    },

    setCardType: function (e) {
        let target = e.currentTarget;
        let val = target.value;
        let cardType = cardUtils.cardType(val) || 'unknown';

        if (target.className.indexOf(cardType) === -1) {
            
            let allTypes = [];
            for(let i in cards){
                allTypes.push(cards[i].type);
            }

            target.classList.remove('unknown');
            target.classList.remove('identified');
            target.classList.remove(... allTypes);
            target.classList.add(cardType);
            target.dataset.cardBrand = cardType;
            
            if(cardType !== 'unknown'){
                target.classList.add('identified');
            }

        }
    },

    cardType: function (num) {
        if (!num) { return null; }
        return cardUtils.__guard__(cardUtils.cardFromNumber(num), x => x.type) || null;
    },

    __guard__: function (value, transform) {
        return (typeof value !== 'undefined' && value !== null) ? transform(value) : undefined;
    }
}
export default cardUtils;