/**
 * Created by bert on 20/06/2015.
 */
var Calendar = {
    weekDays: [['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],['Zo','Ma','Di','Wo','Do','Vr','Za']],
    months: [['January','February','March', 'April','May','June','July','August','September','October','November','December'],
        ['Januari','Februari','Maart', 'April','Mei','Juni','Juli','Augustus','September','Oktober','November','December']],
    monthDays: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
    currentDate: new Date(),
    month: null,
    year: null,
    firstMonthDay: null,
    html: '',
    initCal : function (month, year) {
        this.month = (isNaN(month) || month == null) ? this.currentDate.getMonth() : month;
        this.year  = (isNaN(year) || year == null) ? this.currentDate.getFullYear() : year;
        this.firstMonthDay = this.getFirstMonthDay();
        this.html = '';

        this.generateCal();
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

        this.html += '<table id="calendar-grid" border="1">';
        this.html += '<tr>';
        this.html += '<th colspan="7">';
        this.html += this.months[1][this.month];
        this.html += '</th>';
        this.html += '</tr>';
        this.html += '<tr>';
        for (i = 0; i < 7; i++) {
            this.html += '<th>' + this.weekDays[1][i] + '</th>';
        }
        this.html += '</tr>';
        for (i = 2; i < 8; i++) {
            this.html += '<tr>';
            for (x = 0; x < 7; x++) {

                if (dayCounter > this.monthDays[this.month]) {
                    break;
                }
                else {
                    if (dayCounter === 1) {
                        while (x < this.firstMonthDay) {
                            this.html += '<td></td>';
                            x++;
                        }
                        this.html += '<td><div>' + dayCounter + '</div><div id="' + this.getDayAsTime(dayCounter) + '"></div></td>';
                    }
                    else {
                        this.html += '<td><div>' + dayCounter + '</div><div id="' + this.getDayAsTime(dayCounter) + '"></div></td>';
                    }
                    dayCounter++;
                }
            }
            this.html += '</tr>';
        }
        this.html += '</table>';
    },
    attachCal: function (id) {
        document.getElementById(id).innerHTML = "";
        document.getElementById(id).insertAdjacentHTML('beforeend', this.html);
    },
    loadEventsIntoCal: function () {
        for (var i = 1; i < this.monthDays[this.month]; i++) {
            var eventList = EventController.getEventsByDate(this.getDayAsTime(i));
            for (var key in eventList) {
                var html = '';
                html += '<div id="' + eventList[key].id + '">';
                html += '<a href="#event-detail">' + eventList[key].name + '</a>';
                html += '</div>';
                document.getElementById(this.getDayAsTime(i)).insertAdjacentHTML('beforeend', html);

                document.getElementById(eventList[key].id).children[0].addEventListener("click", function () {
                    Ajax.getOneEventById(this.parentNode.id);
                });
            }
        }
    },
    getDayAsTime: function (day) {
        // Keeping in mind that the property this.month is an index of the array months, and that the month January has the index 0,
        // we need to use alternative ways to create date objects of these properties.
        // this methode does just that.
        // It accepts a day paramter which is numeric and uses it together with the global vars this.year and this.month to create a date object.
        // When we use a string to create a date object, it will interpretate it as a real date.
        // when using the methode below were we use variables as prameters it wil interprate the month value as an index for the associated month.
        // so when we use the month 5 it will become 4 as in april.
        // this method is nessacerry because the controller compares dates on date.getTime.
        // so the date must be correct.
        return new Date(this.year, this.month, day, 0, 0, 0).getTime();
    },
    displayEvent: function () {
        var html = '';
        html += '<p>Naam: ' + EventController.event.name + '</p>';
        html += '<p>Datum: ' + EventController.event.date + '</p>';
        html += '<p>Locatie: ' + EventController.event.locationName + '</p>';
        html += '<p>Adres: ' + EventController.event.locationAddress + '</p>';
        html += '<p>Omschrijving: ' + EventController.event.description + '</p>';
        this.resetDisplay();
        document.getElementById('event-detail').insertAdjacentHTML('afterbegin',html);
    },
    resetDisplay: function () {
        document.getElementById('event-detail').innerHTML = '';
    },
    monthDecrease: function () {
        if (this.month < 1) {
            this.initCal(11,this.year - 1)
        }
        else {
            this.initCal(this.month - 1, this.year)
        }
        this.attachCal('calendar');
        EventController.loadEvents();
    },
    monthIncrease: function () {
        if (this.month > 10) {
            this.initCal(0 ,this.year + 1)
        }
        else {
            this.initCal(this.month + 1, this.year)
        }
        this.attachCal('calendar');
        EventController.loadEvents();
    }
};

(function () {
    document.getElementById('calendar-month-decrease').addEventListener("click", function () {
        Calendar.monthDecrease();
    });
    document.getElementById('calendar-month-increase').addEventListener("click", function () {
        Calendar.monthIncrease();
    });
})();