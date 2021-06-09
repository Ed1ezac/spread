<template>
    <div class="ml-4 mt-4 flex flex-wrap">
    <div class="w-96 pr-2">
        <form ref="purchaseForm" action="/funds/buy" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <!--Details-->
            <div class="space-y-8">
                <!---SMS-->
                <div class="mt-3">
                    <input type="tel" name="quantity" v-model="quantity" @input="restrictQuantity" maxlength="8" placeholder="SMS Quantinty" required 
                    class="w-full font-bold my-form-input"
                    :class="validationErrors.length >0 ?'bg-red-200 border-red-400 focus:ring-red-400':''">
                    <input type="hidden" name="cost" v-model="totalCost"/>
                    <div v-if="validationErrors.length > 0">
                        <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                            <strong>{{ validationErrors[0] }}</strong>
                        </span>
                    </div>
                </div>
                <!--Full Name--->
                <div>
                    <input type="text" name="names" id="names" autocomplete="names" placeholder="Card Holder" required class="w-full font-bold my-form-input">
                </div>
                <!---Card Details-->
                <div class="mt-3">
                    <div class="mt-1 relative rounded">
                        <input 
                            v-model="cardNumber"
                            v-card-number
                            type="tel"
                            required
                            maxlength="19"
                            name="card-number" id="card-number"            
                            class="w-full font-bold pr-12 my-form-input"
                            :class="cardErrors.length >0 ?'bg-red-200 border-red-400 focus:ring-red-400':''"
                            autocomplete="off" placeholder="Card Number">
                        <div class="absolute inset-y-0 flex right-0">
                            <input 
                                ref="expiryField" 
                                v-card-expiry v-model="cardExpiry" 
                                maxlength="9" required name="expiry"
                                class="h-full px-1 w-20 my-form-input mt-0 font-bold border-transparent bg-transparent" placeholder="MM/YY">
                            <input 
                                ref="cvcField" name="cvc"
                                v-card-cvc v-model="cardCvc" maxlength="3" 
                                class="h-full w-14 pr-1 my-form-input mt-0 font-bold border-transparent bg-transparent" placeholder="CVC">
                        </div>
                    </div>
                    <div v-if="cardErrors.length > 0">
                        <span class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                            <strong>{{ cardErrors.join() }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <button type="submit" @click.prevent="submitForm" class="group relative w-full flex justify-center py-2 px-4 mb-3 mt-8 my-btn border-transparent bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                PURCHASE
            </button>
        </form>
    </div>
    <!--Invoice-->
    <div class="md:ml-14 ml-2">
        <div class="shadow-sm border border-gray-300 overflow-hidden w-64 rounded-md">
            <div class="p-2 bg-white">
                <div class="flex-col ml-2">
                    <h5 class="text-base text-gray-400 font-medium">Purchasing</h5>
                    <div class="divide-y divide-y-8 divide-gray-300">
                        <div class="flex-col">
                            <p class="text-gray-600 text-right text-3xl font-bold">{{ (quantity == '' || quantity === 0) ? 0 : quantity  }}<span class="text-gray-800 text-sm font-headings font-extrabold">sms</span></p>
                            <p class="text-gray-400 text-right font-headings text-base font-bold">@ P {{unitPrice}} <span class="text-gray-800 text-sm font-extrabold">/ sms</span></p>
                        </div>
                        <p class="text-gray-800 my-1 pt-2 text-right text-3xl font-bold">P {{cost}}</p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</template>
<script>
import { default as cardUtils } from './banking/utils.js';
import { default as cardCvcUtils } from './banking/cardCVCUtils.js';
import { default as cardNumberUtils } from './banking/cardNumUtils.js';
import { default as cardExpiryUtils } from './banking/cardExpiryUtils.js';
export default {
    props:{
        validationErrors: {
            type:Array,
            default:[],
        },
    },
    data () {
        return {
            quantity:'',
            totalCost: 0,
            cardNumber: '',
            cardName: '',
            cardExpiry: '',
            cardCvc: '',
            cardErrors: [],
            unitPrice: '0.20',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    computed:{
        cost: function(){
            const formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,      
                maximumFractionDigits: 2,
            });
            return this.totalCost = formatter.format(this.quantity * this.unitPrice);
        }
    },
    mounted(){
         console.log(this.validationErrors)
    },
    methods:{
        restrictQuantity(){
            this.quantity = this.quantity.replace(/[^0-9]/g,'');
        },
        submitForm: function(){
            if (this.isCardValid()) {
              this.$refs.purchaseForm.submit();
            }
        },
        isCardValid: function(){
            let isValid=true;
            this.cardErrors = [];
            if(!cardNumberUtils.validateCardNumber(this.cardNumber)){
                this.cardErrors.push("Invalid Credit Card Number");
                isValid=false;
            }
            if(!cardExpiryUtils.validateCardExpiry(this.cardExpiry)){
                this.cardErrors.push("Invalid Expiry Date");
                isValid=false;
            }
            if(!cardCvcUtils.validateCardCVC(this.cardCvc)){
                this.cardErrors.push("Invalid CVC.");
                isValid=false;
            }
            return isValid;
        }
    },
    watch:{
        cardNumber: function(val){
            if(cardNumberUtils.validateCardNumber(val)){
                this.$refs.expiryField.focus();
            }
        },
        cardExpiry: function(val){
            if(cardExpiryUtils.validateCardExpiry(val)){
                this.$refs.cvcField.focus();
            }
        }
    },
    directives: {
        'card-number':{
            created(el){
                el.addEventListener('keypress', cardUtils.restrictNumeric);
                el.addEventListener('keypress', cardNumberUtils.restrictCardNumber);
                el.addEventListener('keypress', cardNumberUtils.formatCardNumber);
                el.addEventListener('keydown', cardNumberUtils.formatBackCardNumber);
                //el.addEventListener('keyup', cardUtils.setCardType);
                el.addEventListener('paste', cardNumberUtils.reFormatCardNumber);
                el.addEventListener('change', cardNumberUtils.reFormatCardNumber);
                el.addEventListener('input', cardNumberUtils.reFormatCardNumber);
                //el.addEventListener('input', cardUtils.setCardType);
            }
        },
        'card-expiry':{
            created(el){
                el.addEventListener('keypress', cardUtils.restrictNumeric);
                el.addEventListener('keypress', cardExpiryUtils.formatExpiry);
                el.addEventListener('keypress', cardExpiryUtils.formatForwardSlashAndSpace);
                el.addEventListener('keypress', cardExpiryUtils.formatForwardExpiry);
                el.addEventListener('keydown', cardExpiryUtils.formatBackExpiry);
                el.addEventListener('change', cardExpiryUtils.reFormatExpiry);
                el.addEventListener('input', cardExpiryUtils.reFormatExpiry);
                el.addEventListener('blur', cardExpiryUtils.reFormatExpiry);
            }
        },
        'card-cvc':{
            created(el){
                el.addEventListener('keypress', cardUtils.restrictNumeric);  
                el.addEventListener('keypress', cardCvcUtils.restrictCVC);
                el.addEventListener('paste', cardCvcUtils.reFormatCVC);
                el.addEventListener('change', cardCvcUtils.reFormatCVC);
                el.addEventListener('input', cardCvcUtils.reFormatCVC);
            }
        }
    },
}
</script>