<template>
    <div class="w-full max-w-sm px-4">
        <Popover>
            <PopoverButton ref="popButton" @click="openPanel()" type="button" class="relative flex items-center border border-accent-900 rounded h-8 pl-2 pr-7 text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-gray-200 focus:ring-accent-800" id="datepicker-menu" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open date popup</span>
                <svg class="flex-shrink-0 h-5 w-5 text-accent-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <input :value="day" type="hidden" name="day">
                <h3 ref="dateText" class="mx-2 pt-1 text-xs text-gray-500 font-semibold">{{ displayDate }}</h3>
            </PopoverButton>
            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform -translate-x-10 translate-y-0 translate-y-0 scale-50 opacity-0"
                enter-to-class="transform translate-x-0 translate-y-0 translate-y-0 scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-out"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-50 opacity-0">
                <div ref="outerWrap">
                    <PopoverPanel class="w-72 z-10 border mt-1 mb-2 border-gray-300 rounded-md origin-top shadow-lg outline-none">
                        <header class="flex justify-around bg-primary-100 rounded-t-md py-2 px-8">
                            <button :title="prevMonthCaption" class="rounded-full p-1 bg-primary-300 hover:bg-primary-400" @click="incrementMonth(-1)" type="button">
                                <svg class="h-4 w-4 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <div class="flex items-center mx-2">
                                <button class="ml-2 text-gray-800" :class="directionClass" :key="currentPeriod.month" type="button">{{ months[currentPeriod.month] }}</button>
                                <button class="ml-2 text-gray-800" :class="directionClass" :key="currentPeriod.year" type="button"> {{ currentPeriod.year }}</button>
                            </div>
                            <button :title="nextMonthCaption" class="rounded-full p-1 bg-primary-300 hover:bg-primary-400" @click="incrementMonth(1)" type="button">
                                <svg class="h-4 w-4 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </header>
                        <table class="table-fixed bg-white rounded-b-md relative w-full z-5">
                            <thead>
                                <tr class="bg-primary-100">
                                    <th class="py-2 px-2" v-for="(weekday, weekdayIndex) in weekdaysSorted" :key="weekdayIndex">
                                        <span class="text-xs text-gray-500">{{weekday}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody :key="currentPeriod.year + '-' + currentPeriod.month" :class="directionClass">
                                <tr v-for="(week, weekIndex) in currentPeriodDates" :key="weekIndex">
                                    <td class="pl-2 py-2" v-for="item in week" :key="item.dateKey"
                                        :class="{
                                            'cursor-pointer rounded-full hover:text-white hover:bg-accent-600': !item.disabled,//selectable
                                            'text-white bg-accent-600': item.selected,//selected
                                            'opacity-50': item.disabled,//disabled
                                            'text-accent-800': item.today,//today
                                            'text-gray-400': item.outOfRange//out of range
                                        }"
                                        :data-id="item.dateKey"
                                        @click="selectDateItem(item)">
                                        <div class="flex leading-6 w-6 font-semibold text-xs justify-center items-center my-0">
                                            <p class="text-center">{{ item.date.getDate() }}</p>
                                        </div>
                                    </td>    
                                </tr>    
                            </tbody>
                        </table>
                    </PopoverPanel>
                </div>  
            </transition>
        </Popover>    
    </div>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
