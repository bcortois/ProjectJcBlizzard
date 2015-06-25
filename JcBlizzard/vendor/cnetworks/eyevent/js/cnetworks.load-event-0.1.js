/**
 * Created by bert on 22/06/2015.
 */
var Ajax = {
    events: null,
    getAllEvents: function (url) {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, true );
        xmlHttp.onreadystatechange = function() {
            var status;
            if (xmlHttp.readyState == 4) {
                status = xmlHttp.status;
                if (status == 200) {
                    EventController.events = JSON.parse(xmlHttp.responseText);
                    Calendar.loadEventsIntoCal();
                }
                else {
                    // failed
                }
            }
            else {
                // pending
            }
        };
        xmlHttp.send();
    },
    getOneEventById: function (eventId) {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", '../controller/LoadOneEventById.php?id=' + eventId, true );
        xmlHttp.onreadystatechange = function() {
            var status;
            if (xmlHttp.readyState == 4) {
                status = xmlHttp.status;
                if (status == 200) {
                    EventController.event = JSON.parse(xmlHttp.responseText);
                    //document.write('ajax executed successfully.')
                    Calendar.displayEvent();
                }
                else {
                    // failed
                }
            }
            else {
                // pending
            }
        };
        xmlHttp.send();
    }
};

var EventController = {
    events: null,
    event: null,
    loadEvents: function () {
        if (this.events) {
            Calendar.loadEventsIntoCal();
        }
        else {
            Ajax.getAllEvents('../controller/LoadAllEvents.php');
        }
    },
    getEventsByDate: function (dateInTime) {
        if (this.events != null) {
            var list = Array();
            for(var key in this.events) {
                var eventDate = new Date(this.events[key].date.slice(0,-9));
                // The next method ensures that the time of the date object is set to 0.
                // When u declare a date object by use of a string as parameter, the hours default to 02:00.
                eventDate.setHours(0,0,0,0);
                if(dateInTime === eventDate.getTime()) {
                    list.push(this.events[key]);
                }
            }
            return list;
        }
        else {
            return false;
        }
    }
};