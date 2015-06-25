/**
 * Created by bert on 11/06/2015.
 */


var app = {
    // This array stores all the name attributes of the fields used to assign a name to an inputField.
    // If we supply this data, together with the data obtained from the form, to the back-end controller in php.
    // We have the knowledge to know which queries to look for. (e.g. input-field-name-2, input-field-name-10, input-field-name-11, input-field-name-13, ..)
    inputFieldNames: ['input-field-name-1'],
    // the counter var has a simple use. It counts how many times a div, containing the necessary form fields to be able to add a inputField,
    // is added. This information is used to generate new fields when a user uses 'addInputField()'.
    counter: 1,
    addInputField: function () {
        // the counter gets added by one, this value will can now be used to make unique names and id's for the new fields.
        this.counter++;

        // this variable stores the DOM element containing the divs which inturn contain the fields to add a inputField.
        var fieldContainer = document.getElementById('create-form-input-fields');
        // Follow function writes HTML just before the closing of the DOM element stored in 'fieldContainer'.
        // The counter is used to add a unique number to the names and id's of the fields.
        // at the bottom of the html, a button gets added to which is liked to a function that, when executed, deletes this block of HTML out of the DOM.
        fieldContainer.insertAdjacentHTML('beforeend', '<div><label id="input-field-name-' + this.counter + '">Naam van het veld: </label>' +
            '<input type="text" id="input-field-name-' + this.counter + '" name="input-field-name-' + this.counter + '" />' +
            '<label id="input-field-comment-' + this.counter + '">Commentaar: </label>' +
            '<input type="text" id="input-field-comment-' + this.counter + '" name="input-field-comment-' + this.counter + '" />' +
            '<label id="input-field-position-' + this.counter + '">Volgorde: </label>' +
            '<input type="text" id="input-field-position-' + this.counter + '" name="input-field-position-' + this.counter + '" />' +
            '<label id="input-field-type-' + this.counter + '">Type veld: </label>' +
            '<select id="input-field-type-' + this.counter + '" name="input-field-type-' + this.counter + '">' +
            '<option value="text">text</option>' +
            '<option value="checkbox">checkbox</option>' +
            '</select>' +
            '<input type="button" id="create-form-delete-field-' + this.counter + '" value="X" />' +
            '</div>'
        );

        // the name attribute of the field 'input-field-name-(nummer)' is added at the end of the array.
        var inputFieldName = 'input-field-name-'.concat(this.counter);
        this.inputFieldNames.push(inputFieldName);

        // the following code will add a event listener to the delete button from this field div.
        // the key click of the event dictionary points to a anonymous function which calls the remove InputField function.

        // the reason behind the wrapping anonymous function is not 100% proven, it's possible it only work this way because
        // when supplying the function with the parameter directly, it gets execute directly.
        // another reason could be the 'this' parameter.
        // if we don't store it in a anonymous function, this will reference to this function and not the element
        // that stores the event dictionary.
        var deleteButton = document.getElementById('create-form-delete-field-'.concat(this.counter));
        deleteButton.addEventListener("click", function () {
            app.removeInputField(this)
        });
    },
    removeInputField: function (trigger) {
        // The parameter 'tigger' is a reference to the DOM element which called the function.
        // The DOM element using this function is the button which is supplied at the end of the html in the function 'addInputField'.
        // The following code removes the name attribute and the parent div of the field associated with the calling button.

        // inputFieldName contains the value of the name attribute of the inputField 'input-field-name-(nummer)'.
        var inputFieldName = 'input-field-name-'.concat(trigger.id.substr(25));
        // index is the position in the array where the name attribute is stored.
        var index = this.inputFieldNames.indexOf(inputFieldName);
        if (index > -1) {
            // this deletes the row from the array containg the name attribute.
            this.inputFieldNames.splice(index, 1);
        }
        // this removes the parent div which contains all the inputs associated with the inputField.
        trigger.parentNode.parentNode.removeChild(trigger.parentNode);
    },
    submitData: function () {
        //document.write(this.inputFieldNames.toString());
        var querystring = this.inputFieldNames.toString();
        document.getElementById('input-field-names').setAttribute("value", querystring);
    }
};

(function () {
     // initiate event listeners and attribute at document ready.
    document.getElementById('create-form-delete-field-1').addEventListener("click", function () {
        app.removeInputField(this)
    });
    document.getElementById('create-form-add-field').addEventListener("click", function () {
        app.addInputField()
    });
    document.getElementById('event-form').addEventListener("submit", function () {
        app.submitData()
    });
})();