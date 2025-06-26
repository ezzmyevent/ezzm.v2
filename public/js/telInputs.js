//for contact 1
window.intlTelInput(input1,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti1 = window.intlTelInputGlobals.getInstance(input1);
input1.addEventListener("countrychange", function() {
    var a=  iti1.getSelectedCountryData();
    $('#countryCode1').val('+'+a.dialCode);
});

//for contact 2
window.intlTelInput(input2,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti2 = window.intlTelInputGlobals.getInstance(input2);
input2.addEventListener("countrychange", function() {
    var a=  iti2.getSelectedCountryData();
    $('#countryCode2').val('+'+a.dialCode);
});

//for contact 3
window.intlTelInput(input3,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti3 = window.intlTelInputGlobals.getInstance(input3);
input3.addEventListener("countrychange", function() {
    var a=  iti3.getSelectedCountryData();
    $('#countryCode3').val('+'+a.dialCode);
});

//for contact 4
window.intlTelInput(input4,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti4 = window.intlTelInputGlobals.getInstance(input4);
input4.addEventListener("countrychange", function() {
    var a=  iti4.getSelectedCountryData();
    $('#countryCode4').val('+'+a.dialCode);
});

//for contact 5
window.intlTelInput(input5,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti5 = window.intlTelInputGlobals.getInstance(input5);
input5.addEventListener("countrychange", function() {
    var a=  iti5.getSelectedCountryData();
    $('#countryCode5').val('+'+a.dialCode);
});

//for contact 6
window.intlTelInput(input6,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti6 = window.intlTelInputGlobals.getInstance(input6);
input6.addEventListener("countrychange", function() {
    var a=  iti6.getSelectedCountryData();
    $('#countryCode6').val('+'+a.dialCode);
});

//for contact 7
window.intlTelInput(input7,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti7 = window.intlTelInputGlobals.getInstance(input7);
input7.addEventListener("countrychange", function() {
    var a=  iti7.getSelectedCountryData();
    $('#countryCode7').val('+'+a.dialCode);
});

//for contact 8
window.intlTelInput(input8,({
    autoHideDialCode: false,
    autoPlaceholder: "off",
    nationalMode: true,
    separateDialCode: true,
    initialCountry: 'in',
    preferredCountries: ["in"]
}));
var iti8 = window.intlTelInputGlobals.getInstance(input8);
input8.addEventListener("countrychange", function() {
    var a=  iti8.getSelectedCountryData();
    $('#countryCode8').val('+'+a.dialCode);
});