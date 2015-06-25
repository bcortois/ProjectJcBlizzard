/**
 * Created by bert on 15/06/2015.
 */

var app = {
    weekDays: [['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],['Zo','Ma','Di','Wo','Do','Vr','Za']],
    months: [['January','February','March', 'April','May','June','July','August','September','October','November','December'],
        ['Januari','Februari','Maart', 'April','Mei','Juni','Juli','Augustus','September','Oktober','November','December']],
    monthDays: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
    currentDate: new Date(),
    month: null,
    year: null,
    firstMonthDay: null,
    initCal : function (month, year) {
        this.month = (isNaN(month) || month == null) ? this.currentDate.getMonth() : month;
        this.year  = (isNaN(year) || year == null) ? this.currentDate.getFullYear() : year;
        this.firstMonthDay = this.getFirstMonthDay();
        this.html = '';
    },
    getFirstMonthDay: function () {
        var firstDay = new Date(this.year, this.month, 1);
        return firstDay.getDay();
    },
    checkLeapYear: function() {
        if (this.month == 1) {
            if ((this.year % 4 == 0 && this.year % 100 != 0) || this.year % 400 == 0){
                this.monthDays[1] = 29;
            }
        }
    },
    generateCal: function () {
        this.checkLeapYear();
        var dayCounter = 1;
        var calendar = document.getElementById('calendar');
        var tableRows = document.getElementById('calendar-grid').children[0].children;

        tableRows[0].children[0].insertAdjacentText('afterbegin', this.months[1][this.month]);
        for (i = 0; i < 7; i++) {
            tableRows[1].children[i].insertAdjacentText('afterbegin', this.weekDays[1][i]);
        }
        for (i = 2; i < 8; i++) {
            for (x = 0; x < 7; x++) {
                if (dayCounter > this.monthDays[this.month]) {
                    break;
                }
                else {
                    if (dayCounter === 1) {
                        x = this.firstMonthDay;
                        tableRows[i].children[x].insertAdjacentText('afterbegin', dayCounter);
                    }
                    else {
                        tableRows[i].children[x].insertAdjacentText('afterbegin', dayCounter);
                    }
                    dayCounter++;
                }
            }
        }
    }
};
