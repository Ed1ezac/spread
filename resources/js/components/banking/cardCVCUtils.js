import { default as cardUtils } from './utils.js';

const cardCvcUtils = {

    //format
    reFormatCVC: function (e) {
        let target = e.currentTarget;
        return setTimeout(function () {
            let value = target.value;
            value = cardUtils.replaceFullWidthChars(value);
            value = value.replace(/\D/g, '').slice(0, 3);
            return cardUtils.safeVal(value, target, e);
        });
    },

    //Restriction
    restrictCVC: function (e) {
        let target = e.currentTarget;
        let digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) { return; }

        if (cardUtils.hasTextSelected(target)) { return; }

        let val = target.value + digit;
        return val.length == 3;//<= 4
    },

    //validation
    validateCardCVC: function (cvc, type) {
        if(!cvc){
            return false;
        }
        cvc = cvc.toString().trim();
        if (!/^\d+$/.test(cvc)) { return false; }  

        let card = cardUtils.cardFromType(type);
        if (card != null) {
            // Check against a explicit card type
            return Array.from(card.cvcLength).includes(cvc.length);
        } else {
            //Check against all types
            return (cvc.length == 3); //&& (cvc.length <= 4);
        }
    },
}

export default cardCvcUtils;