const formatRE = /,|\.|-| |:|\/|\\/;
const dayRE = /D+/;
const monthRE = /M+/;
const yearRE = /Y+/;
export default{
    name: 'Datepicker',
    props: {
        date:{
            type:Date,
            default: function () { return new Date() }
        },
        format: {
            type: String,
            default: 'DD.MM.YYYY'
        },
        displayFormat: {
            type: String
        },
        selectableYearRange: {
            type: [Number, Object, Function],
            default: 2
        },
        startPeriod: {
            type: Object
        },
        isDateDisabled: {
            type: Function,
            default: () => false
        },
        nextMonthCaption: {
            type: String,
            default: 'Next month'
        },
        prevMonthCaption: {
            type: String,
            default: 'Previous month'
        },
        mobileBreakpointWidth: {
            type: Number,
            default: 500
        },
        weekdays: {
            type: Array,
            default: () => ([
                'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'
            ])
        },
        months: {
            type: Array,
            default: () => ([
                'January', 'February', 'March', 'April',
                'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ])
        },
        startWeekOnSunday: {
            type: Boolean,
            default: false
        }
    },
    data(){
        return{
            direction: undefined,
            positionClass: undefined,
            day: this.formatDateToString(this.date, this.format),
            selectedDate: this.formatDateToString(this.date, this.format),
            currentPeriod: this.startPeriod || this.getPeriodFromValue(
                this.selectedDate, this.format
            )
        };
    },
    computed: {
        displayDate(){
            const day = String(this.valueDate.getDate()).padStart(2,'0');
            const month = String(this.valueDate.getMonth() + 1).padStart(2, '0');
            const year = this.valueDate.getFullYear();
            const fulldate = day+'-'+month+'-'+year;
            return fulldate.toString();
        },
        valueDate() {
            const value = this.selectedDate;
            return value
                ? this.parseDateString(value, this.format)
                : undefined;
        },
        isValidValue() {
            const valueDate = this.valueDate;
            return this.selectedDate ? Boolean(valueDate) : true;
        },
        currentPeriodDates() {
            const {year, month} = this.currentPeriod;
            const days = [];
            const date = new Date(year, month, 1);
            const today = new Date();
            today.setHours(0,0,0,0);
            const offset = this.startWeekOnSunday ? 1 : 0;
            // append prev month dates
            const startDay = date.getDay() || 7;
            if (startDay > (1 - offset)) {
                for (let i = startDay - (2 - offset); i >= 0; i--) {
                    const prevDate = new Date(date);
                    prevDate.setDate(-i);
                    days.push({outOfRange: true, date: prevDate});
                }
            }
            while (date.getMonth() === month) {
                if(date < today && (date.getTime() !== today.getTime())){
                    days.push({outOfRange: true, date: new Date(date)});
                    date.setDate(date.getDate() + 1);
                }else{
                    days.push({date: new Date(date)});
                    date.setDate(date.getDate() + 1);
                }
                
            }
            // append next month dates
            const daysLeft = 7 - days.length % 7;
            for (let i = 1; i <= daysLeft; i++) {
                const nextDate = new Date(date);
                nextDate.setDate(i);
                days.push({outOfRange: true, date: nextDate});
            }
            // define day states
            days.forEach(day => {
                day.disabled = this.isDateDisabled(day.date);
                day.today = areSameDates(day.date, today);
                day.dateKey = [
                    day.date.getFullYear(), day.date.getMonth() + 1, day.date.getDate()
                ].join('-');
                day.selected = this.valueDate ? areSameDates(day.date, this.valueDate) : false;
            });
            return chunkArray(days, 7);
        },
        yearRange() {
            const currentYear = this.currentPeriod.year;
            const userRange = this.selectableYearRange;
            const userRangeType = typeof userRange;
            let yearsRange = [];
            if (userRangeType === 'number') {
                yearsRange = range(
                    currentYear - userRange,
                    currentYear + userRange
                );
            } else if (userRangeType === 'object') {
                yearsRange = range(
                    userRange.from,
                    userRange.to
                );
            } else if (userRangeType === 'function') {
                yearsRange = userRange(this);
            }
            if (yearsRange.indexOf(currentYear) < 0) {
                yearsRange.push(currentYear);
                yearsRange = yearsRange.sort();
            }
            return yearsRange;
        },
        directionClass() {
            return this.direction ? `${this.direction}Direction` : undefined;
        },
        weekdaysSorted() {
            if (this.startWeekOnSunday) {
                const weekdays = this.weekdays.slice();
                weekdays.unshift(weekdays.pop());
                return weekdays;
            } else {
                return this.weekdays;
            }
        }
    },
    watch:{
        currentPeriod(currentPeriod, oldPeriod) {
            const currentDate = new Date(currentPeriod.year, currentPeriod.month).getTime();
            const oldDate = new Date(oldPeriod.year, oldPeriod.month).getTime();
            this.direction = currentDate !== oldDate
                ? (currentDate > oldDate ? 'Next' : 'Prev')
                : undefined;
            if (currentDate !== oldDate) {
                this.$emit('periodChange', {
                    year: currentPeriod.year,
                    month: currentPeriod.month
                });
            }
        }
    },
    beforeUnmount() {
        this.teardownPosition();
    },
    methods:{
        getPeriodFromValue(dateString, format) {
            const date = this.parseDateString(dateString, format) || new Date();
            return {month: date.getMonth(), year: date.getFullYear()};
        },
        parseDateString(dateString, dateFormat) {
            return !dateString
                ? undefined
                : this.parseSimpleDateString(dateString, dateFormat)
            ;
        },
        formatDateToString(date, dateFormat) {
            return !date
                ? ''
                : this.formatSimpleDateToString(date, dateFormat)
            ;
        },
        formatSimpleDateToString(date, dateFormat) {
            return dateFormat
                .replace(dayRE, match => paddNum(date.getDate(), match.length))
                .replace(monthRE, match => paddNum(date.getMonth() + 1, match.length))
                .replace(yearRE, match => Number(date.getFullYear().toString().slice(-match.length)))
                ;
        },
        parseSimpleDateString(dateString, dateFormat) {
            let day, month, year;//, hours, minutes, seconds;
            const dateParts = dateString.split(formatRE);
            const formatParts = dateFormat.split(formatRE);
            const partsSize = formatParts.length;
            for (let i = 0; i < partsSize; i++) {
                if (formatParts[i].match(dayRE)) {
                    day = parseInt(dateParts[i], 10);
                } else if (formatParts[i].match(monthRE)) {
                    month = parseInt(dateParts[i], 10);
                } else if (formatParts[i].match(yearRE)) {
                    year = parseInt(dateParts[i], 10);
                }
            };
            const resolvedDate = new Date(
                [paddNum(year, 4), paddNum(month, 2), paddNum(day, 2)].join('-')
            );
            if (isNaN(resolvedDate)) {
                return undefined;
            } else {
                const date = new Date(year, month - 1, day);
                [
                    [year, 'setFullYear'],
                ].forEach(([value, method]) => {
                    typeof value !== 'undefined' && date[method](value);
                });
                return date;
            }
        },
        incrementMonth(increment = 1) {
            const refDate = new Date(this.currentPeriod.year, this.currentPeriod.month);
            const incrementDate = new Date(refDate.getFullYear(), refDate.getMonth() + increment);
            this.currentPeriod = {
                month: incrementDate.getMonth(),
                year: incrementDate.getFullYear()
            };
        },
        setupPosition() {
            if (!this.positionEventListener) {
                this.positionEventListener = () => this.positionFloater();
                window.addEventListener('resize', this.positionEventListener);
            }
            this.positionFloater();
        },
        positionFloater() {
            const inputRect = this.$el.getBoundingClientRect();
            let verticalClass = 'vdpPositionTop';
            let horizontalClass = 'vdpPositionLeft';
            const calculate = () => {
                const rect = this.$refs.outerWrap.getBoundingClientRect();
                const floaterHeight = rect.height;
                const floaterWidth = rect.width;
                if (window.innerWidth > this.mobileBreakpointWidth) {
                    // vertical
                    if (
                        (inputRect.top + inputRect.height + floaterHeight > window.innerHeight) &&
                        (inputRect.top - floaterHeight > 0)
                    ) {
                        verticalClass = 'vdpPositionBottom';
                    }
                    // horizontal
                    if (inputRect.left + floaterWidth > window.innerWidth) {
                        horizontalClass = 'vdpPositionRight';
                    }
                    this.positionClass = ['vdpPositionReady', verticalClass, horizontalClass].join(' ');
                } else {
                    this.positionClass = 'vdpPositionFixed';
                }
            };
            this.$refs.outerWrap ? calculate() : this.$nextTick(calculate);
        },
        teardownPosition() {
            if (this.positionEventListener) {
                this.positionClass = undefined;
                window.removeEventListener('resize', this.positionEventListener);
                delete this.positionEventListener;
            }
        },
        selectDateItem(item) {
            if (!item.disabled && !item.outOfRange) {              
                const newDate = new Date(item.date);
                this.selectedDate = this.formatDateToString(newDate, this.format);
                //this.$refs.rolloutDay.value
                this.day = this.formatDateToString(newDate, this.format);
                this.close(); 
            }
        },
        openPanel() {
            this.currentPeriod = this.startPeriod || this.getPeriodFromValue(this.selectedDate, this.format);
            this.setupPosition();
            this.direction = undefined;
        },
        close() {
            this.$refs.popButton.$el.click();//workaround to close panel
            this.teardownPosition();
        },    
    },
    components:{ 
        Popover,
        PopoverButton, 
        PopoverPanel
    }
};
function paddNum(num, padsize) {
    return typeof num !== 'undefined'
        ? num.toString().length > padsize
            ? num
            : new Array(padsize - num.toString().length + 1).join('0') + num
        : undefined
    ;
}
function chunkArray(inputArray, chunkSize) {
    const results = [];
    while (inputArray.length) {
        results.push(inputArray.splice(0, chunkSize));
    }
    return results;
}
function areSameDates(date1, date2) {
    return (date1.getDate() === date2.getDate()) &&
        (date1.getMonth() === date2.getMonth()) &&
        (date1.getFullYear() === date2.getFullYear())
    ;
}
function range(start, end) {
    const results = [];
    for (let i = start; i <= end; i++) {
        results.push(i);
    }
    return results;
}
</script>

<style>
@keyframes SlideFromLeft {
    from { opacity: 0; transform: translate3d(-0.5em,0,0); }
    to { opacity: 1; transform: translate3d(0,0,0); }
}
@keyframes SlideFromRight {
    from { opacity: 0; transform: translate3d(0.5em,0,0); }
    to { opacity: 1; transform: translate3d(0,0,0); }
}
.NextDirection{
    animation: SlideFromRight 0.5s;
}
.PrevDirection{
    animation: SlideFromLeft 0.5s;
}
</style>
