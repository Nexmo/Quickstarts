# VoiceXML: Catching Errors

Like an HTML form, any data should be validated server side before it's used. However, just like HTML provides for 
useful client side validation, VoiceXML helps you avoid complex server side validation by providing ways to validate 
data before the form is submitted.

VoiceXML throws a few common form events which can be caught using a `<catch>` element. However, it can be much easier 
to use the shorthand elements that directly match the event name.

The `<noinput>` element will catch a `noinput` event thrown when the caller doesn't provide any speech or DTMF input.
Similarly, `<nomatch>` catches the event thrown when the caller provides input that cannot be matched to any defined
grammar. 

For `<noinput>` it may be appropriate to notify the user that nothing was heard, and use `<reprompt>` have the field's
prompt read again. 

[Example](./vxml/form.vxml#L20-L23)

When `<nomatch>` is caught, `<reprompt>` can be used with the `count` attribute of `<prompt>` to change the field's 
prompt. When a field has multiple `<prompt>` elements with different `count` attributes, the highest count that is not 
greater than the counter is used. The default value for `count` is 1.

[Example](./vxml/form.vxml#L28-L31)

[Example](./vxml/form.vxml#L7-L9)

The matching event for `<help>` is thrown when user seems to be asking for help. A more detailed prompt may be useful 
in that case.

[Example](./vxml/form.vxml#L32-L38)

Finally, `<error>` can be used to catch any error event, and avoid an unexplained disconnection to the caller. 

[Example](./vxml/form.vxml#L39-L42)

The `<catch>` element can be used for finer control over events and `<throw>` can be used to throw events. Find out more
about [`<catch>`][catch] [`<throw>`][catch] and how to [handle events][events] at the W3C's documentation.
 
This example also sets a few speech recognizer properties, `confidencelevel` and `universals`. `confidencelevel` sets
the needed confidence level needed for a successful match. `universals` enables recognition of common grammar, in this
case 'help' is recognized and results in an event.  The W3C's documentation has more about 
[Platform Specific Properties][properties] 
 
Example: [Full VXML](./vxml/form.vxml)

Once the form is submitted, validation server side can ensure the data is as expected without needing additional logic 
to drive user interaction.

Example: [PHP](./php/form.php)

Ready for more? Check out the W3C's documentation of [VoiceXML events][events].

[properties]: http://www.w3.org/TR/voicexml20/#dml6.3.1
[events]: http://www.w3.org/TR/voicexml20/#dml5.2
[throw]: http://www.w3.org/TR/voicexml20/#dml5.2.1
[catch]: http://www.w3.org/TR/voicexml20/#dml5.2.2
